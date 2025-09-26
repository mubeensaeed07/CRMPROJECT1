@extends('layouts.master')

@section('title') Supervisor Management @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Supervisor Management
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('admin.supervisors.create') }}" class="btn btn-primary">
                            <i class="bx bx-plus"></i> Create Supervisor
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
                                                <i class="bx bx-user-check fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Total Supervisors</p>
                                            <h4 class="mb-0 fw-semibold">{{ $supervisors->count() }}</h4>
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
                                            <p class="mb-0 text-muted">Active Supervisors</p>
                                            <h4 class="mb-0 fw-semibold">{{ $supervisors->where('status', 'active')->count() }}</h4>
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
                                            <p class="mb-0 text-muted">Inactive Supervisors</p>
                                            <h4 class="mb-0 fw-semibold">{{ $supervisors->where('status', 'inactive')->count() }}</h4>
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

                    <!-- Supervisors List -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">All Supervisors</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Modules</th>
                                                    <th>Permissions</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($supervisors as $supervisor)
                                                <tr>
                                                    <td>{{ $supervisor->full_name }}</td>
                                                    <td>{{ $supervisor->email }}</td>
                                                    <td>
                                                        @if($supervisor->status === 'active')
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-warning">Inactive</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @foreach($supervisor->permissions as $permission)
                                                            <span class="badge bg-primary me-1">{{ $permission->module->name }}</span>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @php
                                                            $permissions = [];
                                                            foreach($supervisor->permissions as $permission) {
                                                                if($permission->can_create_users) $permissions[] = 'Create Users';
                                                                if($permission->can_edit_users) $permissions[] = 'Edit Users';
                                                                if($permission->can_delete_users) $permissions[] = 'Delete Users';
                                                                if($permission->can_reset_passwords) $permissions[] = 'Reset Passwords';
                                                                if($permission->can_assign_modules) $permissions[] = 'Assign Modules';
                                                                if($permission->can_view_reports) $permissions[] = 'View Reports';
                                                            }
                                                        @endphp
                                                        <small class="text-muted">{{ implode(', ', array_unique($permissions)) }}</small>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('admin.supervisors.show', $supervisor->id) }}" class="btn btn-sm btn-info">View</a>
                                                            <a href="{{ route('admin.supervisors.edit', $supervisor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                            <button class="btn btn-sm btn-secondary" onclick="resetPassword({{ $supervisor->id }})">Reset Password</button>
                                                            <button class="btn btn-sm btn-danger" onclick="deleteSupervisor({{ $supervisor->id }})">Delete</button>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="6" class="text-center">No supervisors found</td>
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
