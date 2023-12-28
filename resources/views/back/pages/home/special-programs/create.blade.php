@extends('back.layouts.master')

@section('title')
    @lang('menu.home') - @lang('static.special_programs')
@endsection

@section('css')

@endsection

@section('content')
    <div class="row row-deck row-cards">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><a href="{{ route('home-special-program.index') }}"
                                              class="link-primary">@lang('pages/home/special-programs.table_header')</a></h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <form action="{{ route('home-special-program.store') }}" method="POST" enctype="multipart/form-data"
                          class="w-100" id="submitedForm">
                        @csrf
                        <div class="row mb-2 col-md-12">
                            <div class="mb-3">
                                <label class="form-label" for="program_name">@lang('pages/home/special-programs.program_name')</label>
                                <input type="text" id="program_name" class="form-control @error('program_name') is-invalid @enderror" name="program_name" placeholder="VAŞİNQTON UNİVERSİTETİNDƏ TƏHSİL İMKANI NƏDİR?" value="{{ old('program_name') }}">
                                @error('program_name')
                                <small class="text-danger mt-1">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="program_description">@lang('pages/home/special-programs.program_description')</label>
                                <textarea name="program_description" id="program_description" class="form-control @error('program_description') is-invalid @enderror" cols="30" rows="4">{{ old('program_description') }}</textarea>
                                @error('program_description')
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
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('program_description',{
                language: '{{ app()->getLocale() }}',
                filebrowserImageBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Images&_token={!! csrf_token() !!}',
                filebrowserBrowseUrl: $('#rootUrl').val()+'/laravel-filemanager?type=Files',
                filebrowserUploadUrl: $('#rootUrl').val()+'/laravel-filemanager/upload?type=Files&_token={!! csrf_token() !!}',
                toolbarGroups :[
                    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
                    { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                    { name: 'insert' },
                    { name: 'forms' },
                    { name: 'styles' },
                    { name: 'colors' },
                    { name: 'tools'}
                ],
            });
        });
    </script>
@endsection
