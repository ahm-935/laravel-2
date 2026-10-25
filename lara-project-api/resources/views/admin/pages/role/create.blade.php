@extends('admin.layouts.master')

@section('title', 'Roles - Create')

@section('content')
    <x-admin.phead title="Roles - Create" subtitle="Create a new item.">
        <a href="{{ route('roles.index') }}" class="btn-custom btn-custom-outline-secondary" type="button">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </x-admin.phead>

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-light shadow-sm p-4 h-100">

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
            {{-- {{ $errors }} --}}

            <!-- Text input -->
            <div class="mb-3">
                <label for="basicText" class="form-label-custom">Name</label>
                <input type="text" name="name" class="form-control-custom" id="basicText" placeholder="Enter Rolename"
                    value="{{ old('name') }}">
                <x-admin.error-msg name="name" />
            </div>

            <div class="mb-3 text-end">
                <button type="submit" class="btn-custom btn-custom-secondary">Save</button>
            </div>
        </form>

    </div>
@endsection
