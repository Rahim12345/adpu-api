@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.about') - @lang('pages/home/chronology.table_header')
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
                    <th>Tarix</th>
                    <th>Yaradıcı</th>
                    <th>@lang('static.language')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if($chronologies->count() == 0)
                    <tr>
                        <td colspan="100%" class="text-center">@lang('static.data_not_found')</td>
                    </tr>
                @endif

                @foreach($chronologies as $chronology)
                    <tr>
                        <td><span class="text-muted">{{ ($chronologies ->currentpage()-1) * $chronologies ->perpage() + $loop->index + 1 }}</span></td>
                        <td>{{ $chronology->date }}</td>
                        <td>{{ $chronology->user_name.' '.$chronology->last_name }}</td>
                        <td>{{ $chronology->language }}</td>
                        <td class="text-end">
                            <div class="btn-list flex-nowrap" style="float: right">
                                <a href="{{ route('chronology.edit',$chronology->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <form action="{{ route('chronology.destroy',$chronology->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" type="submit" onclick="remover($(this), {{ $chronology->deleted == 1 ? '`'.__('static.return_undeleted').'`' : '`'.__('static.delete_sure').'`' }}, `@lang('static.confirm')`, `@lang('static.cancel')`);">
                                        <i class="fa fa-{{ $chronology->deleted == 1 ? 'trash-restore' : 'times' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('back.includes.custom-pagination',['data'=>$chronologies])
        </div>
    </div>
@endsection

@section('js')

@endsection
