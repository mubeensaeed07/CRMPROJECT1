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

        // Ensure all users have user_info records
        User::all()->each(function (User $user) use ($superAdminId) {
            // Check if user_info exists
            $userInfo = $user->userInfo;
            
            if (!$userInfo) {
                // Create user_info record
                $user->userInfo()->create([
                    'admin_id' => $user->admin_id,
                    'superadmin_id' => $superAdminId,
                    'user_type_id' => null // Will be assigned later if needed
                ]);
            } else {
                // Update existing user_info if needed
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
                    $updateData['admin_id'] = $user->admin_id;
                    $updateData['superadmin_id'] = $superAdminId;
                }
                
                if (!empty($updateData)) {
                    $userInfo->update($updateData);
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration only creates/updates records, no need to reverse
    }
};