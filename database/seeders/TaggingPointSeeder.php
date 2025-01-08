<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaggingPoint;

class TaggingPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taggingPoints = [
            [
                'city_id' => 1,
                'country_id' => 1,
                'type' => 'City',
                'port_name' => 'Karachi Port',
                'terminal_name' => 'Karachi Terminal',
                'yard_name' => 'Karachi Yard',
                'bonded_area' => true,
                'loading_point' => '98765',
                'warehouse' => '24680',
                'sales_tax_percentage' => 15.5,
                'wht_percentage' => 10.5
            ],
            [
                'city_id' => 2,
                'country_id' => 2,
                'type' => 'Terminal',
                'port_name' => 'Bahrain Port',
                'terminal_name' => 'Bahrain Terminal',
                'yard_name' => 'Bahrain Yard',
                'bonded_area' => false,
                'loading_point' => '11223',
                'warehouse' => '33445',
                'sales_tax_percentage' => 10.0,
                'wht_percentage' => 5.0
            ]
        ];

        foreach ($taggingPoints as $taggingPoint) {
            TaggingPoint::create($taggingPoint);
        }
    }
}
