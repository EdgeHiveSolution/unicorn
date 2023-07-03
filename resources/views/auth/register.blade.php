@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-4">
                <form method="POST" action="{{ route('register') }}" class="w-100">
                    @csrf

                    <div class="mt-3">
                        <label for="name" class="col-form-label text-end">{{ __('Full Name') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-tag"></i></span>
                            <input id="name" type="text" placeholder="Enter your full name"
                                class="form-control p-3 @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" autocomplete="first_name">
                        </div>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="email" class="col-form-label text-end">{{ __('Email') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                            <input id="email" placeholder="Enter your email" type="email"
                                class="form-control p-3 @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email">

                        </div>


                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <label for="password" class="col-form-label text-end">{{ __('Password') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                        <input id="password" placeholder="Enter your password" type="password"
                            class="form-control p-3 @error('password') is-invalid @enderror" name="password"
                            autocomplete="new-password">
                        </div>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mt-3">
                        <label for="password-confirm" class="col-form-label text-end">{{ __('Confirm Password') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                        <input id="password-confirm" placeholder="Confirm your password" type="password"
                            class="form-control p-3" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>
                    <div class="mt-3">

                        <button type="submit" class="btn btn-primary w-100 p-3">
                            <i class="mdi mdi-account-outline"></i> {{ __('Create Account') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
