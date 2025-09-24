<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Password Reset - CRM System</title>
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
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
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
            background: #fff3cd;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #ffc107;
        }
        .button {
            display: inline-block;
            background: #ff6b6b;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 14px;
        }
        .warning {
            background: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid #dc3545;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Password Reset</h1>
        <p>Your password has been reset</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $user->full_name }}!</h2>
        
        <p>Your password has been reset by an administrator. Your new login credentials are:</p>
        
        <div class="credentials">
            <h3>New Login Credentials:</h3>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>New Password:</strong> {{ $newPassword }}</p>
        </div>
        
        <div class="warning">
            <strong>Security Notice:</strong> Please change your password after your first login for security purposes.
        </div>
        
        <a href="{{ url('/login') }}" class="button">Login to CRM System</a>
        
        <p>If you did not request this password reset, please contact your administrator immediately.</p>
    </div>
    
    <div class="footer">
        <p>Best regards,<br>CRM Team</p>
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
