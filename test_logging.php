<?php

// Set locale to English
setlocale(LC_ALL, 'en_US.UTF-8', 'en_US', 'en');
putenv('LC_ALL=en_US.UTF-8');

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TESTING LOGGING WITH ENGLISH LOCALE ===\n";

// Test logging with English locale
\Log::info('This is a test log message in English');
\Log::warning('This is a warning message in English');
\Log::error('This is an error message in English');

echo "Log messages written. Check storage/logs/laravel.log\n";

// Test current locale
echo "Current locale: " . setlocale(LC_ALL, 0) . "\n";
echo "Current timezone: " . date_default_timezone_get() . "\n";
