@extends('layouts.app')
@section('content')

                <div class="module-nav">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="/partners">Partners</a></li>
                          <li class="breadcrumb-item active" aria-current="page">New partner</li>
                        </ol>
                      </nav>
                      <h2>New Partner </h2>
                    <p>On-board a new partner to UNICON.</p>
                    <div class="d-flex justify-content-between">
                        <div class="">
                            <h3>Partner Info</h3>
                            <p>Enter the photo and basic details of the partner here</p>
                        </div>

                        <div class="">
                            <button class="btn btn-light border-dark p-3">
                                Cancel
                            </button>
                            <button type="button" onclick="event.preventDefault(); document.getElementById('submit-form').submit();" class="btn btn-primary p-3">
                               Save changes
                            </button>
                        </div>

                        <div class="">

                        </div>

                    </div>
                </div>

               


@endsection
