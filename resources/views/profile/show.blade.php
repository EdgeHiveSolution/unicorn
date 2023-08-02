@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/profile">My account</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit profile</li>
        </ol>
    </nav>


    <div class="col-8">
        <form id="update-form" method="POST" action="/profile/{{ $user->id }}">
            @csrf
            @method('PUT')
            <div class="row mb-2 p-3">
                <label for="name" class="col-md-3 col-form-label text-md-start">{{ __('Photo') }}</label>
                <div class="col-md-5 offset-md-4 text-center profile-edit">
                    <img src="{{ secure_asset('assets/images/faces/face1.jpg') }}" alt="profile">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-2 p-3">
                <label for="name" class="col-md-3 col-form-label text-md-start">{{ __('Name') }}</label>
                <div class="col-md-5 offset-md-4 text-center">
                    <input id="name" name="name" class="form-control @error('name') is-invalid @enderror form-control-lg"
                        type="text" value="{{ $user->name }}" autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="dropdown-divider"></div>

            <div class="row mb-2 p-3">
                <label for="email" class="col-md-3 col-form-label text-md-start">{{ __('Email Address') }}</label>
                <div class="col-md-5 offset-md-4 text-center">
                    <input id="email" name="email" class="form-control @error('email') is-invalid @enderror form-control-lg"
                        type="email" value="{{ $user->email }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="dropdown-divider"></div>

            <div class="row mb-2 p-3">
                <label for="password" class="col-md-3 col-form-label text-md-start">{{ __('Password') }}</label>
                <div class="col-md-5 offset-md-4 text-center">
                    <input id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror form-control-lg" type="password"
                        value="{{ $user->password }}" autocomplete="email" autofocus>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="text-end mt-3 mb-5">
                <button class="btn btn-light btn-action border-dark p-3">
                    Cancel
                </button>
                <button onclick="event.preventDefault(); document.getElementById('update-form').submit();"
                    class="btn btn-action btn-pri" type="submit">
                    Save changes
                </button>
            </div>
        </form>
        <div class="row mb-2 p-3">
            <label for="email" class="col-md-3 col-form-label text-md-start">{{ __('Delete Account') }}</label>

            <div class="col-md-5 offset-md-0 text-center">
                <form id="update-form" method="POST" action="/profile/{{ $user->id }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-3 py-3">
                        Delete Account
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

