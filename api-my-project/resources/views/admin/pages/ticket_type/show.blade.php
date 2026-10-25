@extends('admin.layouts.master')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">

        <h4>Ticket Type Details</h4>

        <div>
            <a href="{{ route('ticket-types.edit', $ticketType->id) }}"
               class="btn btn-gradient-success">
                Edit
            </a>

            <a href="{{ route('ticket-types.index') }}"
               class="btn btn-outline-success">
                Back
            </a>
        </div>

    </div>

    <div class="card">

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th width="200">Event</th>
                    <td>{{ $ticketType->event->title ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Ticket Name</th>
                    <td>{{ $ticketType->name }}</td>
                </tr>

                <tr>
                    <th>Description</th>
                    <td>{{ $ticketType->description ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Price</th>
                    <td>{{ $ticketType->price }}</td>
                </tr>

                <tr>
                    <th>Quantity</th>
                    <td>{{ $ticketType->quantity }}</td>
                </tr>

                <tr>
                    <th>Available Quantity</th>
                    <td>{{ $ticketType->available_quantity }}</td>
                </tr>

                <tr>
                    <th>Sale Start</th>
                    <td>{{ $ticketType->sale_start ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Sale End</th>
                    <td>{{ $ticketType->sale_end ?? 'N/A' }}</td>
                </tr>

                <tr>
                    <th>Status</th>
                    <td>
                        @if($ticketType->status)
                            <span class="badge bg-success">Active</span>
                        @else
                            <span class="badge bg-danger">Inactive</span>
                        @endif
                    </td>
                </tr>

                <tr>
                    <th>Created At</th>
                    <td>{{ $ticketType->created_at }}</td>
                </tr>

            </table>

        </div>

    </div>

</div>

@endsection