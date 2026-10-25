@extends('admin.layouts.master')

@section('content')

<style>
    body {
        background: #f1f3f5;
    }

    .ticket-wrapper {
        max-width: 850px;
        margin: 40px auto;
    }

    .ticket {
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 35px rgba(0, 0, 0, 0.10);
    }

    /* Event Image */
    .ticket-image {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
    }

    .ticket-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .ticket-image-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(0, 0, 0, 0.05),
            rgba(0, 0, 0, 0.75)
        );
    }

    .event-title {
        position: absolute;
        left: 30px;
        right: 30px;
        bottom: 25px;
        color: #ffffff;
    }

    .event-title h1 {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 8px;
    }

    .event-title p {
        margin: 0;
        font-size: 15px;
        opacity: 0.95;
    }

    /* Ticket Body */
    .ticket-body {
        padding: 30px;
    }

    .ticket-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .ticket-label {
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #6c757d;
        font-weight: 600;
    }

    .booking-code {
        font-size: 20px;
        font-weight: 700;
        color: #212529;
        margin-top: 5px;
    }

    .status-badge {
        display: inline-block;
        padding: 7px 14px;
        border-radius: 50px;
        background: #d1e7dd;
        color: #0f5132;
        font-size: 13px;
        font-weight: 600;
    }

    /* Information Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 18px;
        margin-bottom: 30px;
    }

    .info-box {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 16px;
        border: 1px solid #e9ecef;
    }

    .info-label {
        color: #6c757d;
        font-size: 12px;
        margin-bottom: 5px;
    }

    .info-value {
        color: #212529;
        font-size: 15px;
        font-weight: 600;
    }

    /* Price */
    .price-section {
        border-top: 1px dashed #ced4da;
        border-bottom: 1px dashed #ced4da;
        padding: 20px 0;
        margin-bottom: 25px;
    }

    .price-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
        font-size: 14px;
    }

    .price-row:last-child {
        margin-bottom: 0;
    }

    .total-row {
        font-size: 20px;
        font-weight: 700;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #dee2e6;
    }

    /* QR */
    .qr-section {
        text-align: center;
        padding: 25px 0 10px;
    }

    .qr-section h5 {
        margin-bottom: 5px;
        font-weight: 700;
    }

    .qr-section p {
        color: #6c757d;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .qr-code {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px;
        background: #ffffff;
        border: 1px solid #dee2e6;
        border-radius: 12px;
    }

    .qr-code svg {
        display: block;
    }

    .qr-booking-code {
        margin-top: 10px;
        font-size: 13px;
        font-weight: 600;
        letter-spacing: 1px;
    }

    /* Footer */
    .ticket-footer {
        background: #f8f9fa;
        padding: 18px 30px;
        text-align: center;
        color: #6c757d;
        font-size: 12px;
        border-top: 1px solid #e9ecef;
    }

    /* Buttons */
    .ticket-actions {
        text-align: center;
        margin-top: 25px;
    }

    .ticket-actions .btn {
        margin: 0 5px;
    }

    /* Mobile */
    @media (max-width: 600px) {

        .ticket-wrapper {
            margin: 15px;
        }

        .ticket-image {
            height: 220px;
        }

        .event-title {
            left: 20px;
            right: 20px;
            bottom: 20px;
        }

        .event-title h1 {
            font-size: 24px;
        }

        .ticket-body {
            padding: 20px;
        }

        .ticket-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .info-grid {
            grid-template-columns: 1fr;
        }

        .ticket-footer {
            padding: 15px 20px;
        }
    }

    /* Print */
    @media print {

        @page {
            size: A4;
            margin: 12mm;
        }

        body {
            background: #ffffff !important;
        }

        .ticket-wrapper {
            max-width: 100%;
            margin: 0;
        }

        .ticket {
            box-shadow: none !important;
            border: 1px solid #dee2e6;
        }

        .ticket-actions,
        .no-print {
            display: none !important;
        }

        .ticket-image {
            height: 240px;
        }

        .ticket-body {
            padding: 25px;
        }

        .ticket-footer {
            background: #f8f9fa !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .status-badge {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .info-box {
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
    }
</style>


<div class="ticket-wrapper">

    <div class="ticket">

        {{-- =========================
             EVENT IMAGE
        ========================== --}}
        @if($booking->event && $booking->event->image)

            <div class="ticket-image">

                <img
                    src="{{ asset($booking->event->image) }}"
                    alt="{{ $booking->event->title }}"
                >

                <div class="ticket-image-overlay"></div>

                <div class="event-title">

                    <h1>
                        {{ $booking->event->title }}
                    </h1>

                    <p>
                        {{ $booking->event->venue }}

                        @if($booking->event->address)
                            · {{ $booking->event->address }}
                        @endif
                    </p>

                </div>

            </div>

        @else

            {{-- Fallback if event has no image --}}
            <div
                style="
                    background: #212529;
                    padding: 45px 30px;
                    color: white;
                "
            >

                <h1 style="margin:0;">
                    {{ $booking->event->title }}
                </h1>

                <p style="margin:8px 0 0;">
                    {{ $booking->event->venue }}
                </p>

            </div>

        @endif


        {{-- =========================
             TICKET BODY
        ========================== --}}
        <div class="ticket-body">

            {{-- Header --}}
            <div class="ticket-header">

                <div>

                    <div class="ticket-label">
                        Booking Code
                    </div>

                    <div class="booking-code">
                        {{ $booking->booking_code }}
                    </div>

                </div>

                <div>

                    @if($booking->status === 'confirmed')

                        <span class="status-badge">
                            ✓ Confirmed
                        </span>

                    @elseif($booking->status === 'cancelled')

                        <span
                            class="status-badge"
                            style="background:#f8d7da;color:#842029;"
                        >
                            Cancelled
                        </span>

                    @else

                        <span
                            class="status-badge"
                            style="background:#fff3cd;color:#664d03;"
                        >
                            {{ ucfirst($booking->status) }}
                        </span>

                    @endif

                </div>

            </div>


            {{-- Event Information --}}
            <div class="info-grid">

                <div class="info-box">

                    <div class="info-label">
                        Event Date
                    </div>

                    <div class="info-value">

                        {{ $booking->event->event_date->format('d M Y') }}

                    </div>

                </div>


                <div class="info-box">

                    <div class="info-label">
                        Event Time
                    </div>

                    <div class="info-value">

                        {{ \Carbon\Carbon::parse($booking->event->start_time)->format('h:i A') }}

                        @if($booking->event->end_time)
                            -
                            {{ \Carbon\Carbon::parse($booking->event->end_time)->format('h:i A') }}
                        @endif

                    </div>

                </div>


                <div class="info-box">

                    <div class="info-label">
                        Ticket Type
                    </div>

                    <div class="info-value">

                        {{ $booking->ticketType->name ?? 'N/A' }}

                    </div>

                </div>


                <div class="info-box">

                    <div class="info-label">
                        Quantity
                    </div>

                    <div class="info-value">

                        {{ $booking->quantity }} Ticket(s)

                    </div>

                </div>


                <div class="info-box">

                    <div class="info-label">
                        Venue
                    </div>

                    <div class="info-value">

                        {{ $booking->event->venue }}

                    </div>

                </div>


                <div class="info-box">

                    <div class="info-label">
                        Booking Date
                    </div>

                    <div class="info-value">

                        {{ $booking->created_at->format('d M Y, h:i A') }}

                    </div>

                </div>

            </div>


            {{-- Price Section --}}
            <div class="price-section">

                <div class="price-row">

                    <span>
                        Unit Price
                    </span>

                    <span>
                        ৳{{ number_format($booking->unit_price, 2) }}
                    </span>

                </div>


                <div class="price-row">

                    <span>
                        Quantity
                    </span>

                    <span>
                        × {{ $booking->quantity }}
                    </span>

                </div>


                <div class="price-row total-row">

                    <span>
                        Total Amount
                    </span>

                    <span>
                        ৳{{ number_format($booking->total_price, 2) }}
                    </span>

                </div>

            </div>


            {{-- =========================
                 QR CODE
            ========================== --}}
            <div class="qr-section">

                <h5>
                    Scan to Verify Ticket
                </h5>

                <p>
                    Present this QR code at the event entrance.
                </p>

                <div class="qr-code">

                    {!! QrCode::size(180)->generate($booking->booking_code) !!}

                </div>

                <div class="qr-booking-code">

                    {{ $booking->booking_code }}

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="ticket-footer">

            Please keep this ticket safe and present it at the event entrance.

        </div>

    </div>


    {{-- =========================
         ACTION BUTTONS
    ========================== --}}
    <div class="ticket-actions no-print">

        <button
            type="button"
            onclick="window.print()"
            class="btn btn-info"
        >
            🖨️ Print Ticket
        </button>

        <a
            href="{{ route('bookings.show', $booking->id) }}"
            class="btn btn-outline-info"
        >
            ← Back to Booking
        </a>

    </div>

</div>

@endsection