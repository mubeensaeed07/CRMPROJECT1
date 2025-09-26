@extends('layouts.master')

@section('title') Supervisor Details @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Supervisor Details: {{ $supervisor->full_name }}
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('admin.supervisors.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Back to Supervisors
                        </a>
                        <a href="{{ route('admin.supervisors.edit', $supervisor->id) }}" class="btn btn-warning">
                            <i class="bx bx-edit"></i> Edit
                        </a>
                    </div>
                </div>
                <div class="card-body">
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
                                                <label class="form-label fw-bold">First Name</label>
                                                <p class="form-control-plaintext">{{ $supervisor->first_name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Last Name</label>
                                                <p class="form-control-plaintext">{{ $supervisor->last_name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Email Address</label>
                                                <p class="form-control-plaintext">{{ $supervisor->email }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Status</label>
                                                <p class="form-control-plaintext">
                                                    @if($supervisor->status === 'active')
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-warning">Inactive</span>
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Created By</label>
                                                <p class="form-control-plaintext">{{ $supervisor->admin->full_name }}</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Created At</label>
                                                <p class="form-control-plaintext">{{ $supervisor->created_at->format('M d, Y H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="col-xl-6">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Actions</div>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('admin.supervisors.edit', $supervisor->id) }}" class="btn btn-warning">
                                            <i class="bx bx-edit"></i> Edit Supervisor
                                        </a>
                                        <button class="btn btn-info" onclick="resetPassword({{ $supervisor->id }})">
                                            <i class="bx bx-key"></i> Reset Password
                                        </button>
                                        @if($supervisor->status === 'active')
                                            <button class="btn btn-secondary" onclick="deactivateSupervisor({{ $supervisor->id }})">
                                                <i class="bx bx-pause"></i> Deactivate
                                            </button>
                                        @else
                                            <button class="btn btn-success" onclick="activateSupervisor({{ $supervisor->id }})">
                                                <i class="bx bx-play"></i> Activate
                                            </button>
                                        @endif
                                        <button class="btn btn-danger" onclick="deleteSupervisor({{ $supervisor->id }})">
                                            <i class="bx bx-trash"></i> Delete Supervisor
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Module Permissions -->
                        <div class="col-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Module Permissions</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @forelse($supervisor->permissions as $permission)
                                        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                                            <div class="card custom-card">
                                                <div class="card-header">
                                                    <div class="card-title">{{ $permission->module->name }}</div>
                                                </div>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" {{ $permission->can_create_users ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label">Create Users</label>
                                                            </div>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" {{ $permission->can_edit_users ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label">Edit Users</label>
                                                            </div>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" {{ $permission->can_delete_users ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label">Delete Users</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" {{ $permission->can_reset_passwords ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label">Reset Passwords</label>
                                                            </div>
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="checkbox" {{ $permission->can_assign_modules ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label">Assign Modules</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" {{ $permission->can_view_reports ? 'checked' : '' }} disabled>
                                                                <label class="form-check-label">View Reports</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-12">
                                            <div class="text-center py-4">
                                                <i class="ti ti-package fs-48 text-muted"></i>
                                                <p class="text-muted mt-2">No modules assigned</p>
                                            </div>
                                        </div>
                                        @endforelse
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
function resetPassword(supervisorId) {
    if (confirm('Are you sure you want to reset this supervisor\'s password? A new password will be generated and sent to their email.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/supervisors/${supervisorId}/reset-password`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        document.body.appendChild(form);
        form.submit();
    }
}

function deactivateSupervisor(supervisorId) {
    if (confirm('Are you sure you want to deactivate this supervisor?')) {
        // Redirect to edit page with status change
        window.location.href = `/admin/supervisors/${supervisorId}/edit?status=inactive`;
    }
}

function activateSupervisor(supervisorId) {
    if (confirm('Are you sure you want to activate this supervisor?')) {
        // Redirect to edit page with status change
        window.location.href = `/admin/supervisors/${supervisorId}/edit?status=active`;
    }
}

function deleteSupervisor(supervisorId) {
    if (confirm('Are you sure you want to delete this supervisor? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/supervisors/${supervisorId}`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
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
