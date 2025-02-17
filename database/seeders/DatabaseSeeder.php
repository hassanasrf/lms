<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionSeeder::class,
            // RoleSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            ServiceTypeSeeder::class,
            CompanyTypeSeeder::class,
            CompanySeeder::class,
            CompanyCompanyTypeSeeder::class,
            CustomerTypeSeeder::class,
            TaggingPointSeeder::class,
            CurrencySeeder::class,
            BankSeeder::class,
            AgentSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            ShippingLineSeeder::class,
            CustomerSeeder::class,
            CustomerCustomerTypeSeeder::class,
            PackageSeeder::class,
            CommoditySeeder::class,
            VesselsTableSeeder::class,
            VoyagesTableSeeder::class,
            BookingSeeder::class,
        ]);
    }
}
