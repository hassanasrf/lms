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
        Schema::create('voyages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('vessel_id')->constrained('vessels')->cascadeOnDelete();

            // Terminal Info
            $table->foreignId('terminal_id')->nullable()->constrained('tagging_points')->nullOnDelete();
            $table->foreignId('last_call_id')->nullable()->constrained('tagging_points')->nullOnDelete();
            $table->foreignId('next_call_id')->nullable()->constrained('tagging_points')->nullOnDelete();
            $table->string('voyage_number')->nullable();

            // Routing
            $table->foreignId('transit_time_routing_port_id')->nullable()->constrained('tagging_points')->nullOnDelete();
            $table->string('transit_time_additional_ports')->nullable();

            // Timing and Status
            $table->dateTime('shipping_instruction')->nullable();
            $table->dateTime('cut_off_time')->nullable();
            $table->dateTime('expected_time_of_arrival')->nullable();
            $table->dateTime('arrived_at')->nullable();
            $table->dateTime('expected_time_of_departure')->nullable();
            $table->dateTime('sailed_at')->nullable();

            // Customs and Documentation
            $table->string('vir_number')->nullable();
            $table->date('vir_date')->nullable();
            $table->string('custom_file_number')->nullable();
            $table->date('bond_submitted_date')->nullable();

            // Slot Partners
            $table->json('slot_partners')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyages');
    }
};
