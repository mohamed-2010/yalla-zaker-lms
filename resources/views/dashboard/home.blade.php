@extends('dashboard.layouts.app')

@section('meta_title')

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="col-12">														
            <div class="box no-shadow mb-0 bg-transparent">
                <div class="box-header no-border px-0">
                    <h4 class="box-title">إحصائيات عامه</h4>	
                    <ul class="box-controls pull-right d-md-flex d-none">
                      {{-- <li>
                        <button class="btn btn-primary-light px-10">View All</button>
                      </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($analytics as $analysis)
                <div class="col-lg-3 col-md-6 col-12">
                    <div class="box pull-up">
                        <div class="box-body d-flex align-items-center">
                            <img src="{{asset('')}}images/front-end-img/courses/cor-logo-6.png" alt="" class="align-self-end h-80 w-80">
                            <div class="d-flex flex-column flex-grow-1">
                                <h5 class="box-title fs-16 mb-2 text-center">{{ $analysis['count'] }}</h5>
                                <p class="box-body fs-12 mb-2">{{ $analysis['name'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- <div class="row">
            <div class="col-12 col-xl-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Students Progress </h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                          <li class="dropdown">
                            <button class="btn btn-primary px-10 " data-bs-toggle="dropdown" href="#">View List</button>
                          </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center fw-500">
                                <div class="me-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Amelia</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-600 mb-0 badge badge-pill badge-primary">75%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center fw-500">
                                <div class="me-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-2.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Johen</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-warning progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="64" aria-valuemin="0" aria-valuemax="100" style="width: 64%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-600 mb-0 badge badge-pill badge-warning">64%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center fw-500">
                                <div class="me-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Micheal</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-info progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="59" aria-valuemin="0" aria-valuemax="100" style="width: 59%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-600 mb-0 badge badge-pill badge-info">59%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-30 gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center fw-500">
                                <div class="me-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Amanda</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-danger progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-600 mb-0 badge badge-pill badge-danger">45%</h5>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-items-3 justify-content-between">
                            <div class="d-flex align-items-center fw-500">
                                <div class="me-15 w-50 d-table">
                                    <img src="../images/avatar/avatar-1.png" class="avatar avatar-lg rounded10 bg-primary-light" alt="">
                                </div>
                                <div>
                                    <a href="#" class="text-dark hover-primary mb-5 d-block fs-16">Tyler</a>
                                    <div class="w-200">
                                        <div class="progress progress-sm mb-0">
                                            <div class="progress-bar progress-bar-primary progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-end">
                                <h5 class="fw-600 mb-0 badge badge-pill badge-primary">20%</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-xl-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Working Hours</h4>
                        <ul class="box-controls pull-right d-md-flex d-none">
                          <li class="dropdown">
                            <button class="dropdown-toggle btn btn-warning-light px-10" data-bs-toggle="dropdown" href="#">Today</button>										  
                            <div class="dropdown-menu dropdown-menu-end">
                              <a class="dropdown-item active" href="#">Today</a>
                              <a class="dropdown-item" href="#">Yesterday</a>
                              <a class="dropdown-item" href="#">Last week</a>
                              <a class="dropdown-item" href="#">Last month</a>
                            </div>
                          </li>
                        </ul>
                    </div>
                    <div class="box-body">
                        <div id="revenue5" class="min-h-325"></div>
                        <div class="d-flex justify-content-center">
                            <p class="d-flex align-items-center fw-600 mx-20"><span class="badge badge-xl badge-dot badge-warning me-20"></span> Progress</p>
                            <p class="d-flex align-items-center fw-600 mx-20"><span class="badge badge-xl badge-dot badge-primary me-20"></span> Done</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6">
                <div class="box">
                    <div class="box-body d-flex p-0">
                        <div class="flex-grow-1 bg-danger p-30 flex-grow-1 bg-img" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-3.svg)">

                            <h4 class="fw-400">User Activity</h4>

                            <p class="my-10 fs-16">
                                Grow marketing &amp; sales<br>through product.
                            </p>

                            <a href="#" class="btn btn-danger-light">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="box">
                    <div class="box-body d-flex p-0">
                    <div class="flex-grow-1 bg-primary p-30 flex-grow-1 bg-img" style="background-position: calc(100% + 0.5rem) bottom; background-size: auto 100%; background-image: url(../images/svg-icon/color-svg/custom-4.svg)">

                        <h4 class="fw-400">Based On</h4>

                        <div class="mt-5">
                            <div class="d-flex mb-10 fs-16">
                                <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span class="path2"></span></span>
                                <span class="text-white">Activities</span>
                            </div>

                            <div class="d-flex mb-10 fs-16">
                                <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span class="path2"></span></span>
                                <span class="text-white">Sales</span>
                            </div>

                            <div class="d-flex mb-10 fs-16">
                                <span class="icon-Arrow-right mt-5 me-10"><span class="path1"></span><span class="path2"></span></span>
                                <span class="text-white">Releases</span>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box bg-transparent no-shadow mb-0">
            <div class="box-header no-border">
                <h4 class="box-title">Media Files</h4>							
                <div class="box-controls pull-right d-md-flex d-none">
                  <a href="#">View All</a>
                </div>
            </div>
        </div>
        <div class="box">
            <div class="box-body py-0">
                <div class="table-responsive">
                    <table class="table no-border mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="bg-danger h-50 w-50 l-h-50 rounded text-center">
                                      <p class="mb-0 fs-20 fw-600">A1</p>
                                    </div>
                                </td>
                                <td class="fw-600">Biology Course</td>
                                <td class="text-fade">StarterReplacement.pdf</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-warning me-10"></span>Only view</td>
                                <td class="text-fade">78 members</td>
                                <td class="fw-600">47 MB</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="bg-info h-50 w-50 l-h-50 rounded text-center">
                                      <p class="mb-0 fs-20 fw-600">B1</p>
                                    </div>
                                </td>
                                <td class="fw-600">Contemporary Art</td>
                                <td class="text-fade">Loremipsum.doc</td>
                                <td class="fw-500 text-warning"><span class="badge badge-sm badge-dot badge-warning me-10"></span>Edit available</td>
                                <td class="text-fade">78 members</td>
                                <td class="fw-600">78 MB</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="bg-primary h-50 w-50 l-h-50 rounded text-center">
                                      <p class="mb-0 fs-20 fw-600">C1</p>
                                    </div>
                                </td>
                                <td class="fw-600">Programming Language</td>
                                <td class="text-fade">phpcore.mp3</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-primary me-10"></span>Only view</td>
                                <td class="text-fade">48 members</td>
                                <td class="fw-600">12 MB</td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="bg-success h-50 w-50 l-h-50 rounded text-center">
                                      <p class="mb-0 fs-20 fw-600">A2</p>
                                    </div>
                                </td>
                                <td class="fw-600">Geometry Course</td>
                                <td class="text-fade">dummyabz.pdf</td>
                                <td class="fw-500"><span class="badge badge-sm badge-dot badge-primary me-10"></span>Only view</td>
                                <td class="text-fade">24 members</td>
                                <td class="fw-600">18 MB</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>										 --}}
    </div>
    
</div>

@endsection