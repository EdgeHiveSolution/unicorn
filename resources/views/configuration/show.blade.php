@extends('layouts.app')
@section('content')
  
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="/partners">Deparment</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Department Details</li>
                    </ol>
                  </nav>
               <h1> {{$department['name']}}</h1>

               <ul class="d-flex nav justify-content-start mx-5">
                <li  class="nav-item menu-items ml-1"> <a href="department/performance" class=" text-primary">Perfomance</a></li>
                <li  class="nav-item menu-items mx-5"> <a href="department/partners" class=" text-muted">partners</a></li>
                <li class="nav-item menu-items mx-5">  <a href="department/members" class=" text-muted">Members</a></li>
                <li class="nav-item menu-items mx-5">  <a href="{{$department['id']}}/edit" class=" text-muted">Details</a></li>
               </ul>
               <div class="dropdown-divider"></div>
               <h3>Performance Overview</h3>

               <div class="row">
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="mb-2 text-danger">OFF TRACK</h5>
                            <h6 class="text-primary font-weight-normal lead text-dark">{{ 3 }}</h6>
                            <h5 class="mb-2 text-dark">PARTNERS</h5>
                            <span class="mdi mdi-arrow-up text-danger icon-item"> 40%</span> <small>vs last
                                month</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="mb-2 text-warning">AT RISK</h5>
                            <h6 class="text-primary font-weight-normal lead text-dark">{{ 1 }}</h6>
                            <h5 class="mb- text-dark">PARTNERS</h5>
                            <span class="mdi mdi-arrow-down text-warning icon-item"> -100%</span> <small>vs last
                                month</small>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                    <div class="card bg-light">
                        <div class="card-body">
                            <h5 class="mb-2 text-success">ON TRACK</h5>
                            <h6 class="text-primary font-weight-normal lead text-dark">{{ 6 }}</h6>
                            <h5 class="mb-2 text-dark">PARTNERS</h5>
                            <span class="mdi mdi-arrow-up text-success icon-item"> +50%</span> <span
                                class="ml-2"></span> <small>vs last month</small>
                        </div>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between my-3">
                                <div>

                                    <input class="btn btn-light p-3" type="text" placeholder="search for partners">
                                </div>
                                <div>
                                    <button class="btn btn-light p-3">
                                        <i class="mdi mdi-format-align-bottom text-dark"></i>
                                        Filters
                                    </button>

                                </div>
                            </div>
                            <div class="card-body">


                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Partner</th>
                                                <th>Progress</th>
                                                <th>Members </th>
                                                <th>Deparments </th>
                                                <th> Action </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td>
                                                    <img src="assets/images/faces/face1.jpg" alt="image" />
                                                    <span class="pl-2">Ranson Labs</span>
                                                </td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 48%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">48%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <img src="assets/images/faces/face1.jpg" alt="image" /> <img
                                                        src="assets/images/faces/face3.jpg" alt="image" /> <img
                                                        src="assets/images/faces/face4.jpg" alt="image" /> </td>
                                                <td> <span class="bg-warning p-2 border-3 m-2">Accounting</span> <span
                                                        class="bg-warning p-2 border-3 m-2">Admin</span><span
                                                        class="bg-warning p-2 border-3 m-2">sales</span> <span
                                                        class="bg-warning p-2 border-3 m-2">...</span></td>

                                                <td>
                                                    <div class="btn btn-primary p-2">View details</div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <img src="assets/images/faces/face2.jpg" alt="image" />
                                                    <span class="pl-2">Popote</span>
                                                </td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 18%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">18%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <img src="assets/images/faces/face1.jpg" alt="image" /> <img
                                                        src="assets/images/faces/face5.jpg" alt="image" /> <img
                                                        src="assets/images/faces/face6.jpg" alt="image" /></td>
                                                <td><span class="bg-warning p-2 border-3 m-2">Admin</span> <span
                                                        class="bg-warning p-2 border-3 m-2">Marketing</span> <span
                                                        class="bg-warning p-2 border-3 m-2">Sales</span> </td>

                                                <td>
                                                    <div class="btn btn-primary p-2">View details</div>
                                                </td>
                                            </tr>
                                            <tr>

                                                <td>
                                                    <img src="assets/images/faces/face9.jpg" alt="image" />
                                                    <span class="pl-2">Soko Digi</span>


                                                </td>
                                                <td>
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 56%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">56%
                                                        </div>
                                                    </div>
                                                </td>
                                                <td> <img src="assets/images/faces/face9.jpg" alt="image" /> <img
                                                        src="assets/images/faces/face6.jpg" alt="image" /> <img
                                                        src="assets/images/faces/face1.jpg" alt="image" /></td>
                                                <td><span class="bg-warning p-2 border-3 m-2">Marketing</span> <span
                                                        class="bg-warning p-2 border-3 m-2">Sales</span></td>

                                                <td>
                                                    <div class="btn btn-primary p-2">View details</div>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


@endsection
