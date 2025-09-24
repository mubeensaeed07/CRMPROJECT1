<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Find the SuperAdmin (role_id = 1)
        $superAdmin = User::where('role_id', 1)->first();
        $superAdminId = $superAdmin ? $superAdmin->id : null;

        // Update all users with proper hierarchy in users table
        User::all()->each(function (User $user) use ($superAdminId) {
            $updateData = [];
            
            if ($user->isSuperAdmin()) {
                // SuperAdmin has no admin or superadmin above them
                $updateData['admin_id'] = null;
                $updateData['superadmin_id'] = null;
            } elseif ($user->isAdmin()) {
                // Admins have no admin above them, but report to SuperAdmin
                $updateData['admin_id'] = null;
                $updateData['superadmin_id'] = $superAdminId;
            } else {
                // Regular users report to their assigned admin and the SuperAdmin
                $updateData['admin_id'] = $user->admin_id; // Keep existing admin_id
                $updateData['superadmin_id'] = $superAdminId;
            }
            
            if (!empty($updateData)) {
                $user->update($updateData);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Set all hierarchy fields to null
        DB::table('users')->update([
            'admin_id' => null,
            'superadmin_id' => null
        ]);
    }
};