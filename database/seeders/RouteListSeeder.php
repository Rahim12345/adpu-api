<?php

namespace Database\Seeders;

use App\Models\RouteList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RouteListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            [
                'in_natural_language_name_az'=>'İstifadəçilər',
                'in_natural_language_name_en'=>'Users',
                'route_name'=>'users'
            ],
            [
                'in_natural_language_name_az'=>'Rollar',
                'in_natural_language_name_en'=>'Roles',
                'route_name'=>'roles'
            ],
            [
                'in_natural_language_name_az'=>'Rollara icazənin verilməsi',
                'in_natural_language_name_en'=>'Role permissions',
                'route_name'=>'role-permissions'
            ],
            [
                'in_natural_language_name_az'=>'İcazələr',
                'in_natural_language_name_en'=>'Permissions',
                'route_name'=>'permissions'
            ],


        ];

        foreach ($routes as $route)
        {
            RouteList::create([
                'in_natural_language_name_az'=>$route['in_natural_language_name_az'],
                'in_natural_language_name_en'=>$route['in_natural_language_name_en'],
                'route_name'=>$route['route_name'],
            ]);
        }
    }
}
