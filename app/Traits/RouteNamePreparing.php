<?php

namespace App\Traits;

trait RouteNamePreparing
{
    public function routeNamePreparing($action, $route_name): array
    {
        $routes = [];
        if ($action == 'create')
        {
            $routes[] = $route_name.'.create';
            $routes[] = $route_name.'.store';
        }
        else if ($action == 'edit')
        {
            $routes[] = $route_name.'.edit';
            $routes[] = $route_name.'.update';
        }
        else if ($action == 'delete')
        {
            $routes[] = $route_name.'.destroy';
        }
        else
        {
            $routes[] = $route_name.'.index';
        }

        return $routes;
    }
}
