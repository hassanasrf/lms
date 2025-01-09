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
        Schema::table('roles', function (Blueprint $table) {
            // Drop the existing unique constraint on `name` and `guard_name`
            $table->dropUnique('roles_name_guard_name_unique');

            // Add a new unique constraint on `name`, `company_id`, and `guard_name`
            $table->unique(['name', 'company_id', 'guard_name'], 'roles_name_company_guard_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Drop the new unique constraint
            $table->dropUnique('company_unique');

            // Restore the original unique constraint on `name` and `guard_name`
            $table->unique(['name', 'guard_name'], 'roles_name_guard_name_unique');
        });
    }
};
