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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
            $table->string('service_type')->nullable(); // 1, 2, 3, etc.
            $table->enum('shipment_type', ['By Sea', 'By Air', 'By Road'])->nullable();
            $table->integer('number_of_containers')->nullable();
            $table->string('bulk_details')->nullable();
            $table->string('other_details')->nullable();
            $table->foreignId('loading_point_id')->nullable()->constrained('tagging_points')->nullOnDelete();
            $table->foreignId('commodity_id')->nullable()->constrained('commodities')->nullOnDelete();
            $table->foreignId('destination_country_id')->nullable()->constrained('tagging_points')->nullOnDelete();
            $table->string('licence_name')->nullable();
            $table->text('mailing_details')->nullable();
            $table->foreignId('shipping_line_id')->constrained('shipping_lines')->cascadeOnDelete();
            $table->foreignId('voyage_id')->nullable()->constrained('voyages')->nullOnDelete();
            $table->date('eta')->nullable(); // Estimated Time of Arrival
            $table->boolean('sgs_required')->default(false);
            $table->boolean('fumigation_required')->default(false);
            $table->boolean('fumigation_certificate_required')->default(false);
            $table->enum('document_type', ['CNF', 'CIF', 'FOB', 'ETC'])->nullable();
            $table->string('loading_person')->nullable();
            $table->string('loading_person_cell')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
