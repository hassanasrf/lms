<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $packages = [
            ['name' => 'Bags','packing_code' => 'BAG01'],
            ['name' => 'Bales', 'packing_code' => 'BAL02'],
            ['name' => 'Bundles', 'packing_code' => 'BUN03'],
            ['name' => 'Pieces', 'packing_code' => 'PIE04'],
            ['name' => 'Bulk', 'packing_code' => 'BUL05'],
        ];

        foreach ($packages as $package) {
            DB::table('packages')->insert($package);
        }
    }
}
