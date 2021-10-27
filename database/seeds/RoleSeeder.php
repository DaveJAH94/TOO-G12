<?php

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'Admin']);
        $role2 = Role::create(['name'=>'Usuario']);

        //=>syncRoles([$role1]); puede tener mas de un rol, por el momento solo pongo estos
        Permission::create(['name'=>'GestionarUsuarios'])->syncRoles([$role1]);
        Permission::create(['name'=>'GestionarRoles'])->syncRoles([$role1]);
        Permission::create(['name'=>'VerHorarios'])->syncRoles([$role1,$role2]);
        
        //fantan mas roles segun se tengan en el diagrama de la
        //base de datos despues de tener el diagrama de clases


        //metodos para asignar los roles

        
    }
}
