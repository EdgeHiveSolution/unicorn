@extends('layouts.app')
@section('content')
  

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/partners">Departments</a></li>
                      <li class="breadcrumb-item active" aria-current="page">New Department</li>
                    </ol>
                </nav>
                <h2>New Department</h2>
                <p>Add a new department to UNICON.</p>
                <div class="d-flex justify-content-between">
                    <div class="">
                        <h3>Department Info</h3>
                        <p>Enter the details of the department here.</p>
                    </div>

                    <div class="">
                        <button class="btn btn-light border-dark p-3">
                            Cancel
                        </button>
                        <a href="" onclick="event.preventDefault(); document.getElementById('update-form').submit();" class="btn btn-primary p-3">Save Changes</a>
                    </div>
                </div>

                <form id="update-form" method="POST" action="/departments/{{ $department->id }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-2 p-3">
                        <label for="name" class="col-md-3 col-form-label text-md-start">{{ __('Name') }}</label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="name" name="name" class="form-control @error('name') is-invalid @enderror form-control-lg" type="text" value="{{ $department->name }}" autocomplete="name" autofocus>

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

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="email" name="email" class="form-control @error('email') is-invalid @enderror form-control-lg" type="email" value="{{ $department->email }}" autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="about" class="col-md-3 col-form-label text-md-start">{{ __('About') }} <br><span class="text-muted">Write a brief of the department.</span></label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <div class="d-flex m-3 justify-content-center">
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option value="">Long Text</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                                <i><span class="text-muted ml-3"><b>B</b></span></i>
                                <i><span class="text-muted ml-3"><i>I</i></span></i>
                                <i class="mx-2 mdi mdi-format-align-justify text-dark"></i>
                                <i class="mx-2 mdi mdi-format-line-spacing text-dark"></i>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="about" placeholder="Write company about here" style="height: 100px">{{ $department->about }}</textarea>
                                <label for="about"></label>
                            </div>

                            @error('about')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="members" class="col-md-3 col-form-label text-md-start">{{ __('Members') }} <br><span class="text-muted">Invite or select the relevant members to this department</span></label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="members" name="members" class="form-control @error('members') is-invalid @enderror form-control-lg" type="text" value="{{ $department->members }}" autocomplete="members" autofocus>
                            @error('members')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </form>

                <div class="row mb-2 p-3">
                    <label for="email" class="col-md-3 col-form-label text-md-start">{{ __('Remove Department') }}</label>

                    <div class="col-md-5 offset-md-0 text-center">
                        <form id="update-form" method="POST" action="/departments/{{ $department->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger px-3 py-3">
                                Remove department
                            </button>
                        </form>
                    </div>
                </div>
                <div class="dropdown-divider"></div>
                <div class="dropdown-divider"></div>

                <div class="text-right mt-3 mb-5">
                    <button class="btn btn-light border-dark p-3">
                        Cancel
                    </button>
                    <button onclick="event.preventDefault(); document.getElementById('update-form').submit();" class="btn btn-primary p-3">
                        Save changes
                    </button>
                </div>
                <div class="dropdown-divider mb-5"></div>

@endsection
