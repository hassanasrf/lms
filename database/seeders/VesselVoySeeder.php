<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class VesselVoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vessel_voys')->insert([
            [
                'company_id' => 1,
                'vessel_name' => 'Oceanic Explorer',
                'shipping_line_id' => 1,
                'agent_id' => 1,
                'type_of_vessel' => 'Cargo',
                'flag' => 'Panama',
                'gross_tonnage' => 25000.50,
                'net_tonnage' => 15000.25,
                'loa' => '200m',
                'hatch_cover_lids' => 'Sliding Lid',
                'imo_number' => 'IMO1234567',
                'call_sign' => 'OCEXP01',
                'build' => 2015,
                'terminal_name' => 'Port of Los Angeles',
                'country_id' => 1,
                'last_voyage_copy' => 'last_voy_123.pdf',
                'voyage_number' => 'VOY001',
                'last_call' => Carbon::now()->subDays(10),
                'last_call_voyage_copy' => 'last_call_123.pdf',
                'next_call' => Carbon::now()->addDays(5),
                'next_call_voyage_copy' => 'next_call_123.pdf',
                'routing' => json_encode([
                    ['port' => 'Los Angeles', 'country_id' => 1],
                    ['port' => 'Tokyo', 'country_id' => 2],
                ]),
                'transit_time_routing_ports' => 14,
                'additional_ports' => json_encode([
                    ['port' => 'Busan', 'country_id' => 3],
                    ['port' => 'Shanghai', 'country_id' => 4],
                ]),
                'transit_time_additional_ports' => 7,
                'via_ports' => json_encode([
                    ['via_port' => 'Singapore', 'country_id' => 5],
                ]),
                'shipping_instruction' => Carbon::now()->subDays(15),
                'cut_off_time' => Carbon::now()->subDays(12),
                'expected_time_of_arrival' => Carbon::now()->addDays(5),
                'arrived_at' => null,
                'expected_time_of_departure' => Carbon::now()->addDays(6),
                'sailed_at' => null,
                'vir_number' => 'VIR00123',
                'vir_date' => Carbon::now()->subDays(10),
                'custom_file_number' => 'CUST00123',
                'bond_submitted_date' => Carbon::now()->subDays(20),
                'slot_partners' => json_encode([
                    ['partner_name' => 'Partner A', 'id' => 1],
                    ['partner_name' => 'Partner B', 'id' => 2],
                ]),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
