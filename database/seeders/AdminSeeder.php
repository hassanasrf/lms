<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use App\Models\Client;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'id' => 1,
            'name' => 'Admin',
            'email' => config('settings.admin.email', 'admin@admin.com'),
            'password' => config('settings.admin.password'),
            'is_active' => true,
        ];

        // Create super admin user
        $superAdmin = Admin::create($data);
        $superAdmin->assignRole('super-admin');

        $userdata = [
            'id' => 1,
            'name' => 'User',
            'email' => config('settings.admin.email', 'admin@admin.com'),
            'password' => config('settings.admin.password'),
            'is_active' => true,
        ];

        $user = Client::create($userdata);
        $user->assignRole('client-admin');
    }
}
