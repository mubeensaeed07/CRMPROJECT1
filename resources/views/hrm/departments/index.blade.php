@extends('layouts.master')

@section('title') HRM - Departments @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Department Management
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Department Management System</h4>
                            <p class="text-muted">Organize your employees into departments</p>
                            
                            <!-- Department Stats -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-md bg-primary-transparent">
                                                        <i class="bx bx-building fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Total Departments</p>
                                                    <h4 class="mb-0 fw-semibold">12</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-md bg-success-transparent">
                                                        <i class="bx bx-user fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Total Employees</p>
                                                    <h4 class="mb-0 fw-semibold">150</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-md bg-warning-transparent">
                                                        <i class="bx bx-group fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Managers</p>
                                                    <h4 class="mb-0 fw-semibold">12</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-md bg-info-transparent">
                                                        <i class="bx bx-trending-up fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Growth Rate</p>
                                                    <h4 class="mb-0 fw-semibold">15%</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-primary btn-block">
                                        <i class="bx bx-plus"></i> Add Department
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-success btn-block">
                                        <i class="bx bx-edit"></i> Manage Departments
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-info btn-block">
                                        <i class="bx bx-user-plus"></i> Assign Managers
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-warning btn-block">
                                        <i class="bx bx-bar-chart"></i> Department Reports
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->
</div>
@endsection
