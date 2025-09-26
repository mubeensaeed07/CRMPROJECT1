<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Supervisor extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'admin_id',
        'superadmin_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // Relationships
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function superadmin()
    {
        return $this->belongsTo(User::class, 'superadmin_id');
    }

    public function permissions()
    {
        return $this->hasMany(SupervisorPermission::class);
    }

    public function modules()
    {
        return $this->belongsToMany(Module::class, 'supervisor_permissions', 'supervisor_id', 'module_id')
                    ->withPivot(['can_create_users', 'can_edit_users', 'can_delete_users', 'can_reset_passwords', 'can_assign_modules', 'can_view_reports'])
                    ->withTimestamps();
    }

    // Helper methods
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isActive()
    {
        return $this->status === 'active';
    }

    public function hasPermission($moduleId, $permission)
    {
        return $this->permissions()
                    ->where('module_id', $moduleId)
                    ->where($permission, true)
                    ->exists();
    }

    public function canCreateUsers($moduleId)
    {
        return $this->hasPermission($moduleId, 'can_create_users');
    }

    public function canEditUsers($moduleId)
    {
        return $this->hasPermission($moduleId, 'can_edit_users');
    }

    public function canDeleteUsers($moduleId)
    {
        return $this->hasPermission($moduleId, 'can_delete_users');
    }

    public function canResetPasswords($moduleId)
    {
        return $this->hasPermission($moduleId, 'can_reset_passwords');
    }

    public function canAssignModules($moduleId)
    {
        return $this->hasPermission($moduleId, 'can_assign_modules');
    }

    public function canViewReports($moduleId)
    {
        return $this->hasPermission($moduleId, 'can_view_reports');
    }
}