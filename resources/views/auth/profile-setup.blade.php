@extends('layouts.custom-master')

@section('styles')
@endsection

@section('content')

@section('error-body')
<body>
@endsection

        <div class="container">
            <div class="row justify-content-center align-items-center authentication authentication-basic h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-6 col-sm-8 col-12">
                    <div class="my-5 d-flex justify-content-center">
                        <a href="{{url('index')}}">
                            <img src="{{asset('build/assets/images/brand-logos/desktop-logo.png')}}" alt="logo" class="desktop-logo">
                            <img src="{{asset('build/assets/images/brand-logos/desktop-dark.png')}}" alt="logo" class="desktop-dark">
                        </a>
                    </div>
                    <div class="card custom-card">
                        <div class="card-body p-5">
                            <p class="h5 fw-semibold mb-2 text-center">Complete Your Profile</p>
                            <p class="mb-4 text-muted op-7 fw-normal text-center">Please complete your profile setup</p>
                            
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('profile.complete') }}">
                                @csrf
                                <div class="row gy-3">
                                    <div class="col-xl-6">
                                        <label for="first_name" class="form-label text-default">First Name</label>
                                        <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" value="{{ $user->first_name ?? old('first_name') }}" placeholder="Enter first name" required>
                                    </div>
                                    <div class="col-xl-6">
                                        <label for="last_name" class="form-label text-default">Last Name</label>
                                        <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" value="{{ $user->last_name ?? old('last_name') }}" placeholder="Enter last name" required>
                                    </div>
                                    <div class="col-xl-12">
                                        <label for="password" class="form-label text-default">Set Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Enter password" required>
                                            <button class="btn btn-light" type="button" onclick="createpassword('password',this)" id="button-addon2"><i class="ri-eye-off-line align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-xl-12">
                                        <label for="password_confirmation" class="form-label text-default">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control form-control-lg" id="password_confirmation" name="password_confirmation" placeholder="Confirm password" required>
                                            <button class="btn btn-light" type="button" onclick="createpassword('password_confirmation',this)" id="button-addon3"><i class="ri-eye-off-line align-middle"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 d-grid mt-2">
                                        <button type="submit" class="btn btn-lg btn-primary">Complete Setup</button>
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
@endsection
