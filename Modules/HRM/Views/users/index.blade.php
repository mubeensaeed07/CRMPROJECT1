@extends('layouts.master')

@section('title') Users Management - HRM @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Users Management
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('hrm.users.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Create New User
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Statistics Cards -->
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
                                            <p class="mb-0 text-muted">Total Users</p>
                                            <h4 class="mb-0 fw-semibold">25</h4>
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
                                            <p class="mb-0 text-muted">Active Users</p>
                                            <h4 class="mb-0 fw-semibold">23</h4>
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
                                            <p class="mb-0 text-muted">Inactive Users</p>
                                            <h4 class="mb-0 fw-semibold">2</h4>
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
                                                <i class="bx bx-group fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Departments</p>
                                            <h4 class="mb-0 fw-semibold">5</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users List -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">All Users</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Department</th>
                                                    <th>Role</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>John Doe</td>
                                                    <td>john.doe@company.com</td>
                                                    <td>Human Resources</td>
                                                    <td><span class="badge bg-primary">Employee</span></td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">Edit</button>
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Jane Smith</td>
                                                    <td>jane.smith@company.com</td>
                                                    <td>Information Technology</td>
                                                    <td><span class="badge bg-info">Manager</span></td>
                                                    <td><span class="badge bg-success">Active</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">Edit</button>
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Mike Johnson</td>
                                                    <td>mike.johnson@company.com</td>
                                                    <td>Finance</td>
                                                    <td><span class="badge bg-warning">Supervisor</span></td>
                                                    <td><span class="badge bg-warning">Inactive</span></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning">Edit</button>
                                                        <button class="btn btn-sm btn-danger">Delete</button>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
