<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'icon',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];

    public function userModules()
    {
        return $this->hasMany(UserModule::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_modules');
    }
}
