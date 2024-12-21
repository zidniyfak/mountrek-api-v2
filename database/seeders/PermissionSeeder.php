<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // //
        // $role_admin = Role::updateOrCreate(
        //     [
        //         'name' => 'admin'
        //     ],
        //     ['name' => 'admin']
        // );
        // $role_cust = Role::updateOrCreate(
        //     [
        //         'name' => 'cust'
        //     ],
        //     ['name' => 'cust']
        // );
        // $permission = Permission::updateOrCreate(
        //     [
        //         'name' => 'view_dashboard',
        //     ],
        //     [
        //         'name' => 'view_dashboard',
        //     ]
        // );
        // $permission2 = Permission::updateOrCreate(
        //     [
        //         'name' => 'view_mountains',
        //     ],
        //     [
        //         'name' => 'view_mountains',
        //     ]
        // );

        // $role_admin->givePermissionTo($permission);
        // $role_cust->givePermissionTo($permission2);

        // $usr = User::find(1);
        // $usr2 = User::find(2);

        // $usr->assignRole('admin');
        // $usr2->assignRole('cust');
        $role_admin = Role::updateOrCreate(['name' => 'admin']);
        $role_cust = Role::updateOrCreate(['name' => 'cust']);

        $permission_admin = Permission::updateOrCreate(['name' => 'access_admin']);
        // $permission_mountains = Permission::updateOrCreate(['name' => 'view_mountains']);

        $role_admin->givePermissionTo($permission_admin);
        // $role_cust->givePermissionTo($permission_mountains);

        $user_admin = User::find(1);
        $user_cust = User::find(2);

        $user_admin->assignRole('admin');
        $user_cust->assignRole('cust');
    }
}
