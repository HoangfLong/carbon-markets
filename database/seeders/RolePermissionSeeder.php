<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Permissions
        $permissions = [
            'view projects',
            'create projects',
            'edit projects',
            'delete projects',
            'buy credits',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        //Create role and assign A permisson
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo(['view projects','buy credits']);
    }
}
