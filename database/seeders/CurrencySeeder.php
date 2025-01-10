<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ['name' => 'Pak Rupees', 'code' => 'PKR'],
            ['name' => 'US Dollar', 'code' => 'USD'],
            ['name' => 'AE Dirham', 'code' => 'AED'],
            ['name' => 'Saudi Riyal', 'code' => 'SAR'],
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}
