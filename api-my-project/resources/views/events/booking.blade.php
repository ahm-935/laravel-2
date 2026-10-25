@extends('admin.layouts.master')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
            <button type="button" class="btn-close text-end " data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
            <button type="button" class="btn-close text-end" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container py-5">
        <div class="mb-4">
            <h2>{{ $event->title }}</h2>
            <p class="text-muted mb-1"> <i class="bi bi-geo-alt"></i> {{ $event->venue }} </p>
            <p class="text-muted"> <i class="bi bi-calendar"></i> {{ $event->event_date->format('d M Y') }}
                @if($event->start_time) | {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }} @endif
            </p>
        </div>
        <form action="{{ route('tickets.booking.store', $event->id) }}" method="POST">
            @csrf
            @forelse($event->ticketTypes as $ticket)
                @if($ticket->status === 'active' && $ticket->available_quantity > 0)
                    <div class="card mb-3 shadow-sm">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-1"> {{ $ticket->name }} </h5>
                                    @if($ticket->description)
                                        <p class="text-muted mb-2"> {{ $ticket->description }} </p>
                                    @endif
                                    <h5 class="text-info mb-0">
                                        ৳{{ number_format($ticket->price, 2) }} </h5>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted"> Available </small>
                                    <div>
                                        <strong> {{ $ticket->available_quantity }} </strong>
                                    </div>
                                </div>
                                <div class="col-md-3"> <label class="form-label"> Quantity </label>
                                    <input type="number" name="tickets[{{ $ticket->id }}]" class="form-control" min="0"
                                        max="{{ $ticket->available_quantity }}" value="0">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="alert alert-warning">
                    No tickets are currently available for this event.
                </div>
            @endforelse
            @if(
                    $event->ticketTypes
                        ->where('status', 'active')
                        ->where('available_quantity', '>', 0)->count() > 0
                )
                <div class="mt-4">
                    <button type="submit" class="btn btn-gradient-success btn-lg"> Continue Booking </button>
                </div>
            @endif
        </form>

    </div>
@endsection