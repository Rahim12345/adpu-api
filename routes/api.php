<?php

use App\Http\Controllers\ChronologyController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeAboutController;
use App\Http\Controllers\HomeBannerController;
use App\Http\Controllers\SpecialProgramController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'home','middleware' => ['check_api','check_language']],function (){
    Route::get('home-banner',[HomeBannerController::class,'show'])->name('home-banner.show');
    Route::get('home-about',[HomeAboutController::class,'show'])->name('home-about.show');
    Route::get('home-about/chronologies',[ChronologyController::class,'show'])->name('chronology.show');
    Route::get('home-faq',[FaqController::class,'show'])->name('chronology.show');
    Route::get('home-special-programs',[SpecialProgramController::class,'show'])->name('special.programs.show');
});
