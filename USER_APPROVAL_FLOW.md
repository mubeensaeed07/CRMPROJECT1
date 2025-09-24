# User Approval Flow System

## Overview
Implemented a comprehensive user approval flow where new signups become Admin candidates requiring SuperAdmin approval, while Admin-created users get direct access with email credentials.

## User Flow Types

### 1. New User Signup Flow
**Path**: Public Registration → Admin Candidate → SuperAdmin Approval → Admin Access

#### Steps:
1. **User Signs Up**: Via registration form or Google OAuth
2. **Account Created**: User account created with `role_id = 2` (Admin) and `is_approved = false`
3. **Redirect to Signin**: User redirected to signin page with success message
4. **Approval Pending**: User sees "Please wait for SuperAdmin approval" message
5. **SuperAdmin Approval**: SuperAdmin approves the user in dashboard
6. **Admin Access**: User can now login and access admin features

### 2. Admin-Created User Flow
**Path**: Admin Creates User → Email Sent → Direct Access

#### Steps:
1. **Admin Creates User**: Admin adds user through admin dashboard
2. **Account Created**: User account created with `role_id = 3` (User) and `is_approved = true`
3. **Email Sent**: User receives email with login credentials
4. **Direct Access**: User can login immediately without approval

## Implementation Details

### New User Signup (Registration Form)
```php
// AuthController::register()
$user = User::create([
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'email' => $request->email,
    'password' => Hash::make($request->password),
    'role_id' => 2, // Admin role for new registrations
    'is_approved' => false // Requires SuperAdmin approval
]);

return redirect()->route('login')->with('success', 'Registration successful! Please wait for admin approval.');
```

### New User Signup (Google OAuth)
```php
// GoogleAuthController::handleGoogleCallback()
$user = User::create([
    'first_name' => $googleUser->user['given_name'] ?? '',
    'last_name' => $googleUser->user['family_name'] ?? '',
    'email' => $googleUser->email,
    'role_id' => 2, // Admin role for new registrations
    'is_approved' => false, // Requires SuperAdmin approval
    'password' => Hash::make('google_oauth_user')
]);

return redirect()->route('login')->with('success', 'Account created successfully! Please wait for SuperAdmin approval.');
```

### Admin-Created User
```php
// AdminController::addUser()
$user = User::create([
    'first_name' => $request->first_name,
    'last_name' => $request->last_name,
    'email' => $request->email,
    'role_id' => 3, // User role
    'admin_id' => auth()->id(), // Assign to current admin
    'is_approved' => true, // Admin-created users are automatically approved
    'password' => Hash::make($password)
]);

// Send email with credentials
Mail::to($user->email)->send(new UserRegisteredMail($user, $password, auth()->user()->full_name));
```

## User Experience

### For New Signups
1. **Registration**: User fills registration form or uses Google OAuth
2. **Success Message**: "Registration successful! Please wait for admin approval."
3. **Signin Page**: User redirected to signin page
4. **Approval Status**: User sees approval pending message when trying to login
5. **SuperAdmin Approval**: SuperAdmin approves user in dashboard
6. **Login Access**: User can now login and access admin features

### For Admin-Created Users
1. **Admin Creates User**: Admin adds user through dashboard
2. **Email Notification**: User receives email with login credentials
3. **Direct Login**: User can login immediately with provided credentials
4. **Module Access**: User has access to assigned modules

### For SuperAdmins
1. **Pending Approvals**: See list of users waiting for approval
2. **Approve/Reject**: Can approve or reject admin candidates
3. **User Management**: Full control over user access

## Security Features

### Approval System
- **Role-based Access**: New signups become Admin candidates
- **SuperAdmin Control**: Only SuperAdmins can approve new admins
- **Automatic Approval**: Admin-created users are automatically approved
- **Email Verification**: Users receive credentials via email

### Access Control
- **Pending Users**: Cannot access system until approved
- **Approved Users**: Full access based on role
- **Admin Isolation**: Admins only see their own users
- **SuperAdmin Override**: SuperAdmins have full system access

## Database Structure

### User Roles
- **SuperAdmin** (`role_id = 1`): Full system access, can approve admins
- **Admin** (`role_id = 2`): Can manage users, requires approval for new signups
- **User** (`role_id = 3`): Regular users, created by admins

### Approval Status
- **`is_approved = false`**: New signups, pending SuperAdmin approval
- **`is_approved = true`**: Approved users or admin-created users

### User Assignment
- **`admin_id`**: Links users to their managing admin
- **Admin Isolation**: Each admin only sees their own users

## Email Notifications

### User Registration Email
- **Recipient**: New user
- **Content**: Welcome message, login credentials, admin contact
- **Purpose**: Provide login information to new users

### Password Reset Email
- **Recipient**: User requesting password reset
- **Content**: New password, security instructions
- **Purpose**: Reset user password securely

## SuperAdmin Dashboard Features

### Pending Approvals
- **List View**: All users waiting for approval
- **User Details**: Name, email, registration date
- **Actions**: Approve or reject buttons
- **Status Tracking**: Clear approval status

### User Management
- **Approved Admins**: List of approved admin users
- **User Statistics**: Total users, pending approvals
- **Module Management**: Create and manage system modules

## Admin Dashboard Features

### User Management
- **Add Users**: Create new users with email credentials
- **User List**: View and manage assigned users
- **Module Assignment**: Assign modules to users
- **Password Reset**: Reset user passwords

### Module Management
- **Full Access**: View all available modules
- **User Assignment**: Assign modules to users
- **Access Control**: Users only see assigned modules

## Testing Scenarios

### New User Signup
1. **Registration Form**: Test normal registration
2. **Google OAuth**: Test Google signup
3. **Approval Flow**: Test approval process
4. **Login Access**: Test login after approval

### Admin User Creation
1. **User Creation**: Test admin creating users
2. **Email Sending**: Test email notifications
3. **Direct Access**: Test immediate login access
4. **Module Assignment**: Test module assignment

### SuperAdmin Approval
1. **Pending List**: Test pending approvals display
2. **Approval Process**: Test approve/reject functionality
3. **User Access**: Test user access after approval
4. **Status Updates**: Test status updates

## Benefits

### For System Security
- **Controlled Access**: Only approved users can access system
- **Role Separation**: Clear separation between admins and users
- **Approval Process**: SuperAdmin control over new admins
- **Email Verification**: Secure credential delivery

### For User Experience
- **Clear Process**: Users understand approval process
- **Email Notifications**: Users receive login credentials
- **Immediate Access**: Admin-created users get immediate access
- **Status Updates**: Clear approval status messages

### For Administrators
- **User Control**: Full control over user access
- **Approval Management**: Easy approval process
- **User Creation**: Simple user creation with email
- **Module Management**: Easy module assignment

## Future Enhancements

1. **Email Templates**: Customizable email templates
2. **Bulk Approval**: Approve multiple users at once
3. **Approval Notifications**: Email notifications for approvals
4. **User Onboarding**: Guided user onboarding process
5. **Analytics**: User registration and approval analytics
6. **Custom Roles**: Additional user roles and permissions
