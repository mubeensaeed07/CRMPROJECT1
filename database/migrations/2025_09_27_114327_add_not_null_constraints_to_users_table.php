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
        Schema::table('users', function (Blueprint $table) {
            // Add NOT NULL constraints to prevent future NULL values
            $table->string('created_by_type')->nullable(false)->change();
            $table->unsignedBigInteger('created_by_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Revert to nullable
            $table->string('created_by_type')->nullable(true)->change();
            $table->unsignedBigInteger('created_by_id')->nullable(true)->change();
        });
    }
};
