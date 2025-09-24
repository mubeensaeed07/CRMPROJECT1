<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;

    protected $table = 'user_info';

    protected $fillable = [
        'user_id',
        'admin_id',
        'superadmin_id',
        'user_type_id',
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
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'email_notifications' => 'boolean',
            'sms_notifications' => 'boolean'
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }
}