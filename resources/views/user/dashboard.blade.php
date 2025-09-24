@extends('layouts.master')

@section('title') CRM Dashboard @endsection

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
                        Welcome to CRM Dashboard
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h4>Hello, {{ Auth::user()->full_name }}!</h4>
                                    @php
                                        $user = Auth::user();
                                        $userType = $user->userInfo && $user->userInfo->userType ? $user->userInfo->userType : null;
                                    @endphp
                                    @if($userType)
                                        <p class="text-muted">
                                            <span class="badge bg-info me-2">{{ $userType->name }}</span>
                                            Access your assigned modules below:
                                        </p>
                                    @else
                                        <p class="text-muted">Access your assigned modules below:</p>
                                    @endif
                                </div>
                                <div>
                                    @php
                                        $user = Auth::user();
                                        $profileFields = ['first_name', 'last_name', 'phone', 'date_of_birth', 'gender', 'address', 'city', 'state', 'country', 'job_title', 'company', 'bio'];
                                        $completedFields = 0;
                                        foreach($profileFields as $field) {
                                            if(!empty($user->$field)) $completedFields++;
                                        }
                                        $completionPercentage = round(($completedFields / count($profileFields)) * 100);
                                    @endphp
                                    
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="text-end">
                                            <small class="text-muted">Profile Completion</small>
                                            <div class="progress" style="width: 100px; height: 6px;">
                                                <div class="progress-bar bg-{{ $completionPercentage >= 80 ? 'success' : ($completionPercentage >= 50 ? 'warning' : 'danger') }}" 
                                                     style="width: {{ $completionPercentage }}%"></div>
                                            </div>
                                            <small class="text-muted">{{ $completionPercentage }}%</small>
                                        </div>
                                        <a href="{{ route('user.profile') }}" class="btn btn-outline-primary">
                                            <i class="ti ti-user me-1"></i>Complete Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- User Type Information Card -->
                    @php
                        $user = Auth::user();
                        $userType = $user->userInfo && $user->userInfo->userType ? $user->userInfo->userType : null;
                    @endphp
                    
                    @if($userType)
                    <div class="row mb-4">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <span class="avatar avatar-lg bg-info-transparent">
                                                <i class="ti ti-badge fs-24"></i>
                                            </span>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">Your Role: {{ $userType->name }}</h5>
                                            <p class="text-muted mb-0">{{ $userType->description ?? 'You have been assigned this role by your administrator.' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    <div class="row">
                        @forelse($userModules as $userModule)
                            <x-module-card 
                                :module="$userModule->module" 
                                :isAssigned="true"
                                :showAssignButton="false"
                            />
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ti ti-info-circle fs-24 text-info"></i>
                                        </div>
                                        <div>
                                            <h5 class="mb-1">No modules assigned</h5>
                                            <p class="mb-0">You don't have any modules assigned yet. Please contact your administrator.</p>
                                        </div>
                                    </div>
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

@section('scripts')
@endsection
