<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // Create Permissions
        Permission::create(['name' => 'view role']);
        Permission::create(['name' => 'create role']);
        Permission::create(['name' => 'update role']);
        Permission::create(['name' => 'delete role']);

        Permission::create(['name' => 'view permission']);
        Permission::create(['name' => 'create permission']);
        Permission::create(['name' => 'update permission']);
        Permission::create(['name' => 'delete permission']);

        Permission::create(['name' => 'view user']);
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        Permission::create(['name' => 'view jenis-status']);
        Permission::create(['name' => 'create jenis-status']);
        Permission::create(['name' => 'update jenis-status']);
        Permission::create(['name' => 'delete jenis-status']);


        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $pendetaRole = Role::create(['name' => 'pendeta']);
        $penatuaLingkunganRole = Role::create(['name' => 'penatua lingkungan']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create role', 'view role', 'update role']);
        $adminRole->givePermissionTo(['create permission', 'view permission']);
        $adminRole->givePermissionTo(['create user', 'view user', 'update user']);
        $adminRole->givePermissionTo(['create jenis-status', 'view jenis-status', 'update jenis-status']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
            'email' => 'superadmin@gmail.com',
        ], [
            'username' => 'SuperAdmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'username' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $adminUser->assignRole($adminRole);


        $pendetaUser = User::firstOrCreate([
            'email' => 'pendeta@gmail.com',
        ], [
            'username' => 'Pendeta',
            'email' => 'pendeta@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $pendetaUser->assignRole($pendetaRole);

        $penatuaLingkunganUser = User::firstOrCreate([
            'email' => 'penatuaLingkungan@gmail.com',
        ], [
            'username' => 'PenatuaLingkungan',
            'email' => 'penatuaLingkungan@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $penatuaLingkunganUser->assignRole($penatuaLingkunganRole);
    }
}
