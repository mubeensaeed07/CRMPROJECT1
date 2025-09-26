<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('supervisor_permissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('supervisor_id');
            $table->unsignedBigInteger('module_id');
            $table->boolean('can_create_users')->default(false);
            $table->boolean('can_edit_users')->default(false);
            $table->boolean('can_delete_users')->default(false);
            $table->boolean('can_reset_passwords')->default(false);
            $table->boolean('can_assign_modules')->default(false);
            $table->boolean('can_view_reports')->default(false);
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('supervisor_id')->references('id')->on('supervisors')->onDelete('cascade');
            $table->foreign('module_id')->references('id')->on('modules')->onDelete('cascade');
            
            // Unique constraint to prevent duplicate permissions
            $table->unique(['supervisor_id', 'module_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisor_permissions');
    }
};
