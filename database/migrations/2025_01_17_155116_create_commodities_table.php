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
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('currency_id')->nullable()->constrained('currencies')->nullOnDelete();
            $table->foreignId('packing_id')->nullable()->constrained('packages')->nullOnDelete();
            $table->string('name');
            $table->string('hs_code')->nullable();
            $table->boolean('dangerous_cargo')->default(false); // Use boolean instead of enum
            $table->string('undg_code')->nullable();
            $table->string('dg_class')->nullable();
            $table->string('dg_chapter')->nullable();

            // Import
            $table->decimal('cargo_value', 15, 2)->nullable();
            $table->string('connected_currency')->nullable(); // e.g., USD
            $table->decimal('connected_packing', 15, 2)->nullable(); // e.g., based on Kgs

            // Landing Charges
            $table->decimal('landing_charges_percentage', 5, 2)->nullable(); // Example: 1 for 1%
            $table->string('landing_charges_type')->nullable(); // Replace enum with string

            // Insurance
            $table->decimal('insurance_percentage', 5, 2)->nullable(); // Example: 1 for 1%
            $table->string('insurance_type')->nullable(); // Replace enum with string

            // Customs Duties
            $table->decimal('custom_duty_percentage', 5, 2)->nullable(); // Example: 0
            $table->string('custom_duty_type')->nullable(); // Replace enum with string

            // Sales Tax
            $table->decimal('sales_tax_percentage', 5, 2)->nullable(); // Example: 18 for 18%
            $table->string('sales_tax_type')->nullable(); // Replace enum with string

            // Value Addition Tax
            $table->decimal('vat_percentage', 5, 2)->nullable(); // Example: 3 for 3%
            $table->string('vat_type')->nullable(); // Replace enum with string

            // Additional Custom Duty
            $table->decimal('additional_custom_duty_percentage', 5, 2)->nullable(); // Example: 2 for 2%
            $table->string('additional_custom_duty_type')->nullable(); // Replace enum with string

            // Regulatory Duty
            $table->decimal('regulatory_duty_percentage', 5, 2)->nullable(); // Example: 0
            $table->string('regulatory_duty_type')->nullable(); // Replace enum with string

            // Additional Income Tax
            $table->decimal('additional_income_tax_percentage', 5, 2)->nullable(); // Example: 2 for 2%
            $table->string('additional_income_tax_type')->nullable(); // Replace enum with string

            // Excise Duty
            $table->decimal('excise_duty_percentage', 5, 2)->nullable(); // Example: 1.24 for 1.24%
            $table->string('excise_duty_type')->nullable(); // Replace enum with string

            // Stamp Duty
            $table->decimal('stamp_duty_value', 15, 2)->nullable(); // Example: 1000
            $table->string('stamp_duty_type')->nullable(); // Replace enum with string

            // Export
            $table->decimal('export_value_per_kg', 15, 2)->nullable();
            $table->string('export_currency')->nullable(); // Replace enum with string (e.g., USD, PKR)

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
