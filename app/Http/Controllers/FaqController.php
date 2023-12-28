<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\HomeFaqCollection;
use App\Models\Faq;
use App\Http\Requests\StoreFaqRequest;
use App\Http\Requests\UpdateFaqRequest;
use App\Models\SystemLanguage;
use App\Traits\Searcher;

class FaqController extends Controller
{
    use Searcher;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $where = [
            ['faqs.deleted', '=', request('general_actions') == 'deleted' ? 1 : 0],
        ];

        $joins = [
            [
                'users',
                [
                    ['users.id', '=', 'faqs.creator']
                ],
                'left'
            ],
            [
                'system_languages',
                [
                    ['faqs.language_id', '=', 'system_languages.id']
                ],
                'left'
            ],
        ];

        $selectColumns = [
            'faqs.id as id',
            'faqs.deleted as deleted',
            'faqs.question as question',
            'faqs.answer as answer',
            'users.name as user_name',
            'users.last_name as last_name',
            'system_languages.language as language',
        ];

        $faq = $this->searching(Faq::class, [], $joins, [], $selectColumns, $where, [], [['id', 'asc']]);

        return view('back.pages.home.faq.index', [
            'table_header' => __('pages/home/faq.table_header'),
            'create_route_name' => 'home-faq.create',
            'create_url' => route('home-faq.create'),
            'faq' => $faq
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.home.faq.create',[
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFaqRequest $request)
    {
        $faq = Faq::create([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'creator' => auth()->id(),
            'language_id' => $request->language_id,
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('home-faq.edit', $faq->id);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $language           = request('language');
        $check_language     = SystemLanguage::where('language', $language)->first();
        $faq                = Faq::where('language_id', $check_language->id)->get();

        return response()->json(new HomeFaqCollection($faq),200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($home_faq)
    {
        $faq = Faq::whereId($home_faq)->where('deleted',0)->firstOrFail();
        return view('back.pages.home.faq.edit', [
            'faq' => $faq,
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFaqRequest $request,$home_faq)
    {
        $faq = Faq::whereId($home_faq)->where('deleted',0)->firstOrFail();

        $faq->update([
            'question'=>$request->question,
            'answer'=>$request->answer,
            'creator' => auth()->id(),
            'language_id' => $request->language_id
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('home-faq.edit', $faq->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($home_faq)
    {
        $faq = Faq::whereId($home_faq)->firstOrFail();

        $faq->update([
            'deleted'=>$faq->deleted == 1 ? 0 : 1
        ]);

        toastr()->success($faq->deleted == 1 ? __('static.data_deleted_successfully') : __('static.data_removed_from_deleted'),__('static.super'));

        return redirect(url()->previous());
    }
}
