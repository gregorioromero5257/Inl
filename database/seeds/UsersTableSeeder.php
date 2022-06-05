<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'INL user',
                'username' => 'inluser',
                'domain' => '@state.gov',
                'email' => 'inluser@state.gov',
                'password' => bcrypt('password'),
                'type' => 'inl',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Directorc230',
                'username' => 'director',
                'domain' => '@c-230.com',
                'email' => 'director@c-230.com',
                'password' => bcrypt('password'),
                'type' => 'director',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'DirectorFortis',
                'username' => 'fortisdirector',
                'domain' => '@c-230.com',
                'email' => 'fortisdirector@c-230.com',
                'password' => bcrypt('password'),
                'type' => 'fortis_director',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Coordinador',
                'username' => 'coordinator',
                'domain' => '@c-230.com',
                'email' => 'coordinator@c-230.com',
                'password' => bcrypt('password'),
                'type' => 'coordinator',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Analista',
                'username' => 'analyst',
                'domain' => '@c-230.com',
                'email' => 'analyst@c-230.com',
                'password' => bcrypt('password'),
                'type' => 'analyst',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Gabriel Iván de la Garza Santos',
                'username' => 'ivandelagarza',
                'domain' => '@fortisconsultores.com.mx',
                'email' => 'ivandelagarza@fortisconsultores.com.mx',
                'password' => bcrypt('12345678'),
                'type' => 'fortis_director',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Roberto José Reyes Gallareta',
                'username' => 'roberto.reyes',
                'domain' => '@fortisconsultores.com.mx',
                'email' => 'roberto.reyes@fortisconsultores.com.mx',
                'password' => bcrypt('12345678'),
                'type' => 'coordinator',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Rodrigo Jiménez Galicia',
                'username' => 'rodrigo.jimenez',
                'domain' => '@fortisconsultores.com.mx',
                'email' => 'rodrigo.jimenez@fortisconsultores.com.mx',
                'password' => bcrypt('12345678'),
                'type' => 'coordinator',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Santiago Rosas',
                'username' => 'srosas',
                'domain' => '@c-230.com',
                'email' => 'srosas@c-230.com',
                'password' => bcrypt('12345678'),
                'type' => 'coordinator',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Itzel Guadalupe García Vázquez',
                'username' => 'Itzel.garciav',
                'domain' => '@c-230.com',
                'email' => 'Itzel.garciav@c-230.com',
                'password' => bcrypt('12345678'),
                'type' => 'analyst',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => '	Arturo Emmanuel Martínez Rodríguez',
                'username' => 'arturo.martinez',
                'domain' => '@fortisconsultores.com.mx',
                'email' => 'arturo.martinez@fortisconsultores.com.mx',
                'password' => bcrypt('12345678'),
                'type' => 'analyst',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'name' => '	CamachoMJ',
                'username' => 'CamachoMJ',
                'domain' => '@state.gov',
                'email' => 'CamachoMJ@state.gov',
                'password' => bcrypt('12345678'),
                'type' => 'inl',
                'is_active' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('users')->insert($users);
    }
}
