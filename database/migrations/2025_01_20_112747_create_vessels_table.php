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
        Schema::create('vessels', function (Blueprint $table) {
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
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vessels');
    }
};
