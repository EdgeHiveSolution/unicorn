@extends('layouts.app')
@section('content')
    <div class="container-scroller">

        @include('inc.sidebar')

        <main class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/configurations">Configurations</a></li>
                      <li class="breadcrumb-item active" aria-current="page">New metric</li>
                    </ol>
                  </nav>
                  <h2 class="text-center">New Metric</h2>
                  <div class="col-8 card mx-auto bg-light p-4">
                    <h3 class="mt-5">Add Metric Type</h3>
                    <form method="POST" action="{{ route('metrics.store') }}" class="p-4">
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
                                <label for="data_type" class="col-form-label text-md-start">{{ __('Standard unit of measurement') }}</label>
                                <select name="data_type" class="form-select">
                                    <option value="">Choose</option>
                                    <option value="1">Count</option>
                                    <option value="2">Currency</option>
                                    <option value="3">Time</option>
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
            </div>
        </main>
    </div>
@endsection
