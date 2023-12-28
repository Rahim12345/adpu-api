<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use App\Models\User;
use App\Models\UserRoles;
use App\Traits\Searcher;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
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

        $searchColumns = ['name','last_name'];
        $users = $this->searching(User::class,[],[],$searchColumns,['*'],$where,[],[['name','asc']]);
        $table_header = __('menu.users');
        $create_url = route('users.create');
        $create_route_name = 'users.create';

        return view('back.pages.users.index',compact('users','table_header','create_url','create_route_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('back.pages.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        UserRoles::create([
           'user_id' => $user->id,
           'role_id' => $request->role_id
        ]);

        $role_permissions = RolePermission::where('role_id', $request->role_id)->get();

        foreach ($role_permissions as $role_permission)
        {
            Permission::create([
                'user_id'=>$user->id,
                'route_name'=>$role_permission->route_name
            ]);
        }

        toastr()->success(__('static.data_added_successfully'),__('static.super'));

        return redirect()->route('users.edit',$user->id);
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
     * @param int $id
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(int $id)
    {
        $user = User::where('id',$id)->where('deleted',0)->firstOrFail();
        $roles = Role::all();

        return view('back.pages.users.edit',[
            'user'=>$user,
            'roles'=>$roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateUserRequest $request
     * @param int $id
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        $user = User::where('id',$id)->where('deleted',0)->firstOrFail();

        $user->update([
            'name'=>$request->name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);

        UserRoles::where('user_id',$user->id)->update([
            'role_id' => $request->role_id
        ]);

        toastr()->success(__('static.data_updated_successfully'),__('static.super'));

        return redirect()->route('users.edit',$user->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::whereId($id)->firstOrFail();
        if ($user->id == auth()->id())
        {
            toastr()->warning('Siz öz hesabınızı silə bilməzsiniz!','Diqqət');
            return redirect()->back();
        }

        $deletedStatus = $user->deleted;
        $user->update([
            'deleted'=>$deletedStatus == 1 ? 0 : 1
        ]);

        toastr()->success($deletedStatus == 0 ? __('static.data_deleted_successfully') : __('static.data_removed_from_deleted'), __('static.super'));

        return redirect()->route('users.index');
    }

    public function isBlocked(Request $request)
    {
        $this->validate($request,[
            'id'=>'required|exists:users,id',
            'checked'=>['required',Rule::in([0,1])]
        ],[],[
            'id'=>__('static.user'),
            'checked'=>__('static.chosen')
        ]);

        if (auth()->id() == $request->id)
        {
            return response()->json([
                'errors'=>[
                    'message'=>'Özünüzü blok edə bilməzsiniz!'
                ]
            ],422);
        }

        $user = User::where('id',$request->id)->where('deleted',0)->firstOrFail();
        $user->update([
           'blocked'=>$request->checked
        ]);

        return response()->json([
            'message'=>$request->checked == 1 ? __('static.yes') : __('static.no')
        ],200);
    }
}
