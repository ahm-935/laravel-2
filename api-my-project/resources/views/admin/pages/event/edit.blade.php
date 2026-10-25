@extends('admin.layouts.master')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3>Edit Event</h3>
                <p class="text-muted mb-0">
                    Update event information
                </p>
            </div>
            <a href="{{ route('events.index') }}" class="btn btn-outline-success">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>
        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('events.update', $event) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-8 mb-3">

                            <label class="form-label">
                                Event Title
                            </label>

                            <input type="text" name="title" value="{{ old('title', $event->title) }}"
                                class="form-control @error('title') is-invalid @enderror">

                            @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Status
                            </label>

                            <select name="status" class="form-select @error('status') is-invalid @enderror">

                                <option value="active" {{ old('status', $event->status) === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" {{ old('status', $event->status) === 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        <div class="col-12 mb-3">

                            <label class="form-label">
                                Description
                            </label>

                            <textarea name="description" rows="5"
                                class="form-control">{{ old('description', $event->description) }}</textarea>

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Event Image
                            </label>

                            <input type="file" name="image" accept="image/*" class="form-control">

                            @if($event->image)

                                <div class="mt-2">

                                    <img src="{{ asset($event->image) }}" width="150" class="rounded">

                                </div>

                            @endif

                        </div>


                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Venue
                            </label>

                            <input type="text" name="venue" value="{{ old('venue', $event->venue) }}" class="form-control">

                        </div>


                        <div class="col-12 mb-3">

                            <label class="form-label">
                                Address
                            </label>

                            <input type="text" name="address" value="{{ old('address', $event->address) }}"
                                class="form-control">

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Event Date
                            </label>

                            <input type="date" name="event_date"
                                value="{{ old('event_date', $event->event_date->format('Y-m-d')) }}" class="form-control">

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                Start Time
                            </label>

                            <input type="time" name="start_time"
                                value="{{ old('start_time', \Carbon\Carbon::parse($event->start_time)->format('H:i')) }}"
                                class="form-control">

                        </div>


                        <div class="col-md-4 mb-3">

                            <label class="form-label">
                                End Time
                            </label>

                            <input type="time" name="end_time"
                                value="{{ old('end_time', \Carbon\Carbon::parse($event->end_time)->format('H:i')) }}"
                                class="form-control">

                        </div>

                    </div>


                    <button type="submit" class="btn btn-gradient-success">

                        <i class="bi bi-save"></i>
                        Update Event

                    </button>

                    <a href="{{ route('events.index') }}" class="btn btn-outline-success">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection