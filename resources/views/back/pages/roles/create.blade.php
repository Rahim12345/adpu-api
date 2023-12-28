@extends('back.layouts.master')

@section('title')
    @lang('menu.roles')
@endsection

@section('css')

@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="{{ route('roles.index') }}" class="link-primary">@lang('menu.roles')</a></h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data" class="w-100" id="submitedForm">
                        @csrf
                        <div class="row mb-2 col-md-12">
                            <div class="input-group">
                                <label for="name"></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="@lang('static.name')" name="name" id="name" value="{{ old('name') }}" autocomplete="off">
                                <button class="btn bg-primary" type="button" onclick="$(this).prop('disabled',true).closest('form').submit();"><i class="fa fa-plus"></i></button>
                            </div>
                            @error('name')
                            <small class="text-danger mt-1">{{ $message }}</small>
                            @enderror
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
