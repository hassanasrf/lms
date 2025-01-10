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
        Schema::create('shipping_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('line_name');
            $table->string('local_agent');
            $table->string('owner');
            $table->text('address');
            $table->string('contact_person_name');
            $table->string('tel');
            $table->string('cell');
            $table->string('fax');
            $table->json('bank_details'); // Store bank details as JSON
            $table->enum('payment_type', ['Cash', 'Cheque', 'Pay Order', 'Online']);
            $table->integer('credit_period'); // in days
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_lines');
    }
};
