<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Models\RouteList;
use App\Models\User;
use App\Traits\RouteNamePreparing;

class PermissionController extends Controller
{
    use RouteNamePreparing;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $current_user = User::whereId(request()->segment(3))->firstOrFail();
        $routes = RouteList::orderBy('order_no','asc')->get();
        $permissions = Permission::where('user_id',request()->segment(3))->pluck('route_name')->toArray();

        return view('back.pages.permissions.index',compact('current_user','routes','permissions'));
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
    public function store(StorePermissionRequest $request)
    {
        $this->permissionPreparing($request->checked, $request->route_name, $request->action, $request->user_id);

        return response()->json([
            'message' => __('static.data_updated_successfully')
        ], 200);
    }

    private function permissionPreparing($checked, $route_name, $action, $user_id)
    {
        $routes = $this->routeNamePreparing($action, $route_name);
        if ($checked == 'true')
        {
            foreach ($routes as $route)
            {
                Permission::updateOrCreate(
                    [
                        'user_id'   => $user_id,
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
                Permission::where('user_id', $user_id)->where('route_name', $route)->delete();
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        //
    }
}
