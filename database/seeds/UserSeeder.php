<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Patient;
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
            'slug' => 'assistants',
            'description' => 'Asistente del médico',

        ]);

        $user = User::create([
            'name' => 'Soporte Informático',
            'email' => 'camilo.alvarado0501@gmail.com',
            'address' => 'Avenidad Manuel Bonilla Casa #36, La Ceiba, Atlantida, Honduras',
            'phone' => '96645637',
            'date' => '24-06-1978',
            'password' => bcrypt('milogaqw'),
        ]);
        $user->roles()->sync(1);

        factory(App\User::class, 20)->create();
        factory(App\Patient::class, 50)->create();
    }
}
