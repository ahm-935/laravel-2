@extends('admin.layouts.master')


@section('title', 'Event Details')

@section('content')

    <div class="container-fluid py-4">

        {{-- =========================
        Page Header
        ========================== --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="mb-1">Event Details</h3>

                <p class="text-muted mb-0">
                    View event information and ticket details
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('events.index') }}" class="btn btn-outline-success">

                    <i class="bi bi-arrow-left me-1"></i>
                    Back

                </a>
                @if (auth()->user()->role_id != 3)
                <a href="{{ route('events.edit', $event->id) }}" class="btn  btn-gradient-success">

                    <i class="bi bi-pencil me-1"></i>
                    Edit Event

                </a>
                @endif
            </div>

        </div>


        {{-- =========================
        Main Content
        ========================== --}}
        <div class="row g-4">

            {{-- =========================
            LEFT SIDE
            ========================== --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    {{-- Event Image --}}
                    @if ($event->image)

                        <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" class="card-img-top"
                            style="height: 420px; object-fit: cover;">

                    @else

                        <div class="bg-light d-flex align-items-center justify-content-center text-muted"
                            style="height: 420px;">

                            <div class="text-center">

                                <i class="bi bi-image fs-1"></i>

                                <p class="mt-2 mb-0">
                                    No image available
                                </p>

                            </div>

                        </div>

                    @endif


                    <div class="card-body p-4">

                        {{-- Title --}}
                        <div class="d-flex justify-content-between align-items-start mb-3">

                            <div>

                                <h2 class="fw-bold mb-1">
                                    {{ $event->title }}
                                </h2>

                                <small class="text-muted">
                                    Event #{{ $event->id }}
                                </small>

                            </div>


                            {{-- Event Status --}}
                            @if ($event->status === 'active')

                                <span class="badge bg-success px-3 py-2">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary px-3 py-2">
                                    Inactive
                                </span>

                            @endif

                        </div>


                        {{-- Description --}}
                        @if ($event->description)

                            <div class="mb-4">

                                <h5 class="fw-semibold mb-2">
                                    About This Event
                                </h5>

                                <p class="text-muted mb-0" style="line-height: 1.8;">

                                    {!! nl2br(e($event->description)) !!}

                                </p>

                            </div>

                        @endif


                        {{-- =========================
                        Event Information
                        ========================== --}}
                        <div class="row g-3">

                            {{-- Date --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <div class="d-flex align-items-center">

                                        <div class="text-success fs-4 me-3">

                                            <i class="bi bi-calendar-event"></i>

                                        </div>

                                        <div>

                                            <small class="text-muted d-block">
                                                Event Date
                                            </small>

                                            <strong>
                                                {{ $event->event_date->format('d M Y') }}
                                            </strong>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Time --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <div class="d-flex align-items-center">

                                        <div class="text-primary fs-4 me-3">

                                            <i class="bi bi-clock text-success"></i>

                                        </div>

                                        <div>

                                            <small class="text-muted d-block">
                                                Event Time
                                            </small>

                                            <strong>

                                                {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}

                                                -

                                                {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}

                                            </strong>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Venue --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <div class="d-flex align-items-center">

                                        <div class="text-primary fs-4 me-3">

                                            <i class="bi bi-geo-alt text-success"></i>

                                        </div>

                                        <div>

                                            <small class="text-muted d-block">
                                                Venue
                                            </small>

                                            <strong>
                                                {{ $event->venue }}
                                            </strong>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Address --}}
                            <div class="col-md-6">

                                <div class="border rounded p-3 h-100">

                                    <div class="d-flex align-items-center">

                                        <div class="text-primary fs-4 me-3">

                                            <i class="bi bi-pin-map text-success"></i>

                                        </div>

                                        <div>

                                            <small class="text-muted d-block">
                                                Address
                                            </small>

                                            <strong>
                                                {{ $event->address ?? 'Not available' }}
                                            </strong>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================
                TICKET TYPES
                ========================== --}}
                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-header bg-white border-0 p-4 pb-2">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>

                                <h5 class="fw-bold mb-1">
                                    Ticket Types
                                </h5>

                                <small class="text-muted">
                                    Available ticket categories for this event
                                </small>

                            </div>

                            <span class="badge bg-light text-dark">
                                {{ $event->ticketTypes->count() }}
                                {{ Str::plural('Type', $event->ticketTypes->count()) }}
                            </span>

                        </div>

                    </div>


                    <div class="card-body p-4">

                        @forelse ($event->ticketTypes as $ticket)

                            <div class="border rounded p-3 mb-3">

                                <div class="row align-items-center">

                                    {{-- Ticket Name --}}
                                    <div class="col-md-5">

                                        <h6 class="fw-bold mb-1">
                                            {{ $ticket->name }}
                                        </h6>

                                        @if ($ticket->description)

                                            <p class="text-muted small mb-0">

                                                {{ $ticket->description }}

                                            </p>

                                        @endif

                                    </div>


                                    {{-- Price --}}
                                    <div class="col-md-2 mt-3 mt-md-0">

                                        <small class="text-muted d-block">
                                            Price
                                        </small>

                                        <strong class="text-info">

                                            {{ number_format((float) $ticket->price, 2) }}

                                        </strong>

                                    </div>


                                    {{-- Available Quantity --}}
                                    <div class="col-md-2 mt-3 mt-md-0">

                                        <small class="text-muted d-block">
                                            Available
                                        </small>

                                        @if ($ticket->available_quantity > 0)

                                            <strong class="text-success">

                                                {{ number_format($ticket->available_quantity) }}

                                            </strong>

                                        @else

                                            <strong class="text-danger">
                                                Sold Out
                                            </strong>

                                        @endif

                                    </div>


                                    {{-- Status --}}
                                    <div class="col-md-3 mt-3 mt-md-0 text-md-end">

                                        @if ($ticket->status === 'active')

                                            <span class="badge bg-success">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </div>

                                </div>


                                {{-- Sale Period --}}
                                @if ($ticket->sale_start || $ticket->sale_end)

                                    <hr>

                                    <div class="small text-muted">

                                        <i class="bi bi-calendar-range me-1"></i>

                                        Sale Period:

                                        @if ($ticket->sale_start)

                                            {{ $ticket->sale_start->format('d M Y, h:i A') }}

                                        @else

                                            Anytime

                                        @endif

                                        <span class="mx-1">
                                            →
                                        </span>

                                        @if ($ticket->sale_end)

                                            {{ $ticket->sale_end->format('d M Y, h:i A') }}

                                        @else

                                            No end date

                                        @endif

                                    </div>

                                @endif

                            </div>

                        @empty

                            <div class="text-center py-5">

                                <i class="bi bi-ticket-perforated fs-1 text-muted"></i>

                                <h6 class="mt-3">
                                    No Ticket Types
                                </h6>

                                <p class="text-muted mb-0">
                                    No tickets have been created for this event yet.
                                </p>

                            </div>

                        @endforelse

                    </div>

                </div>

            </div>


            {{-- =========================
            RIGHT SIDE
            ========================== --}}
            <div class="col-lg-4">


                {{-- =========================
                BOOKING CARD
                ========================== --}}
                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <div class="text-center">

                            <div class="rounded-circle bg-primary bg-opacity-10
                                       d-inline-flex align-items-center
                                       justify-content-center mb-3" style="width: 70px; height: 70px;">

                                <i class="bi bi-ticket-perforated text-success fs-2"></i>

                            </div>


                            <h5 class="fw-bold">
                                Book Your Ticket
                            </h5>


                            @php

                                $availableTickets = $event->ticketTypes
                                    ->where('status', 'active')
                                    ->where('available_quantity', '>', 0);

                            @endphp


                            @if ($event->status === 'active' && $availableTickets->count() > 0)

                                <p class="text-muted small">
                                    Choose your ticket type and continue
                                    to the booking page.
                                </p>

                                <a href="{{ route('tickets.booking', $event->id) }}" class="btn  btn-gradient-success btn-lg w-100">

                                    <i class="bi bi-ticket-perforated me-2"></i>

                                    Book Ticket

                                </a>

                            @elseif ($event->status !== 'active')

                                <div class="alert alert-secondary mb-0">

                                    <i class="bi bi-info-circle me-1"></i>

                                    This event is currently inactive.

                                </div>

                            @else

                                <div class="alert alert-warning mb-0">

                                    <i class="bi bi-exclamation-circle me-1"></i>

                                    No tickets are currently available.

                                </div>

                            @endif

                        </div>

                    </div>

                </div>


                {{-- =========================
                Event Creator
                ========================== --}}
                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-body p-4">

                        <h6 class="fw-bold mb-3">
                            Event Created By
                        </h6>


                        <div class="d-flex align-items-center">

                            <div class="rounded-circle bg-success text-white
                                       d-flex align-items-center
                                       justify-content-center me-3" style="width: 45px; height: 45px;">

                                <i class="bi bi-person text-white"></i>

                            </div>


                            <div>

                                <strong>

                                    {{ $event->creator->name ?? 'Unknown' }}

                                </strong>

                                <!-- @if ($event->creator?->email)

                                    <small class="text-muted d-block">

                                        {{ $event->creator->email }}

                                    </small>

                                @endif -->

                            </div>

                        </div>

                    </div>

                </div>


                {{-- =========================
                Quick Information
                ========================== --}}
                <div class="card border-0 shadow-sm mt-4">

                    <div class="card-body p-4">

                        <h6 class="fw-bold mb-3">
                            Quick Information
                        </h6>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Total Ticket Types
                            </span>

                            <strong>
                                {{ $event->ticketTypes->count() }}
                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Total Tickets
                            </span>

                            <strong>

                                {{ number_format($event->ticketTypes->sum('quantity')) }}

                            </strong>

                        </div>


                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Available Tickets
                            </span>

                            <strong class="text-success">

                                {{ number_format($event->ticketTypes->sum('available_quantity')) }}

                            </strong>

                        </div>


                        <div class="d-flex justify-content-between">

                            <span class="text-muted">
                                Event Status
                            </span>

                            @if ($event->status === 'active')

                                <span class="badge bg-success">
                                    Active
                                </span>

                            @else

                                <span class="badge bg-secondary">
                                    Inactive
                                </span>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection