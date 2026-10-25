@extends('admin.layouts.single-page')

@section('title', 'Register')

@section('content')

<div class="container-fluid">

    <div class="row justify-content-center">

        <div class="col-md-6 col-lg-5">

            <div class="card mt-5">
            
                 <div class="d-flex card-body text-center p-4">
                      <div class="brand-logo text-center">
                        <img src="../../assets/images/logo.png" 
                        height="100">
                      </div>

                    <div class="text-center mb-4">
                        <h3>Create Account</h3>
                        <p class="text-muted">
                            Create your account to continue.
                        </p>
                    </div>
                 </div>


                    {{-- Validation Errors --}}
                    @if ($errors->any())

                        <div class="alert alert-danger">

                            <ul class="mb-0">

                                @foreach ($errors->all() as $error)

                                    <li>{{ $error }}</li>

                                @endforeach

                            </ul>

                        </div>

                    @endif


                    {{-- Registration Form --}}
                    <form
                        method="POST"
                        action="{{ route('register') }}"
                    >

                        @csrf


                        {{-- Name --}}
                        <div class="form-group mb-3">

                            <label for="name">
                                Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control form-control-lg"
                                value="{{ old('name') }}"
                                placeholder="Enter your name"
                                required
                                autofocus
                            >

                        </div>


                        {{-- Email --}}
                        <div class="form-group mb-3">

                            <label for="email">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control form-control-lg"
                                value="{{ old('email') }}"
                                placeholder="Enter your email"
                                required
                            >

                        </div>


                        {{-- Password --}}
                        <div class="form-group mb-3">

                            <label for="password">
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control form-control-lg"
                                placeholder="Enter password"
                                required
                            >

                        </div>


                        {{-- Confirm Password --}}
                        <div class="form-group mb-4">

                            <label for="password_confirmation">
                                Confirm Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control form-control-lg"
                                placeholder="Confirm password"
                                required
                            >

                        </div>


                        {{-- Submit --}}
                        <div class="d-grid">

                            <button
                                type="submit"
                                class="btn btn-gradient-primary btn-lg"
                            >
                                REGISTER
                            </button>

                        </div>

                    </form>


                    {{-- Login Link --}}
                    <div class="text-center mt-4">

                        <span class="text-muted">
                            Already have an account?
                        </span>

                        <a href="{{ route('login') }}">
                            Login
                        </a>

                    </div>


            </div>

        </div>

    </div>

</div>

@endsection