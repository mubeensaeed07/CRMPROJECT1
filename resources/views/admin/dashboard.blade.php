@extends('layouts.master')

@section('title') Admin Dashboard @endsection

@section('styles')
<style>
    .form-check {
        padding: 8px 12px;
        border: 1px solid #e9ecef;
        border-radius: 6px;
        margin-bottom: 8px;
        transition: all 0.2s ease;
    }
    
    .form-check:hover {
        background-color: #f8f9fa;
        border-color: #007bff;
    }
    
    .form-check-input:checked + .form-check-label {
        font-weight: 600;
        color: #007bff;
    }
    
    .form-check-input:checked {
        background-color: #007bff;
        border-color: #007bff;
    }
    
    .module-selection-info {
        background-color: #e3f2fd;
        border: 1px solid #bbdefb;
        border-radius: 6px;
        padding: 12px;
        margin-bottom: 16px;
    }
</style>
@endsection

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
                            <p class="text-muted">Manage users and assign modules</p>
                        </div>
                    </div>
                    
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
                                            <h4 class="mb-0 fw-semibold">{{ $users->count() }}</h4>
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
                                                <i class="bx bx-grid-alt fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Total Modules</p>
                                            <h4 class="mb-0 fw-semibold">{{ $modules->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- All Modules Display -->
                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">All Available Modules</div>
                                    <p class="text-muted mb-0">Full access to all CRM modules for user assignment</p>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @forelse($modules as $module)
                                            <x-module-card 
                                                :module="$module" 
                                                :isAssigned="true"
                                                :showAssignButton="false"
                                            />
                                        @empty
                                            <div class="col-12">
                                                <div class="text-center py-4">
                                                    <i class="ti ti-package fs-48 text-muted"></i>
                                                    <p class="text-muted mt-2">No modules available</p>
                                                </div>
                                            </div>
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add User Form -->
                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Add New User</div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('admin.users.add') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">First Name</label>
                                                    <input type="text" class="form-control" name="first_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" name="last_name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">User Type</label>
                                                    <select class="form-control" name="user_type" required>
                                                        <option value="">Select User Type</option>
                                                        @foreach($userTypes as $userType)
                                                            <option value="{{ $userType->id }}">{{ $userType->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Assign Modules</label>
                                                    <div class="module-selection-info">
                                                        <i class="ti ti-info-circle me-2"></i>
                                                        <strong>Tip:</strong> Click on modules to select them. You can select multiple modules by clicking on each one.
                                                    </div>
                                                    <div class="row">
                                                        @foreach($modules as $module)
                                                        <div class="col-md-3 col-sm-6 mb-2">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="modules[]" value="{{ $module->id }}" id="module_{{ $module->id }}">
                                                                <label class="form-check-label" for="module_{{ $module->id }}">
                                                                    {{ $module->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Add User</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Users List -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Users Management</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>User Type</th>
                                                    <th>Modules</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($users as $user)
                                                <tr>
                                                    <td>{{ $user->full_name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if($user->userInfo && $user->userInfo->userType)
                                                            <span class="badge bg-info">{{ $user->userInfo->userType->name }}</span>
                                                        @else
                                                            <span class="text-muted">Not assigned</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach($user->userModules as $userModule)
                                                            <span class="badge bg-primary me-1">{{ $userModule->module->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" onclick="editUser({{ $user->id }})">Edit</button>
                                                        <button class="btn btn-sm btn-info" onclick="resetPassword({{ $user->id }})">Reset Password</button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteUser({{ $user->id }})">Delete</button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="5" class="text-center">No users found</td>
                                                </tr>
                                                @endforelse
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

@section('scripts')
<script>
// Simple checkbox selection for modules
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('input[name="modules[]"]');
    
    // Add visual feedback for checkbox selection
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                this.parentElement.style.backgroundColor = '#e8f5e8';
                this.parentElement.style.borderColor = '#28a745';
            } else {
                this.parentElement.style.backgroundColor = '';
                this.parentElement.style.borderColor = '#e9ecef';
            }
        });
    });
});

function editUser(userId) {
    // Show edit modal or redirect to edit page
    const editUrl = `/admin/users/${userId}/edit`;
    window.location.href = editUrl;
}

function resetPassword(userId) {
    if (confirm('Are you sure you want to reset this user\'s password? A new password will be generated and sent to their email.')) {
        // Create a form to submit the password reset request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/users/${userId}/reset-password`;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user? This action cannot be undone.')) {
        // Create a form to submit the delete request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/users/${userId}`;
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method override for DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection
