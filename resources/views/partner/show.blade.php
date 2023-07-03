@extends('layouts.app')
@section('content')

                <div class="module-nav">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="/partners">Partners</a></li>
                          <li class="breadcrumb-item active" aria-current="page">Partner Details</li>
                        </ol>
                </div>
                    </nav>
                <h2>Partner Details </h2>
                <p>On-board a new partner to UNICON.</p>
                <div>
                    <ul class="row justify-content-start">
                        <li class="col-auto nav-link"><a href="" class="txt-gray">Progress</a></li>
                        <li class="col-auto nav-link"><a href="#account" class="txt-gray">Account</a></li>
                        <li class="col-auto nav-link"><a href="" class="txt-gray">Members</a></li>
                        <li class="col-auto nav-link"><a href="" class="txt-gray">KPIs</a></li>
                    </ul>
                </div>



                <div class="d-flex align-items-center">
                    <img src="/assets/images/faces/face1.jpg" alt="image" />
                    <h1 class="pl-2">{{ $partner['name'] }}</h1>
                </div>
                <div class="d-flex align-items-center">
                    <span class="active-period txt-gray">Date Joined:
                        {{ $partner['created_at'] }}</span>
                </div>


            <div class="" id="account">
                <form id="submit-form" method="POST" action="/partners/{{ $partner->id }}">
                    @csrf
                    @method('PUT')

                    <div class="row mb-2 p-3">
                        <label for="first_name" class="col-md-3 col-form-label text-md-start">{{ __('Name') }}</label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $partner['name']  }}">

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
                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $partner['email']  }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="website" class="col-md-3 col-form-label text-md-start">{{ __('Website') }}</label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="website" type="text" class="form-control @error('website') is-invalid @enderror" name="website" value="{{ $partner['website']  }}">

                            @error('website')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="phone" class="col-md-3 col-form-label text-md-start">{{ __('Phone Number') }}</label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $partner['phone']  }}">

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="address" class="col-md-3 col-form-label text-md-start">{{ __('Address') }}</label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $partner['address']  }}">

                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="logo" class="col-md-3 col-form-label text-md-start">{{ __('Partner logo') }} <br> <span class=" text-muted">This will be used to identify the partner.</span></label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="{{ old('logo') }}" autocomplete="logo" autofocus>

                            @error('logo')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="country" class="col-md-3 col-form-label text-md-start">{{ __('Country') }}</label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <select name="country" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="">Select country</option>
                                <option value="Kenya">Kenya</option>
                                <option value="Uganda">Uganda</option>
                                <option value="Tanzania">Tanzania</option>
                                <option value="Nigeria">Nigeria</option>
                              </select>
                            @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="dropdown-divider"></div>

                    <div class="row mb-2 p-3">
                        <label for="business_type" class="col-md-3 col-form-label text-md-start">{{ __('Type of Business') }}
                        <br> <span class="text-muted">Brief description of the main concern of
                            the business e.g Software, Marketing</span></label>

                        <div class="col-md-5 offset-md-0 text-center">
                            <select name="business_type" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                <option value="">Select type of business</option>
                                <option value="Software">Software</option>
                                <option value="Marketing">Marketing</option>
                                <option value="IT">IT</option>
                                <option value="Logistics">Logistics</option>
                              </select>
                            @error('business_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-2 p-3">
                        <label for="about" class="col-md-3 col-form-label text-md-start">{{ __('About') }} <br><span class="text-muted">Write a short introduction of the business. </span></label>


                        <div class="col-md-5 offset-md-0 text-center">
                            <div class="d-flex m-3 justify-content-center">
                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                                    <option value="">Long Text</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>


                                <i>   <span class="text-muted ml-3"> <b>B</b></span></i>
                                <i>   <span class="text-muted ml-3"> <i>I</i></span></i>
                                <i class="mx-2 mdi mdi-format-align-justify text-dark"></i>
                                <i class="mx-2 mdi mdi-format-line-spacing text-dark"></i>
                            </div>
                            <div class="form-floating mb-3">
                                <textarea class="form-control"  name="about" placeholder="Write company about here"  style="height: 100px" >
                                    {{$partner['about']}}
                                </textarea>

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
                        <label for="documents" class="col-md-3 col-form-label text-md-start">{{ __('Documents') }} <br><span class="text-muted">Upload any relevant documents related to
                            this business e.g KRA Pin, Company  Profile e.t.c </span></label>


                            <div class="col-md-5 offset-md-0 text-center">
                                <input id="documents" type="file" class="form-control @error('logo') is-invalid @enderror" name="documents" value="{{$partner['logo']}}">

                                @error('logo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                    </div>

                    <div class="row mb-2">
                        <label for="members" class="col-md-3 col-form-label text-md-start">{{ __('Members') }}
                        <br> <span class="text-muted">Invite or select the relevant members to this organisation.</span></label>

                        <div class="col-md-9 offset-md-0 text-center">
                            <div class="d-flex m-3 justify-content-between">
                                <select name="members" multiple class="form-select form-select mb-3">
                                    <option value="">Enter name or email address</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                  <select class="form-select form-select-lg mb-3 mx-3">
                                    <option value="">Select department</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                  <select class="form-select form-select mb-3">
                                    <option value="">Select Role</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                  </select>
                                  <button type="button" class="btn btn-warning ml-3 input-add">Add</button>
                            </div>
                            @error('members')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>




                    <div class="text-right">
                        <button class="btn btn-light border-dark p-3">
                            Cancel
                        </button>
                        <button class="btn btn-primary p-3">
                            Save changes
                        </button>
                    </div>
                    <div class="dropdown-divider"></div>
                </form>

            </div>




@endsection
