@extends('layouts.master')

@section('title') HRM - Attendance @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Attendance Management
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Attendance Management System</h4>
                            <p class="text-muted">Track and manage employee attendance</p>
                            
                            <!-- Attendance Stats -->
                            <div class="row mb-4">
                                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                    <div class="card custom-card">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <span class="avatar avatar-md bg-primary-transparent">
                                                        <i class="bx bx-user-check fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Present Today</p>
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
                                                    <p class="mb-0 text-muted">Absent Today</p>
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
                                                        <i class="bx bx-time fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Late Arrivals</p>
                                                    <h4 class="mb-0 fw-semibold">5</h4>
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
                                                        <i class="bx bx-trending-up fs-18"></i>
                                                    </span>
                                                </div>
                                                <div>
                                                    <p class="mb-0 text-muted">Attendance Rate</p>
                                                    <h4 class="mb-0 fw-semibold">94.7%</h4>
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
                                        <i class="bx bx-plus"></i> Mark Attendance
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-success btn-block">
                                        <i class="bx bx-import"></i> Bulk Import
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-info btn-block">
                                        <i class="bx bx-calendar"></i> View Calendar
                                    </a>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <a href="#" class="btn btn-warning btn-block">
                                        <i class="bx bx-bar-chart"></i> Reports
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
