<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\HomeAboutResource;
use App\Http\Resources\Home\HomeBannerResource;
use App\Models\HomeAbout;
use App\Http\Requests\StoreHomeAboutRequest;
use App\Http\Requests\UpdateHomeAboutRequest;
use App\Models\SystemLanguage;
use App\Traits\FileUploader;

class HomeAboutController extends Controller
{
    use FileUploader;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreHomeAboutRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $language = request('language');
        $check_language = SystemLanguage::where('language', $language)->first();
        $home_about = HomeAbout::where('language_id', $check_language->id)->first();

        return response()->json(new HomeAboutResource($home_about),200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $home_about = HomeAbout::where('language_id',request('language_id'))->first();
        return view('back.pages.home.about.edit', [
            'homeAbout' => $home_about,
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeAboutRequest $request)
    {
        $homeAbout = HomeAbout::where('language_id',request('language_id'))->first();
        $path   = 'files/home/about/';
        $src    = $this->fileUpdate($homeAbout ? $homeAbout->src : null, $request->hasFile('src'), $request->src, $path);

        if ($homeAbout)
        {
            $homeAbout->update([
                'src' => $src,
                'alt' => $request->alt,
                'creator' => auth()->id(),
                'language_id' => $request->language_id,
                'icon' => $request->icon,
                'title_1' => $request->title_1,
                'title_2' => $request->title_2,
                'intro_text' => $request->intro_text,
            ]);
        }
        else
        {
            $homeAbout = HomeAbout::create([
                'src' => $src,
                'alt' => $request->alt,
                'creator' => auth()->id(),
                'language_id' => $request->language_id,
                'icon' => $request->icon,
                'title_1' => $request->title_1,
                'title_2' => $request->title_2,
                'intro_text' => $request->intro_text,
            ]);
        }

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeAbout $homeAbout)
    {
        //
    }
}
