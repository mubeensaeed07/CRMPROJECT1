<!DOCTYPE html>
<html>
<head>
    <title>Debug Info</title>
</head>
<body>
    <h1>Debug Information</h1>
    
    <h2>Authentication Status:</h2>
    <p>Logged in: {{ Auth::check() ? 'Yes' : 'No' }}</p>
    
    @if(Auth::check())
        <h2>User Information:</h2>
        <p>Name: {{ Auth::user()->full_name }}</p>
        <p>Email: {{ Auth::user()->email }}</p>
        <p>Role ID: {{ Auth::user()->role_id }}</p>
        <p>Is Approved: {{ Auth::user()->is_approved ? 'Yes' : 'No' }}</p>
        <p>Is SuperAdmin: {{ Auth::user()->isSuperAdmin() ? 'Yes' : 'No' }}</p>
        <p>Is Admin: {{ Auth::user()->isAdmin() ? 'Yes' : 'No' }}</p>
        <p>Is User: {{ Auth::user()->isUser() ? 'Yes' : 'No' }}</p>
        
        <h2>Available Routes:</h2>
        <p><a href="{{ route('superadmin.dashboard') }}">Super Admin Dashboard</a></p>
        <p><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></p>
        <p><a href="{{ route('user.dashboard') }}">User Dashboard</a></p>
    @else
        <p><a href="{{ route('login') }}">Login</a></p>
    @endif
</body>
</html>
