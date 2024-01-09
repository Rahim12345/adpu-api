@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.banner')
@endsection

@section('css')

@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        @lang('pages/home/about.table_header')

                    </h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('home-about.update',['home_about'=>1]) }}" method="POST" enctype="multipart/form-data"
                          class="w-100" id="submitedForm">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2 col-md-12">
                            @if($homeAbout and $homeAbout->src)
                                <img src="{{ asset($homeAbout->src) }}" alt="{{ $homeAbout->alt }}" class="img-100px">
                            @endif
                            <div class="mb-3">
                                <div class="form-label">@lang('pages/home/banner.choose_a_photo')</div>
                                <input type="file" class="form-control" name="src">
                                @error('src')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="alt">@lang('pages/home/about.alt')</label>
                                <input type="text" id="alt" class="form-control" name="alt" placeholder="@lang('pages/home/about.alt')" value="{{ old('alt',$homeAbout ? $homeAbout->alt : '') }}">
                                @error('alt')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="icon">@lang('pages/home/about.icon')</label>
                                <input type="text" id="icon" class="form-control" name="icon" placeholder="@lang('pages/home/about.icon')" value="{{ old('icon',$homeAbout ? $homeAbout->icon : '') }}">
                                @error('icon')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="title_1">@lang('pages/home/about.title_1')</label>
                                <input type="text" id="title_1" class="form-control" name="title_1" placeholder="@lang('pages/home/about.title_1')" value="{{ old('title_1',$homeAbout ? $homeAbout->title_1 : '') }}">
                                @error('title_1')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label" for="title_2">@lang('pages/home/about.title_2')</label>
                                <input type="text" id="title_2" class="form-control" name="title_2" placeholder="@lang('pages/home/about.title_2')" value="{{ old('title_2',$homeAbout ? $homeAbout->title_2 : '') }}">
                                @error('title_2')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="intro_text">@lang('pages/home/about.intro_text')</label>
                                <textarea name="intro_text" placeholder="@lang('pages/home/about.intro_text')" id="intro_text" cols="30" rows="4" class="form-control @error('intro_text') is-invalid @enderror">{{ old('intro_text',$homeAbout ? $homeAbout->intro_text : '') }}</textarea>
                                @error('intro_text')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label class="form-label" for="language_id">@lang('static.language')</label>
                                <select name="language_id" id="language_id" class="form-control @error('language_id') is-invalid @enderror" onchange="window.location.href='/admin/pages/home/home-about/1/edit?language_id='+$(this).val()">
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" @selected(old('language_id', request('language_id')) == $language->id)>{{ $language->language }}</option>
                                    @endforeach
                                </select>

                                @error('language_id')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <a href="{{ route('chronology.index') }}" class="btn btn-outline-success">Ətraflı</a>
                                <button class="btn bg-primary float-end" type="button" onclick="$(this).prop('disabled',true).closest('form').submit();">
                                    <i class="fa fa-pen"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
