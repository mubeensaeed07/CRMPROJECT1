<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegisteredMail;
use App\Models\User;

class TestEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the email system by sending a sample email';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testing Email System...');
        
        // Create a test user
        $user = new User();
        $user->first_name = 'Test';
        $user->last_name = 'User';
        $user->email = 'test@example.com';
        
        try {
            // Send test email
            Mail::to($user->email)->send(new UserRegisteredMail($user, 'TestPassword123', 'Admin'));
            
            $this->info('✅ Email sent successfully!');
            $this->line('📧 Check storage/logs/laravel.log for the email content');
            $this->line('🔑 Test Password: TestPassword123');
            $this->line('📱 Email contains login credentials for the new user');
            
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
        }
    }
}
