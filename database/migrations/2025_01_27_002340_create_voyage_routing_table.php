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
        Schema::create('voyage_routing', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voyage_id')->constrained('voyages')->cascadeOnDelete();
            $table->foreignId('routing_id')->constrained('tagging_points')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('voyage_routing');
    }
};
