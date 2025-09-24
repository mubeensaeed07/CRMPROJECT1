@extends('layouts.master')

@section('title') Edit User @endsection

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
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Edit User: {{ $user->full_name }}
                    </div>
                    <div class="card-options">
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="ti ti-arrow-left me-1"></i>Back to Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.edit', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">First Name</label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                                    @error('first_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Last Name</label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                    @error('last_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">User Type</label>
                                    <select class="form-control" name="user_type" required>
                                        <option value="">Select User Type</option>
                                        @foreach($userTypes as $userType)
                                            <option value="{{ $userType->id }}" 
                                                {{ old('user_type', $currentUserType) == $userType->id ? 'selected' : '' }}>
                                                {{ $userType->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
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
                                                <input class="form-check-input" type="checkbox" name="modules[]" value="{{ $module->id }}" 
                                                       id="module_{{ $module->id }}" 
                                                       {{ in_array($module->id, old('modules', $userModuleIds)) ? 'checked' : '' }}>
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
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update User</button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
</script>
@endsection
