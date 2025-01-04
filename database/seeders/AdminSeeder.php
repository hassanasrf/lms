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
            'email' => config('settings.admin.email'),
            'password' => config('settings.admin.password'),
            'is_active' => true
        ];

        $model = new Admin();

        // Create super admin user
        $superAdmin = $model->updateOrCreate(['email' => $data['email']], $data);
        $superAdmin->assignRole('super-admin');
    }
}
