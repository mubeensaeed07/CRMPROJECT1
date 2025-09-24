@extends('layouts.master')

@section('title') Super Admin Dashboard @endsection

@section('styles')
@endsection

@section('content')

<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Super Admin Dashboard
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Welcome, {{ Auth::user()->full_name }}!</h4>
                            <p class="text-muted">Manage the entire CRM system</p>
                        </div>
                    </div>
                    
                    <!-- Statistics Cards -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                            <div class="card custom-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <span class="avatar avatar-md bg-primary-transparent">
                                                <i class="bx bx-user fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Total Users</p>
                                            <h4 class="mb-0 fw-semibold">{{ $totalUsers }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                            <div class="card custom-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <span class="avatar avatar-md bg-warning-transparent">
                                                <i class="bx bx-time fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Pending Admins</p>
                                            <h4 class="mb-0 fw-semibold">{{ $pendingAdmins->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                            <div class="card custom-card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <span class="avatar avatar-md bg-success-transparent">
                                                <i class="bx bx-check-circle fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Approved Admins</p>
                                            <h4 class="mb-0 fw-semibold">{{ $approvedAdmins->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 mb-3">
                            <div class="card custom-card h-100">
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

                    <!-- Pending Admin Approvals -->
                    @if($pendingAdmins->count() > 0)
                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Pending Admin Approvals</div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Registration Date</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($pendingAdmins as $admin)
                                                <tr>
                                                    <td>{{ $admin->full_name }}</td>
                                                    <td>{{ $admin->email }}</td>
                                                    <td>{{ $admin->created_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <form method="POST" action="{{ route('superadmin.approve', $admin->id) }}" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-success">Approve</button>
                                                        </form>
                                                        <form method="POST" action="{{ route('superadmin.reject', $admin->id) }}" style="display: inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Reject</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- All Modules Display -->
                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">All Available Modules</div>
                                    <p class="text-muted mb-0">Complete access to all CRM modules</p>
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

                    <!-- Module Management -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Module Management</div>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="{{ route('superadmin.modules.create') }}" class="mb-4">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Module Name</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Description</label>
                                                    <input type="text" class="form-control" name="description">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Icon</label>
                                                    <input type="text" class="form-control" name="icon" placeholder="bx bx-grid-alt">
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary">Add Module</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Description</th>
                                                    <th>Icon</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse($modules as $module)
                                                <tr>
                                                    <td>{{ $module->name }}</td>
                                                    <td>{{ $module->description }}</td>
                                                    <td><i class="{{ $module->icon }}"></i></td>
                                                    <td>
                                                        <button class="btn btn-sm btn-warning" onclick="editModule({{ $module->id }})">Edit</button>
                                                        <button class="btn btn-sm btn-danger" onclick="deleteModule({{ $module->id }})">Delete</button>
                                                    </td>
                                                </tr>
                                                @empty
                                                <tr>
                                                    <td colspan="4" class="text-center">No modules found</td>
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
function editModule(moduleId) {
    // Implement edit functionality
    alert('Edit module: ' + moduleId);
}

function deleteModule(moduleId) {
    if (confirm('Are you sure you want to delete this module? This will remove it from all users and cannot be undone.')) {
        // Create a form to submit the delete request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/superadmin/modules/' + moduleId;
        
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
