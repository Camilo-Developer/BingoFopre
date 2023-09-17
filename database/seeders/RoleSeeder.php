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
        $role4 = Role::create(['name' => 'Vendedor']);


        //Permiso admin Dashboard
        Permission::create([
            'name' => 'admin.dashboard',
            'description'=> 'Ver panel administrativo Administrador'
        ])->syncRoles([$role1, $role2]);

        //Permiso User Dashboard
        Permission::create([
            'name' => 'dashboard',
            'description'=> 'Ver panel administrativo Estudiantes y Vendedores'
        ])->syncRoles([$role1, $role2,$role3,$role4]);

        //Permisos admin Estados
        Permission::create([
            'name' => 'admin.states.index',
            'description'=> 'Lista de Estados Disponibles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.create',
            'description'=> 'Creacion de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.edit',
            'description'=> 'Edicion de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.destroy',
            'description'=> 'Eliminar Estados'
        ])->syncRoles([$role1]);

        //Permisos admin Configuracion Template
        Permission::create([
            'name' => 'admin.templateconfigs.index',
            'description'=> 'Configuracion Template'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.templateconfigs.edit',
            'description'=> 'Edición de la configuración template'
        ])->syncRoles([$role1]);

        //Permisos admin Noticias principales
        Permission::create([
            'name' => 'admin.cardmains.index',
            'description'=> 'Lista de noticias principales'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.cardmains.create',
            'description'=> 'Creacion de noticias principales'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.cardmains.edit',
            'description'=> 'Edición de las noticias principales'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.cardmains.destroy',
            'description'=> 'Eliminación de noticias principales'
        ])->syncRoles([$role1]);

        //Permisos admin Patrocinadores
        Permission::create([
            'name' => 'admin.sponsors.index',
            'description'=> 'Lista de patrocinadores'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.sponsors.create',
            'description'=> 'Creación de patrocinadores'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.sponsors.edit',
            'description'=> 'Edición de patrocinadores'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.sponsors.destroy',
            'description'=> 'Eliminación de patrocinadores'
        ])->syncRoles([$role1]);

        //Permisos admin Instrucciones
        Permission::create([
            'name' => 'admin.instructions.index',
            'description'=> 'Lista de instrucciones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.instructions.create',
            'description'=> 'Creación de instrucciones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.instructions.edit',
            'description'=> 'Edición de instrucciones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.instructions.destroy',
            'description'=> 'Eliminación de instrucciones'
        ])->syncRoles([$role1]);

        //Permisos admin Dinamicas del juego
        Permission::create([
            'name' => 'admin.dynamicgames.index',
            'description'=> 'Lista de dinamicas del juego'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.dynamicgames.create',
            'description'=> 'Creación de dinamicas del juego'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.dynamicgames.edit',
            'description'=> 'Edición de dinamicas del juego'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.dynamicgames.destroy',
            'description'=> 'Eliminación de dinamicas del juego'
        ])->syncRoles([$role1]);

        //Permisos admin Premios
        Permission::create([
            'name' => 'admin.prizes.index',
            'description'=> 'Lista de premios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.prizes.create',
            'description'=> 'Creación de premios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.prizes.edit',
            'description'=> 'Edición de premios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.prizes.destroy',
            'description'=> 'Eliminación de premios'
        ])->syncRoles([$role1]);

        //Permisos admin roles
        Permission::create([
            'name' => 'admin.roles.index',
            'description'=> 'Lista de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.create',
            'description'=> 'Creación de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.edit',
            'description'=> 'Edición de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.destroy',
            'description'=> 'Eliminación de roles'
        ])->syncRoles([$role1]);


        //Permisos admin Creacion de cartones
        Permission::create([
            'name' => 'admin.cartones.createForm',
            'description'=> 'Creación de cartones'
        ])->syncRoles([$role1]);



    }
}
