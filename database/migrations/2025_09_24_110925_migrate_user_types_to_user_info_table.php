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
        // Migrate existing user type assignments to user_info table
        $userTypeAssignments = DB::table('user_type_assignments')->get();
        
        foreach ($userTypeAssignments as $assignment) {
            // Find the user
            $user = User::find($assignment->user_id);
            
            if ($user && $user->userInfo) {
                // Update existing user_info record
                $user->userInfo->update([
                    'user_type_id' => $assignment->user_type_id
                ]);
            } elseif ($user) {
                // Create user_info record if it doesn't exist
                $user->userInfo()->create([
                    'user_type_id' => $assignment->user_type_id,
                    'admin_id' => $user->admin_id,
                    'superadmin_id' => null // Will be set by existing migration
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Clear user_type_id from user_info table
        DB::table('user_info')->update(['user_type_id' => null]);
    }
};