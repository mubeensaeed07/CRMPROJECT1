@extends('layouts.master')

@section('title') {{ $userModule->module->name }} @endsection

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
                        <i class="{{ $userModule->module->icon }} me-2"></i>
                        {{ $userModule->module->name }}
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <h4>{{ $userModule->module->name }}</h4>
                            <p class="text-muted">{{ $userModule->module->description }}</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <h5>Module Content</h5>
                                    <p>This is where the {{ $userModule->module->name }} functionality would be implemented.</p>
                                    
                                    @if($userModule->module->name == 'Customer Management')
                                        <div class="alert alert-info">
                                            <h6>Customer Management Features:</h6>
                                            <ul>
                                                <li>Add new customers</li>
                                                <li>View customer list</li>
                                                <li>Edit customer information</li>
                                                <li>Customer communication history</li>
                                            </ul>
                                        </div>
                                    @elseif($userModule->module->name == 'Lead Tracking')
                                        <div class="alert alert-info">
                                            <h6>Lead Tracking Features:</h6>
                                            <ul>
                                                <li>Track lead sources</li>
                                                <li>Monitor lead status</li>
                                                <li>Lead conversion tracking</li>
                                                <li>Lead follow-up reminders</li>
                                            </ul>
                                        </div>
                                    @elseif($userModule->module->name == 'Deal Pipeline')
                                        <div class="alert alert-info">
                                            <h6>Deal Pipeline Features:</h6>
                                            <ul>
                                                <li>Create new deals</li>
                                                <li>Track deal stages</li>
                                                <li>Deal value tracking</li>
                                                <li>Deal forecasting</li>
                                            </ul>
                                        </div>
                                    @elseif($userModule->module->name == 'Reports & Analytics')
                                        <div class="alert alert-info">
                                            <h6>Reports & Analytics Features:</h6>
                                            <ul>
                                                <li>Sales performance reports</li>
                                                <li>Customer analytics</li>
                                                <li>Revenue tracking</li>
                                                <li>Custom dashboards</li>
                                            </ul>
                                        </div>
                                    @endif
                                    
                                    <div class="mt-4">
                                        <a href="{{ route('user.dashboard') }}" class="btn btn-primary">Back to Dashboard</a>
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
@endsection
