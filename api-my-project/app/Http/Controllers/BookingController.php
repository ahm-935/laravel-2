<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Event;
use App\Models\Payment;
use App\Models\TicketType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /**
     * Show bookings belonging to the logged-in user.
     * Guest bookings are not listed here.
     */
    public function index()
    {
        abort_unless(Auth::check(), 401);

        $bookings = Booking::with([
            'event',
            'ticketType',
            'payment',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        // return view('bookings.index', compact('bookings'));
        return response()->json($bookings);
    }

    /**
     * Display the public booking form.
     */
    public function create(Event $event)
    {
        abort_unless($event->status === 'active', 404);

        $event->load([
            'ticketTypes' => function ($query) {
                $query->where('status', 'active')
                    ->where('available_quantity', '>', 0);
            },
        ]);

        return view('events.booking', compact('event'));
    }

    /**
     * Create a guest or authenticated user's cash booking.
     *
     * Booking remains pending until an admin confirms receipt
     * of the cash payment.
     */
    public function store(Request $request, Event $event)
    {
        $data = $request->validate([
            'tickets' => ['required', 'array', 'min:1'],
            'tickets.*' => ['nullable', 'integer', 'min:0'],

            'guest_name' => ['required', 'string', 'max:255'],
            'guest_email' => ['required', 'email', 'max:255'],
            'guest_phone' => ['required', 'string', 'max:30'],
        ]);

        if ($event->status !== 'active') {
            return back()
                ->withInput()
                ->with('error', 'This event is not available for booking.');
        }

        $tickets = collect($data['tickets'])
            ->filter(fn($quantity) => (int) $quantity > 0);

        if ($tickets->isEmpty()) {
            return back()
                ->withInput()
                ->with('error', 'Please select at least one ticket.');
        }

        // Current bookings table supports one ticket type per booking.
        if ($tickets->count() !== 1) {
            return back()
                ->withInput()
                ->with(
                    'error',
                    'Please select only one ticket type at a time.'
                );
        }

        $ticketTypeId = (int) $tickets->keys()->first();
        $quantity = (int) $tickets->first();

        try {
            $booking = DB::transaction(function () use (
                $event,
                $ticketTypeId,
                $quantity,
                $data
            ) {
                $ticketType = TicketType::whereKey($ticketTypeId)
                    ->where('event_id', $event->id)
                    ->where('status', 'active')
                    ->lockForUpdate()
                    ->first();

                if (! $ticketType) {
                    throw ValidationException::withMessages([
                        'tickets' => 'The selected ticket type is unavailable.',
                    ]);
                }

                if (
                    $quantity < 1 ||
                    $ticketType->available_quantity < $quantity
                ) {
                    throw ValidationException::withMessages([
                        'tickets' => 'Not enough tickets are available.',
                    ]);
                }

                if (
                    $ticketType->sale_start &&
                    now()->lt($ticketType->sale_start)
                ) {
                    throw ValidationException::withMessages([
                        'tickets' => 'Ticket sales have not started yet.',
                    ]);
                }

                if (
                    $ticketType->sale_end &&
                    now()->gt($ticketType->sale_end)
                ) {
                    throw ValidationException::withMessages([
                        'tickets' => 'Ticket sales have ended.',
                    ]);
                }

                $totalPrice = (float) $ticketType->price * $quantity;
                $bookingCode = 'BK-' . strtoupper(Str::random(12));

                $booking = Booking::create([
                    'booking_code' => $bookingCode,
                    'user_id' => Auth::id(),
                    'event_id' => $event->id,
                    'ticket_type_id' => $ticketType->id,
                    'quantity' => $quantity,
                    'unit_price' => $ticketType->price,
                    'total_price' => $totalPrice,
                    'status' => 'pending',

                    'guest_name' => $data['guest_name'],
                    'guest_email' => $data['guest_email'],
                    'guest_phone' => $data['guest_phone'],
                ]);

                Payment::create([
                    'booking_id' => $booking->id,
                    'transaction_id' => $bookingCode,
                    'amount' => $totalPrice,
                    'currency' => 'BDT',
                    'payment_method' => 'cash',
                    'status' => 'pending',
                ]);

                // Do not decrement ticket stock here.
                // Do not confirm the booking here.

                return $booking;
            });

            return redirect()
                ->route('bookings.guest-status', [
                    'bookingCode' => $booking->booking_code,
                ])
                ->with(
                    'success',
                    'Booking submitted. Please pay cash to the admin.'
                );
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->with('error', 'Unable to create booking. Please try again.');
        }
    }

    /**
     * Public status page for a guest.
     * The booking code is a random, unguessable-style reference,
     * but should still be treated as private.
     */
    public function guestStatus(string $bookingCode)
    {
        $booking = Booking::with([
            'event',
            'ticketType',
            'payment',
        ])
            ->where('booking_code', $bookingCode)
            ->firstOrFail();

        return view('payment.success', compact('booking'));
    }

    /**
     * Admin: list bookings awaiting cash payment.
     */
    public function cashPending()
    {
        $this->ensureAdmin();

        $bookings = Booking::with([
            'user',
            'event',
            'ticketType',
            'payment',
        ])
            ->where('status', 'pending')
            ->whereHas('payment', function ($query) {
                $query->where('payment_method', 'cash')
                    ->where('status', 'pending');
            })
            ->latest()
            ->paginate(15);

        return view('admin.pages.bookings.cash-pending', compact('bookings'));
    }

    /**
     * Admin: confirm receipt of cash.
     *
     * Payment and booking are updated in one transaction.
     * Ticket quantity is reduced only once.
     */
    public function markCashPaid(Booking $booking)
    {
        $this->ensureAdmin();

        try {
            DB::transaction(function () use ($booking) {
                $lockedBooking = Booking::whereKey($booking->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $payment = Payment::where(
                    'booking_id',
                    $lockedBooking->id
                )
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $lockedBooking->status !== 'pending' ||
                    $payment->status !== 'pending' ||
                    $payment->payment_method !== 'cash'
                ) {
                    throw ValidationException::withMessages([
                        'booking' => 'This booking is not awaiting cash payment.',
                    ]);
                }

                $ticketType = TicketType::whereKey(
                    $lockedBooking->ticket_type_id
                )
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $ticketType->available_quantity <
                    $lockedBooking->quantity
                ) {
                    throw ValidationException::withMessages([
                        'booking' => 'Not enough tickets are currently available.',
                    ]);
                }

                $payment->update([
                    'status' => 'paid',
                    'paid_at' => now(),
                ]);

                $lockedBooking->update([
                    'status' => 'confirmed',
                ]);

                $ticketType->decrement(
                    'available_quantity',
                    $lockedBooking->quantity
                );
            });

            return back()->with(
                'success',
                'Cash received. Payment marked paid and booking confirmed.'
            );
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Unable to confirm payment. Please try again.'
            );
        }
    }

    /**
     * Admin: cancel an unpaid cash booking.
     * No stock adjustment is needed because stock is reserved only
     * when payment is confirmed.
     */
    public function cancelCashBooking(Booking $booking)
    {
        $this->ensureAdmin();

        try {
            DB::transaction(function () use ($booking) {
                $lockedBooking = Booking::whereKey($booking->id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $payment = Payment::where(
                    'booking_id',
                    $lockedBooking->id
                )
                    ->lockForUpdate()
                    ->firstOrFail();

                if (
                    $lockedBooking->status !== 'pending' ||
                    $payment->status !== 'pending' ||
                    $payment->payment_method !== 'cash'
                ) {
                    throw ValidationException::withMessages([
                        'booking' => 'Only pending cash bookings can be cancelled.',
                    ]);
                }

                $payment->update([
                    'status' => 'cancelled',
                ]);

                $lockedBooking->update([
                    'status' => 'cancelled',
                ]);
            });

            return back()->with('success', 'Cash booking cancelled.');
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Throwable $e) {
            report($e);

            return back()->with(
                'error',
                'Unable to cancel booking. Please try again.'
            );
        }
    }

    /**
     * Show booking details to its owner.
     */
    public function show(Booking $booking)
    {
        abort_unless(
            Auth::check() && $booking->user_id === Auth::id(),
            403
        );

        $booking->load(['event', 'ticketType', 'payment']);

        return view('bookings.show', compact('booking'));
    }

    /**
     * Show a printable ticket only after admin confirms payment.
     */
    public function ticket(Booking $booking)
    {
        abort_unless(
            Auth::check() && $booking->user_id === Auth::id(),
            403
        );

        $booking->load(['event', 'ticketType', 'payment']);

        abort_unless(
            $booking->status === 'confirmed' &&
                $booking->payment?->status === 'paid',
            403,
            'Your ticket will be available after payment is confirmed.'
        );

        return view('bookings.ticket', compact('booking'));
    }

    /**
     * Admin authorization.
     *
     * This example assumes role_id = 1 is the admin role.
     * Change the ID if your database uses another admin role ID.
     */
    private function ensureAdmin(): void
    {
        abort_unless(
            Auth::check() &&
                (string) Auth::user()->role_id === '1',
            403,
            'Only administrators can perform this action.'
        );
    }

    /**
     * React API: create a pending cash booking.
     * Payment must be verified by an admin before confirmation.
     */
    public function apiCashBooking(Request $request)
    {
        $data = $request->validate([
            'event_id' => ['required', 'integer', 'exists:events,id'],
            'ticket_type_id' => ['required', 'integer', 'exists:ticket_types,id'],
            'quantity' => ['required', 'integer', 'min:1', 'max:20'],
            'guest_name' => ['required', 'string', 'max:255'],
            'guest_email' => ['required', 'email', 'max:255'],
            'guest_phone' => ['required', 'string', 'max:30'],
        ]);

        $booking = DB::transaction(function () use ($data) {
            $event = Event::whereKey($data['event_id'])
                ->where('status', 'active')
                ->first();

            if (! $event) {
                throw ValidationException::withMessages([
                    'event_id' => 'This event is unavailable.',
                ]);
            }

            $ticketType = TicketType::whereKey($data['ticket_type_id'])
                ->where('event_id', $event->id)
                ->where('status', 'active')
                ->lockForUpdate()
                ->first();

            if (! $ticketType) {
                throw ValidationException::withMessages([
                    'ticket_type_id' => 'The selected ticket is unavailable.',
                ]);
            }

            $quantity = (int) $data['quantity'];

            if ((int) $ticketType->available_quantity < $quantity) {
                throw ValidationException::withMessages([
                    'quantity' => 'Not enough tickets are available.',
                ]);
            }

            if (
                $ticketType->sale_start &&
                now()->lt($ticketType->sale_start)
            ) {
                throw ValidationException::withMessages([
                    'ticket_type_id' => 'Ticket sales have not started.',
                ]);
            }

            if (
                $ticketType->sale_end &&
                now()->gt($ticketType->sale_end)
            ) {
                throw ValidationException::withMessages([
                    'ticket_type_id' => 'Ticket sales have ended.',
                ]);
            }

            $totalPrice = round(
                (float) $ticketType->price * $quantity,
                2
            );

            $bookingCode = 'BK-' . strtoupper(Str::random(12));

            $booking = Booking::create([
                'booking_code' => $bookingCode,
                'user_id' => Auth::id(),
                'event_id' => $event->id,
                'ticket_type_id' => $ticketType->id,
                'quantity' => $quantity,
                'unit_price' => $ticketType->price,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'guest_name' => $data['guest_name'],
                'guest_email' => $data['guest_email'],
                'guest_phone' => $data['guest_phone'],
            ]);

            Payment::create([
                'booking_id' => $booking->id,
                'transaction_id' => $bookingCode,
                'amount' => $totalPrice,
                'currency' => 'BDT',
                'payment_method' => 'cash',
                'status' => 'pending',
            ]);

            // Do not confirm booking or reduce stock here.

            return $booking;
        });

        $booking->load('payment');

        return response()->json([
            'message' => 'Booking submitted. Please pay cash to the admin.',
            'data' => [
                'id' => $booking->id,
                'booking_code' => $booking->booking_code,
                'status' => $booking->status,
                'payment_status' => $booking->payment?->status ?? 'pending',
            ],
        ], 201);
    }
    /**
     * React API: logged-in user's bookings
     */
    public function apiMyBookings()
    {
        $bookings = Booking::with([
            'event',
            'ticketType',
            'payment',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Bookings retrieved successfully.',
            'data' => $bookings,
        ]);
    }
    public function apiDetails(Booking $booking)
    {
        $booking->load([
            'event',
            'ticketType',
            'payment',
        ]);

        return response()->json([
            'data' => $booking,
        ]);
    }
}
