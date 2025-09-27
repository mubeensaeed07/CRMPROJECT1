<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to CRM System - Supervisor Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .credentials {
            background: #e3f2fd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #2196f3;
        }
        .button {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .google-button {
            background: #db4437;
        }
        .login-options {
            margin: 30px 0;
        }
        .option {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
        }
        .next-steps {
            background: #f0f8ff;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #4CAF50;
        }
        .next-steps ol {
            margin: 10px 0;
            padding-left: 20px;
        }
        .next-steps li {
            margin: 8px 0;
        }
        .supervisor-info {
            background: #fff3cd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to CRM System!</h1>
        <p>Your Supervisor account has been successfully created</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $supervisor->full_name }}!</h2>
        
        <p>Your supervisor account has been created by {{ $adminName ?? 'an administrator' }}. You now have elevated privileges to manage users and modules within your assigned scope.</p>
        
        <div class="supervisor-info">
            <h3>Supervisor Account Details:</h3>
            <p><strong>Role:</strong> Supervisor</p>
            <p><strong>Account Status:</strong> {{ ucfirst($supervisor->status ?? 'Active') }}</p>
            <p><strong>Created by:</strong> {{ $adminName ?? 'System Administrator' }}</p>
        </div>
        
        <div class="credentials">
            <h3>Login Credentials:</h3>
            <p><strong>Email:</strong> {{ $supervisor->email }}</p>
            <p><strong>Password:</strong> {{ $password }}</p>
        </div>
        
        <div class="login-options">
            <h3>How to Login:</h3>
            <div class="option">
                <h4>Option 1: Email & Password</h4>
                <p>Use your email and the password provided above to login.</p>
                <a href="{{ url('/login') }}" class="button">Login with Email & Password</a>
            </div>
            
            <div class="option">
                <h4>Option 2: Google Sign-In</h4>
                <p>You can also sign in using your Google account with the same email address.</p>
                <a href="{{ url('/auth/google/signin') }}" class="button google-button">Sign in with Google</a>
            </div>
        </div>
        
        <div class="next-steps">
            <h3>Supervisor Responsibilities:</h3>
            <ol>
                <li><strong>Login</strong> using either method above</li>
                <li><strong>Review your assigned modules</strong> and permissions</li>
                <li><strong>Manage users</strong> within your assigned modules</li>
                <li><strong>Monitor and report</strong> on user activities</li>
                <li><strong>Change your password</strong> for security purposes</li>
            </ol>
        </div>
        
        <p><strong>Important:</strong> As a supervisor, you have elevated privileges. Please ensure you understand your responsibilities and use your access appropriately.</p>
        
        <p>If you have any questions about your supervisor role or need assistance, please contact your administrator.</p>
    </div>
    
    <div class="footer">
        <p>Best regards,<br>CRM Team</p>
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
