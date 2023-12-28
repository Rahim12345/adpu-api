@extends('back.layouts.master')

@section('title')
    @lang('menu.users')
@endsection

@section('css')

@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="{{ route('users.index') }}" class="link-primary">@lang('menu.users')</a></h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('users.update',$user->id) }}" method="POST" enctype="multipart/form-data" class="w-100" id="submitedForm">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="name">@lang('static.name')</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" value="{{ old('name',$user->name) }}" autocomplete="off" maxlength="15">
                                @error('name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="last_name">@lang('static.last_name')</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name',$user->last_name) }}" autocomplete="off" maxlength="30">
                                @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="email">@lang('static.email')</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email',$user->email) }}" autocomplete="off">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="role_id">@lang('menu.roles')</label>
                                <select name="role_id" id="role_id" class="form-control form-select @error('email') is-invalid @enderror">

                                    <option value="">@lang('static.choose_one')</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @selected(old('role_id',$user->getUserRole->role_id) == $role->id)>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="password">@lang('static.password')</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" autocomplete="off">
                                @error('password')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="password_confirmation">@lang('static.password_confirmation')</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" autocomplete="off">
                                @error('password_confirmation')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-primary float-end" onclick="$(this).prop('disabled',true).closest('form').submit();">
                                <i class="fa fa-pencil"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
