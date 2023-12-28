@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.faq')
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
                    <th>@lang('pages/home/faq.question')</th>
                    <th>@lang('pages/home/faq.answer')</th>
                    <th>@lang('static.language')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if($faq->count() == 0)
                    <tr>
                        <td colspan="100%" class="text-center">@lang('static.data_not_found')</td>
                    </tr>
                @endif

                @foreach($faq as $f)
                    <tr>
                        <td><span class="text-muted">{{ ($faq ->currentpage()-1) * $faq ->perpage() + $loop->index + 1 }}</span></td>
                        <td>{{ $f->question }}</td>
                        <td>{{ $f->user_name.' '.$f->last_name }}</td>
                        <td>{{ $f->language }}</td>
                        <td class="text-end">
                            <div class="btn-list flex-nowrap" style="float: right">
                                <a href="{{ route('home-faq.edit',$f->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <form action="{{ route('home-faq.destroy',$f->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" type="submit" onclick="remover($(this), {{ $f->deleted == 1 ? '`'.__('static.return_undeleted').'`' : '`'.__('static.delete_sure').'`' }}, `@lang('static.confirm')`, `@lang('static.cancel')`);">
                                        <i class="fa fa-{{ $f->deleted == 1 ? 'trash-restore' : 'times' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('back.includes.custom-pagination',['data'=>$faq])
        </div>
    </div>
@endsection

@section('js')

@endsection
