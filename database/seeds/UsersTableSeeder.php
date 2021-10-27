<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;
use Spatie\Permission\Models\Role;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('users')->delete();
        User::create(array(
            'dui' => '02222222-2',
            'nombre' => 'Marco Aurelio',
            'apellido' => 'Herrera Herrero',
            'nit' => '2222-251022-222-4',
            'fechaNacimiento' => '01/11/2007',
            'estado' => TRUE,
            'email' => 'emailPrueba@gmail.com',
            'password' => Hash::make('1234'),
            /* 'remember_token' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime       */
    ))->assignRole('Admin'); 
    User::create(array(
            'dui' => '02222222-3',
            'nombre' => 'Jairo Jeremias',
            'apellido' => 'Jacinto Jicama',
            'nit' => '2222-251022-222-5',
            'fechaNacimiento' => '01/11/2006',
            'estado' => TRUE,
            'email' => 'emailPrueba2@gmail.com',
            'password' => Hash::make('1234'),
            /* 'remember_token' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime       */
    ))->assignRole('Usuario');
    User::create(array(
            'dui' => '02222222-4',
            'nombre' => 'Frans Ferrita',
            'apellido' => 'Palacios Palasuelos',
            'nit' => '2222-251022-222-6',
            'fechaNacimiento' => '01/11/2001',
            'estado' => TRUE,
            'email' => 'emailPrueba3@gmail.com',
            'password' => Hash::make('12345'),
            /* 'remember_token' => null,
            'created_at' => new DateTime,
            'updated_at' => new DateTime       */
    ))->assignRole('Usuario');  
    }
}
