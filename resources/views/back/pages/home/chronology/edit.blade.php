@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.about') - @lang('pages/home/chronology.table_header')
        @endsection

        @section('css')

        @endsection

        @section('content')
            <div class="row row-deck row-cards">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><a href="{{ route('chronology.index') }}"
                                                      class="link-primary">@lang('pages/home/chronology.table_header')</a></h3>
                        </div>
                        <div class="card-body border-bottom py-3">
                            <form action="{{ route('chronology.update',['chronology'=>$chronology->id]) }}" method="POST" enctype="multipart/form-data"
                                  class="w-100" id="submitedForm">
                                @csrf
                                @method('PUT')
                                <div class="row mb-2 col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="date">@lang('pages/home/chronology.date')</label>
                                        <input type="text" id="date" class="form-control @error('date') is-invalid @enderror" name="date" placeholder="26 avqust 1921-ci il" value="{{ old('date',$chronology->date) }}">
                                        @error('date')
                                        <small class="text-danger mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="my_content">@lang('pages/home/chronology.content')</label>
                                        <textarea name="my_content" id="my_content" class="form-control @error('date') is-invalid @enderror" placeholder="Azərbaycan XKS sədri Nəriman Nərimanovun  imzaladığı 66 saylı “Birinci Azərbaycan Kişi Dövlət Pedaqoji İnstitutunun təsis edilməsi haqqında” dekret əsasında ölkəmizin ilk anadilli ali təhsil müəssisəsi yaradıldı. 15 noyabr 1921-ci il tarixində 6 tələbə, 8 müəllim ilə institutda ilk dərslər başlanıldı. 1924-cü ildə İnstitutun 28 nəfər məzunla ilk buraxılış oldu." cols="30" rows="4">{{ old('my_content',$chronology->content) }}</textarea>
                                        @error('my_content')
                                        <small class="text-danger mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label" for="language_id">@lang('static.language')</label>
                                        <select name="language_id" id="language_id" class="form-control @error('alt') is-invalid @enderror">
                                            <option value="">@lang('static.choose_one')</option>
                                            @foreach($languages as $language)
                                                <option value="{{ $language->id }}" @selected(old('language_id', $chronology->language_id) == $language->id)>{{ $language->language }}</option>
                                            @endforeach
                                        </select>

                                        @error('language_id')
                                        <small class="text-danger mt-1">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
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
