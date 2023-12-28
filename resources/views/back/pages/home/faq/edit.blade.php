@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.faq')
@endsection

@section('css')

@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="{{ route('home-faq.index') }}"
                                              class="link-primary">@lang('pages/home/faq.table_header')</a></h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('home-faq.update',['home_faq'=>$faq->id]) }}" method="POST" enctype="multipart/form-data"
                          class="w-100" id="submitedForm">
                        @csrf
                        @method('PUT')
                        <div class="row mb-2 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="question">@lang('pages/home/faq.question')</label>
                                <input type="text" id="question" class="form-control @error('question') is-invalid @enderror" name="question" placeholder="Təqaüdlər nə zaman ödənilir ?" value="{{ old('question',$faq->question) }}">
                                @error('question')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="answer">@lang('pages/home/faq.answer')</label>
                                <textarea name="answer" id="answer" class="form-control @error('answer') is-invalid @enderror" placeholder="Hər ayın təqaüdü növbəti ayın 10-a qədər hesablara yüklənir. Yay aylarının təqaüdləri isə sentyabr-oktyabr aylarında ödənilir." cols="30" rows="4">{{ old('answer',$faq->answer) }}</textarea>
                                @error('answer')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="language_id">@lang('static.language')</label>
                                <select name="language_id" id="language_id" class="form-control @error('alt') is-invalid @enderror">
                                    <option value="">@lang('static.choose_one')</option>
                                    @foreach($languages as $language)
                                        <option value="{{ $language->id }}" @selected(old('language_id', $faq->language_id) == $language->id)>{{ $language->language }}</option>
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
