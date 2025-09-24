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
        // Get the SuperAdmin ID (role_id = 1)
        $superAdmin = DB::table('users')->where('role_id', 1)->first();
        $superAdminId = $superAdmin ? $superAdmin->id : null;
        
        if (!$superAdminId) {
            // If no SuperAdmin exists, create one or use the first user
            $firstUser = DB::table('users')->orderBy('id')->first();
            if ($firstUser) {
                // Update the first user to be SuperAdmin
                DB::table('users')->where('id', $firstUser->id)->update(['role_id' => 1]);
                $superAdminId = $firstUser->id;
            }
        }
        
        // Update all existing user_info records
        DB::table('user_info')->update([
            'superadmin_id' => $superAdminId
        ]);
        
        // For users (role_id = 3), assign them to the first admin if they don't have an admin_id
        $users = DB::table('users')->where('role_id', 3)->get();
        $firstAdmin = DB::table('users')->where('role_id', 2)->where('is_approved', true)->first();
        
        if ($firstAdmin) {
            foreach ($users as $user) {
                // Update user_info for this user
                DB::table('user_info')
                    ->where('user_id', $user->id)
                    ->update([
                        'admin_id' => $firstAdmin->id,
                        'superadmin_id' => $superAdminId
                    ]);
            }
        }
        
        // For admins (role_id = 2), set their admin_id to null and superadmin_id to the SuperAdmin
        $admins = DB::table('users')->where('role_id', 2)->get();
        foreach ($admins as $admin) {
            DB::table('user_info')
                ->where('user_id', $admin->id)
                ->update([
                    'admin_id' => null,
                    'superadmin_id' => $superAdminId
                ]);
        }
        
        // For SuperAdmin (role_id = 1), set both to null
        if ($superAdminId) {
            DB::table('user_info')
                ->where('user_id', $superAdminId)
                ->update([
                    'admin_id' => null,
                    'superadmin_id' => null
                ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset all hierarchy IDs to null
        DB::table('user_info')->update([
            'admin_id' => null,
            'superadmin_id' => null
        ]);
    }
};