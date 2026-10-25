@extends('admin.layouts.master')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Create Ticket Type</h4>

            <a href="{{ route('ticket-types.index') }}" class="btn btn-outline-success">
                Back
            </a>
        </div>

        <div class="card">
            <div class="card-body">

                <form action="{{ route('ticket-types.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        {{-- Event --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Event</label>

                            <select name="event_id" class="form-control">
                                <option value="">Select Event</option>

                                @foreach($events as $event)
                                    <option value="{{ $event->id }}" {{ old('event_id', $selectedEventId) == $event->id ? 'selected' : '' }}>
                                        {{ $event->title }}
                                    </option>
                                @endforeach
                            </select>

                            @error('event_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- Name --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Ticket Name</label>

                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">

                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- Description --}}
                        <div class="col-md-12 mb-3">

                            <label class="form-label">Description</label>

                            <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>

                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- Price --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">Price</label>

                            <input type="number" name="price" class="form-control" step="0.01" min="0"
                                value="{{ old('price') }}">

                            @error('price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- Quantity --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">Quantity</label>

                            <input type="number" name="quantity" class="form-control" min="0" value="{{ old('quantity') }}">

                            @error('quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- Available Quantity --}}
                        <div class="col-md-4 mb-3">

                            <label class="form-label">Available Quantity</label>

                            <input type="number" name="available_quantity" class="form-control" min="0"
                                value="{{ old('available_quantity') }}">

                            @error('available_quantity')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- Sale Start --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Sale Start</label>

                            <input type="datetime-local" name="sale_start" class="form-control"
                                value="{{ old('sale_start') }}">

                            @error('sale_start')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                        {{-- Sale End --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Sale End</label>

                            <input type="datetime-local" name="sale_end" class="form-control" value="{{ old('sale_end') }}">

                            @error('sale_end')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        {{-- Status --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">Status</label>

                            <select name="status" class="form-control">

                                <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>

                    </div>

                    <button type="submit" class="btn btn-gradient-success">
                        Save Ticket Type
                    </button>

                </form>

            </div>
        </div>

    </div>

@endsection