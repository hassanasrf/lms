<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Consignee / Importer', 'is_active' => true],
            ['name' => 'Shipper / Exporter', 'is_active' => true],
            ['name' => 'Buyer', 'is_active' => true],
            ['name' => 'Seller', 'is_active' => true],
            ['name' => 'Trading', 'is_active' => true],
            ['name' => 'Clearing Agent', 'is_active' => true],
            ['name' => 'Transporter', 'is_active' => true],
            ['name' => 'Empty Depot', 'is_active' => true],
            ['name' => 'NVOCC', 'is_active' => true],
            ['name' => 'Shipping Agency', 'is_active' => true],
            ['name' => 'Forwarder', 'is_active' => true],
            ['name' => 'Warehouse', 'is_active' => true],
            ['name' => 'Etc', 'is_active' => true],
        ];

        foreach ($types as $type) {
            DB::table('company_types')->updateOrInsert(
                ['name' => $type['name']],
                [
                    'is_active' => $type['is_active'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}
