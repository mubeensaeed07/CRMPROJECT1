@extends('layouts.master')

@section('title') Edit Supervisor @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Edit Supervisor: {{ $supervisor->full_name }}
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('admin.supervisors.index') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Back to Supervisors
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.supervisors.update', $supervisor->id) }}">
                        @csrf
                        @method('PUT')
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
                                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $supervisor->first_name) }}" required>
                                                    @error('first_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $supervisor->last_name) }}" required>
                                                    @error('last_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                                    <input type="email" class="form-control" name="email" value="{{ old('email', $supervisor->email) }}" required>
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label">Status <span class="text-danger">*</span></label>
                                                    <select class="form-control" name="status" required>
                                                        <option value="active" {{ old('status', $supervisor->status) == 'active' ? 'selected' : '' }}>Active</option>
                                                        <option value="inactive" {{ old('status', $supervisor->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                    @error('status')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Module Assignment -->
                            <div class="col-xl-6">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">Module Assignment</div>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Select Modules <span class="text-danger">*</span></label>
                                            <div class="row">
                                                @foreach($modules as $module)
                                                @php
                                                    $isAssigned = $supervisor->permissions->where('module_id', $module->id)->isNotEmpty();
                                                @endphp
                                                <div class="col-md-6 mb-2">
                                                    <div class="form-check">
                                                        <input class="form-check-input module-checkbox" type="checkbox" name="modules[]" value="{{ $module->id }}" id="module_{{ $module->id }}" {{ $isAssigned ? 'checked' : '' }} onchange="togglePermissions({{ $module->id }})">
                                                        <label class="form-check-label" for="module_{{ $module->id }}">
                                                            {{ $module->name }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @error('modules')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Permissions -->
                            <div class="col-12">
                                <div class="card custom-card">
                                    <div class="card-header">
                                        <div class="card-title">Permissions Configuration</div>
                                        <p class="text-muted mb-0">Select what permissions the supervisor should have for each module</p>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            @foreach($modules as $module)
                                            @php
                                                $isAssigned = $supervisor->permissions->where('module_id', $module->id)->isNotEmpty();
                                                $permission = $supervisor->permissions->where('module_id', $module->id)->first();
                                            @endphp
                                            <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
                                                <div class="card custom-card module-permissions" id="permissions_{{ $module->id }}" style="display: {{ $isAssigned ? 'block' : 'none' }};">
                                                    <div class="card-header">
                                                        <div class="card-title">{{ $module->name }} Permissions</div>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->id }}][]" value="create_users" id="create_users_{{ $module->id }}" {{ $permission && $permission->can_create_users ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="create_users_{{ $module->id }}">
                                                                Create Users
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->id }}][]" value="edit_users" id="edit_users_{{ $module->id }}" {{ $permission && $permission->can_edit_users ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="edit_users_{{ $module->id }}">
                                                                Edit Users
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->id }}][]" value="delete_users" id="delete_users_{{ $module->id }}" {{ $permission && $permission->can_delete_users ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="delete_users_{{ $module->id }}">
                                                                Delete Users
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->id }}][]" value="reset_passwords" id="reset_passwords_{{ $module->id }}" {{ $permission && $permission->can_reset_passwords ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="reset_passwords_{{ $module->id }}">
                                                                Reset Passwords
                                                            </label>
                                                        </div>
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->id }}][]" value="assign_modules" id="assign_modules_{{ $module->id }}" {{ $permission && $permission->can_assign_modules ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="assign_modules_{{ $module->id }}">
                                                                Assign Modules
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->id }}][]" value="view_reports" id="view_reports_{{ $module->id }}" {{ $permission && $permission->can_view_reports ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="view_reports_{{ $module->id }}">
                                                                View Reports
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-12">
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bx bx-save"></i> Update Supervisor
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

@section('scripts')
<script>
function togglePermissions(moduleId) {
    const checkbox = document.getElementById('module_' + moduleId);
    const permissionsDiv = document.getElementById('permissions_' + moduleId);
    
    if (checkbox.checked) {
        permissionsDiv.style.display = 'block';
    } else {
        permissionsDiv.style.display = 'none';
        // Uncheck all permissions for this module
        const permissionCheckboxes = permissionsDiv.querySelectorAll('input[type="checkbox"]');
        permissionCheckboxes.forEach(cb => cb.checked = false);
    }
}
</script>
@endsection
