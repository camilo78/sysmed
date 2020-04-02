<?php

use Illuminate\Database\Seeder;
use App\User;
use Caffeinated\Shinobi\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Soporte Informático',
            'email' => 'camilo.alvarado0501@gmail.com',
            'address' => 'Avenidad Manuel Bonilla Casa #36, La Ceiba, Atlantida, Honduras',
            'phone' => '96645637',
            'date' => '24-06-1978',
            'password' => bcrypt('milogaqw'),
        ]);

        factory(App\User::class, 20)->create();

        Role::create([
            'name' => 'Administrador',
            'slug' => 'admin',
            'description' => 'Usuario con todos los permisos',
            'special' => 'all-access',
        ]);
        Role::create([
            'name' => 'Médico',
            'slug' => 'medic',
            'description' => 'Usuario medico del sistema',

        ]);

        Role::create([
            'name' => 'Asistente',
            'slug' => 'assistant',
            'description' => 'Asistente del médico',

        ]);
    }
}
