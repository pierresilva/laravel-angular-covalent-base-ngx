<?php

use App\User;
use Illuminate\Database\Seeder;

class AppFirstSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();

        try {
            $userSuperAdmin = \App\User::create([
                'name' => 'Super Administrador',
                'email' => 'super.admin@email.com',
                'password' => bcrypt('colombia1'),
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'accept_terms_conditions' => true,
                'email_verified_at' => now(),
            ]);

            $roleSuperAdmin = \App\UserRole::create([
                'name' => 'Super Administrador',
                'code' => 'super.admin'
            ]);

            $permissionSuperAdmin = \App\UserPermission::create([
                'name' => 'Permiso super admin',
                'code' => 'permission.super.admin'
            ]);

        } catch (Exception $exception) {
            echo $exception->getMessage();
            return;
        }

        try {

            $userAdmin = \App\User::create([
                'name' => 'Administrador',
                'email' => 'admin@email.com',
                'password' => bcrypt('colombia1'),
                'first_name' => 'Admin',
                'last_name' => 'Istrador',
                'accept_terms_conditions' => true,
                'email_verified_at' => now(),
            ]);

            $roleAdmin = \App\UserRole::create([
                'name' => 'Administrador',
                'code' => 'admin'
            ]);

            $permissionAdmin = \App\UserPermission::create([
                'name' => 'Permiso admin',
                'code' => 'permission.admin'
            ]);

        } catch (Exception $exception) {
            echo $exception->getMessage();
            return;
        }

        try {

            $userUser = \App\User::create([
                'name' => 'Usuario',
                'email' => 'user@email.com',
                'password' => bcrypt('colombia1'),
                'first_name' => 'Usuario',
                'last_name' => 'Prueba',
                'accept_terms_conditions' => true,
                'email_verified_at' => now(),
            ]);

            $roleUser = \App\UserRole::create([
                'name' => 'Usuario',
                'code' => 'user'
            ]);

            $permissionUser = \App\UserPermission::create([
                'name' => 'Permiso usuario',
                'code' => 'permission.user'
            ]);


        } catch (Exception $exception) {
            echo $exception->getMessage();
            return;
        }

        $userSuperAdmin->roles()->sync([
            $roleSuperAdmin->id,
            $roleAdmin->id,
            $roleUser->id,
        ]);

        $roleSuperAdmin->permissions()->sync([
            $permissionSuperAdmin->id,
            $permissionAdmin->id,
            $permissionUser->id,
        ]);

        $userAdmin->roles()->sync([
            $roleAdmin->id
        ]);

        $roleAdmin->permissions()->sync([
            $permissionAdmin->id,
        ]);

        $userUser->roles()->sync([
            $roleUser->id
        ]);

        $roleUser->permissions()->sync([
            $permissionUser->id,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
