@extends('back.layouts.master')

@section('title')

@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('back/css/permission.css') }}">
@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-body border-bottom py-3">
                    <table class="table card-table table-vcenter text-nowrap datatable">
                        <thead>
                        <tr>
                            <th colspan="100%" class="header-table-text">{{ $current_user->name.' '.$current_user->last_name.' üçün icazə cədvəli' }}</th>
                        </tr>
                        <tr>
                            <th class="thead-col">#</th>
                            <th class="thead-col">İcazə adı</th>
                            <th class="thead-col">create</th>
                            <th class="thead-col">read</th>
                            <th class="thead-col">update</th>
                            <th class="thead-col">delete</th>
                        </tr>
                        </thead>
                        <tbody>


                        @foreach($routes as $route)
                            <tr>
                                <td><span class="text-muted">{{ $loop->iteration }}</span></td>
                                <td>
                                    {{ $route->{'in_natural_language_name_'.app()->getLocale()} }}
                                </td>
                                <td>
                                    @if($route->route_name != 'archive-units')
                                    <input type="checkbox" class="create" data-route="{{ $route->route_name }}" data-action="create" {{ in_array($route->route_name.'.create',$permissions) ? 'checked' : '' }}>
                                    @endif
                                </td>
                                <td>
                                    <input type="checkbox" class="index" data-route="{{ $route->route_name }}" data-action="index" {{ in_array($route->route_name.'.index',$permissions) ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <input type="checkbox" class="edit" data-route="{{ $route->route_name }}" data-action="edit" {{ in_array($route->route_name.'.edit',$permissions) ? 'checked' : '' }}>
                                </td>
                                <td>
                                    @if($route->route_name != 'archive-units')
                                    <input type="checkbox" class="delete" data-route="{{ $route->route_name }}" data-action="delete" {{ in_array($route->route_name.'.destroy',$permissions) ? 'checked' : '' }}>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('back/js/tabler-theme.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.create, .index, .edit, .delete').change(function() {
                let checked = $(this).is(':checked');
                let route_name = $(this).attr('data-route');
                let action = $(this).attr('data-action');

                $.ajax({
                    type: 'POST',
                    url: '{!! route('permissions.store',['user_id'=>request()->segment(3)]) !!}',
                    data:{
                        checked: checked,
                        route_name: route_name,
                        action: action,
                        user_id : {{ request()->segment(3) }},
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                        toastr.success(response.message);
                    }
                });
            });

            tableTheme(['header-table-text', 'thead-col']);
        });
    </script>
@endsection
