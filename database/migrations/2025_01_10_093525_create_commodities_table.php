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
        Schema::create('commodities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('hs_code')->nullable();
            $table->enum('dangerous_cargo', ['Y', 'N'])->default('N');
            $table->string('undg_code')->nullable();
            $table->string('dg_class')->nullable();
            $table->string('dg_chapter')->nullable();

            // Import
            $table->decimal('cargo_value', 15, 2)->nullable();
            $table->string('connected_currency')->nullable(); // e.g., USD
            $table->decimal('connected_packing', 15, 2)->nullable(); // e.g., based on Kgs

            // Landing Charges
            $table->decimal('landing_charges_percentage', 5, 2)->nullable(); // Example: 1 for 1%
            $table->enum('landing_charges_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Insurance
            $table->decimal('insurance_percentage', 5, 2)->nullable(); // Example: 1 for 1%
            $table->enum('insurance_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Customs Duties
            $table->decimal('custom_duty_percentage', 5, 2)->nullable(); // Example: 0
            $table->enum('custom_duty_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Sales Tax
            $table->decimal('sales_tax_percentage', 5, 2)->nullable(); // Example: 18 for 18%
            $table->enum('sales_tax_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Value Addition Tax
            $table->decimal('vat_percentage', 5, 2)->nullable(); // Example: 3 for 3%
            $table->enum('vat_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Additional Custom Duty
            $table->decimal('additional_custom_duty_percentage', 5, 2)->nullable(); // Example: 2 for 2%
            $table->enum('additional_custom_duty_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Regulatory Duty
            $table->decimal('regulatory_duty_percentage', 5, 2)->nullable(); // Example: 0
            $table->enum('regulatory_duty_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Additional Income Tax
            $table->decimal('additional_income_tax_percentage', 5, 2)->nullable(); // Example: 2 for 2%
            $table->enum('additional_income_tax_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Excise Duty
            $table->decimal('excise_duty_percentage', 5, 2)->nullable(); // Example: 1.24 for 1.24%
            $table->enum('excise_duty_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Stamp Duty
            $table->decimal('stamp_duty_value', 15, 2)->nullable(); // Example: 1000
            $table->enum('stamp_duty_type', ['Percentage', 'Multiply', 'Value'])->nullable();

            // Export
            $table->decimal('export_value_per_kg', 15, 2)->nullable();
            $table->enum('export_currency', ['USD', 'PKR', 'AED', 'ETC'])->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commodities');
    }
};
