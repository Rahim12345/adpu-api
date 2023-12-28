<div class="card-footer d-flex align-items-center">
    {!! $data->appends(request()->query())->links('vendor.pagination.bootstrap-4') !!}
    <div id="showing" style="float: right; position: absolute; right: 0px;margin-right: 20px">
        @if (app()->getLocale() == 'en')
            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }} of {{ $data->total() }} entries
        @else
            @if($data->total() > 0)
                {{ $data->total() }} nəticədən {{ $data->firstItem() }}-dən {{ $data->lastItem() }}-ə qədəri göstərilir
            @endif
        @endif
    </div>
</div>
<div class="d-flex align-items-center m-2 mt-0">

</div>
