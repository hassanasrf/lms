<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banks = [
            [
                'company_id' => 1,
                // 'customer_type_id' => null,
                // 'customer_id' => 1,
                'bank_name' => 'National Bank',
                'branch_name' => 'Main Branch',
                'address' => '123 Street, Business District',
                'city_id' => 1,
                'country_id' => 1,
                'title' => 'Corporate Account',
                'account_number' => '9876543210',
                'iban_number' => 'PK36NBPA9876543210',
                'swift_code' => 'NBPKKHI',
                'account_type' => 'Savings',
                'currency' => 'PKR',
            ],
            [
                'company_id' => 2,
                // 'customer_type_id' => 1,
                // 'customer_id' => 2,
                'bank_name' => 'HBL',
                'branch_name' => 'City Branch',
                'address' => '456 Avenue, Financial Hub',
                'city_id' => 2,
                'country_id' => 2,
                'title' => 'Retail Account',
                'account_number' => '1234567890',
                'iban_number' => 'PK36HBLA1234567890',
                'swift_code' => 'HBLPKHI',
                'account_type' => 'Current',
                'currency' => 'USD',
            ],
        ];

        foreach ($banks as $bank) {
            Bank::create($bank);
        }
    }
}
