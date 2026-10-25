@extends('admin.layouts.master')

@section('content')

    <style>
        .booking-page {
            background: #f6f8fb;
            min-height: 100vh;
        }

        .booking-hero {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            min-height: 300px;
            background: #212529;
            color: #fff;
        }

        .booking-hero-image {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .booking-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg,
                    rgba(0, 0, 0, .82) 0%,
                    rgba(0, 0, 0, .55) 45%,
                    rgba(0, 0, 0, .20) 100%);
        }

        .booking-hero-content {
            position: relative;
            z-index: 2;
            padding: 35px;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
        }

        .booking-hero-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .booking-location {
            font-size: 15px;
            opacity: .9;
        }

        .booking-code {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, .15);
            border: 1px solid rgba(255, 255, 255, .25);
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 13px;
            margin-bottom: 15px;
            backdrop-filter: blur(5px);
        }

        .status-confirmed {
            background: #198754;
            color: #fff;
        }

        .status-cancelled {
            background: #dc3545;
            color: #fff;
        }

        .status-other {
            background: #ffc107;
            color: #212529;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 50px;
            font-size: 13px;
            font-weight: 600;
        }

        .booking-card {
            background: #fff;
            border: 0;
            border-radius: 16px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, .06);
            overflow: hidden;
            height: 100%;
        }

        .card-title-area {
            padding: 20px 22px;
            border-bottom: 1px solid #edf0f3;
        }

        .card-title-area h5 {
            margin: 0;
            font-size: 17px;
            font-weight: 700;
        }

        .card-content {
            padding: 22px;
        }

        .detail-item {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            margin-bottom: 20px;
        }

        .detail-item:last-child {
            margin-bottom: 0;
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            min-width: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            background: #f0f4ff;
            color: #0d6efd;
            font-size: 18px;
        }

        .detail-label {
            font-size: 12px;
            color: #8a94a6;
            margin-bottom: 3px;
        }

        .detail-value {
            font-size: 14px;
            font-weight: 600;
            color: #252b33;
        }

        .ticket-summary {
            background: linear-gradient(135deg, #f8faff, #ffffff);
            border: 1px solid #edf1f7;
            border-radius: 14px;
            padding: 18px;
            margin-bottom: 15px;
        }

        .ticket-name {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .ticket-quantity {
            color: #6c757d;
            font-size: 13px;
        }

        .price-table {
            margin-top: 20px;
        }

        .price-line {
            display: flex;
            justify-content: space-between;
            padding: 9px 0;
            color: #6c757d;
            font-size: 14px;
        }

        .price-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px dashed #d8dde5;
            margin-top: 8px;
            padding-top: 18px;
        }

        .price-total span:first-child {
            font-weight: 700;
            font-size: 16px;
            color: #212529;
        }

        .price-total span:last-child {
            font-size: 25px;
            font-weight: 800;
            color: #0d6efd;
        }

        .booking-meta {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 16px;
        }

        .action-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .action-buttons .btn {
            border-radius: 10px;
            padding: 10px 17px;
            font-weight: 600;
        }

        .event-address {
            color: #6c757d;
            font-size: 13px;
            margin-top: 5px;
        }

        @media (max-width: 767px) {

            .booking-hero {
                min-height: 360px;
            }

            .booking-hero-content {
                min-height: 360px;
                padding: 22px;
            }

            .booking-hero-title {
                font-size: 25px;
            }

            .action-bar {
                align-items: flex-start;
                flex-direction: column;
            }

            .action-buttons {
                width: 100%;
            }

            .action-buttons .btn {
                flex: 1;
            }
        }

        /* ===== BOOKING PAGE SCROLL FIX ===== */

        html,
        body {
            height: auto !important;
            min-height: 100% !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
        }

        .main-panel,
        .content-wrapper {
            height: auto !important;
            min-height: 100vh !important;
            overflow: visible !important;
        }

        .booking-page {
            height: auto !important;
            min-height: 100vh !important;
            overflow: visible !important;
        }

        .booking-page .container {
            height: auto !important;
            overflow: visible !important;
        }

        .booking-page .row.g-4 {
            align-items: flex-start !important;
        }

        .booking-card {
            height: auto !important;
            min-height: 0 !important;
        }
    </style>


    <div class="booking-page">

        <div class="container py-4 py-md-5">

            {{-- =========================
            TOP ACTION BAR
            ========================== --}}
            <div class="action-bar">

                <div>
                    <h2 class="fw-bold mb-1">
                        Booking Details
                    </h2>

                    <p class="text-muted mb-0">
                        View your booking and ticket information
                    </p>
                </div>

                <div class="action-buttons">

                    <a href="{{ route('bookings.ticket', $booking->id) }}" class="btn btn-gradient-success" target="_blank">
                        <i class="mdi mdi-ticket-confirmation-outline me-1"></i>
                        Print Ticket
                    </a>

                    <a href="{{ route('bookings.index') }}" class="btn btn-outline-success">
                        <i class="mdi mdi-arrow-left me-1"></i>
                        My Bookings
                    </a>

                </div>

            </div>


            {{-- =========================
            EVENT HERO
            ========================== --}}
            <div class="booking-hero mb-4">

                @if($booking->event && $booking->event->image)

                    <img src="{{ asset($booking->event->image) }}" alt="{{ $booking->event->title }}"
                        class="booking-hero-image">

                    <div class="booking-hero-overlay"></div>

                @endif


                <div class="booking-hero-content">

                    <div>

                        <div class="booking-code">

                            <i class="mdi mdi-ticket-outline"></i>

                            {{ $booking->booking_code }}

                        </div>


                        <h1 class="booking-hero-title">

                            {{ $booking->event->title ?? 'N/A' }}

                        </h1>


                        <div class="booking-location">

                            <i class="mdi mdi-map-marker-outline me-1"></i>

                            {{ $booking->event->venue ?? 'N/A' }}

                            @if($booking->event && $booking->event->address)

                                <span class="mx-1">•</span>

                                {{ $booking->event->address }}

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
            STATUS
            ========================== --}}
            <div class="mb-4">

                @if($booking->status === 'confirmed')

                    <span class="status-badge status-confirmed">
                        <i class="mdi mdi-check-circle me-1"></i>
                        Booking Confirmed
                    </span>

                @elseif($booking->status === 'cancelled')

                    <span class="status-badge status-cancelled">
                        <i class="mdi mdi-close-circle me-1"></i>
                        Booking Cancelled
                    </span>

                @else

                    <span class="status-badge status-other">
                        <i class="mdi mdi-information-outline me-1"></i>
                        {{ ucfirst($booking->status) }}
                    </span>

                @endif

            </div>


            {{-- =========================
            MAIN CONTENT
            ========================== --}}
            <div class="row g-4">


                {{-- LEFT COLUMN --}}
                <div class="col-lg-7">


                    {{-- Event Information --}}
                    <div class="booking-card mb-4">

                        <div class="card-title-area">

                            <h5>
                                <i class="mdi mdi-calendar-star text-success me-2"></i>
                                Event Information
                            </h5>

                        </div>


                        <div class="card-content">

                            <div class="detail-item">

                                <div class="detail-icon">
                                    <i class="mdi mdi-calendar-event"></i>
                                </div>

                                <div>

                                    <div class="detail-label">
                                        Event
                                    </div>

                                    <div class="detail-value">
                                        {{ $booking->event->title ?? 'N/A' }}
                                    </div>

                                </div>

                            </div>


                            <div class="detail-item">

                                <div class="detail-icon">
                                    <i class="mdi mdi-map-marker"></i>
                                </div>

                                <div>

                                    <div class="detail-label">
                                        Venue
                                    </div>

                                    <div class="detail-value">
                                        {{ $booking->event->venue ?? 'N/A' }}
                                    </div>

                                    @if($booking->event && $booking->event->address)

                                        <div class="event-address">
                                            {{ $booking->event->address }}
                                        </div>

                                    @endif

                                </div>

                            </div>


                            <div class="detail-item">

                                <div class="detail-icon">
                                    <i class="mdi mdi-calendar"></i>
                                </div>

                                <div>

                                    <div class="detail-label">
                                        Event Date
                                    </div>

                                    <div class="detail-value">

                                        @if($booking->event && $booking->event->event_date)

                                            {{ $booking->event->event_date->format('d M Y') }}

                                        @else

                                            N/A

                                        @endif

                                    </div>

                                </div>

                            </div>


                            <div class="detail-item">

                                <div class="detail-icon">
                                    <i class="mdi mdi-clock-outline"></i>
                                </div>

                                <div>

                                    <div class="detail-label">
                                        Event Time
                                    </div>

                                    <div class="detail-value">

                                        @if($booking->event)

                                            {{ \Carbon\Carbon::parse($booking->event->start_time)->format('h:i A') }}

                                            @if($booking->event->end_time)

                                                - {{ \Carbon\Carbon::parse($booking->event->end_time)->format('h:i A') }}

                                            @endif

                                        @else

                                            N/A

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Booking Information --}}
                    <div class="booking-card">

                        <div class="card-title-area">

                            <h5>
                                <i class="mdi mdi-information-outline text-success me-2"></i>
                                Booking Information
                            </h5>

                        </div>


                        <div class="card-content">

                            <div class="detail-item">

                                <div class="detail-icon">
                                    <i class="mdi mdi-barcode"></i>
                                </div>

                                <div>

                                    <div class="detail-label">
                                        Booking Code
                                    </div>

                                    <div class="detail-value">
                                        {{ $booking->booking_code }}
                                    </div>

                                </div>

                            </div>


                            <div class="detail-item">

                                <div class="detail-icon">
                                    <i class="mdi mdi-check-decagram"></i>
                                </div>

                                <div>

                                    <div class="detail-label">
                                        Booking Status
                                    </div>

                                    <div class="detail-value">
                                        {{ ucfirst($booking->status) }}
                                    </div>

                                </div>

                            </div>


                            <div class="detail-item">

                                <div class="detail-icon">
                                    <i class="mdi mdi-calendar-clock"></i>
                                </div>

                                <div>

                                    <div class="detail-label">
                                        Booked On
                                    </div>

                                    <div class="detail-value">
                                        {{ $booking->created_at->format('d M Y, h:i A') }}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- RIGHT COLUMN --}}
                <div class="col-lg-5">


                    {{-- Ticket Summary --}}
                    <div class="booking-card mb-4">

                        <div class="card-title-area">

                            <h5>
                                <i class="mdi mdi-ticket-confirmation-outline text-success me-2"></i>
                                Ticket Summary
                            </h5>

                        </div>


                        <div class="card-content">

                            <div class="ticket-summary">

                                <div class="ticket-name">

                                    {{ $booking->ticketType->name ?? 'N/A' }}

                                </div>

                                <div class="ticket-quantity">

                                    {{ $booking->quantity }} ticket(s)

                                </div>

                            </div>


                            <div class="price-table">

                                <div class="price-line">

                                    <span>
                                        Unit Price
                                    </span>

                                    <strong>
                                        ৳{{ number_format($booking->unit_price, 2) }}
                                    </strong>

                                </div>


                                <div class="price-line">

                                    <span>
                                        Quantity
                                    </span>

                                    <strong>
                                        × {{ $booking->quantity }}
                                    </strong>

                                </div>


                                <div class="price-total">

                                    <span>
                                        Total
                                    </span>

                                    <span>
                                        ৳{{ number_format($booking->total_price, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>


                    {{-- Quick Ticket Card --}}
                    <div class="booking-card">

                        <div class="card-title-area">

                            <h5>
                                <i class="mdi mdi-qrcode-scan text-success me-2"></i>
                                Your Ticket
                            </h5>

                        </div>


                        <div class="card-content text-center">

                            <div class="booking-meta mb-3">

                                <div class="small text-muted mb-1">
                                    Booking Code
                                </div>

                                <div class="fw-bold fs-5">
                                    {{ $booking->booking_code }}
                                </div>

                            </div>


                            <p class="text-muted small mb-3">

                                Your printable ticket contains the QR code
                                for event entry.

                            </p>


                            <a href="{{ route('bookings.ticket', $booking->id) }}" class="btn btn-info w-100"
                                target="_blank">

                                <i class="mdi mdi-qrcode me-1"></i>

                                View QR / Print Ticket

                            </a>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Bottom Action --}}
            <div class="text-center mt-4">

                <a href="{{ route('bookings.index') }}" class="btn btn-outline-success">

                    <i class="mdi mdi-arrow-left me-1"></i>

                    Back to My Bookings

                </a>

            </div>

        </div>

    </div>

@endsection