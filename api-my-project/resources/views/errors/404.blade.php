{{-- @extends("admin.layouts.single-page") --}}
{{-- @section("main")
<div class="text-center">
    <h1 class="h1 mb-3 fw-bold text-danger"> 404</h1>
    <p class="h2 fw-bold">Page not found.</p><br>
    <x-btn href="/"> Back to HomePage</x-btn>
</div>
@endsection --}}

@extends('admin.layouts.single-page')

@section('title', 'Page Not Found')
@section('content')

    <div class="container-fluid d-flex align-items-center justify-content-center text-center" style="
                min-height: 100vh;
                background-color: #771c73;
                padding: 30px;
            ">

        <div class="row w-100 justify-content-center">

            <div class="col-12 text-white">

                <!-- 404 + Message -->
                <div class="row align-items-center justify-content-center" style="max-width: 900px; margin: 0 auto;">

                    <!-- 404 -->
                    <div class="col-12 col-lg-6">
                        <h1 class="display-1 fw-bold mb-0" style="font-size: clamp(100px, 15vw, 180px); line-height: 1;">
                            404
                        </h1>
                    </div>

                    <!-- Divider + Text -->
                    <div class="col-12 col-lg-6 text-center text-lg-start" style="
                                border-left: 0;
                                padding-left: 0;
                                margin-top: 30px;
                            ">

                        <div style="
                                    border-left: 0;
                                " class="ps-lg-4">
                            <h2 class="fw-bold mb-2">
                                SORRY!
                            </h2>

                            <h3 class="fw-light fs-5 mb-0">
                                The page you’re looking for was not found.
                            </h3>
                        </div>

                    </div>

                </div>


                <!-- Back to Home -->
                <div class="row mt-5">
                    <div class="col-12">

                        <a href="{{ url('/') }}" class="text-white fw-medium text-decoration-none" style="
                                    display: inline-block;
                                    border: 1px solid rgba(255,255,255,0.7);
                                    padding: 10px 24px;
                                    border-radius: 5px;
                                ">
                            Back to home
                        </a>

                    </div>
                </div>


                <!-- Copyright -->
                <div class="row mt-5">
                    <div class="col-12">

                        <p class="text-white fw-medium text-center mb-0" style="font-size: 14px;">
                            Copyright &copy; 2021 All rights reserved.
                            Distributed by
                            <a href="https://themewagon.com" target="_blank" class="text-white fw-bold">
                                ThemeWagon
                            </a>
                        </p>

                    </div>
                </div>

            </div>

        </div>

    </div>

@endsection