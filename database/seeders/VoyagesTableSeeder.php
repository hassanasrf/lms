<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class VoyagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $voyageId = DB::table('voyages')->insertGetId([
            'company_id' => 1,
            'vessel_id' => 1,
            'terminal_id' => 1,
            'last_call_id' => 2,
            'next_call_id' => 1,
            'voyage_number' => 'VY-' . rand(1000, 9999),
            'transit_time_routing_port_id' => 1,
            'transit_time_additional_ports' => now()->subDays(2),
            'shipping_instruction' => now(),
            'cut_off_time' => now()->addDays(2),
            'expected_time_of_arrival' => now()->addDays(5),
            'arrived_at' => null,
            'expected_time_of_departure' => now()->addDays(7),
            'sailed_at' => null,
            'vir_number' => 'VIR-' . rand(1000, 9999),
            'vir_date' => now()->subDays(1),
            'custom_file_number' => 'CF-' . rand(1000, 9999),
            'bond_submitted_date' => now()->subDays(2),
            'slot_partners' => json_encode(['Partner A', 'Partner B']),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert sample voyage routing
        DB::table('voyage_routing')->insert([
            [
                'voyage_id' => $voyageId,
                'routing_id' => 1
            ],
            [
                'voyage_id' => $voyageId,
                'routing_id' => 2
            ]
        ]);
    }
}
