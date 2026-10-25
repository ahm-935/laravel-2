@extends('admin.layouts.master')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3>Create Event</h3>
            <p class="text-muted mb-0">
                Add a new event
            </p>
        </div>

        <a href="{{ route('events.index') }}"
           class="btn btn-outline-success">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('events.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
 

                <div class="row">


                    {{-- Title --}}
                    <div class="col-md-8 mb-3">

                        <label class="form-label">
                            Event Title
                        </label>

                        <input
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            class="form-control @error('title') is-invalid @enderror"
                            placeholder="Enter event title">

                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select
                            name="status"
                            class="form-select @error('status') is-invalid @enderror">

                            <option value="active"
                                {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="inactive"
                                {{ old('status') == 'inactive' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Description --}}
                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea
                            name="description"
                            rows="5"
                            class="form-control @error('description') is-invalid @enderror"
                            placeholder="Event description">{{ old('description') }}</textarea>

                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Image --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Event Image
                        </label>

                        <input
                            type="file"
                            name="image"
                            accept="image/*"
                            class="form-control @error('image') is-invalid @enderror">

                        <small class="text-muted">
                            JPG, JPEG, PNG or WEBP. Max 2MB.
                        </small>

                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Venue --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Venue
                        </label>

                        <input
                            type="text"
                            name="venue"
                            value="{{ old('venue') }}"
                            class="form-control @error('venue') is-invalid @enderror"
                            placeholder="Example: International Convention Center">

                        @error('venue')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Address --}}
                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Address
                        </label>

                        <input
                            type="text"
                            name="address"
                            value="{{ old('address') }}"
                            class="form-control @error('address') is-invalid @enderror"
                            placeholder="Event full address">

                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Date --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Event Date
                        </label>

                        <input
                            type="date"
                            name="event_date"
                            value="{{ old('event_date') }}"
                            class="form-control @error('event_date') is-invalid @enderror">

                        @error('event_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- Start --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Start Time
                        </label>

                        <input
                            type="time"
                            name="start_time"
                            value="{{ old('start_time') }}"
                            class="form-control @error('start_time') is-invalid @enderror">

                        @error('start_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- End --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            End Time
                        </label>

                        <input
                            type="time"
                            name="end_time"
                            value="{{ old('end_time') }}"
                            class="form-control @error('end_time') is-invalid @enderror">

                        @error('end_time')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="mt-3">

                    <button type="submit"
                            class="btn btn-gradient-success">

                        <i class="bi bi-check-lg"></i>
                        Create Event

                    </button>

                    <a href="{{ route('events.index') }}"
                       class="btn btn-outline-success">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection