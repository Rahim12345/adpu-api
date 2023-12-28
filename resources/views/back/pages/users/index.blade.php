@extends('back.layouts.master')

@section('title')
    @lang('menu.users')
@endsection

@section('css')

@endsection

@section('content')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('back/js/remover.js') }}"></script>
    <div class="col-md-12">
        <div class="card">
            @include('back.includes.tables.table-header')
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>@lang('static.name')</th>
                    <th>@lang('static.last_name')</th>
                    <th>@lang('static.blocked')</th>
                    <th>İcazələr</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>

                @if($users->count() == 0)
                    <tr>
                        <td colspan="100%" class="text-center">@lang('static.data_not_found')</td>
                    </tr>
                @endif

                @foreach($users as $user)
                    <tr>
                        <td><span class="text-muted">{{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}</span></td>
                        <td>
                            {{ $user->name }}
                        </td>
                        <td>
                            {{ $user->last_name }}
                        </td>
                        <td>
                            <label class="form-check form-switch">
                                <input class="form-check-input blocked" data-id="{{ $user->id }}" type="checkbox" {{ $user->blocked == 1 ? 'checked' : '' }} {{ auth()->id() == $user->id ? 'disabled' : '' }}>
                                <span class="form-check-label blocked-text" data-id="{{ $user->id }}">{{ $user->blocked == 1 ? __('static.yes') : __('static.no') }}</span>
                            </label>
                        </td>
                        <td>
                            @if(\App\Helpers\MenuShower::getPermission('permissions.index'))
                            <a href="{{ route('permissions.index',['user_id'=>$user->id]) }}" class="btn btn-primary"><i class="fa fa-lock" aria-hidden="true"></i></a>
                            @endif
                        </td>
                        <td class="text-end">
                            <div class="btn-list flex-nowrap" style="float: right">
                                @if(\App\Helpers\MenuShower::getPermission('users.edit'))
                                <a href="{{ route('users.edit',$user->id) }}" class="btn btn-primary">
                                    <i class="fa fa-pen"></i>
                                </a>
                                @endif
                                @if(\App\Helpers\MenuShower::getPermission('users.destroy'))
                                <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger show_confirm" type="submit" onclick="remover($(this), {{ $user->deleted == 1 ? '`'.__('static.return_undeleted').'`' : '`'.__('static.delete_sure').'`' }}, `@lang('static.confirm')`, `@lang('static.cancel')`);" {{ $user->id == auth()->id() ? 'disabled' : '' }}>
                                        <i class="fa fa-{{ $user->deleted == 1 ? 'trash-restore' : 'times' }}"></i>
                                    </button>
                                </form>
                                @endif

                            </div>
                        </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('back.includes.custom-pagination',['data'=>$users])
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $('.blocked').change(function () {
                let myThis = $(this);
                let id = $(this).attr('data-id');
                let checked = $(this).is(':checked') === true ? 1 : 0;

               $.ajax({
                   type: "POST",
                   data:{
                       id,
                       checked
                   },
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   url: '{!! route('user.block') !!}',
                   success:function (response) {
                       toastr.options = {
                           "debug": false,
                           "positionClass": "toast-bottom-right",
                           "onclick": null,
                           "fadeIn": 300,
                           "fadeOut": 1000,
                           "timeOut": 5000,
                           "extendedTimeOut": 1000
                       }

                       $('.blocked-text[data-id='+id+']').html(response.message);
                       toastr.success('{!! __('static.data_updated_successfully') !!}');
                   },
                   error : function (myErrors) {
                       myThis.prop('checked', false);
                       toastr.options = {
                           "debug": false,
                           "positionClass": "toast-bottom-right",
                           "onclick": null,
                           "fadeIn": 300,
                           "fadeOut": 1000,
                           "timeOut": 5000,
                           "extendedTimeOut": 1000
                       }

                       $.each(myErrors.responseJSON.errors,function (key, value) {
                           toastr.error(value);
                       })
                   }
               })
            });
        });
    </script>
@endsection
