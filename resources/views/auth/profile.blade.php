@extends('layouts.master')

@section('title') Profile @endsection

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
                        User Profile
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-8">
                            <form method="POST" action="{{ route('user.profile.update') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">First Name</label>
                                            <input type="text" class="form-control" name="first_name" value="{{ $user->first_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ $user->last_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">New Password (optional)</label>
                                            <input type="password" class="form-control" name="password" placeholder="Leave blank to keep current password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm new password">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xl-4">
                            <div class="card custom-card">
                                <div class="card-body text-center">
                                    <div class="mb-3">
                                        <span class="avatar avatar-xxl bg-primary-transparent">
                                            <i class="bx bx-user fs-24"></i>
                                        </span>
                                    </div>
                                    <h5>{{ $user->full_name }}</h5>
                                    <p class="text-muted">{{ $user->email }}</p>
                                    <p class="text-muted">
                                        Role: 
                                        @if($user->isSuperAdmin())
                                            <span class="badge bg-danger">Super Admin</span>
                                        @elseif($user->isAdmin())
                                            <span class="badge bg-warning">Admin</span>
                                        @else
                                            <span class="badge bg-info">User</span>
                                        @endif
                                    </p>
                                    <p class="text-muted">
                                        Status: 
                                        @if($user->is_approved)
                                            <span class="badge bg-success">Approved</span>
                                        @else
                                            <span class="badge bg-warning">Pending Approval</span>
                                        @endif
                                    </p>
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
@endsection
