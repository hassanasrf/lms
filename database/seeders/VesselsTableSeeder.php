<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VesselsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vessels')->insert([
            [
                'company_id' => 1,
                'vessel_name' => 'Evergreen Voyager',
                'shipping_line_id' => 1,
                'agent_id' => 1,
                'type_of_vessel' => 'Container Ship',
                'flag' => 'Panama',
                'gross_tonnage' => 75000.00,
                'net_tonnage' => 40000.00,
                'loa' => '300m',
                'hatch_cover_lids' => 'Yes',
                'imo_number' => 'IMO1234567',
                'call_sign' => 'CALL123',
                'build' => 2010,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
