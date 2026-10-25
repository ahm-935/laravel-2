@extends('admin.layouts.master')

@section('title', 'Edit User')

@section('content')
    <x-admin.phead title="Edit User" subtitle="Change the details to edit the user.">
        <a href="{{ route('users.index') }}" class="btn btn-gradient-success" type="button">
            <i class="bi bi-arrow-left"></i> Back to Users
        </a>
    </x-admin.phead>
    <hr>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form class="forms-sample" action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group fw-bold">
                    <label for="Username">Username</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}">
                    <small class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="form-group fw-bold">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control" name="email" id="email1" value="{{ $user->email }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group fw-bold">
                    <label for="exampleInputRole">Role</label>
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="0" selected disabled>Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" @selected($user->role_id == $role->id)>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-gradient-success me-2">Update</button>
                <a href="{{ route('users.index') }}" class="btn btn-gradient-danger">
                    Cancel
                </a>
            </form>
        </div>
    </div>
@endsection