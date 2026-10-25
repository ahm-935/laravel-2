@extends('admin.layouts.master')

@section('title', 'Create User')

@section('content')
    <x-admin.phead title="Create User" subtitle="Fill in the details to create a new user.">
        <a href="{{ route('users.index') }}" class="btn btn-gradient-success" type="button">
            <i class="bi bi-arrow-left"></i> Back to Users
        </a>
    </x-admin.phead>

    <div class="card">
        <div class="card-body">
            {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif --}}
            <form class="forms-sample" action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="exampleInputUsername1">Username</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Username">
                    <small class="text-danger">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="text" class="form-control" name="email" id="email1" placeholder="Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputRole">Role</label>
                    <select class="form-control" name="role_id" id="role_id">
                        <option value="0" selected disabled>Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    {{-- <x-admin.input-error name="password" /> --}}
                </div>
                <div class="form-group">
                    <label for="exampleInputConfirmPassword1">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password1"
                        placeholder="Password">
                </div>
                
                <button type="submit" class="btn btn-gradient-success me-2">Submit</button>
               <button type="button" class="btn btn-gradient-danger">Cancel</button>

            </form>
        </div>
    </div>
@endsection