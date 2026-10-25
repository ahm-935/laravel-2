@extends('admin.layouts.master')

@section('title', 'Users')


@section('content')

    <x-admin.phead title="Edit User" subtitle="Update user information.">
        @if (auth()->user()->role_id != 5)
            <a href="{{ route('users.index') }}" class="btn-custom btn-custom-secondary fw-bold" type="button">
                <i class="bi bi-arrow-left"></i> Back to Users
            </a>
        @endif
    </x-admin.phead>



    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
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
                value="{{ $user->name }}">
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
                value="{{ $user->email }}">
            <x-admin.error-msg name="email" />
        </div>

        <!-- Role input -->
        <div class="mb-3">
            <label class="form-label-custom">Role</label>
            <select name="role_id" class="form-select-custom">
                <option value="0" selected disabled>Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>{{ $role->name }} </option>

                @endforeach
            </select>
            <x-admin.error-msg name="role_id" />
        </div>


        <div class="mb-3 text-end">
            <button type="submit" class="btn-custom btn-custom-secondary">Update</button>
        </div>
    </form>


    </div>
    <!-- END: Basic Table Card Container -->
@endsection