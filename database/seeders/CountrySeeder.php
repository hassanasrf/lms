<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyId = Company::first()->id ?? 1;
        $countries = [
            ['name' => 'Pakistan', 'code' => 'PK'],
            ['name' => 'Bahrain', 'code' => 'BH'],
            ['name' => 'Kuwait', 'code' => 'KW'],
        ];

        foreach ($countries as $country) {
            // $country['company_id'] = $companyId;
            Country::create($country);
        }
    }
}
