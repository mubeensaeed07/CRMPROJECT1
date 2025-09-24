<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove profile fields that are now in user_infos table
            $table->dropColumn([
                'phone',
                'date_of_birth', 
                'gender',
                'avatar',
                'address',
                'city',
                'state',
                'country',
                'postal_code',
                'job_title',
                'department',
                'company',
                'bio',
                'linkedin_url',
                'twitter_url',
                'website_url',
                'emergency_contact_name',
                'emergency_contact_phone',
                'emergency_contact_relationship',
                'timezone',
                'language',
                'email_notifications',
                'sms_notifications'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Re-add the fields if needed to rollback
            $table->string('phone')->nullable()->after('email');
            $table->date('date_of_birth')->nullable()->after('phone');
            $table->enum('gender', ['male', 'female', 'other'])->nullable()->after('date_of_birth');
            $table->string('avatar')->nullable()->after('gender');
            $table->text('address')->nullable()->after('avatar');
            $table->string('city')->nullable()->after('address');
            $table->string('state')->nullable()->after('city');
            $table->string('country')->nullable()->after('state');
            $table->string('postal_code')->nullable()->after('country');
            $table->string('job_title')->nullable()->after('postal_code');
            $table->string('department')->nullable()->after('job_title');
            $table->string('company')->nullable()->after('department');
            $table->text('bio')->nullable()->after('company');
            $table->string('linkedin_url')->nullable()->after('bio');
            $table->string('twitter_url')->nullable()->after('linkedin_url');
            $table->string('website_url')->nullable()->after('twitter_url');
            $table->string('emergency_contact_name')->nullable()->after('website_url');
            $table->string('emergency_contact_phone')->nullable()->after('emergency_contact_name');
            $table->string('emergency_contact_relationship')->nullable()->after('emergency_contact_phone');
            $table->string('timezone')->default('UTC')->after('emergency_contact_relationship');
            $table->string('language')->default('en')->after('timezone');
            $table->boolean('email_notifications')->default(true)->after('language');
            $table->boolean('sms_notifications')->default(false)->after('email_notifications');
        });
    }
};