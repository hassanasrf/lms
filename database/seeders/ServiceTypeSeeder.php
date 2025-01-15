<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ServiceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Import'],
            ['name' => 'Export'],
            ['name' => 'Forwarding'],
            ['name' => 'Clearing'],
            ['name' => 'Transportation'],
            ['name' => 'Warehouse'],
            ['name' => 'Lifters'],
            ['name' => 'Labours'],
            ['name' => 'Commodity'],
            ['name' => 'Etc'],
        ];

        DB::table('service_types')->insert($services);
    }
}
