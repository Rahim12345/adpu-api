<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\HomeAboutChronologyCollection;
use App\Models\Chronology;
use App\Http\Requests\StoreChronologyRequest;
use App\Http\Requests\UpdateChronologyRequest;
use App\Models\SystemLanguage;
use App\Traits\Searcher;

class ChronologyController extends Controller
{
    use Searcher;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $where = [
            ['chronologies.deleted', '=', request('general_actions') == 'deleted' ? 1 : 0],
        ];

        $joins = [
            [
                'users',
                [
                    ['users.id', '=', 'chronologies.creator']
                ],
                'left'
            ],
            [
                'system_languages',
                [
                    ['chronologies.language_id', '=', 'system_languages.id']
                ],
                'left'
            ],
        ];

        $selectColumns = [
            'chronologies.id as id',
            'chronologies.deleted as deleted',
            'chronologies.date as date',
            'chronologies.content as content',
            'users.name as user_name',
            'users.last_name as last_name',
            'system_languages.language as language',
        ];

        $chronologies = $this->searching(Chronology::class, [], $joins, [], $selectColumns, $where, [], [['id', 'asc']]);

        return view('back.pages.home.chronology.index', [
            'table_header' => __('pages/home/chronology.table_header'),
            'create_route_name' => 'chronology.create',
            'create_url' => route('chronology.create'),
            'chronologies' => $chronologies
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.home.chronology.create',[
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreChronologyRequest $request)
    {
        $chronology = Chronology::create([
            'date'=>$request->date,
            'content'=>$request->my_content,
            'creator' => auth()->id(),
            'language_id' => $request->language_id,
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('chronology.edit', $chronology->id);
    }

    /**
     * Display the specified resource.
     */
    public function show(Chronology $chronology)
    {
        $language           = request('language');
        $check_language     = SystemLanguage::where('language', $language)->first();
        $chronologies       = Chronology::where('language_id', $check_language->id)->get();

        return response()->json(new HomeAboutChronologyCollection($chronologies),200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chronology $chronology)
    {
        return view('back.pages.home.chronology.edit', [
            'chronology' => $chronology,
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChronologyRequest $request, Chronology $chronology)
    {
        $chronology->update([
            'date'=>$request->date,
            'content'=>$request->my_content,
            'creator' => auth()->id(),
            'language_id' => $request->language_id,
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('chronology.edit', $chronology->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chronology $chronology)
    {
        $chronology->update([
            'deleted'=>$chronology->deleted == 1 ? 0 : 1
        ]);

        toastr()->success($chronology->deleted == 1 ? __('static.data_deleted_successfully') : __('static.data_removed_from_deleted'),__('static.super'));

        return redirect(url()->previous());
    }
}
