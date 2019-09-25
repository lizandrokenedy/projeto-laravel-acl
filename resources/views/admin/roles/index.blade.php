@extends('layouts.app')

@section('content')
@page(['col'=>12, 'page'=>__('my.list', ['page'=>$page])])
  @alert(['msg'=>session('msg'), 'status'=>session('status')])
  @endalert

  @breadcrumb(['page'=>$page, 'items'=>$breadcrumb ?? []])
  @endbreadcrumb

  @search(['routeName'=>$routeName, 'search'=>$search])
  @endsearch

  @table(['columnList'=>$columnList, 'list'=>$list, 'routeName'=>$routeName])
  @endtable

  @paginate(['search'=>$search, 'list'=>$list])
  @endpaginate
@endpage
@endsection