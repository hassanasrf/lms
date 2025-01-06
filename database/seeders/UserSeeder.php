<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'id' => 1,
            'name' => 'Admin',
            'email' => config('settings.admin.email', 'admin@admin.com'),
            'password' => config('settings.admin.password'),
            'is_active' => true,
        ];

        // Create super admin user
        $superAdmin = User::create($admin);
        $superAdmin->assignRole('super-admin');

        $client = [
            'id' => 2,
            'name' => 'Client',
            'email' => 'client@admin.com',
            'password' => config('settings.admin.password'),
            'is_active' => true,
        ];

        // Create client admin user
        $clientAdmin = User::create($client);
        $clientAdmin->assignRole('client-admin');

    }
}
