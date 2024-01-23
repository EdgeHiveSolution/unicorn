@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-8 col-lg-4">
                <h4>Sign in to your account</h4>
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mt-3">
                        <label for="email" class="col-form-label text-end">{{ __('Email') }}</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-email"></i></span>
                            <input id="email" placeholder="Enter your email" type="email"
                                class="form-control p-1 @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" autocomplete="email">
                        </div>

                  
{{-- 
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>

                    <div class="mt-3">
                        <div class="d-flex justify-content-between">
                            <label for="password" class="col-form-label text-end">{{ __('Password') }}</label>
                            @if (Route::has('password.request'))
                                <a class="btn btn-link text-decoration-none"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                        <div class="input-group">
                            <span class="input-group-text"><i class="mdi mdi-lock-outline"></i></span>
                            <input id="password" placeholder="Enter your password" type="password"
                                class="form-control p-1 @error('password') is-invalid @enderror" name="password"
                                autocomplete="new-password">
                        </div>

                        {{-- @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror --}}
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                   </div>
                @endif

                    <div class="mt-3">
                        <button type="submit" class="btn w-100 px-3" style="background:#084bf7;color:white;">
                            <i class="mdi mdi-lock-outline"></i> {{ __('Continue') }}
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
