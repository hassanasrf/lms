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
        DB::table('vessels')->insert([
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
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
