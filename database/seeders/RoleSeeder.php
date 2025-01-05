<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createRoles();
        // $this->assignPermissionsToRoles();
    }

    /**
     * Create roles.
     */
    private function createRoles(): void
    {
        Role::updateOrCreate(['name' => 'super-admin', 'guard_name' => 'admin']);
        Role::updateOrCreate(['name' => 'client-admin', 'guard_name' => 'client']); // company admin
    }

    /**
     * Assign permissions to roles.
     */
    private function assignPermissionsToRoles(): void
    {
        $developerRole = Role::findByName('client-admin');
        $developerPermissions = [
            'permission-create'
        ];

        $developerRole->givePermissionTo($developerPermissions);
    }
}
