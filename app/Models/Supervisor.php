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

    /**
     * Get the name of the unique identifier for the user.
     *
     * @return string
     */
    public function getAuthIdentifierName()
    {
        return 'id';
    }

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->id;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the token value for the "remember me" session.
     *
     * @return string|null
     */
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    /**
     * Set the token value for the "remember me" session.
     *
     * @param  string|null  $value
     * @return void
     */
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    /**
     * Get the column name for the "remember me" token.
     *
     * @return string
     */
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

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

    // Method to check if supervisor is a super admin
    public function isSuperAdmin()
    {
        // For now, return false as supervisors are not super admins
        // You can modify this logic based on your business requirements
        return false;
    }

    // Method to check if supervisor is an admin
    public function isAdmin()
    {
        // Supervisors are not admins, they are supervisors
        return false;
    }

    // Method to check if supervisor is a regular user
    public function isUser()
    {
        // Supervisors are not regular users
        return false;
    }

    // Method to check if this is a supervisor
    public function isSupervisor()
    {
        // This is a supervisor
        return true;
    }

    // Get the admin that manages this supervisor (already exists as admin())
    // This method is already defined above

    // Get all users managed by this supervisor (if needed)
    public function managedUsers()
    {
        // Supervisors don't manage users directly, they have permissions for modules
        return collect(); // Return empty collection
    }
}