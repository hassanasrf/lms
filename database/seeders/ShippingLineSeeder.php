<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingLine;
use App\Models\Company;

class ShippingLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companyId = Company::first()->id ?? 1;
        $shippingLines = [
            [
                'line_name' => 'Shipping Line 1',
                'local_agent' => 'Local Agent 1',
                'owner' => 'Owner 1',
                'address' => '123 Shipping Lane, City, Country',
                'contact_person_name' => 'John Doe',
                'tel' => '123-456-7890',
                'cell' => '987-654-3210',
                'fax' => '111-222-3333',
                'bank_details' => json_encode([
                    'account_number' => '123456',
                    'bank_name' => 'Bank A',
                    'swift_code' => 'BANKA123',
                ]),
                'payment_type' => 'Cash',
                'credit_period' => 15
            ],
            [
                'line_name' => 'Shipping Line 2',
                'local_agent' => 'Local Agent 2',
                'owner' => 'Owner 2',
                'address' => '456 Ocean Road, City, Country',
                'contact_person_name' => 'Jane Smith',
                'tel' => '234-567-8901',
                'cell' => '876-543-2109',
                'fax' => '444-555-6666',
                'bank_details' => json_encode([
                    'account_number' => '654321',
                    'bank_name' => 'Bank B',
                    'swift_code' => 'BANKB456',
                ]),
                'payment_type' => 'Cheque',
                'credit_period' => 30
            ]
        ];

        foreach ($shippingLines as $shippingLine) {
            $shippingLine['company_id'] = $companyId;
            ShippingLine::create($shippingLine);
        }
    }
}
