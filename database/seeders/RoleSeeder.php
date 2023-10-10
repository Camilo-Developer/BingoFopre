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
            'description'=> 'Ver panel administrativo ( Administrador y Sub-Administrador )'
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
            'description'=> 'Creación de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.edit',
            'description'=> 'Edición de Estados'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.states.destroy',
            'description'=> 'Eliminar Estados'
        ])->syncRoles([$role1]);


        //Permisos admin usuarios
        Permission::create([
            'name' => 'admin.users.index',
            'description'=> 'Lista de usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.create',
            'description'=> 'Creación de usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.edit',
            'description'=> 'Edición de usuarios'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.show',
            'description'=> 'Detalle del usuario'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.users.destroy',
            'description'=> 'Eliminación de usuarios'
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
            'description'=> 'Creación de noticias principales'
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
            'name' => 'admin.instructions.edit',
            'description'=> 'Edición de instrucciones'
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
            'description'=> 'Listado de roles'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.create',
            'description'=> 'Creación del rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.edit',
            'description'=> 'Edición del rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.show',
            'description'=> 'Detalle del rol'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.roles.destroy',
            'description'=> 'Eliminación del rol'
        ])->syncRoles([$role1]);



        //Permisos admin Creacion de cartones
        Permission::create([
            'name' => 'admin.cartones.createForm',
            'description'=> 'Listado y creación de cartones masivos'
        ])->syncRoles([$role1]);


        //Edicion de cartones
        Permission::create([
            'name' => 'admin.cartones.update',
            'description'=> 'Edición del cartón'
        ])->syncRoles([$role1]);
        //Detalles de cartones
        Permission::create([
            'name' => 'admin.cartones.show',
            'description'=> 'Detalle del cartón'
        ])->syncRoles([$role1]);
        //Creacion de qr masivos
        Permission::create([
            'name' => 'admin.cardboard.generadormasivoQR',
            'description'=> 'Creación masiva de codigos QR'
        ])->syncRoles([$role1]);


        //Añadir cartones al carrito
        Permission::create([
            'name' => 'addToCart',
            'description'=> 'Añadir cartones al carrito'
        ])->syncRoles([$role1,$role2,$role4]);

        //Finalizar compra de cartones
        Permission::create([
            'name' => 'admin.cartones.finishPurchase',
            'description'=> 'Finalizar comprar de cartones'
        ])->syncRoles([$role1,$role2,$role4]);

        //remover cartones del carrito
        Permission::create([
            'name' => 'admin.cartones.removeFromCart',
            'description'=> 'Eliminar carton del carrito'
        ])->syncRoles([$role1,$role2,$role4]);

        //Asigancion de grupo de cartones usuarios
        Permission::create([
            'name' => 'admin.users.asiginacionGrupos',
            'description'=> 'Asignación de grupo de cartones a un usuario'
        ])->syncRoles([$role1]);

        //Cambio del estado en grupo de cartones usuarios
        Permission::create([
            'name' => 'admin.users.cambioStateGruposCartones',
            'description'=> 'Cambiar el estado de los grupos de cartones en vista usuario'
        ])->syncRoles([$role1]);



        //Permisos admin Grupo de cartones
        Permission::create([
            'name' => 'admin.cartongroups.index',
            'description'=> 'Lista de grupos de cartones'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.cartongroups.create',
            'description'=> 'Creación de grupo de cartón'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.cartongroups.edit',
            'description'=> 'Edición del grupo del cartón'
        ])->syncRoles([$role1]);
        Permission::create([
            'name' => 'admin.cartongroups.destroy',
            'description'=> 'Eliminación del grupo de cartón'
        ])->syncRoles([$role1]);


        //Permisos para Usuarios

        //Infomacion administrativa Estudiante
        Permission::create([
            'name' => 'users.dashboard.admin.stundents',
            'description'=> 'Ver información administrativa estudiantes'
        ])->syncRoles([$role1,$role2,$role3]);
        //Infomacion administrativa Vendedor
        Permission::create([
            'name' => 'users.dashboard.admin.seller',
            'description'=> 'Ver información administrativa vendedores'
        ])->syncRoles([$role1,$role2,$role4]);

    }
}
