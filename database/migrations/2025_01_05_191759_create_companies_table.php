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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            // $table->foreignId('company_type_id')->constrained('company_types')->cascadeOnDelete();
            $table->string('name');
            // $table->string('domain_name')->nullable();
            $table->string('address')->nullable();
            $table->string('ntn_number')->nullable();
            $table->string('str_number')->nullable();
            $table->string('licence_name')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('custom_code')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
