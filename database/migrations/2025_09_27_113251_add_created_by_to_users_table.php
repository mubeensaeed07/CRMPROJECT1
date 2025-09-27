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
            $table->string('created_by_type')->nullable()->after('admin_id'); // 'admin' or 'supervisor'
            $table->unsignedBigInteger('created_by_id')->nullable()->after('created_by_type'); // ID of admin or supervisor
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['created_by_type', 'created_by_id']);
        });
    }
};
