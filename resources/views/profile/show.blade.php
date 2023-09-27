@extends('layouts.app')
@section('content')
@include("inc.status")

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/profile">My account</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit profile</li>
        </ol>
    </nav>


    <div class="col-8">
        <form id="update-form" method="POST" action="{{ route('profile.update', $user->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-2 p-3">
                <label for="photo" class="col-md-3 col-form-label text-md-start">{{ __('Photo') }}</label>
                <div class="col-md-5 offset-md-4 text-center profile-edit">
                    @if ($user->photo)
                    <img src="{{ asset('profile-photos/' . $user->photo) }}" alt="profile">
                    @else
                    <!-- Display a default image if the user doesn't have a photo -->
                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="profile">
                @endif
                
                <input id="photo" name="photo" type="file" class="form-control @error('photo') is-invalid @enderror">
                    @error('photo')
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
                <label for="new_password" class="col-md-3 col-form-label text-md-start">{{ __('New Password') }}</label>
                <div class="col-md-5 offset-md-4 text-center">
                    <input id="new_password" name="new_password"
                        class="form-control @error('new_password') is-invalid @enderror form-control-lg" type="password"
                        value="{{ old('new_password') }}" autocomplete="new-password" autofocus>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
            
            <div class="row mb-2 p-3">
                <label for="new_password_confirmation" class="col-md-3 col-form-label text-md-start">{{ __('Confirm Password') }}</label>
                <div class="col-md-5 offset-md-4 text-center">
                    <input id="new_password_confirmation" name="new_password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror form-control-lg" type="password"
                        value="{{ old('new_password_confirmation') }}" autocomplete="new-password" autofocus>
                    @error('new_password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>            
            
            

            <div class="text-end mt-3 mb-5">
                <button class="btn btn-light btn-action border-secondary">
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

