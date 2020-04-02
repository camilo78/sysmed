<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::Create([
            'name' => 'Ver detalle de usuario',
            'slug' => 'users.show',
            'description' => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::Create([
            'name' => 'Navegar usuarios',
            'slug' => 'users.index',
            'description' => 'Ver detalle de cada usuario del sistema',
        ]);

        Permission::Create([
            'name' => 'Crear usuarios',
            'slug' => 'users.create',
            'description' => 'crear usuarios del sistema',
        ]);

        Permission::Create([
            'name' => 'Edición usuarios',
            'slug' => 'users.edit',
            'description' => 'Editar datos de un usuario',
        ]);

        Permission::Create([
            'name' => 'Eliminar usuarios',
            'slug' => 'users.destroy',
            'description' => 'Eliminar usuarios del sistema',
        ]);

        //Roles

        Permission::Create([
            'name' => 'Ver detalle de Rol',
            'slug' => 'roles.show',
            'description' => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::Create([
            'name' => 'Navegar Roles',
            'slug' => 'roles.index',
            'description' => 'Ver detalle de cada rol del sistema',
        ]);

        Permission::Create([
            'name' => 'Crear Roles',
            'slug' => 'roles.create',
            'description' => 'crear roles del sistema',
        ]);

        Permission::Create([
            'name' => 'Edición Roles',
            'slug' => 'roles.edit',
            'description' => 'Editar datos de un rol',
        ]);

        Permission::Create([
            'name' => 'Eliminar Roles',
            'slug' => 'roles.destroy',
            'description' => 'Eliminar roles del sistema',
        ]);

        //settings
        Permission::Create([
            'name' => 'Ver detalle de configuraciones',
            'slug' => 'settings.show',
            'description' => 'Lista y navega todos las configuracines del sistema',
        ]);

        Permission::Create([
            'name' => 'Navegar configuraciones',
            'slug' => 'settings.index',
            'description' => 'Ver detalle de cada configuración del sistema',
        ]);

        Permission::Create([
            'name' => 'Crear configuraciones',
            'slug' => 'settings.create',
            'description' => 'crear configuraciones del sistema',
        ]);
        
        Permission::Create([
            'name' => 'Edición configuraciones',
            'slug' => 'settings.edit',
            'description' => 'Editar datos de configuraciones',
        ]);

        Permission::Create([
            'name' => 'Eliminar configuraciones',
            'slug' => 'settings.destroy',
            'description' => 'Eliminar configuraciones del sistema',
        ]);


        //Patients

        Permission::Create([
            'name' => 'Ver detalle de paciente',
            'slug' => 'patients.show',
            'description' => 'Lista y navega todos los pacientes del sistema',
        ]);

        Permission::Create([
            'name' => 'Navegar Pacientes',
            'slug' => 'patients.index',
            'description' => 'Ver detalle de cada paciente del sistema',
        ]);

        Permission::Create([
            'name' => 'Crear Pacientes',
            'slug' => 'patients.create',
            'description' => 'crear pacientes del sistema',
        ]);

        Permission::Create([
            'name' => 'Edición Pacientes',
            'slug' => 'patients.edit',
            'description' => 'Editar datos de un paciente',
        ]);

        Permission::Create([
            'name' => 'Eliminar Pacientes',
            'slug' => 'patients.destroy',
            'description' => 'Eliminar pacientes del sistema',
        ]);


    }
}
