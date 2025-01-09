<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = [
            'id' => 1,
            'company_id' => 1,
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => config('settings.admin.password'),
            'is_active' => true,
        ];

        // Create super admin user
        $superAdmin = User::create($admin);

        // Check if the 'super-admin' role exists
        $role = Role::where('company_id', $admin['company_id'])->first();

        // Assign the 'super-admin' role to the user
        $superAdmin->assignRole($role->name);;
    }
}
