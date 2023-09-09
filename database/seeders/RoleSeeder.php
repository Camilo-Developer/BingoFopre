<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'Admin']);
        $role2 = Role::create(['name' => 'Sub-Admin']);
        $role3 = Role::create(['name' => 'Estudiante']);


        //Permiso admin Dashboard
        Permission::create([
            'name' => 'admin.dashboard',
            'description'=> 'Ver panel administrativo'
        ])->syncRoles([$role1, $role2,$role3]);


    }
}
