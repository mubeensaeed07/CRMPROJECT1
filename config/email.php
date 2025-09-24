<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Email Configuration for CRM System
    |--------------------------------------------------------------------------
    |
    | This configuration handles email settings for the CRM system.
    | It supports both development (log driver) and production (SMTP) modes.
    |
    */

    'development' => [
        'driver' => 'log',
        'path' => storage_path('logs/emails.log'),
    ],

    'production' => [
        'driver' => 'smtp',
        'host' => env('MAIL_HOST', 'smtp.gmail.com'),
        'port' => env('MAIL_PORT', 587),
        'username' => env('MAIL_USERNAME'),
        'password' => env('MAIL_PASSWORD'),
        'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        'from' => [
            'address' => env('MAIL_FROM_ADDRESS', 'noreply@yourdomain.com'),
            'name' => env('MAIL_FROM_NAME', 'CRM System'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Templates Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for email templates and branding.
    |
    */

    'templates' => [
        'user_registered' => 'emails.user-registered',
        'password_reset' => 'emails.password-reset',
    ],

    /*
    |--------------------------------------------------------------------------
    | Email Queue Configuration
    |--------------------------------------------------------------------------
    |
    | For production, emails should be queued to avoid blocking the application.
    |
    */

    'queue' => [
        'enabled' => env('MAIL_QUEUE_ENABLED', false),
        'connection' => env('MAIL_QUEUE_CONNECTION', 'database'),
    ],
];
