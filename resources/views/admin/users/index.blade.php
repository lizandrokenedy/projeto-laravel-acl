@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">@lang('my.list', ['page'=>$page])</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">@lang('my.list', ['page'=>$page])</li>
            </ol>
          </nav>

          <form class="form-inline" method="GET" action="{{route($routeName.'.index')}}">
            <div class="form-group mb-2">
              <a href="#">@lang('my.add')</a>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="search" class="form-control" name="search" placeholder="@lang('my.search')"
                value="{{$search}}">
            </div>
            <button type="submit" class="btn btn-primary mb-2">@lang('my.search')</button>
            <a class="btn btn-primary mb-2 ml-2" href="{{route($routeName.'.index')}}">@lang('my.clear')</a>
          </form>

          <table class="table">
            <thead>
              <tr>
                @foreach ($columnList as $key => $value)
                <th scope="col">{{$value}}</th>
                @endforeach
              </tr>
            </thead>
            <tbody>
              @foreach ($list as $key => $value )

              <tr>
                @foreach ($columnList as $key2 => $value2)
                @if($key2 == 'id')
                <th scope="row">@php echo $value->{$key2} @endphp</th>
                @else
                <td>@php echo $value->{$key2} @endphp</td>
                @endif

                @endforeach
              
              </tr>
              @endforeach


            </tbody>
          </table>

          @if(!$search && $list)
          <div class="">
            {{$list}}
          </div>
          @endif


        </div>
      </div>
    </div>
  </div>
</div>
@endsection