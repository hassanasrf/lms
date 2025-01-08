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
            RoleSeeder::class,
            UserSeeder::class,
            CountrySeeder::class,
            CitySeeder::class,
            TypeSeeder::class,
            CompanySeeder::class,
            AdminSeeder::class,
            TaggingPointSeeder::class,
        ]);
    }
}
