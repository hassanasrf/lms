<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CustomerType;
use App\Models\Company;

class CustomerTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $companyId = Company::first()->id ?? 1;

        $types = [
            ['name' => 'Consignee / Importer'],
            ['name' => 'Shipper / Exporter'],
            ['name' => 'Buyer'],
            ['name' => 'Seller'],
            ['name' => 'Trading'],
            ['name' => 'Clearing Agent'],
            ['name' => 'Transporter'],
            ['name' => 'Empty Depot'],
            ['name' => 'NVOCC'],
            ['name' => 'Shipping Agency'],
            ['name' => 'Forwarder'],
            ['name' => 'Warehouse'],
            ['name' => 'Notifier'],
        ];

        foreach ($types as $type) {
            // $type['company_id'] = $companyId;
            CustomerType::create($type);
        }
    }
}
