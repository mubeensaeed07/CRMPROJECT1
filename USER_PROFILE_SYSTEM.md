# User Profile System

## Overview
A comprehensive user profile system that captures all user information in the database with a beautiful, organized form interface.

## Features

### 1. Complete Profile Form
- **Personal Information**: First name, last name, email, phone, date of birth, gender, avatar
- **Address Information**: Full address, city, state, country, postal code
- **Professional Information**: Job title, department, company, bio
- **Social Media**: LinkedIn, Twitter, website URLs
- **Emergency Contact**: Contact name, phone, relationship
- **Preferences**: Timezone, language, notification settings

### 2. Profile Completion Tracking
- **Progress Bar**: Visual indicator of profile completion percentage
- **Color Coding**: Green (80%+), Yellow (50-79%), Red (<50%)
- **Real-time Updates**: Updates as user fills out information

### 3. Avatar Upload System
- **Image Upload**: Support for JPEG, PNG, JPG, GIF formats
- **File Validation**: Maximum 2MB file size
- **Storage**: Files stored in `storage/app/public/avatars/`
- **Display**: Avatar shown in profile header and throughout the system

### 4. Form Validation
- **Required Fields**: First name, last name, email
- **Email Uniqueness**: Prevents duplicate emails
- **Date Validation**: Date of birth must be before today
- **URL Validation**: Social media and website URLs
- **File Validation**: Avatar image type and size restrictions

## Database Fields

### Personal Information
- `first_name` - User's first name (required)
- `last_name` - User's last name (required)
- `email` - User's email address (required, unique)
- `phone` - Phone number (optional)
- `date_of_birth` - Date of birth (optional)
- `gender` - Gender selection (male/female/other)
- `avatar` - Profile picture file path

### Address Information
- `address` - Full address text
- `city` - City name
- `state` - State/province
- `country` - Country name
- `postal_code` - Postal/ZIP code

### Professional Information
- `job_title` - Current job title
- `department` - Department/division
- `company` - Company name
- `bio` - Personal biography/description

### Social Media
- `linkedin_url` - LinkedIn profile URL
- `twitter_url` - Twitter profile URL
- `website_url` - Personal website URL

### Emergency Contact
- `emergency_contact_name` - Emergency contact name
- `emergency_contact_phone` - Emergency contact phone
- `emergency_contact_relationship` - Relationship to user

### Preferences
- `timezone` - User's timezone
- `language` - Preferred language
- `email_notifications` - Email notification preference
- `sms_notifications` - SMS notification preference

## User Interface

### Profile Header
- **Avatar Display**: Large profile picture or default icon
- **User Information**: Name, email, job title, company
- **Edit Button**: Quick access to edit profile

### Form Sections
1. **Personal Information**: Basic user details
2. **Address Information**: Location details
3. **Professional Information**: Work-related information
4. **Social Media & Links**: Online presence
5. **Emergency Contact**: Emergency contact details
6. **Preferences**: System preferences

### Visual Design
- **Gradient Header**: Beautiful gradient background
- **Section Titles**: Clear section separation
- **Form Validation**: Real-time error display
- **Responsive Layout**: Works on all screen sizes
- **Progress Tracking**: Visual completion indicator

## Implementation Details

### Routes
```php
Route::get('user/profile', [UserController::class, 'profile'])->name('user.profile');
Route::put('user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
```

### Controller Methods
- `profile()` - Display profile form
- `updateProfile()` - Handle profile updates with validation

### Model Updates
- Added all profile fields to `$fillable` array
- Added proper casting for date and boolean fields
- Maintained backward compatibility with existing fields

### File Storage
- Avatar uploads stored in `storage/app/public/avatars/`
- Public storage link created for file access
- Unique filename generation to prevent conflicts

## Security Features

### Validation
- **Input Sanitization**: All inputs properly validated
- **File Upload Security**: Image type and size restrictions
- **Email Uniqueness**: Prevents duplicate email addresses
- **XSS Protection**: Laravel's built-in XSS protection

### Access Control
- **Authentication Required**: Only logged-in users can access
- **Own Profile Only**: Users can only edit their own profile
- **Role-based Access**: Different views for different user roles

## Usage

### For Users
1. Navigate to "Complete Profile" from dashboard
2. Fill out all relevant information
3. Upload profile picture (optional)
4. Save profile to update database
5. View completion progress on dashboard

### For Admins
- Admins can view user profiles
- Profile completion helps with user management
- All data stored in database for reporting

## Future Enhancements

1. **Profile Templates**: Different profile layouts for different roles
2. **Bulk Import**: Import user data from CSV/Excel
3. **Profile Analytics**: Track profile completion rates
4. **Custom Fields**: Admin-configurable profile fields
5. **Profile Verification**: Email/phone verification system
6. **Profile Export**: Export user profiles to PDF/Excel
