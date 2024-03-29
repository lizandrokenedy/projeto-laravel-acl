<form class="form-inline" method="GET" action="{{route($routeName.'.index')}}">
    <div class="form-group mb-2">
        @can('criar')
            <a href="{{route($routeName.'.create')}}">@lang('my.add')</a>
        @endcan
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="search" class="form-control" name="search" placeholder="@lang('my.search')" value="{{$search}}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">@lang('my.search')</button>
    <a class="btn btn-primary mb-2 ml-2" href="{{route($routeName.'.index')}}">@lang('my.clear')</a>
</form>