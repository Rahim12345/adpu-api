<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Http\Requests\StoreRolePermissionRequest;
use App\Http\Requests\UpdateRolePermissionRequest;
use App\Models\RouteList;
use App\Traits\RouteNamePreparing;

class RolePermissionController extends Controller
{
    use RouteNamePreparing;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_role = Role::whereId(request()->segment(3))->firstOrFail();
        $routes = RouteList::orderBy('order_no','asc')->get();
        $role_permissions = RolePermission::where('role_id',request()->segment(3))->pluck('route_name')->toArray();

        return view('back.pages.role-permissions.index',compact('current_role','routes','role_permissions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRolePermissionRequest $request)
    {
        $this->rolePermissionPreparing($request->checked, $request->route_name, $request->action, $request->role_id);

        return response()->json([
            'message' => __('static.data_updated_successfully')
        ], 200);
    }

    private function rolePermissionPreparing($checked, $route_name, $action, $role_id)
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

    /**
     * Display the specified resource.
     */
    public function show(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RolePermission $rolePermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolePermissionRequest $request, RolePermission $rolePermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolePermission $rolePermission)
    {
        //
    }
}
