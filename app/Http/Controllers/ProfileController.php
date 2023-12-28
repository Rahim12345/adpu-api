<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateAccountRequest;
use App\Traits\FileUploader;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    use FileUploader;
    public function index()
    {
        return view('back.pages.profile.index');
    }

    public function profileStore(StoreProfileRequest $request)
    {
        $avatar = $this->fileUpdate(auth()->user()->avatar, $request->hasFile('avatar'), $request->avatar, 'images/profiles/');

        auth()->user()->update([
            'avatar' => $avatar,
        ]);

        return response()->json([
            'message'=>'Profil şəkili uğurla dəyişdirildi',
            'avatarUrl'=>asset($avatar)
        ], 200);
    }

    public function accountUpdate(UpdateAccountRequest $request)
    {
        auth()->user()->update([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'password' => bcrypt($request->ypassword),
        ]);

        return response()->json([
            'message'=>'Profil məlumatları uğurla dəyişdirildi',
            'fname'=>$request->name.' '.$request->last_name
        ], 200);
    }
}
