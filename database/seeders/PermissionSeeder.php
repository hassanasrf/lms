<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'user-read', 'user-create', 'user-update', 'user-delete',
            'city-read', 'city-create', 'city-update', 'city-delete',
            'role-read', 'role-create', 'role-update', 'role-delete',
            'agent-read', 'agent-create', 'agent-update', 'agent-delete',
            'booking-read', 'booking-create', 'booking-update', 'booking-delete',
            'country-read', 'country-create', 'country-update', 'country-delete',
            'company-read', 'company-create', 'company-update', 'company-delete',
            'currency-read', 'currency-create', 'currency-update', 'currency-delete',
            'customer-read', 'customer-create', 'customer-update', 'customer-delete',
            'shipping-read', 'shipping-create', 'shipping-update', 'shipping-delete',
            'commodity-read', 'commodity-create', 'commodity-update', 'commodity-delete',
            'permission-read', 'permission-create', 'permission-update', 'permission-delete',
            'tagging-point-read', 'tagging-point-create', 'tagging-point-update', 'tagging-point-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(['name' => $permission]);
        }
    }
}
