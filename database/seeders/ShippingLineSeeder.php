<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ShippingLine;
use Illuminate\Support\Arr;
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
                'owner' => 'Owner 1',
                'contact_person_name' => 'John Doe',
                'tel' => '123-456-7890',
                'cell' => '987-654-3210',
                'fax' => '111-222-3333',
                'agents' => [
                    [
                        'agent_id' => 1,
                        'payment_type' => 'Cash',
                        'credit_type' => 'prepaid',
                    ],
                    [
                        'agent_id' => 2,
                        'payment_type' => 'Cheque',
                        'credit_type' => 'postpaid',
                    ]
                ]
            ],
            [
                'line_name' => 'Shipping Line 2',
                'owner' => 'Owner 2',
                'contact_person_name' => 'Jane Smith',
                'tel' => '234-567-8901',
                'cell' => '876-543-2109',
                'fax' => '444-555-6666',
                'agents' => [
                    [
                        'agent_id' => 1,
                        'payment_type' => 'Cash',
                        'credit_type' => 'prepaid',
                    ]
                ]
            ]
        ];

        foreach ($shippingLines as $shippingLineData) {
            $shippingLineData['company_id'] = $companyId;
            
            $shippingLine = ShippingLine::create(Arr::except($shippingLineData, ['agents']));

            // Attach agents to the shipping line with pivot data
            foreach ($shippingLineData['agents'] as $agentData) {
                $shippingLine->agents()->attach($agentData['agent_id'], [
                    'payment_type' => $agentData['payment_type'],
                    'credit_type' => $agentData['credit_type']
                ]);
            }
        }
    }
}
