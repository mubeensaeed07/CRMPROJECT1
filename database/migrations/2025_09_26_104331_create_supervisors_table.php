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
        Schema::create('supervisors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('admin_id'); // Admin who created this supervisor
            $table->unsignedBigInteger('superadmin_id'); // SuperAdmin hierarchy
            $table->timestamps();
            
            // Foreign key constraints
            $table->foreign('admin_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('superadmin_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisors');
    }
};
