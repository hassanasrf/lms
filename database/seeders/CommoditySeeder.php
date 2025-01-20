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
                'name' => 'Electronics',
                'hs_code' => '8501.10',
                'dangerous_cargo' => 0,
                'undg_code' => null,
                'dg_class' => null,
                'dg_chapter' => null,
                'cargo_value' => 5000.00,
                'currency_id' => DB::table('currencies')->where('code', 'USD')->value('id'),
                'packing_id' => DB::table('packages')->where('name', 'Bags')->value('id'),
                'landing_charges_percentage' => 1.00,
                'landing_charges_type' => 'Percentage',
                'insurance_percentage' => 2.00,
                'insurance_type' => 'Value',
                'custom_duty_percentage' => 5.00,
                'custom_duty_type' => 'Multiply',
                'sales_tax_percentage' => 18.00,
                'sales_tax_type' => 'Percentage',
                'vat_percentage' => 3.00,
                'vat_type' => 'Percentage',
                'additional_custom_duty_percentage' => 2.00,
                'additional_custom_duty_type' => 'Value',
                'regulatory_duty_percentage' => 1.00,
                'regulatory_duty_type' => 'Percentage',
                'additional_income_tax_percentage' => 2.00,
                'additional_income_tax_type' => 'Multiply',
                'excise_duty_percentage' => 1.24,
                'excise_duty_type' => 'Percentage',
                'stamp_duty_value' => 1000.00,
                'stamp_duty_type' => 'Value',
                'export_value_per_kg' => 10.00,
                'export_currency' => 'USD',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
