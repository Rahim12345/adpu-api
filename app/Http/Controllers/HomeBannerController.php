<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\HomeBannerCollection;
use App\Models\HomeBanner;
use App\Http\Requests\StoreHomeBannerRequest;
use App\Http\Requests\UpdateHomeBannerRequest;
use App\Models\SystemLanguage;
use App\Traits\FileUploader;
use App\Traits\Searcher;

class HomeBannerController extends Controller
{
    use Searcher, FileUploader;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $where = [
            ['home_banners.deleted', '=', request('general_actions') == 'deleted' ? 1 : 0],
        ];

        $joins = [
            [
                'users',
                [
                    ['users.id', '=', 'home_banners.creator']
                ],
                'left'
            ],
            [
                'system_languages',
                [
                    ['home_banners.language_id', '=', 'system_languages.id']
                ],
                'left'
            ],
        ];

        $selectColumns = [
            'home_banners.id as id',
            'home_banners.deleted as deleted',
            'home_banners.src as src',
            'users.name as user_name',
            'users.last_name as last_name',
            'system_languages.language as language',
        ];

        $banners = $this->searching(HomeBanner::class, [], $joins, [], $selectColumns, $where, [], [['id', 'asc']]);

        return view('back.pages.home.banner.index', [
            'table_header' => __('pages/home/banner.table_header'),
            'create_route_name' => 'home-banner.create',
            'create_url' => route('home-banner.create'),
            'banners' => $banners
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.home.banner.create',[
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeBannerRequest $request)
    {
        $path = 'files/home/banners/';
        $src = $this->fileSave($path, $request, 'src');

        $homeBanner = HomeBanner::create([
            'src' => $src,
            'alt' => $request->alt,
            'creator' => auth()->id(),
            'language_id' => $request->language_id,
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('home-banner.edit', $homeBanner->id);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $language           = request('language');
        $check_language     = SystemLanguage::where('language', $language)->first();
        $home_banners       = HomeBanner::where('language_id', $check_language->id)->get();

        return response()->json(new HomeBannerCollection($home_banners),200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeBanner $homeBanner)
    {
        return view('back.pages.home.banner.edit', [
            'homeBanner' => $homeBanner,
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeBannerRequest $request, HomeBanner $homeBanner)
    {
        $path   = 'files/home/banners/';
        $src    = $this->fileUpdate($homeBanner->src, $request->hasFile('src'), $request->src, $path);

        $homeBanner->update([
            'src' => $src,
            'alt' => $request->alt,
            'creator' => auth()->id(),
            'language_id' => $request->language_id,
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('home-banner.edit', $homeBanner->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeBanner $homeBanner)
    {
        $homeBanner->update([
            'deleted'=>$homeBanner->deleted == 1 ? 0 : 1
        ]);

        toastr()->success($homeBanner->deleted == 1 ? __('static.data_deleted_successfully') : __('static.data_removed_from_deleted'),__('static.super'));

        return redirect(url()->previous());
    }
}
