@extends('layouts.master')

@section('title') Supervisor Dashboard @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        Supervisor Dashboard
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>Welcome, {{ $supervisor->full_name }}!</h4>
                            <p class="text-muted">Choose a module to manage your system</p>
                        </div>
                    </div>
                    
                    <!-- Module Cards -->
                    <div class="row">
                        @forelse($modules as $module)
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                                <div class="card custom-card h-100 module-card" onclick="window.location.href='{{ route('supervisor.module', $module->id) }}'">
                                    <div class="card-body text-center">
                                        <div class="mb-3">
                                            <span class="avatar avatar-xl bg-primary-transparent">
                                                <i class="{{ $module->icon ?? 'bx bx-package' }} fs-24"></i>
                                            </span>
                                        </div>
                                        <h5 class="card-title">{{ $module->name }}</h5>
                                        <p class="text-muted">{{ $module->description }}</p>
                                        <div class="mt-3">
                                            <span class="badge bg-success">Active</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="text-center py-5">
                                    <i class="bx bx-package fs-48 text-muted"></i>
                                    <h5 class="mt-3">No modules assigned yet</h5>
                                    <p class="text-muted">Contact your administrator to get module access</p>
                                </div>
                            </div>
                        @endforelse
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
