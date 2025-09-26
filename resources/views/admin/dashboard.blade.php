@extends('layouts.master')

@section('title') Admin Dashboard @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Admin Dashboard
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Welcome, {{ Auth::user()->full_name }}!</h4>
                            <p class="text-muted">Choose a module to manage your system</p>
                        </div>
                    </div>
                    
                    <!-- Module Cards -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card h-100 module-card" onclick="window.location.href='/hrm'">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="avatar avatar-xl bg-primary-transparent">
                                            <i class="bx bx-group fs-24"></i>
                                        </span>
                                    </div>
                                    <h5 class="card-title">HRM</h5>
                                    <p class="text-muted">Human Resource Management System</p>
                                    <div class="mt-3">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card h-100 module-card" onclick="window.location.href='/leads'">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="avatar avatar-xl bg-success-transparent">
                                            <i class="bx bx-target-lock fs-24"></i>
                                        </span>
                                    </div>
                                    <h5 class="card-title">Lead Tracking</h5>
                                    <p class="text-muted">Track and manage sales leads</p>
                                    <div class="mt-3">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card h-100 module-card" onclick="window.location.href='/deals'">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="avatar avatar-xl bg-info-transparent">
                                            <i class="bx bx-trending-up fs-24"></i>
                                        </span>
                                    </div>
                                    <h5 class="card-title">Deal Pipeline</h5>
                                    <p class="text-muted">Manage sales deals and opportunities</p>
                                    <div class="mt-3">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                            <div class="card custom-card h-100 module-card" onclick="window.location.href='/reports'">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="avatar avatar-xl bg-warning-transparent">
                                            <i class="bx bx-bar-chart-alt-2 fs-24"></i>
                                        </span>
                                    </div>
                                    <h5 class="card-title">Reports & Analytics</h5>
                                    <p class="text-muted">View reports and analytics dashboard</p>
                                    <div class="mt-3">
                                        <span class="badge bg-success">Active</span>
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

@section('styles')
<style>
    .module-card {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .module-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #007bff;
    }
    
    .module-card:hover .avatar {
        transform: scale(1.1);
    }
    
    .avatar {
        transition: all 0.3s ease;
    }
</style>
@endsection