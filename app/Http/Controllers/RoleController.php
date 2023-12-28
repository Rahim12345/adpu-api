<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Role;
use App\Traits\Searcher;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    use Searcher;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->validate(request(), [
            'count' => 'nullable|integer|min:1|max:500',
            'search' => 'nullable|max:25',
            'general_actions'=>['nullable',Rule::in(['deleted','undeleted'])]
        ]);

        if (request('general_actions') == null || request('general_actions') == 'undeleted')
        {
            $where = [
                [
                    'deleted',
                    '=',
                    0
                ]
            ];
        }
        else
        {
            $where = [
                [
                    'deleted',
                    '=',
                    1
                ]
            ];
        }



        $searchColumns = ['name'];
        $roles = $this->searching(Role::class,[],[],$searchColumns,['*'],$where,[],[['name','asc']]);
        $table_header = __('menu.roles');
        $create_url = route('roles.create');
        $create_route_name = 'roles.create';

        return view('back.pages.roles.index',compact('roles','table_header','create_url','create_route_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $user = Role::create([
            'name'=>$request->name,
        ]);

        toastr()->success(__('static.data_added_successfully'),__('static.super'));

        return redirect()->route('roles.edit',$user->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $role = Role::where('id',$id)->where('deleted',0)->firstOrFail();
        return view('back.pages.roles.edit',[
            'role'=>$role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, int $id)
    {
        $role = Role::where('id',$id)->where('deleted',0)->firstOrFail();

        $role->update([
            'name'=>$request->name,
        ]);

        toastr()->success(__('static.data_updated_successfully'),__('static.super'));

        return redirect()->route('roles.edit',$role->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $role = Role::where('id',$id)->firstOrFail();
        $deletedStatus = $role->deleted;
        $role->update([
            'deleted'=>$deletedStatus == 1 ? 0 : 1
        ]);

        toastr()->success($deletedStatus == 0 ? __('static.data_deleted_successfully') : __('static.data_removed_from_deleted'), __('static.super'));

        return redirect()->route('roles.index');
    }
}
