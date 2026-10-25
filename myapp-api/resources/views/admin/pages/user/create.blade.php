@extends('admin.layouts.master')

@section('title', 'Create Users')


@section('content')
    <x-admin.phead title="Create User" subtitle="Create a new user.">
        <a href="{{ route('users.index') }}" class="btn-custom btn-custom-secondary fw-bold" type="button">
            <i class="bi bi-arrow-left"></i> Back to Users
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
    <form action="{{ route('users.store') }}" method="POST">
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
            <input type="text" name="name" class="form-control-custom" id="basicText" placeholder="Enter username"
                value="{{ old('name') }}">
            <small class="text-danger">
                @error('name')
                    {{ $message }}
                @enderror
            </small>
        </div>

        <!-- Email input -->
        <div class="mb-3">
            <label class="form-label-custom">Email Address</label>
            <input type="text" name="email" class="form-control-custom" placeholder="name@example.com"
                value="{{ old('email') }}">
            <x-admin.error-msg name="email" />
        </div>

        <!-- Role input -->
        <div class="mb-3">
            <label class="form-label-custom">Role</label>
            <select name="role_id" class="form-select-custom">
                <option value="0" selected disabled>Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected(old('role_id') == $role->id)>{{ $role->name }} </option>

                @endforeach
            </select>
            <x-admin.error-msg name="role_id" />
        </div>

        <!-- Password input -->
        <div class="mb-3">
            <label for="basicPassword" class="form-label-custom">Password</label>
            <input type="password" name="password" class="form-control-custom" id="basicPassword"
                placeholder="Enter your secure password">
            <x-admin.error-msg name="password" />
        </div>
        <!-- Password input -->
        <div class="mb-3">
            <label class="form-label-custom">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control-custom"
                placeholder="Enter your secure password">
            <x-admin.error-msg name="password_confirmation" />
        </div>

        <div class="mb-3 text-end">
            <button type="submit" class="btn-custom btn-custom-secondary">Save</button>
        </div>
    </form>

    </div>
    <!-- END: Basic Table Card Container -->
@endsection