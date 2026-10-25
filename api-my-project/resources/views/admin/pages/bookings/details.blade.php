@extends('admin.layouts.master')

@section('title', 'Booking Details')

@section('content')

    {{-- Page Header --}}
    <div class="border px-3 py-3 mb-3">
        <x-admin.phead
            title="Booking Details"
            subtitle="Show booking information."
        >
            <a href="{{ route('bookings.my') }}"
               class="btn btn-gradient-success">
                <i class="bi bi-arrow-left"></i>
                Back to My Bookings
            </a>
        </x-admin.phead>
    </div>


    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    {{-- Booking Details --}}
    <div class="card">
        <div class="card-body">

            {{-- Customer Information --}}
            <div class="table-user-cell">

                <span class="bg-success rounded-4 d-flex align-items-center justify-content-center
                    text-lime fw-bold fs-2 px-4 py-3">

                    {{ Str::substr($booking->user->name, 0, 1) }}

                </span>

                <div>
                    <div class="h3 mb-1">
                        {{ $booking->user->name }}
                    </div>

                    <div class="h5 text-muted fw-normal">
                        {{ $booking->user->email }}
                    </div>
                </div>

            </div>


            <hr>


            {{-- Booking Information --}}
            <div class="row">

                <div class="col-md-6">
                    <p>
                        <strong>Booking Number:</strong>
                        {{ $booking->booking_number }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>Booking Date:</strong>

                        {{ $booking->booking_date
                            ? $booking->booking_date->format('d M Y h:i A')
                            : 'N/A'
                        }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>Customer:</strong>
                        {{ $booking->user->name }}
                    </p>
                </div>

                <div class="col-md-6">
                    <p>
                        <strong>Email:</strong>
                        {{ $booking->user->email }}
                    </p>
                </div>

                {{-- <div class="col-md-6">
                    <p>
                        <strong>Status:</strong>

                        @if($booking->status === 'pending')

                            <span class="badge bg-warning">
                                Pending
                            </span>

                        @elseif($booking->status === 'confirmed')

                            <span class="badge bg-success">
                                Confirmed
                            </span>

                        @elseif($booking->status === 'cancelled')

                            <span class="badge bg-danger">
                                Cancelled
                            </span>

                        @else

                            <span class="badge bg-secondary">
                                {{ ucfirst($booking->status) }}
                            </span>

                        @endif

                    </p>
                </div> --}}

            </div>


            <hr>


            {{-- Ticket Details --}}
            <h5 class="mb-3">
                Ticket Details
            </h5>

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Event</th>
                            <th>Ticket</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($booking->items as $item)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    {{ $item->ticketType->event->title }}
                                </td>

                                <td>
                                    {{ $item->ticketType->name }}
                                </td>

                                <td>
                                    {{ $item->quantity }}
                                </td>

                                <td>
                                    ৳{{ number_format($item->unit_price, 2) }}
                                </td>

                                <td>
                                    ৳{{ number_format($item->subtotal, 2) }}
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center text-muted py-4">

                                    No ticket details found.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Total --}}
            <div class="text-end mt-4">

                <h4 class="fw-bold">
                    Total:
                    ৳{{ number_format($booking->total_amount, 2) }}
                </h4>

            </div>

        </div>
    </div>

@endsection