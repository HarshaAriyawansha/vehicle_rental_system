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
        Permission::create(['name' => 'view_role','module_name' => 'Role']);
        Permission::create(['name' => 'create_role','module_name' => 'Role']);
        Permission::create(['name' => 'update_role','module_name' => 'Role']);
        Permission::create(['name' => 'delete_role','module_name' => 'Role']);

        Permission::create(['name' => 'view_permission','module_name' => 'Permission']);
        Permission::create(['name' => 'create_permission','module_name' => 'Permission']);
        Permission::create(['name' => 'update_permission','module_name' => 'Permission']);
        Permission::create(['name' => 'delete_permission','module_name' => 'Permission']);

        Permission::create(['name' => 'view_user','module_name' => 'User']);
        Permission::create(['name' => 'create_user','module_name' => 'User']);
        Permission::create(['name' => 'update_user','module_name' => 'User']);
        Permission::create(['name' => 'delete_user','module_name' => 'User']);


        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff']);
        $userRole = Role::create(['name' => 'user']);

        // Lets give all permission to super-admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);

        // Let's give few permissions to admin role.
        $adminRole->givePermissionTo(['create_role', 'view_role', 'update_role']);
        $adminRole->givePermissionTo(['create_permission', 'view_permission', 'update_permission']);
        $adminRole->givePermissionTo(['create_user', 'view_user', 'update_user']);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
                    'email' => 'superadmin@gmail.com',
                ], [
                    'name' => 'Super Admin',
                    'email' => 'superadmin@gmail.com',
                    'password' => Hash::make ('admin123'),
                ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
                            'email' => 'admin@gmail.com'
                        ], [
                            'name' => 'Admin',
                            'email' => 'admin@gmail.com',
                            'password' => Hash::make ('admin123'),
                        ]);

        $adminUser->assignRole($adminRole);


        $staffUser = User::firstOrCreate([
                            'email' => 'staff@gmail.com',
                        ], [
                            'name' => 'Staff',
                            'email' => 'staff@gmail.com',
                            'password' => Hash::make('12345678'),
                        ]);

        $staffUser->assignRole($staffRole);
    }
}
