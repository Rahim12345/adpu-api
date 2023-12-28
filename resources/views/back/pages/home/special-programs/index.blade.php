@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.special_programs')
@endsection

@section('css')

@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('back/js/remover.js') }}"></script>
    <div class="col-12">
        <div class="card">
            @include('back.includes.tables.table-header')
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('pages/home/special-programs.program_name')</th>
                    <th>@lang('static.language')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if($special_programs->count() == 0)
                    <tr>
                        <td colspan="100%" class="text-center">@lang('static.data_not_found')</td>
                    </tr>
                @endif

                @foreach($special_programs as $special_program)
                    <tr>
                        <td><span class="text-muted">{{ ($special_programs ->currentpage()-1) * $special_programs ->perpage() + $loop->index + 1 }}</span></td>
                        <td>{{ $special_program->program_name }}</td>
                        <td>{{ $special_program->language }}</td>
                        <td class="text-end">
                            <div class="btn-list flex-nowrap" style="float: right">
                                <a href="{{ route('home-special-program.edit',$special_program->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <form action="{{ route('home-special-program.destroy',$special_program->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" type="submit" onclick="remover($(this), {{ $special_program->deleted == 1 ? '`'.__('static.return_undeleted').'`' : '`'.__('static.delete_sure').'`' }}, `@lang('static.confirm')`, `@lang('static.cancel')`);">
                                        <i class="fa fa-{{ $special_program->deleted == 1 ? 'trash-restore' : 'times' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('back.includes.custom-pagination',['data'=>$special_programs])
        </div>
    </div>
@endsection

@section('js')

@endsection
