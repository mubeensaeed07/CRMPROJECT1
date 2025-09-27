@extends('layouts.master')

@section('title') Create User - HRM @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Create New User
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('hrm.dashboard') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Back to HRM Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('hrm.users.store') }}">
                        @csrf
                        <div class="row">
                            <!-- Basic Information -->
                            <div class="col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">Basic Information</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
                                                    @error('first_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
                                                    @error('last_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Salary</label>
                                                    <input type="number" class="form-control" name="salary" value="{{ old('salary') }}" step="0.01" min="0">
                                                    @error('salary')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Phone Number</label>
                                                    <input type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Department</label>
                                                    <select class="form-control" name="department">
                                                        <option value="">Select Department</option>
                                                        <option value="hr">Human Resources</option>
                                                        <option value="it">Information Technology</option>
                                                        <option value="finance">Finance</option>
                                                        <option value="marketing">Marketing</option>
                                                        <option value="sales">Sales</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- User Role & Permissions -->
                            <div class="col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">Role & Permissions</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">User Role <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="role" required>
                                                        <option value="">Select Role</option>
                                                        <option value="employee">Employee</option>
                                                        <option value="supervisor">Supervisor</option>
                                                        <option value="manager">Manager</option>
                                                    </select>
                                                    @error('role')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">HRM Module Access</label>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="modules[]" value="employees" id="module_employees">
                                                                <label class="form-check-label" for="module_employees">
                                                                    Employee Management
                                                                </label>
                                                            </div>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="modules[]" value="departments" id="module_departments">
                                                                <label class="form-check-label" for="module_departments">
                                                                    Department Management
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="modules[]" value="attendance" id="module_attendance">
                                                                <label class="form-check-label" for="module_attendance">
                                                                    Attendance Tracking
                                                                </label>
                                                            </div>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" name="modules[]" value="payroll" id="module_payroll">
                                                                <label class="form-check-label" for="module_payroll">
                                                                    Payroll Management
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save"></i> Create User
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End::row-1 -->
</div>
@endsection
