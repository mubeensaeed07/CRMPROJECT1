@extends('layouts.master')

@section('title') HRM - Employees @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Employee Management
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Employee Management System</h4>
                            <p class="text-muted">Manage your organization's employees</p>
                            
                            <!-- Employee Stats -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-md bg-primary-transparent">
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
                                                    <span class="avatar avatar-md bg-success-transparent">
                                                        <i class="bx bx-user-check fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Active Employees</p>
                                                    <h4 class="mb-0 fw-semibold">142</h4>
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
                                                        <i class="bx bx-user-x fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">On Leave</p>
                                                    <h4 class="mb-0 fw-semibold">8</h4>
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
                                                        <i class="bx bx-building fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Departments</p>
                                                    <h4 class="mb-0 fw-semibold">12</h4>
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
                                        <i class="bx bx-plus"></i> Add Employee
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-success btn-block">
                                        <i class="bx bx-import"></i> Import Employees
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-info btn-block">
                                        <i class="bx bx-export"></i> Export Data
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-warning btn-block">
                                        <i class="bx bx-cog"></i> Settings
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
