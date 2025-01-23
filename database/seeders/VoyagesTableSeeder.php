<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoyagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('voyages')->insert([
            [
                'vessel_id' => 1,
                'terminal_name' => 'Port of Singapore',
                'country_id' => 1,
                'last_voyage_copy' => 'LVC123',
                'voyage_number' => 'VN456',
                'last_call' => now()->subDays(10),
                'last_call_voyage_copy' => 'LVC123',
                'next_call' => now()->addDays(5),
                'next_call_voyage_copy' => 'NVC123',
                'routing' => json_encode(['Singapore', 'Hong Kong']),
                'transit_time_routing_ports' => 12,
                'additional_ports' => json_encode(['Port Klang', 'Jakarta']),
                'transit_time_additional_ports' => 8,
                'via_ports' => json_encode(['Colombo', 'Mumbai']),
                'shipping_instruction' => now()->subDays(20),
                'cut_off_time' => now()->subDays(15),
                'expected_time_of_arrival' => now()->addDays(3),
                'arrived_at' => null,
                'expected_time_of_departure' => now()->addDays(5),
                'sailed_at' => null,
                'vir_number' => 'VIR789',
                'vir_date' => now()->subDays(25),
                'custom_file_number' => 'CFN987',
                'bond_submitted_date' => now()->subDays(30),
                'slot_partners' => json_encode(['Partner A', 'Partner B']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
