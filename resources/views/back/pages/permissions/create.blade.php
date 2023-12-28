@extends('back.layouts.master')

@section('title')
    @lang('menu.units')
@endsection

@section('css')

@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="{{ route('units.index') }}" class="link-primary">@lang('menu.units')</a></h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('units.store') }}" method="POST" enctype="multipart/form-data" class="w-100" id="submitedForm">
                        @csrf
                        <div class="row">
                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="name_az">@lang('static.unit_az')</label>
                                <input type="text" class="form-control @error('name_az') is-invalid @enderror" name="name_az" id="name_az" value="{{ old('name_az') }}" autocomplete="off">
                                @error('name_az')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3 col-md-6">
                                <label class="form-label" for="name_en">@lang('static.unit_en')</label>
                                <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" id="name_en" value="{{ old('name_en') }}" autocomplete="off">
                                @error('name_en')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <button class="btn btn-primary float-end" onclick="$(this).prop('disabled',true).closest('form').submit();">
                                <i class="fa fa-plus"></i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
