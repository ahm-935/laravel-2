@extends('admin.layouts.master')

@section('title', 'Create roles')


@section('content')
    <x-admin.phead title="Create role" subtitle="Create a new role.">
        <a href="{{ route('roles.index') }}" class="btn-custom btn-custom-secondary fw-bold" type="button">
            <i class="bi bi-arrow-left"></i> Back to roles
        </a>
    </x-admin.phead>

    @if (session('error'))
        <div>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        {{-- @if ($errors->any())

        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @endif --}}
        <!-- Text input -->
        <div class="mb-3">
            <label for="basicText" class="form-label-custom">Name</label>
            <input type="text" name="name" class="form-control-custom" id="basicText" placeholder="Enter rolename"
                value="{{ old('name') }}">
            <small class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </small>
        </div>

        <div class="mb-3 text-end">
            <button type="submit" class="btn-custom btn-custom-secondary">Save</button>
        </div>
    </form>

    </div>
    <!-- END: Basic Table Card Container -->
@endsection