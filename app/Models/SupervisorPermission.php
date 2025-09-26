<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorPermission extends Model
{
    use HasFactory;

    protected $fillable = [
        'supervisor_id',
        'module_id',
        'can_create_users',
        'can_edit_users',
        'can_delete_users',
        'can_reset_passwords',
        'can_assign_modules',
        'can_view_reports'
    ];

    protected $casts = [
        'can_create_users' => 'boolean',
        'can_edit_users' => 'boolean',
        'can_delete_users' => 'boolean',
        'can_reset_passwords' => 'boolean',
        'can_assign_modules' => 'boolean',
        'can_view_reports' => 'boolean'
    ];

    // Relationships
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}