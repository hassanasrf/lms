<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'name' => 'Admin',
            'email' => config('settings.admin.email', 'admin@admin.com'),
            'password' => config('settings.admin.password'),
            'is_active' => true,
        ];

        // Create super admin user
        $superAdmin = Admin::create($data);
        $superAdmin->assignRole('super-admin');
    }
}
