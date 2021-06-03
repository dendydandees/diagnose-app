<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create role
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $expert = Role::updateOrCreate(['name' => 'expert']);
        $user = Role::updateOrCreate(['name' => 'user']);

        // create permissions
        Permission::updateOrCreate(['name' => 'experts.*']);
        Permission::updateOrCreate(['name' => 'articles.*']);
        Permission::updateOrCreate(['name' => 'articles.view']);
        Permission::updateOrCreate(['name' => 'symptoms.*']);
        Permission::updateOrCreate(['name' => 'symptoms.view']);
        Permission::updateOrCreate(['name' => 'diseases.*']);
        Permission::updateOrCreate(['name' => 'diseases.view']);

        // assign created permissions

        $admin->givePermissionTo(Permission::all());
        $expert->givePermissionTo(['articles.*']);
        $expert->givePermissionTo(['symptoms.*']);
        $expert->givePermissionTo(['diseases.*']);
        $user->givePermissionTo(['articles.view']);
        $user->givePermissionTo(['symptoms.view']);
        $expert->givePermissionTo(['diseases.view']);
    }
}
