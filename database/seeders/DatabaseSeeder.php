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
            TypeSeeder::class,
            CompanySeeder::class,
            TaggingPointSeeder::class,
            AdminSeeder::class,
            UserSeeder::class,
            CurrencySeeder::class,
            CommoditySeeder::class,
            ShippingLineSeeder::class,
            AgentSeeder::class,
        ]);
    }
}
