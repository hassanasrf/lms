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
        $this->assignPermissionsToRoles();
    }

    /**
     * Create roles.
     */
    private function createRoles(): void
    {
        Role::create(['name' => 'super-admin', 'guard_name' => 'api']);
        // Role::create(['name' => 'client-admin', 'guard_name' => 'api']);
    }

    /**
     * Assign permissions to roles.
     */
    private function assignPermissionsToRoles(): void
    {
        $admin = Role::findByName('super-admin');
        $admin->givePermissionTo(Permission::all());

        // $client = Role::findByName('client-admin');
        // $permissions = [
        //     //
        // ];
        // $client->givePermissionTo($permissions);
    }
}
