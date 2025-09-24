@extends('layouts.master')

@section('title') User Profile @endsection

@section('styles')
<style>
    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 2rem 0;
        margin-bottom: 2rem;
    }
    .profile-avatar {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 4px solid white;
        object-fit: cover;
    }
    .section-title {
        color: #495057;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e9ecef;
    }
</style>
@endsection

@section('content')

<div class="container-fluid">
    <!-- Profile Header -->
    <div class="row">
        <div class="col-12">
            <div class="profile-header">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            @if($user->avatar)
                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Profile" class="profile-avatar">
                            @else
                                <div class="profile-avatar bg-white d-flex align-items-center justify-content-center">
                                    <i class="ti ti-user fs-48 text-primary"></i>
                                </div>
                            @endif
                        </div>
                        <div class="col">
                            <h2 class="mb-1">{{ $user->full_name }}</h2>
                            <p class="mb-1 opacity-75">{{ $user->email }}</p>
                            @php
                                $userType = $user->userInfo && $user->userInfo->userType ? $user->userInfo->userType : null;
                            @endphp
                            @if($userType)
                                <span class="badge bg-light text-dark fs-12">{{ $userType->name }}</span>
                            @endif
                            @if($user->job_title)
                                <p class="mb-0 opacity-75">{{ $user->job_title }} @ {{ $user->company }}</p>
                            @endif
                        </div>
                        <div class="col-auto">
                            <button class="btn btn-light" onclick="editProfile()">
                                <i class="ti ti-edit me-1"></i>Edit Profile
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Form -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">Complete Your Profile</div>
                    <p class="text-muted mb-0">Fill in all the details to complete your profile</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Personal Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">Personal Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
                                    @error('first_name')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
                                    @error('last_name')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>
                                    @error('email')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" name="phone" value="{{ old('phone', $user->userInfo->phone ?? '') }}">
                                    @error('phone')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" name="date_of_birth" value="{{ old('date_of_birth', $user->userInfo->date_of_birth ?? '') }}">
                                    @error('date_of_birth')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <select class="form-control" name="gender">
                                        <option value="">Select Gender</option>
                                        <option value="male" {{ old('gender', $user->userInfo->gender ?? '') == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender', $user->userInfo->gender ?? '') == 'female' ? 'selected' : '' }}>Female</option>
                                        <option value="other" {{ old('gender', $user->userInfo->gender ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Profile Picture</label>
                                    <input type="file" class="form-control" name="avatar" accept="image/*">
                                    @error('avatar')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Address Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">Address Information</h5>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <textarea class="form-control" name="address" rows="3" placeholder="Enter your full address">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" value="{{ old('city', $user->city) }}">
                                    @error('city')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">State/Province</label>
                                    <input type="text" class="form-control" name="state" value="{{ old('state', $user->state) }}">
                                    @error('state')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Country</label>
                                    <input type="text" class="form-control" name="country" value="{{ old('country', $user->country) }}">
                                    @error('country')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Postal Code</label>
                                    <input type="text" class="form-control" name="postal_code" value="{{ old('postal_code', $user->postal_code) }}">
                                    @error('postal_code')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Professional Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">Professional Information</h5>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Job Title</label>
                                    <input type="text" class="form-control" name="job_title" value="{{ old('job_title', $user->job_title) }}">
                                    @error('job_title')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Department</label>
                                    <input type="text" class="form-control" name="department" value="{{ old('department', $user->department) }}">
                                    @error('department')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Company</label>
                                    <input type="text" class="form-control" name="company" value="{{ old('company', $user->company) }}">
                                    @error('company')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-control" name="bio" rows="4" placeholder="Tell us about yourself">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Social Media -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">Social Media & Links</h5>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">LinkedIn URL</label>
                                    <input type="url" class="form-control" name="linkedin_url" value="{{ old('linkedin_url', $user->linkedin_url) }}" placeholder="https://linkedin.com/in/username">
                                    @error('linkedin_url')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Twitter URL</label>
                                    <input type="url" class="form-control" name="twitter_url" value="{{ old('twitter_url', $user->twitter_url) }}" placeholder="https://twitter.com/username">
                                    @error('twitter_url')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Website URL</label>
                                    <input type="url" class="form-control" name="website_url" value="{{ old('website_url', $user->website_url) }}" placeholder="https://yourwebsite.com">
                                    @error('website_url')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Emergency Contact -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">Emergency Contact</h5>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Contact Name</label>
                                    <input type="text" class="form-control" name="emergency_contact_name" value="{{ old('emergency_contact_name', $user->emergency_contact_name) }}">
                                    @error('emergency_contact_name')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Contact Phone</label>
                                    <input type="tel" class="form-control" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $user->emergency_contact_phone) }}">
                                    @error('emergency_contact_phone')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Relationship</label>
                                    <input type="text" class="form-control" name="emergency_contact_relationship" value="{{ old('emergency_contact_relationship', $user->emergency_contact_relationship) }}" placeholder="e.g., Spouse, Parent, Friend">
                                    @error('emergency_contact_relationship')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Preferences -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="section-title">Preferences</h5>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Timezone</label>
                                    <select class="form-control" name="timezone">
                                        <option value="UTC" {{ old('timezone', $user->timezone) == 'UTC' ? 'selected' : '' }}>UTC</option>
                                        <option value="America/New_York" {{ old('timezone', $user->timezone) == 'America/New_York' ? 'selected' : '' }}>Eastern Time</option>
                                        <option value="America/Chicago" {{ old('timezone', $user->timezone) == 'America/Chicago' ? 'selected' : '' }}>Central Time</option>
                                        <option value="America/Denver" {{ old('timezone', $user->timezone) == 'America/Denver' ? 'selected' : '' }}>Mountain Time</option>
                                        <option value="America/Los_Angeles" {{ old('timezone', $user->timezone) == 'America/Los_Angeles' ? 'selected' : '' }}>Pacific Time</option>
                                        <option value="Europe/London" {{ old('timezone', $user->timezone) == 'Europe/London' ? 'selected' : '' }}>London</option>
                                        <option value="Europe/Paris" {{ old('timezone', $user->timezone) == 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                                        <option value="Asia/Tokyo" {{ old('timezone', $user->timezone) == 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo</option>
                                    </select>
                                    @error('timezone')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Language</label>
                                    <select class="form-control" name="language">
                                        <option value="en" {{ old('language', $user->language) == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="es" {{ old('language', $user->language) == 'es' ? 'selected' : '' }}>Spanish</option>
                                        <option value="fr" {{ old('language', $user->language) == 'fr' ? 'selected' : '' }}>French</option>
                                        <option value="de" {{ old('language', $user->language) == 'de' ? 'selected' : '' }}>German</option>
                                        <option value="it" {{ old('language', $user->language) == 'it' ? 'selected' : '' }}>Italian</option>
                                        <option value="pt" {{ old('language', $user->language) == 'pt' ? 'selected' : '' }}>Portuguese</option>
                                        <option value="zh" {{ old('language', $user->language) == 'zh' ? 'selected' : '' }}>Chinese</option>
                                        <option value="ja" {{ old('language', $user->language) == 'ja' ? 'selected' : '' }}>Japanese</option>
                                    </select>
                                    @error('language')
                                        <div class="text-danger fs-12">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Notifications</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="email_notifications" value="1" {{ old('email_notifications', $user->email_notifications) ? 'checked' : '' }}>
                                        <label class="form-check-label">Email Notifications</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sms_notifications" value="1" {{ old('sms_notifications', $user->sms_notifications) ? 'checked' : '' }}>
                                        <label class="form-check-label">SMS Notifications</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('user.dashboard') }}" class="btn btn-light">Cancel</a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="ti ti-device-floppy me-1"></i>Save Profile
                                    </button>
                                </div>
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
function editProfile() {
    // Scroll to the form
    document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
}
</script>
@endsection
