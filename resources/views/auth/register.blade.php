@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="form-container p-3">
                    <!-- <p class="text-center">   
                    <span style="font-weight: bold">Raison Labs</span> invited you to their UNICON Organisation. Create your account to get started.
                    </p> -->
                    <form method="POST" action="{{ route('register') }}" class="w-100">
                        @csrf

                        <div class="mt-2"> <!-- Reduced top margin -->
                            <label for="name" class="col-form-label text-end">{{ __('Full Name') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-tag"></i></span>
                                <input id="name" type="text" placeholder="Enter your full name"
                                    class="form-control py-2 px-3 @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" autocomplete="first_name">
                            </div>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mt-2"> <!-- Reduced top margin -->
                            <label for="email" class="col-form-label text-end">{{ __('Email') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                                <input id="email" placeholder="Enter your email" type="email"
                                    class="form-control py-2 px-3 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" autocomplete="email">
                            </div>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div>

                           @if(isset($partnerId))
                                <input type="hidden" name="partner_id" value="{{ $partnerId }}">
                            @endif

                            </div>
                          <div>
                             @if(isset($departmentId))
                            <input type="hidden" name="department_id" value="{{ $departmentId }}">
                             @endif

                            </div>

                        <div class="mt-2"> <!-- Reduced top margin -->
                            <label for="password" class="col-form-label text-end">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                                <input id="password" placeholder="Enter your password" type="password"
                                    class="form-control py-2 px-3 @error('password') is-invalid @enderror"
                                    name="password" autocomplete="new-password">
                            </div>

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-2"> <!-- Reduced top margin -->
                            <label for="password-confirm" class="col-form-label text-end">{{ __('Confirm Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                                <input id="password-confirm" placeholder="Confirm your password" type="password"
                                    class="form-control py-2 px-3" name="password_confirmation"
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <div class="mt-3 d-flex justify-content-center"> <!-- Reduced top margin -->

                            <button style="" type="submit" class="btn btn-primary w-100">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
  <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z"/>
</svg> {{ __('Create Account') }} 
                               
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
