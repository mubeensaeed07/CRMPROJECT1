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
        Schema::table('user_identification', function (Blueprint $table) {
            // Change status column to be larger to accommodate 'pending', 'active', etc.
            $table->string('status', 50)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_identification', function (Blueprint $table) {
            // Revert back to smaller size if needed
            $table->string('status', 20)->change();
        });
    }
};