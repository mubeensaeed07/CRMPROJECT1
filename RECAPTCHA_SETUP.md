# Google reCAPTCHA Setup Instructions

## Step 1: Get reCAPTCHA Credentials

1. Go to [Google reCAPTCHA Console](https://www.google.com/recaptcha/admin)
2. Click "Create" to add a new site
3. Fill in the form:
   - **Label**: CRM Project
   - **reCAPTCHA type**: Select "reCAPTCHA v2" → "I'm not a robot" Checkbox
   - **Domains**: Add your domains:
     - `localhost`
     - `127.0.0.1`
     - `127.0.0.1:8000`
     - `localhost:8000`
4. Accept the Terms of Service
5. Click "Submit"

## Step 2: Get Your Keys

After creating the site, you'll get:
- **Site Key** (public key)
- **Secret Key** (private key)

## Step 3: Update .env File

Add these lines to your `.env` file:

```
RECAPTCHA_SITE_KEY=your_site_key_here
RECAPTCHA_SECRET_KEY=your_secret_key_here
```

## Step 4: Test reCAPTCHA

1. Start your Laravel server: `php artisan serve`
2. Go to `http://127.0.0.1:8000/login`
3. You should see the reCAPTCHA checkbox
4. Try to submit the form without checking reCAPTCHA - it should show an error
5. Check the reCAPTCHA and submit - it should work

## Features Added

✅ **Login Form**: reCAPTCHA protection
✅ **Registration Form**: reCAPTCHA protection  
✅ **Server-side Validation**: Validates reCAPTCHA response
✅ **Error Handling**: Shows user-friendly error messages
✅ **Security**: Prevents bot registrations and login attempts

## Files Modified

- `app/Services/RecaptchaService.php` - reCAPTCHA service class
- `config/services.php` - reCAPTCHA configuration
- `app/Http/Controllers/AuthController.php` - Added validation
- `resources/views/pages/signin-cover.blade.php` - Added reCAPTCHA widget
- `resources/views/pages/signup-cover.blade.php` - Added reCAPTCHA widget
- `.env` - Added reCAPTCHA keys

## Security Benefits

- **Bot Protection**: Prevents automated bot attacks
- **Spam Prevention**: Reduces spam registrations
- **Brute Force Protection**: Adds extra layer to login attempts
- **User Verification**: Ensures real users are registering/logging in
