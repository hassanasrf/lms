<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TaggingPoint;
use App\Models\Company;

class TaggingPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyId = Company::first()->id ?? 1;
        $taggingPoints = [
            [
                'country_id' => 1,
                'city_id' => 1,
                'port_name' => 'Port of Example City',
                'type' => 'city',
                'value' => 'Example Value 1',
                'sales_tax' => 10,
                'wht' => 5,
            ],
            [
                'country_id' => 1,
                'city_id' => 2,
                'port_name' => 'Port of Example Terminal',
                'type' => 'terminal',
                'value' => 'Example Value 2',
                'sales_tax' => 15,
                'wht' => 7,
            ]
        ];

        foreach ($taggingPoints as $taggingPoint) {
            $taggingPoint['company_id'] = $companyId;
            TaggingPoint::create($taggingPoint);
        }
    }
}
