<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'company_id' => 1,
                'country_id' => 1,
                'city_id' => $city->id ?? 1,
                'name' => 'John Doe',
                'address' => '123 Main Street',
                'contact' => '123-456-7890',
                'email' => 'john.doe@example.com',
                'ntn' => '123456789',
                'str' => '987654321',
                'licence_name' => 'Business Licence',
                'licence_no' => 'LIC123456',
                'custom_code' => 'CUS123',
            ],
            [
                'company_id' => 2,
                'country_id' => 2,
                'city_id' => 3,
                'name' => 'Jane Smith',
                'address' => '456 Elm Street',
                'contact' => '987-654-3210',
                'email' => 'jane.smith@example.com',
                'ntn' => '987654321',
                'str' => '123456789',
                'licence_name' => 'Trading Licence',
                'licence_no' => 'LIC654321',
                'custom_code' => 'CUS654',
            ],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
