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
                    <h3 class="card-title"><a href="{{ route('home-banner.index') }}"
                                              class="link-primary">@lang('pages/home/banner.table_header')</a></h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('home-banner.store') }}" method="POST" enctype="multipart/form-data"
                          class="w-100" id="submitedForm">
                        @csrf
                        <div class="row mb-2 col-md-12">
                            <div class="mb-3">
                                <div class="form-label">@lang('pages/home/banner.choose_a_photo')</div>
                                <input type="file" class="form-control" name="src">
                                @error('src')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="alt">@lang('pages/home/banner.alt')</label>
                                <input type="text" id="alt" class="form-control" name="alt" placeholder="@lang('pages/home/banner.alt')" value="{{ old('alt') }}">
                                @error('alt')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="language_id">@lang('static.language')</label>
                                <select name="language_id" id="language_id" class="form-control @error('alt') is-invalid @enderror">
                                    <option value="">@lang('static.choose_one')</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}">{{ $language->language }}</option>
                                    @endforeach
                                </select>

                                @error('language_id')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button class="btn bg-primary float-end" type="button" onclick="$(this).prop('disabled',true).closest('form').submit();">
                                    <i class="fa fa-plus"></i>
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
