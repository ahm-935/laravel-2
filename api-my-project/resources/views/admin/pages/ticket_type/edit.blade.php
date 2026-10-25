@extends('admin.layouts.master')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Edit Ticket Type</h4>

            <a href="{{ route('ticket-types.index') }}" class="btn btn-outline-success">
                Back
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('ticket-types.update', $ticketType->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Event</label>

                            <select name="event_id" class="form-control">

                                @foreach($events as $event)

                                    <option value="{{ $event->id }}" {{ $ticketType->event_id == $event->id ? 'selected' : '' }}>
                                        {{ $event->title }}
                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Ticket Name</label>

                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $ticketType->name) }}">

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">Description</label>

                            <textarea name="description" class="form-control"
                                rows="4">{{ old('description', $ticketType->description) }}</textarea>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Price</label>

                            <input type="number" name="price" class="form-control" step="0.01" min="0"
                                value="{{ old('price', $ticketType->price) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Quantity</label>

                            <input type="number" name="quantity" class="form-control" min="0"
                                value="{{ old('quantity', $ticketType->quantity) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Available Quantity</label>

                            <input type="number" name="available_quantity" class="form-control" min="0"
                                value="{{ old('available_quantity', $ticketType->available_quantity) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Sale Start</label>

                            <input type="datetime-local" name="sale_start" class="form-control"
                                value="{{ old('sale_start', $ticketType->sale_start ? $ticketType->sale_start->format('Y-m-d\TH:i') : '') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Sale End</label>

                            <input type="datetime-local" name="sale_end" class="form-control"
                                value="{{ old('sale_end', $ticketType->sale_end ? $ticketType->sale_end->format('Y-m-d\TH:i') : '') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Status</label>

                            <select name="status" class="form-control">

                                <option value="active" {{ old('status', $ticketType->status) === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" {{ old('status', $ticketType->status) === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror


                        </div>

                    </div>

                    <button type="submit" class="btn btn-gradient-success">
                        Update Ticket Type
                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection