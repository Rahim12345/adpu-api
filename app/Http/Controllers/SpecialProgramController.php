<?php

namespace App\Http\Controllers;

use App\Http\Resources\Home\HomeSpecialProgramsCollection;
use App\Models\SpecialProgram;
use App\Http\Requests\StoreSpecialProgramRequest;
use App\Http\Requests\UpdateSpecialProgramRequest;
use App\Models\SystemLanguage;
use App\Traits\Searcher;

class SpecialProgramController extends Controller
{
    use Searcher;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $where = [
            ['special_programs.deleted', '=', request('general_actions') == 'deleted' ? 1 : 0],
        ];

        $joins = [
            [
                'users',
                [
                    ['users.id', '=', 'special_programs.creator']
                ],
                'left'
            ],
            [
                'system_languages',
                [
                    ['special_programs.language_id', '=', 'system_languages.id']
                ],
                'left'
            ],
        ];

        $selectColumns = [
            'special_programs.id as id',
            'special_programs.deleted as deleted',
            'special_programs.program_name as program_name',
            'special_programs.program_description as program_description',
            'users.name as user_name',
            'users.last_name as last_name',
            'system_languages.language as language',
        ];

        $special_programs = $this->searching(SpecialProgram::class, [], $joins, [], $selectColumns, $where, [], [['id', 'asc']]);

        return view('back.pages.home.special-programs.index', [
            'table_header' => __('pages/home/special-programs.table_header'),
            'create_route_name' => 'home-special-program.create',
            'create_url' => route('home-special-program.create'),
            'special_programs' => $special_programs
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.pages.home.special-programs.create',[
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpecialProgramRequest $request)
    {
        $special_programs = SpecialProgram::create([
            'program_name'=>$request->program_name,
            'program_description'=>$request->program_description,
            'creator' => auth()->id(),
            'language_id' => $request->language_id,
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('home-special-program.edit', $special_programs->id);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $language           = request('language');
        $check_language     = SystemLanguage::where('language', $language)->first();
        $specialProgram     = SpecialProgram::where('language_id', $check_language->id)->get();

        return response()->json(new HomeSpecialProgramsCollection($specialProgram),200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($home_special_program)
    {
        $specialProgram = SpecialProgram::whereId($home_special_program)->where('deleted',0)->firstOrFail();
        return view('back.pages.home.special-programs.edit', [
            'specialProgram' => $specialProgram,
            'languages'=>SystemLanguage::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpecialProgramRequest $request, $home_special_program)
    {
        $specialProgram = SpecialProgram::whereId($home_special_program)->where('deleted',0)->firstOrFail();

        $specialProgram->update([
            'program_name'=>$request->program_name,
            'program_description'=>$request->program_description,
            'creator' => auth()->id(),
            'language_id' => $request->language_id,
        ]);

        toastr()->success(__('static.data_added_successfully'), __('static.super'));
        return redirect()->route('home-special-program.edit', $specialProgram->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($home_special_program)
    {
        $specialProgram = SpecialProgram::whereId($home_special_program)->firstOrFail();

        $specialProgram->update([
            'deleted'=>$specialProgram->deleted == 1 ? 0 : 1
        ]);

        toastr()->success($specialProgram->deleted == 1 ? __('static.data_deleted_successfully') : __('static.data_removed_from_deleted'),__('static.super'));

        return redirect(url()->previous());
    }
}
