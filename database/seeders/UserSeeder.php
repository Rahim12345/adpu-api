<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserRoles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Rahim',
                'last_name' => 'Süleymanov',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(12345678),
                'role_id'=>1,
            ],

            [
                'name' => 'Fərid',
                'last_name' => 'Mehdibəyli',
                'email' => 'ferid@gmail.com',
                'password' => bcrypt(12345678),
                'role_id'=>2,
            ],
        ];

        foreach ($users as $user)
        {
            $created_user = User::create([
                'name' => $user['name'],
                'last_name' => $user['last_name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            UserRoles::create([
                'user_id' => $created_user->id,
                'role_id' => $user['role_id']
            ]);

            $role_permissions = RolePermission::where('role_id', $user['role_id'])->get();

            foreach ($role_permissions as $role_permission)
            {
                Permission::create([
                    'user_id'=>$created_user->id,
                    'route_name'=>$role_permission->route_name
                ]);
            }
        }
    }
}
