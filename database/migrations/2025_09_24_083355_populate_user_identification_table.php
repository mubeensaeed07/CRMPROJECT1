<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Get all users from the users table
        $users = DB::table('users')->get();
        
        // Get the SuperAdmin ID (role_id = 1)
        $superAdmin = DB::table('users')->where('role_id', 1)->first();
        $superAdminId = $superAdmin ? $superAdmin->id : null;
        
        foreach ($users as $user) {
            // Check if user already exists in user_identification table
            $existingRecord = DB::table('user_identification')
                ->where('user_id', $user->id)
                ->first();
            
            if (!$existingRecord) {
                // Determine user role
                $userRole = 'user';
                if ($user->role_id == 1) {
                    $userRole = 'superadmin';
                } elseif ($user->role_id == 2) {
                    $userRole = 'admin';
                }
                
                // Determine admin_id and superadmin_id based on role
                $adminId = null;
                $superAdminIdForUser = null;
                
                if ($user->role_id == 1) {
                    // SuperAdmin - no admin or superadmin above them
                    $adminId = null;
                    $superAdminIdForUser = null;
                } elseif ($user->role_id == 2) {
                    // Admin - reports to SuperAdmin
                    $adminId = null;
                    $superAdminIdForUser = $superAdminId;
                } elseif ($user->role_id == 3) {
                    // User - reports to Admin and SuperAdmin
                    // Get admin_id from users table or user_info table
                    $adminId = $user->admin_id;
                    $superAdminIdForUser = $superAdminId;
                }
                
                // Create record in user_identification table
                DB::table('user_identification')->insert([
                    'user_id' => $user->id,
                    'admin_id' => $adminId,
                    'superadmin_id' => $superAdminIdForUser,
                    'user_role' => $userRole,
                    'status' => $user->is_approved ? 'active' : 'pending',
                    'approved_at' => $user->is_approved ? now() : null,
                    'assigned_at' => now(),
                    'notes' => 'Auto-populated from existing user data',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove all auto-populated records
        DB::table('user_identification')
            ->where('notes', 'Auto-populated from existing user data')
            ->delete();
    }
};