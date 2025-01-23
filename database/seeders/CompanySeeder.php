<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'ABC Corp',
                'address' => '123 Business St.',
                'city_id' => 1,
                'country_id' => 1,
                'ntn_number' => '12345',
                'str_number' => '67890',
                'licence_name' => 'Business License',
                'licence_number' => 'LIC001',
                'custom_code' => 'CUST001',
                'telephone' => '021-12345678',
                // 'company_type_id' => 1,
                // 'domain_name' => 'abc-corp.com',
            ],
            [
                'name' => 'XYZ Ltd',
                'address' => '456 Industry Rd.',
                'city_id' => 2,
                'country_id' => 1,
                'ntn_number' => '54321',
                'str_number' => '09876',
                'licence_name' => 'Trade License',
                'licence_number' => 'LIC002',
                'custom_code' => 'CUST002',
                'telephone' => '042-98765432',
                // 'company_type_id' => 2,
                // 'domain_name' => 'xyz-ltd.com',
            ],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}
