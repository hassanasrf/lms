<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyId = Company::first()->id ?? 1;
        $cities = [
            ['name' => 'Karachi', 'country_id' => 1, 'code' => '101'],
            ['name' => 'Lahore', 'country_id' => 1, 'code' => '102'],
            ['name' => 'Bahrain City', 'country_id' => 2, 'code' => '201'],
            ['name' => 'Kuwait City', 'country_id' => 3, 'code' => '301'],
        ];

        foreach ($cities as $city) {
            // $city['company_id'] = $companyId;
            City::create($city);
        }
    }
}
