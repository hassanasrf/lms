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
        Schema::create('vessel_voys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->string('vessel_name');
            $table->foreignId('shipping_line_id')->nullable()->constrained('shipping_lines')->nullOnDelete();
            $table->foreignId('agent_id')->nullable()->constrained('agents')->nullOnDelete();
            $table->string('type_of_vessel')->nullable();
            $table->string('flag')->nullable();
            $table->decimal('gross_tonnage', 15, 2)->nullable();
            $table->decimal('net_tonnage', 15, 2)->nullable();
            $table->string('loa')->nullable(); // Length Overall
            $table->string('hatch_cover_lids')->nullable();
            $table->string('imo_number')->nullable();
            $table->string('call_sign')->nullable();
            $table->year('build')->nullable();

            // Terminal Info
            $table->string('terminal_name')->nullable();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('last_voyage_copy')->nullable();
            $table->string('voyage_number')->nullable();
            $table->dateTime('last_call')->nullable();
            $table->string('last_call_voyage_copy')->nullable();
            $table->dateTime('next_call')->nullable();
            $table->string('next_call_voyage_copy')->nullable();

            // Routing
            $table->json('routing')->nullable(); // 1st, 2nd, etc., connected to countries
            $table->integer('transit_time_routing_ports')->nullable();
            $table->json('additional_ports')->nullable(); // Additional ports (1, 2, etc.)
            $table->integer('transit_time_additional_ports')->nullable();
            $table->json('via_ports')->nullable(); // Via ports (1, 2, etc.)

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
        Schema::dropIfExists('vessel_voys');
    }
};
