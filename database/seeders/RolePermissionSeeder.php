<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'manage statistics',
            'manage products',
            'manage principles',
            'manage testimonials',
            'manage clients',
            'manage teams',
            'manage abouts',
            'manage appointments',
            'manage hero sections',
            'manage shop items',
            'manage transactions'
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate(
                [
                  'name' => $permission  
                ]
                );
        }

        $designManagerRole = Role::firstOrCreate([
            'name' => 'designer_manager'
        ]);
        $designManagerPermissions = [
            'manage products',
            'manage principles',
            'manage testimonials'
        ];
        $designManagerRole->syncPermissions($designManagerPermissions);


        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $superAdminRole->syncPermissions($permissions);

        $user = User::create([
            'name' => 'Wiskulcomp',
            'email' => 'super@admin.com',
            'password' => bcrypt('123123123')
        ]);

        $user->assignRole($superAdminRole);


    }
}
