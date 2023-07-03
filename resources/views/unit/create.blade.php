@extends('layouts.app')
@section('content')
    <div class="container-scroller">

        @include('inc.sidebar')

        <main class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/partners">Deparments</a></li>
                      <li class="breadcrumb-item active" aria-current="page">New Department</li>
                    </ol>
                  </nav>
                  <h2>New Department </h2>
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
                        <button class="btn btn-primary p-3">
                            Add
                        </button>
                    </div>

                    <div class="">

                    </div>

                </div>

                <h3 class="mt-5">Add Standard Unit</h3>
                    <form method="POST" action="{{ route('units.store') }}" class="p-4">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="col-form-label text-md-start">{{ __('Name') }}</label>
                                <input id="name" name="name" class="form-control @error('name') is-invalid @enderror" type="text" value="{{ old('name') }}" autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label for="data_type" class="col-form-label text-md-start">{{ __('Data type') }}</label>
                                <select name="data_type" class="form-select">
                                    <option value="">Select data type</option>
                                    <option value="integer">integer</option>
                                    <option value="number">Number</option>
                                    <option value="date/time">Date/time</option>
                                </select>

                                @error('data_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('data_type') }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="text-left">
                            <button class="btn btn-light border-dark py-3 px-4 mr-2">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary py-3 px-4">
                                Add
                            </button>
                        </div>
                    </form>

            </div>

        </main>
    </div>


@endsection

