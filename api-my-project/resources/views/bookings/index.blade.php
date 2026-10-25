@extends('admin.layouts.master')

@section('content')

<style>
    .bookings-page {
        min-height: 100vh;
        background: #f6f8fb;
    }

    .booking-list-card {
        border: 0;
        border-radius: 18px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, .06);
        overflow: hidden;
    }

    .booking-list-header {
        padding: 22px 24px;
        background: #fff;
        border-bottom: 1px solid #edf0f3;
    }

    .booking-list-header h2 {
        font-size: 24px;
        font-weight: 700;
    }

    .booking-table {
        margin-bottom: 0;
    }

    .booking-table thead th {
        background: #f8f9fb;
        color: #6c757d;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .4px;
        border-bottom: 1px solid #e9ecef;
        padding: 15px 14px;
        white-space: nowrap;
    }

    .booking-table tbody td {
        padding: 17px 14px;
        vertical-align: middle;
        border-bottom: 1px solid #f0f2f5;
        font-size: 14px;
    }

    .booking-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .booking-table tbody tr {
        transition: .2s ease;
    }

    .booking-table tbody tr:hover {
        background: #f9fbff;
    }

    .booking-number {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #eef3ff;
        color: #0d6efd;
        font-weight: 700;
        font-size: 13px;
    }

    .booking-code {
        font-weight: 700;
        color: #212529;
        white-space: nowrap;
    }

    .event-name {
        font-weight: 600;
        color: #343a40;
        max-width: 220px;
    }

    .ticket-name {
        color: #6c757d;
    }

    .price {
        font-weight: 600;
        white-space: nowrap;
    }

    .total-price {
        font-weight: 700;
        color: #0d6efd;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 7px 11px;
        border-radius: 50px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-confirmed {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-cancelled {
        background: #f8d7da;
        color: #842029;
    }

    .status-other {
        background: #fff3cd;
        color: #664d03;
    }

    .booking-date {
        color: #6c757d;
        white-space: nowrap;
    }

    .view-btn {
        border-radius: 8px;
        padding: 7px 13px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .empty-bookings {
        padding: 70px 20px;
        text-align: center;
    }

    .empty-icon {
        width: 75px;
        height: 75px;
        margin: 0 auto 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef3ff;
        color: #0d6efd;
        border-radius: 50%;
        font-size: 32px;
    }

    .empty-bookings h5 {
        font-weight: 700;
        margin-bottom: 8px;
    }

    .empty-bookings p {
        color: #6c757d;
        margin-bottom: 0;
    }

    .pagination-wrapper {
        padding: 18px 24px;
        border-top: 1px solid #edf0f3;
        background: #fff;
    }

    @media (max-width: 767px) {

        .bookings-page {
            padding-bottom: 30px;
        }

        .booking-list-header {
            padding: 18px;
        }

        .booking-list-header h2 {
            font-size: 21px;
        }

        .booking-table thead th,
        .booking-table tbody td {
            padding: 12px 10px;
        }

        .booking-list-card {
            border-radius: 14px;
        }
    }
</style>


<div class="bookings-page">

    <div class="container py-4 py-md-5">

        {{-- =========================
             PAGE HEADER
        ========================== --}}
        <div class="booking-list-header rounded-top">

            <div class="d-flex justify-content-between align-items-center">

                <div>

                    <h2 class="mb-1">
                        <i class="mdi mdi-ticket-confirmation-outline text-success me-2"></i>
                        My Bookings
                    </h2>

                    <p class="text-muted mb-0">
                        View and manage your event bookings
                    </p>

                </div>

            </div>

        </div>


        {{-- Success Message --}}
        @if(session('success'))

            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">

                <i class="mdi mdi-check-circle-outline me-1"></i>

                {{ session('success') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        {{-- Error Message --}}
        @if(session('error'))

            <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">

                <i class="mdi mdi-alert-circle-outline me-1"></i>

                {{ session('error') }}

                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
                </button>

            </div>

        @endif


        @if($bookings->count() > 0)

            <div class="card booking-list-card">

                <div class="table-responsive">

                    <table class="table booking-table align-middle">

                        <thead>

                            <tr>

                                <th>#</th>

                                <th>Booking Code</th>

                                <th>Event</th>

                                <th>Ticket</th>

                                <th>Qty</th>

                                <th>Unit Price</th>

                                <th>Total</th>

                                <th>Status</th>

                                <th>Date</th>

                                <th>Action</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($bookings as $booking)

                                <tr>

                                    {{-- # --}}
                                    <td>

                                        <span class="booking-number">
                                            {{ $bookings->firstItem() + $loop->index }}
                                        </span>

                                    </td>


                                    {{-- Booking Code --}}
                                    <td>

                                        <div class="booking-code">
                                            {{ $booking->booking_code }}
                                        </div>

                                    </td>


                                    {{-- Event --}}
                                    <td>

                                        <div class="event-name">

                                            {{ $booking->event->title ?? 'N/A' }}

                                        </div>

                                    </td>


                                    {{-- Ticket --}}
                                    <td>

                                        <span class="ticket-name">

                                            {{ $booking->ticketType->name ?? 'N/A' }}

                                        </span>

                                    </td>


                                    {{-- Quantity --}}
                                    <td>

                                        <strong>
                                            {{ $booking->quantity }}
                                        </strong>

                                    </td>


                                    {{-- Unit Price --}}
                                    <td>

                                        <span class="price">

                                            ৳{{ number_format($booking->unit_price, 2) }}

                                        </span>

                                    </td>


                                    {{-- Total --}}
                                    <td>

                                        <span class="total-price">

                                            ৳{{ number_format($booking->total_price, 2) }}

                                        </span>

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($booking->status === 'confirmed')

                                            <span class="status-badge status-confirmed">

                                                <i class="mdi mdi-check-circle"></i>

                                                Confirmed

                                            </span>

                                        @elseif($booking->status === 'cancelled')

                                            <span class="status-badge status-cancelled">

                                                <i class="mdi mdi-close-circle"></i>

                                                Cancelled

                                            </span>

                                        @else

                                            <span class="status-badge status-other">

                                                <i class="mdi mdi-information-outline"></i>

                                                {{ ucfirst($booking->status) }}

                                            </span>

                                        @endif

                                    </td>


                                    {{-- Date --}}
                                    <td>

                                        <span class="booking-date">

                                            {{ $booking->created_at->format('d M Y') }}

                                        </span>

                                    </td>


                                    {{-- Action --}}
                                    <td>

                                        <a
                                            href="{{ route('bookings.show', $booking->id) }}"
                                            class="btn btn-sm btn-info view-btn"
                                        >

                                            <i class="mdi mdi-eye-outline  me-1"></i>

                                            View

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="10">

                                        <div class="empty-bookings">

                                            <div class="empty-icon">

                                                <i class="mdi mdi-ticket-outline"></i>

                                            </div>

                                            <h5>
                                                No bookings found
                                            </h5>

                                            <p>
                                                You haven't booked any event yet.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                @if($bookings->hasPages())

                    <div class="pagination-wrapper">

                        {{ $bookings->links() }}

                    </div>

                @endif

            </div>

        @else

            {{-- No Booking --}}
            <div class="card booking-list-card">

                <div class="empty-bookings">

                    <div class="empty-icon">

                        <i class="mdi mdi-ticket-outline"></i>

                    </div>

                    <h5>
                        No bookings yet
                    </h5>

                    <p>
                        You haven't booked any event yet.
                    </p>

                </div>

            </div>

        @endif

    </div>

</div>

@endsection