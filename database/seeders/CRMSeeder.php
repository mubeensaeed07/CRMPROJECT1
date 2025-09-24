<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\Module;
use App\Models\User;
use App\Models\UserModule;
use Illuminate\Support\Facades\Hash;

class CRMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Roles
        $roles = [
            ['name' => 'SuperAdmin', 'description' => 'Full system access'],
            ['name' => 'Admin', 'description' => 'User management and module assignment'],
            ['name' => 'User', 'description' => 'Access to assigned modules only']
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }

        // Create Modules
        $modules = [
            [
                'name' => 'Customer Management',
                'description' => 'Manage customers and contacts',
                'icon' => 'bx bx-user'
            ],
            [
                'name' => 'Lead Tracking',
                'description' => 'Track and manage sales leads',
                'icon' => 'bx bx-target-lock'
            ],
            [
                'name' => 'Deal Pipeline',
                'description' => 'Manage sales deals and opportunities',
                'icon' => 'bx bx-trending-up'
            ],
            [
                'name' => 'Reports & Analytics',
                'description' => 'View reports and analytics dashboard',
                'icon' => 'bx bx-bar-chart-alt-2'
            ]
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }

        // Create or update SuperAdmin User
        $superAdmin = User::updateOrCreate(
            ['email' => 'saeedmubeen20@gmail.com'],
            [
                'name' => 'Saeed Mubeen',
                'first_name' => 'Saeed',
                'last_name' => 'Mubeen',
                'password' => Hash::make('12345678'),
                'role_id' => 1,
                'is_approved' => true
            ]
        );

        // Create or update sample Admin User
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'first_name' => 'Admin',
                'last_name' => 'User',
                'password' => Hash::make('password123'),
                'role_id' => 2,
                'is_approved' => true
            ]
        );

        // Create or update sample regular User
        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name' => 'John Doe',
                'first_name' => 'John',
                'last_name' => 'Doe',
                'password' => Hash::make('password123'),
                'role_id' => 3,
                'is_approved' => true
            ]
        );

        // Assign modules to regular user
        $userModules = [
            ['user_id' => $user->id, 'module_id' => 1], // Customer Management
            ['user_id' => $user->id, 'module_id' => 2], // Lead Tracking
        ];

        foreach ($userModules as $userModule) {
            UserModule::updateOrCreate($userModule);
        }
    }
}
