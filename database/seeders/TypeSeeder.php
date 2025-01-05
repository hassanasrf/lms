<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['name' => 'Consignee'],
            ['name' => 'Shipper'],
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
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
