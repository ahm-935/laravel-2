@extends('admin.layouts.master')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3 class="mb-1">Event Management</h3>
                <p class="text-muted mb-0">
                    Manage all events
                </p>
            </div>
            @if (auth()->user()->role_id != 3)
            <a href="{{ route('events.create') }}" class="btn btn-gradient-success">
                <i class="bi bi-plus-lg"></i>
                Add Event
            </a>
            @endif
        </div>


        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Event</th>
                                <th>Venue</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Created By</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($events as $event)

                                <tr>

                                    <td>
                                        {{ $events->firstItem() + $loop->index }}
                                    </td>


                                    {{-- Image --}}
                                    <td>

                                        @if($event->image)

                                            <img src="{{ asset($event->image) }}" alt="{{ $event->title }}" width="70" height="50"
                                                class="rounded object-fit-cover">

                                        @else

                                            <div class="bg-light rounded d-flex
                                                                       align-items-center
                                                                       justify-content-center" style="width:70px;height:50px;">

                                                <i class="bi bi-image text-muted"></i>

                                            </div>

                                        @endif

                                    </td>


                                    {{-- Event --}}
                                    <td>

                                        <div class="fw-semibold">
                                            {{ $event->title }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $event->slug }}
                                        </small>

                                    </td>


                                    {{-- Venue --}}
                                    <td>

                                        <div>
                                            {{ $event->venue }}
                                        </div>

                                        @if($event->address)
                                            <small class="text-muted">
                                                {{ $event->address }}
                                            </small>
                                        @endif

                                    </td>


                                    {{-- Date --}}
                                    <td>
                                        {{ $event->event_date->format('d M Y') }}
                                    </td>


                                    {{-- Time --}}
                                    <td>

                                        {{ \Carbon\Carbon::parse($event->start_time)->format('h:i A') }}

                                        <br>

                                        <small class="text-muted">
                                            to
                                            {{ \Carbon\Carbon::parse($event->end_time)->format('h:i A') }}
                                        </small>

                                    </td>


                                    {{-- Status --}}
                                    <td>

                                        @if($event->status === 'active')

                                            <span class="badge bg-gradient-info">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-danger">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>


                                    {{-- Creator --}}
                                    <td>
                                        {{ $event->creator?->name ?? 'N/A' }}
                                    </td>


                                    {{-- Actions --}}
                                    <td class="text-end">

                                        <div class="btn-group">

                                            {{-- Add Ticket Type --}}
                                            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                            <a href="{{ route('ticket-types.create', ['event_id' => $event->id]) }}"
                                                class="btn btn-sm btn-gradient-success">
                                                <i class="bi bi-ticket-perforated"></i>
                                                Add Ticket
                                            </a>
                                            @endif

                                            {{-- View --}}
                                            <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-outline-info"
                                                title="View Details">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- Edit --}}
                                            @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                            <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-outline-primary"
                                                title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- Delete --}}
                                            
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this event?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="bi bi-calendar-x fs-1"></i>

                                            <h5 class="mt-3">
                                                No events found
                                            </h5>

                                            <a href="{{ route('events.create') }}" class="btn btn-primary mt-2">

                                                Add First Event

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="mt-3">
                    {{ $events->links() }}
                </div>

            </div>

        </div>

    </div>

@endsection