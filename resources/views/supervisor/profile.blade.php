@extends('layouts.master')

@section('title') Supervisor Profile @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Supervisor Profile
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('supervisor.dashboard') }}" class="btn btn-secondary">
                            <i class="bx bx-arrow-back"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <span class="avatar avatar-xl bg-primary-transparent">
                                                <i class="bx bx-user fs-24"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $supervisor->full_name }}</h6>
                                            <span class="text-muted fs-12">Supervisor</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-6 col-sm-6">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Profile Information</div>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('supervisor.profile.update') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                                           id="first_name" name="first_name" value="{{ old('first_name', $supervisor->first_name) }}" required>
                                                    @error('first_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="last_name" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                                           id="last_name" name="last_name" value="{{ old('last_name', $supervisor->last_name) }}" required>
                                                    @error('last_name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                                   id="email" name="email" value="{{ old('email', $supervisor->email) }}" required>
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Status</label>
                                            <div class="form-control-plaintext">
                                                <span class="badge bg-{{ $supervisor->isActive() ? 'success' : 'danger' }}">
                                                    {{ ucfirst($supervisor->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Assigned Modules</label>
                                            <div class="form-control-plaintext">
                                                <span class="badge bg-primary">{{ $supervisor->modules->count() }} Modules</span>
                                            </div>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="bx bx-save me-1"></i>Update Profile
                                            </button>
                                            <a href="{{ route('supervisor.dashboard') }}" class="btn btn-secondary">
                                                <i class="bx bx-x me-1"></i>Cancel
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Assigned Modules Section -->
                    <div class="row mt-4">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-header">
                                    <div class="card-title">Your Assigned Modules</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @forelse($supervisor->modules as $module)
                                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 mb-3">
                                                <div class="card custom-card h-100">
                                                    <div class="card-body">
                                                        <div class="d-flex align-items-center mb-3">
                                                            <div class="avatar avatar-md bg-primary-transparent rounded-circle me-3">
                                                                <i class="{{ $module->icon ?? 'ti ti-package' }} fs-18"></i>
                                                            </div>
                                                            <div>
                                                                <h6 class="mb-0 fw-semibold">{{ $module->name }}</h6>
                                                                <span class="text-muted fs-12">{{ $module->category ?? 'General' }}</span>
                                                            </div>
                                                        </div>
                                                        <p class="text-muted mb-3 fs-13">{{ Str::limit($module->description, 60) }}</p>
                                                        <div class="d-flex align-items-center justify-content-between">
                                                            <span class="badge bg-success-transparent">
                                                                <i class="ti ti-check me-1"></i>Assigned
                                                            </span>
                                                            <a href="{{ route('supervisor.module', $module->id) }}" class="btn btn-sm btn-primary">
                                                                <i class="ti ti-arrow-right me-1"></i>Access
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            <div class="col-12">
                                                <div class="text-center py-4">
                                                    <i class="ti ti-package fs-48 text-muted"></i>
                                                    <p class="text-muted mt-2">No modules assigned yet</p>
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
