<?php

use App\Http\Controllers\back\AdminDashboard;
use App\Http\Controllers\ChronologyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\SetLocaleController;
use App\Http\Controllers\SpecialProgramController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;

Route::get('/', function () {
    return view('auth.login');
})->name('front.home');

Route::get('localization/{lang}',[SetLocaleController::class,'setLocale'])->name('setLocale');

Auth::routes([
    'register' => false,
    'reset'=>false
]);

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    Lfm::routes();
});

Route::group(['prefix' => 'admin','middleware' => ['auth','locale','is_blocked','un_deleted_user','permission_links']],function (){
    Route::get('dashboard',[AdminDashboard::class,'dashboard'])->name('admin.dashboard');
    Route::resource('roles', RoleController::class);
    Route::resource('roles/{role_id}/role-permissions', RolePermissionController::class)->only(['index','store']);

    Route::resource('users', UserController::class);
    Route::post('user-block',[UserController::class,'isBlocked'])
        ->name('user.block');
    Route::resource('users/{user_id}/permissions', PermissionController::class)->only(['index','store']);

    Route::get('profile',[ProfileController::class,'index'])
        ->name('profil.index');

    Route::post('profile-store',[ProfileController::class,'profileStore'])
        ->name('profil.store');

    Route::post('account-update',[ProfileController::class,'accountUpdate'])
        ->name('account.update');

    Route::group(['prefix' => 'pages'],function (){
        Route::group(['prefix' => 'home'],function (){
            Route::resource('home-banner', HomeBannerController::class);
            Route::resource('home-about', HomeAboutController::class);
            Route::resource('home-about/sub/chronology', ChronologyController::class);
            Route::resource('home-faq', FaqController::class);
            Route::resource('home-special-program', SpecialProgramController::class);
        });
    });
});

