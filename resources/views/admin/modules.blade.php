@extends('layouts.master')

@section('title') Module Management @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Module Management
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
                        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <span class="avatar avatar-md bg-success-transparent">
                                                <i class="bx bx-check-circle fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Active Modules</p>
                                            <h4 class="mb-0 fw-semibold">{{ $modules->where('status', 'active')->count() }}</h4>
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
                                                <i class="bx bx-pause-circle fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Inactive Modules</p>
                                            <h4 class="mb-0 fw-semibold">{{ $modules->where('status', 'inactive')->count() }}</h4>
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
                                                <i class="bx bx-category fs-18"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <p class="mb-0 text-muted">Categories</p>
                                            <h4 class="mb-0 fw-semibold">{{ $modules->pluck('category')->unique()->count() }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modules List -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">All Modules</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @forelse($modules as $module)
                                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 mb-4">
                                            <div class="card custom-card h-100">
                                                <div class="card-body text-center">
                                                    <div class="mb-3">
                                                        <span class="avatar avatar-xl bg-primary-transparent">
                                                            <i class="{{ $module->icon }} fs-24"></i>
                                                        </span>
                                                    </div>
                                                    <h5 class="card-title">{{ $module->name }}</h5>
                                                    <p class="text-muted">{{ $module->description }}</p>
                                                    <div class="mt-3">
                                                        <span class="badge bg-{{ $module->status == 'active' ? 'success' : 'warning' }}">{{ ucfirst($module->status) }}</span>
                                                        <span class="badge bg-info ms-1">{{ $module->category }}</span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <button class="btn btn-sm btn-primary" onclick="editModule({{ $module->id }})">Edit</button>
                                                        <button class="btn btn-sm btn-{{ $module->status == 'active' ? 'warning' : 'success' }}" onclick="toggleModule({{ $module->id }})">
                                                            {{ $module->status == 'active' ? 'Deactivate' : 'Activate' }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
    // Implement edit module functionality
    console.log('Edit module:', moduleId);
}

function toggleModule(moduleId) {
    if (confirm('Are you sure you want to toggle this module status?')) {
        // Implement toggle module functionality
        console.log('Toggle module:', moduleId);
    }
}
</script>
@endsection
