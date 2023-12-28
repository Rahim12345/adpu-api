@extends('back.layouts.master')

@section('title')
    @lang('menu.roles')
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
                    <th>@lang('static.name')</th>
                    @if(\App\Helpers\MenuShower::getPermission('role-permissions.index'))
                    <th>@lang('static.permissions')</th>
                    @endif
                    @if(\App\Helpers\MenuShower::getPermission('roles.edit') || \App\Helpers\MenuShower::getPermission('roles.destroy'))
                    <th></th>
                    @endif
                </tr>
                </thead>
                <tbody>

                @if($roles->count() == 0)
                    <tr>
                        <td colspan="100%" class="text-center">@lang('static.data_not_found')</td>
                    </tr>
                @endif

                @foreach($roles as $role)
                    <tr>
                        <td><span class="text-muted">{{ ($roles ->currentpage()-1) * $roles ->perpage() + $loop->index + 1 }}</span></td>
                        <td>
                            {{ $role->name }}
                        </td>
                        @if(\App\Helpers\MenuShower::getPermission('role-permissions.index'))
                            <td>
                                <a href="{{ route('role-permissions.index',['role_id'=>$role->id]) }}" class="btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i></a>
                            </td>
                        @endif
                        @if(\App\Helpers\MenuShower::getPermission('roles.edit') || \App\Helpers\MenuShower::getPermission('roles.destroy'))
                        <td class="text-end">
                            <div class="btn-list flex-nowrap" style="float: right">
                                @if(\App\Helpers\MenuShower::getPermission('roles.edit'))
                                <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>
                                @endif

                                @if(\App\Helpers\MenuShower::getPermission('roles.destroy'))
                                <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" type="submit" onclick="remover($(this), {{ $role->deleted == 1 ? '`'.__('static.return_undeleted').'`' : '`'.__('static.delete_sure').'`' }}, `@lang('static.confirm')`, `@lang('static.cancel')`);">
                                        <i class="fa fa-{{ $role->deleted == 1 ? 'trash-restore' : 'times' }}"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                        @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('back.includes.custom-pagination',['data'=>$roles])
        </div>
    </div>
@endsection

@section('js')

@endsection
