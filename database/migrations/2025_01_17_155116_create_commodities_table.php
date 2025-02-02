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
            $table->string('type')->nullable();
            $table->string('hs_code')->nullable();
            $table->boolean('dangerous_cargo')->default(false);
            $table->string('undg_code')->nullable();
            $table->string('dg_class')->nullable();
            $table->string('dg_chapter')->nullable();

            // Import
            $table->string('cargo_value')->nullable();

            // Landing Charges
            $table->string('landing_charges')->nullable();
            $table->string('landing_charges_type')->nullable();

            // Insurance
            $table->string('insurance')->nullable();
            $table->string('insurance_type')->nullable();

            // Customs Duties
            $table->string('custom_duty')->nullable();
            $table->string('custom_duty_type')->nullable();

            // Sales Tax
            $table->string('sales_tax')->nullable(); 
            $table->string('sales_tax_type')->nullable();

            // Value Addition Tax
            $table->string('vat')->nullable();
            $table->string('vat_type')->nullable();

            // Additional Custom Duty
            $table->string('additional_custom_duty')->nullable();
            $table->string('additional_custom_duty_type')->nullable();

            // Regulatory Duty
            $table->string('regulatory_duty')->nullable();
            $table->string('regulatory_duty_type')->nullable();

            // Additional Income Tax
            $table->string('additional_income_tax')->nullable();
            $table->string('additional_income_tax_type')->nullable();

            // Excise Duty
            $table->string('excise_duty')->nullable();
            $table->string('excise_duty_type')->nullable();

            // Stamp Duty
            $table->decimal('stamp_duty_value', 15, 2)->nullable();
            $table->string('stamp_duty_type')->nullable();

            // Net Total
            $table->string('net_total')->nullable();

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
