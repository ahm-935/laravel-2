<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\TicketType;
use Illuminate\Http\Request;

class TicketTypeController extends Controller
{
    public function index()
    {
        $ticketTypes = TicketType::with('event')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // return view('admin.pages.ticket_type.index', compact('ticketTypes'));
        return response()->json($ticketTypes);
    }

    public function create(Request $request)
    {
        $events = Event::orderBy('id', 'desc')->get();

        $selectedEventId = $request->event_id;

        return view(
            'admin.pages.ticket_type.create',
            compact('events', 'selectedEventId')
        );
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'available_quantity' => 'required|integer|min:0|lte:quantity',
            'sale_start' => 'nullable|date',
            'sale_end' => 'nullable|date|after_or_equal:sale_start',
            'status' => 'required|in:active,inactive',
        ], [
            'event_id.required' => 'Event is required',
            'event_id.exists' => 'Selected event does not exist',

            'name.required' => 'Ticket name is required',
            'name.max' => 'Ticket name should not exceed 100 characters',

            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price cannot be negative',

            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be a number',
            'quantity.min' => 'Quantity cannot be negative',

            'available_quantity.required' => 'Available quantity is required',
            'available_quantity.integer' => 'Available quantity must be a number',
            'available_quantity.min' => 'Available quantity cannot be negative',
            'available_quantity.lte' => 'Available quantity cannot be greater than total quantity',

            'sale_end.after_or_equal' => 'Sale end must be after or equal to sale start',
        ]);

        $ticketType = new TicketType();

        $ticketType->event_id = $request->event_id;
        $ticketType->name = $request->name;
        $ticketType->description = $request->description;
        $ticketType->price = $request->price;
        $ticketType->quantity = $request->quantity;
        $ticketType->available_quantity = $request->available_quantity;
        $ticketType->sale_start = $request->sale_start;
        $ticketType->sale_end = $request->sale_end;
        $ticketType->status = $request->status;

        if ($ticketType->save()) {

            return redirect()
                ->route('ticket-types.index')
                ->with('success', 'Ticket type created successfully');
        } else {

            return redirect()
                ->route('ticket-types.create')
                ->with('error', 'Ticket type not created');
        }
    }

    public function show(string $id)
    {
        $ticketType = TicketType::with('event')->find($id);

        return view(
            'admin.pages.ticket_type.show',
            compact('ticketType')
        );
    }

    public function edit(string $id)
    {
        $events = Event::orderBy('id', 'desc')->get();

        $ticketType = TicketType::find($id);

        return view(
            'admin.pages.ticket_type.edit',
            compact('ticketType', 'events')
        );
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'event_id' => 'required|exists:events,id',
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'available_quantity' => 'required|integer|min:0|lte:quantity',
            'sale_start' => 'nullable|date',
            'sale_end' => 'nullable|date|after_or_equal:sale_start',
            'status' => 'required|in:active,inactive',
        ], [
            'event_id.required' => 'Event is required',
            'event_id.exists' => 'Selected event does not exist',

            'name.required' => 'Ticket name is required',
            'name.max' => 'Ticket name should not exceed 100 characters',

            'price.required' => 'Price is required',
            'price.numeric' => 'Price must be a number',
            'price.min' => 'Price cannot be negative',

            'quantity.required' => 'Quantity is required',
            'quantity.integer' => 'Quantity must be a number',
            'quantity.min' => 'Quantity cannot be negative',

            'available_quantity.required' => 'Available quantity is required',
            'available_quantity.integer' => 'Available quantity must be a number',
            'available_quantity.min' => 'Available quantity cannot be negative',
            'available_quantity.lte' => 'Available quantity cannot be greater than total quantity',

            'sale_end.after_or_equal' => 'Sale end must be after or equal to sale start',
        ]);

        $ticketType = TicketType::find($id);

        $ticketType->event_id = $request->event_id;
        $ticketType->name = $request->name;
        $ticketType->description = $request->description;
        $ticketType->price = $request->price;
        $ticketType->quantity = $request->quantity;
        $ticketType->available_quantity = $request->available_quantity;
        $ticketType->sale_start = $request->sale_start;
        $ticketType->sale_end = $request->sale_end;
        $ticketType->status = $request->status;

        if ($ticketType->save()) {

            return redirect()
                ->route('ticket-types.index')
                ->with('success', 'Ticket type updated successfully');
        } else {

            return redirect()
                ->route('ticket-types.edit', $id)
                ->with('error', 'Ticket type not updated');
        }
    }

    public function destroy(string $id)
    {
        $ticketType = TicketType::findOrFail($id);

        $ticketType->delete();

        return redirect()
            ->route('ticket-types.index')
            ->with('success', 'Ticket type deleted successfully');
    }
}
