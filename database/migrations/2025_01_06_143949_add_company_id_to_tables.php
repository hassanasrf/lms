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
        Schema::table('countries', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->after('id')->constrained('companies')->cascadeOnDelete();
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->after('id')->constrained('companies')->cascadeOnDelete();
        });

        Schema::table('types', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable()->after('id')->constrained('companies')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dropping company_id from the 'countries' table
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });

        // Dropping company_id from the 'cities' table
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });

        // Dropping company_id from the 'types' table
        Schema::table('types', function (Blueprint $table) {
            $table->dropColumn('company_id');
        });
    }
};
