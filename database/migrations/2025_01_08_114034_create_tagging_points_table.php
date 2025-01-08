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
        Schema::create('tagging_points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained('cities')->cascadeOnDelete();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->string('type'); // Type (Country / City / Terminal / Yard / Loading Point / Warehouse)
            $table->string('port_name')->nullable();
            $table->string('port_code', 5)->nullable();
            $table->string('terminal_name')->nullable();
            $table->string('yard_name')->nullable();
            $table->boolean('bonded_area')->nullable(); // Bonded Area Y/N
            $table->string('loading_point')->nullable();
            $table->string('warehouse')->nullable();
            $table->decimal('sales_tax_percentage', 5, 2)->nullable(); // Sales Tax %
            $table->decimal('wht_percentage', 5, 2)->nullable(); // WHT %
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagging_points');
    }
};
