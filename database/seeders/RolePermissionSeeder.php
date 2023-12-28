<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\RolePermission;
use App\Models\RouteList;
use App\Traits\RouteNamePreparing;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    use RouteNamePreparing;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = Role::all();
        $routes = RouteList::all();
        $actions = [
            'create',
            'index',
            'edit',
            'delete',
        ];

        foreach ($roles as $role)
        {
            foreach ($routes as $route)
            {
                foreach ($actions as $action)
                {
                    $this->rolePermissionPreparing('true' , $route->route_name, $action, $role->id);
                }
            }
        }
    }

    private function rolePermissionPreparing($checked, $route_name, $action, $role_id): void
    {
        $routes = $this->routeNamePreparing($action, $route_name);
        if ($checked == 'true')
        {
            foreach ($routes as $route)
            {
                RolePermission::updateOrCreate(
                    [
                        'role_id'   => $role_id,
                        'route_name'   => $route,
                    ],
                    [
                        'route_name'   => $route,
                    ]
                );
            }
        }
        else
        {
            foreach ($routes as $route)
            {
                RolePermission::where('role_id', $role_id)->where('route_name', $route)->delete();
            }
        }
    }
}
