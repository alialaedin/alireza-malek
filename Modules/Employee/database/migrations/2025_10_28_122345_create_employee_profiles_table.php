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
        // The employee_profiles table is already created (with its full schema) by
        // the earlier 2025_10_05_123432_create_employee_profiles_table migration.
        // This leftover stub would otherwise fail on a fresh database, so guard it.
        if (Schema::hasTable('employee_profiles')) {
            return;
        }

        Schema::create('employee_profiles', function (Blueprint $table) {
            $table->id();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_profiles');
    }
};
