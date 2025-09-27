@extends('layouts.master')

@section('title') {{ $module->name }} Module @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="{{ $module->icon ?? 'ti ti-package' }} me-2"></i>
                        {{ $module->name }} Module
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('supervisor.dashboard') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Welcome to {{ $module->name }}!</h4>
                            <p class="text-muted">{{ $module->description }}</p>
                        </div>
                    </div>
                    
                    <!-- Module Information -->
                    <div class="row mb-4">
                        <div class="col-xl-8">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Module Information</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p><strong>Module Name:</strong> {{ $module->name }}</p>
                                            <p><strong>Category:</strong> {{ $module->category ?? 'General' }}</p>
                                            <p><strong>Status:</strong> 
                                                <span class="badge bg-{{ $module->is_active ? 'success' : 'warning' }}">
                                                    {{ $module->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </p>
                                        </div>
                                        <div class="col-md-6">
                                            <p><strong>Icon:</strong> <i class="{{ $module->icon ?? 'ti ti-package' }}"></i></p>
                                            <p><strong>Created:</strong> {{ $module->created_at->format('M d, Y') }}</p>
                                            <p><strong>Last Updated:</strong> {{ $module->updated_at->format('M d, Y') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Your Permissions</div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-column gap-2">
                                        @if($permissions['can_create_users'])
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-check-circle text-success me-2"></i>
                                                <span>Create Users</span>
                                            </div>
                                        @endif
                                        @if($permissions['can_edit_users'])
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-check-circle text-success me-2"></i>
                                                <span>Edit Users</span>
                                            </div>
                                        @endif
                                        @if($permissions['can_delete_users'])
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-check-circle text-success me-2"></i>
                                                <span>Delete Users</span>
                                            </div>
                                        @endif
                                        @if($permissions['can_reset_passwords'])
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-check-circle text-success me-2"></i>
                                                <span>Reset Passwords</span>
                                            </div>
                                        @endif
                                        @if($permissions['can_assign_modules'])
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-check-circle text-success me-2"></i>
                                                <span>Assign Modules</span>
                                            </div>
                                        @endif
                                        @if($permissions['can_view_reports'])
                                            <div class="d-flex align-items-center">
                                                <i class="ti ti-check-circle text-success me-2"></i>
                                                <span>View Reports</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Module Actions -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Available Actions</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @if($permissions['can_create_users'])
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                                                <div class="card custom-card">
                                                    <div class="card-body text-center">
                                                        <div class="avatar avatar-lg bg-success-transparent mx-auto mb-3">
                                                            <i class="ti ti-user-plus fs-24"></i>
                                                        </div>
                                                        <h6 class="card-title">Create User</h6>
                                                        <p class="text-muted fs-13">Add new users to this module</p>
                                                        <a href="#" class="btn btn-sm btn-success">Create</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($permissions['can_edit_users'])
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                                                <div class="card custom-card">
                                                    <div class="card-body text-center">
                                                        <div class="avatar avatar-lg bg-warning-transparent mx-auto mb-3">
                                                            <i class="ti ti-user-edit fs-24"></i>
                                                        </div>
                                                        <h6 class="card-title">Manage Users</h6>
                                                        <p class="text-muted fs-13">Edit and update user information</p>
                                                        <a href="#" class="btn btn-sm btn-warning">Manage</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($permissions['can_view_reports'])
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                                                <div class="card custom-card">
                                                    <div class="card-body text-center">
                                                        <div class="avatar avatar-lg bg-info-transparent mx-auto mb-3">
                                                            <i class="ti ti-chart-bar fs-24"></i>
                                                        </div>
                                                        <h6 class="card-title">View Reports</h6>
                                                        <p class="text-muted fs-13">Access module reports and analytics</p>
                                                        <a href="#" class="btn btn-sm btn-info">Reports</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        @if($permissions['can_reset_passwords'])
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                                                <div class="card custom-card">
                                                    <div class="card-body text-center">
                                                        <div class="avatar avatar-lg bg-primary-transparent mx-auto mb-3">
                                                            <i class="ti ti-key fs-24"></i>
                                                        </div>
                                                        <h6 class="card-title">Reset Passwords</h6>
                                                        <p class="text-muted fs-13">Reset user passwords</p>
                                                        <a href="#" class="btn btn-sm btn-primary">Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    @if(!$permissions['can_create_users'] && !$permissions['can_edit_users'] && !$permissions['can_view_reports'] && !$permissions['can_reset_passwords'])
                                        <div class="text-center py-4">
                                            <i class="ti ti-lock fs-48 text-muted"></i>
                                            <p class="text-muted mt-2">No specific permissions assigned</p>
                                            <p class="text-muted">Contact your administrator for module access</p>
                                        </div>
                                    @endif
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
