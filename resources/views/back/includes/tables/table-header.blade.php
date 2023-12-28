<form action="" method="GET" style="overflow: auto" id="searcherForm">
    <div class="card-header" style="justify-content: space-between">
        <div style="display: flex;align-items: center;">
            <h3 class="card-title">{{ $table_header }}</h3>

            @if(\App\Helpers\MenuShower::getPermission($create_route_name))
                <a href="{{ $create_url }}" class="btn btn-primary m-2">
                    <i class="fa fa-plus"></i>
                </a>
            @endif

        </div>

        <div class="general-action">
            <label for="general_actions"></label>
            <select class="form-control " name="general_actions" id="general_actions" >
                <option value="undeleted" {{ request('general_actions') == 'undeleted' ? 'selected' : '' }}>Silinməyənlər</option>
                <option value="deleted" {{ request('general_actions') == 'deleted' ? 'selected' : '' }}>Silinənlər</option>
            </select>
        </div>
    </div>
    <div class="card-body border-bottom py-3">
        <div class="d-flex">
            <div class="text-muted">
                @if(app()->getLocale() == 'en')
                Show
                <div class="mx-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" name="count" value="{{ request('count') ? request('count') : config('system.per_page') }}" size="3" onkeyup="if(event.keyCode === 13) $(this).closest('form').submit();">
                </div>
                entries
                @else
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" name="count" value="{{ request('count') ? request('count') : config('system.per_page') }}" size="3" onkeyup="if(event.keyCode === 13) $(this).closest('form').submit();">
                    </div>
                    nəticə göstərilir
                @endif
            </div>
            <div class="ms-auto text-muted">
                @lang('static.search'):
                <div class="ms-2 d-inline-block">
                    <input type="text" class="form-control form-control-sm" name="search" aria-label="Search invoice" onkeyup="if(event.keyCode === 13) $(this).closest('form').submit();" value="{{ request('search') }}">
                </div>
            </div>
        </div>
    </div>
</form>
