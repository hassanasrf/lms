<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CommoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('commodities')->insert([
            [
                'company_id' => 1,
                'currency_id' => 1,
                'packing_id' => 1,
                'name' => 'Electronics',
                'type' => 'Import',
                'hs_code' => '8542.21.00',
                'dangerous_cargo' => false,
                'undg_code' => 'UN1234',
                'dg_class' => '9',
                'dg_chapter' => '36',
                'cargo_value' => '5000',
                'landing_charges' => '200',
                'landing_charges_type' => 'Percentage',
                'insurance' => '300',
                'insurance_type' => 'Percentage',
                'custom_duty' => '10',
                'custom_duty_type' => 'Percentage',
                'sales_tax' => '15',
                'sales_tax_type' => 'Percentage',
                'vat' => '12',
                'vat_type' => 'Percentage',
                'additional_custom_duty' => '5',
                'additional_custom_duty_type' => 'Percentage',
                'regulatory_duty' => '7',
                'regulatory_duty_type' => 'Percentage',
                'additional_income_tax' => '3',
                'additional_income_tax_type' => 'Percentage',
                'excise_duty' => '2',
                'excise_duty_type' => 'Percentage',
                'stamp_duty_value' => 50.00,
                'stamp_duty_type' => 'Fixed',
                'net_total' => '7500',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
