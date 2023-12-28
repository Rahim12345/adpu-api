<div class="row">
    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="name_az">@lang('static.stock_name_az')</label>
        <input type="text" class="form-control @error('name_az') is-invalid @enderror" name="name_az" id="name_az" value="{{ old('name_az') }}" autocomplete="off">
        @error('name_az')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="name_en">@lang('static.stock_name_en')</label>
        <input type="text" class="form-control @error('name_en') is-invalid @enderror" name="name_en" id="name_en" value="{{ old('name_en') }}" autocomplete="off">
        @error('name_en')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="sku">SKU</label>
        <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" id="sku" value="{{ old('sku') }}" autocomplete="off">
        @error('sku')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="sub_category_id">@lang('static.category_name')</label>
        <select name="sub_category_id" id="sub_category_id" class="form-control @error('sub_category_id') is-invalid @enderror"></select>
        @error('sub_category_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="mark_id">@lang('static.mark_name')</label>
        <div>
            <select name="mark_id" id="mark_id"></select>
            @error('mark_id')
            <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-group mb-3 col-md-6">
        <label class="form-label" for="model">Model</label>
        <input type="text" class="form-control @error('model') is-invalid @enderror" name="model" id="model" value="{{ old('model') }}" autocomplete="off">
        @error('model')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="form-group mb-3 col-md-12">
        <label class="form-label" for="unit_id">@lang('static.unit')</label>
        <select name="unit_id[]" id="unit_id" class="form-control" multiple="multiple">
            @foreach($units as $unit)
                <option value="{{ $unit->id }}" {{ old('unit_id') && in_array($unit->id,old('unit_id')) ? 'selected' : '' }}>{{ $unit->{'name_'.app()->getLocale()} }}</option>
            @endforeach
        </select>
        @error('unit_id')
        <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
</div>
