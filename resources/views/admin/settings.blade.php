@extends('layouts.master')

@section('title') System Settings @endsection

@section('content')
<div class="container-fluid">
    <!-- Start::row-1 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">
                        System Settings
                    </div>
                </div>
                <div class="card-body">
                    <!-- Settings Tabs -->
                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="nav flex-column nav-pills" id="settings-tabs" role="tablist">
                                        <button class="nav-link active" id="general-tab" data-bs-toggle="pill" data-bs-target="#general" type="button" role="tab">
                                            <i class="bx bx-cog me-2"></i>General Settings
                                        </button>
                                        <button class="nav-link" id="email-tab" data-bs-toggle="pill" data-bs-target="#email" type="button" role="tab">
                                            <i class="bx bx-envelope me-2"></i>Email Settings
                                        </button>
                                        <button class="nav-link" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab">
                                            <i class="bx bx-shield me-2"></i>Security Settings
                                        </button>
                                        <button class="nav-link" id="modules-tab" data-bs-toggle="pill" data-bs-target="#modules" type="button" role="tab">
                                            <i class="bx bx-grid-alt me-2"></i>Module Settings
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-8">
                            <div class="card custom-card">
                                <div class="card-body">
                                    <div class="tab-content" id="settings-tabContent">
                                        <!-- General Settings -->
                                        <div class="tab-pane fade show active" id="general" role="tabpanel">
                                            <h5 class="mb-4">General Settings</h5>
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">System Name</label>
                                                            <input type="text" class="form-control" value="CRM Management System">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">System Version</label>
                                                            <input type="text" class="form-control" value="v1.0.0" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Default Language</label>
                                                            <select class="form-control">
                                                                <option value="en">English</option>
                                                                <option value="es">Spanish</option>
                                                                <option value="fr">French</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Timezone</label>
                                                            <select class="form-control">
                                                                <option value="UTC">UTC</option>
                                                                <option value="America/New_York">Eastern Time</option>
                                                                <option value="America/Chicago">Central Time</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Save General Settings</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Email Settings -->
                                        <div class="tab-pane fade" id="email" role="tabpanel">
                                            <h5 class="mb-4">Email Settings</h5>
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">SMTP Host</label>
                                                            <input type="text" class="form-control" value="smtp.gmail.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">SMTP Port</label>
                                                            <input type="number" class="form-control" value="587">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">SMTP Username</label>
                                                            <input type="email" class="form-control" value="your-email@gmail.com">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">SMTP Password</label>
                                                            <input type="password" class="form-control" value="••••••••">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="email-ssl" checked>
                                                            <label class="form-check-label" for="email-ssl">
                                                                Use SSL/TLS
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Save Email Settings</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Security Settings -->
                                        <div class="tab-pane fade" id="security" role="tabpanel">
                                            <h5 class="mb-4">Security Settings</h5>
                                            <form>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Session Timeout (minutes)</label>
                                                            <input type="number" class="form-control" value="30">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">Max Login Attempts</label>
                                                            <input type="number" class="form-control" value="5">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="two-factor" checked>
                                                            <label class="form-check-label" for="two-factor">
                                                                Enable Two-Factor Authentication
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="password-policy" checked>
                                                            <label class="form-check-label" for="password-policy">
                                                                Enforce Strong Password Policy
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Save Security Settings</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                        <!-- Module Settings -->
                                        <div class="tab-pane fade" id="modules" role="tabpanel">
                                            <h5 class="mb-4">Module Settings</h5>
                                            <form>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="hrm-module" checked>
                                                            <label class="form-check-label" for="hrm-module">
                                                                HRM Module
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="leads-module" checked>
                                                            <label class="form-check-label" for="leads-module">
                                                                Lead Tracking Module
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="deals-module" checked>
                                                            <label class="form-check-label" for="deals-module">
                                                                Deal Pipeline Module
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" id="reports-module" checked>
                                                            <label class="form-check-label" for="reports-module">
                                                                Reports & Analytics Module
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary">Save Module Settings</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
