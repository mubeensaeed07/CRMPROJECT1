@extends('layouts.master')

@section('title') HRM - Payroll @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Payroll Management
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Payroll Management System</h4>
                            <p class="text-muted">Manage employee salaries and payments</p>
                            
                            <!-- Payroll Stats -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-md bg-primary-transparent">
                                                        <i class="bx bx-money fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Total Payroll</p>
                                                    <h4 class="mb-0 fw-semibold">$125,000</h4>
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
                                                        <i class="bx bx-check-circle fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Processed</p>
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
                                                        <i class="bx bx-time fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Pending</p>
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
                                                        <i class="bx bx-trending-up fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Average Salary</p>
                                                    <h4 class="mb-0 fw-semibold">$4,200</h4>
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
                                        <i class="bx bx-plus"></i> Process Payroll
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-success btn-block">
                                        <i class="bx bx-edit"></i> Manage Salaries
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-info btn-block">
                                        <i class="bx bx-export"></i> Export Reports
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-warning btn-block">
                                        <i class="bx bx-cog"></i> Payroll Settings
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
