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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            // $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            // $table->foreignId('customer_type_id')->nullable()->constrained('customer_types')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->cascadeOnDelete();
            $table->foreignId('city_id')->nullable()->constrained('cities')->cascadeOnDelete();
            $table->string('bank_name');
            $table->string('branch_name')->nullable();
            $table->string('address')->nullable();
            $table->string('title');
            $table->string('account_number');
            $table->string('iban_number')->nullable();
            $table->string('swift_code')->nullable();
            $table->string('account_type')->nullable();
            $table->string('currency');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
