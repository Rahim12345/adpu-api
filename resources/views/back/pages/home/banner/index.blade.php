@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.banner')
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
                    <th>Şəkil</th>
                    <th>Yaradıcı</th>
                    <th>@lang('static.language')</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if($banners->count() == 0)
                    <tr>
                        <td colspan="100%" class="text-center">@lang('static.data_not_found')</td>
                    </tr>
                @endif

                @foreach($banners as $banner)
                    <tr>
                        <td><span class="text-muted">{{ ($banners ->currentpage()-1) * $banners ->perpage() + $loop->index + 1 }}</span></td>
                        <td>
                            <img src="{{ asset($banner->src) }}" alt="{{ $banner->alt }}" class="img-100px">
                        </td>
                        <td>
                            {{ $banner->user_name.' '.$banner->last_name }}
                        </td>
                        <td>{{ $banner->language }}</td>
                        <td class="text-end">
                            <div class="btn-list flex-nowrap" style="float: right">
                                <a href="{{ route('home-banner.edit',$banner->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>

                                <form action="{{ route('home-banner.destroy',$banner->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" type="submit" onclick="remover($(this), {{ $banner->deleted == 1 ? '`'.__('static.return_undeleted').'`' : '`'.__('static.delete_sure').'`' }}, `@lang('static.confirm')`, `@lang('static.cancel')`);">
                                        <i class="fa fa-{{ $banner->deleted == 1 ? 'trash-restore' : 'times' }}"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('back.includes.custom-pagination',['data'=>$banners])
        </div>
    </div>
@endsection

@section('js')

@endsection
