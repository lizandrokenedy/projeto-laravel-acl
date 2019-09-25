@extends('layouts.app')

@section('content')
@page(['col'=>12, 'page'=>__('my.add_user', ['page'=>$page_add])])
@alert(['msg'=>session('msg'), 'status'=>session('status')])
@endalert

@breadcrumb(['page'=>$page, 'items'=>$breadcrumb ?? []])
@endbreadcrumb

@form(['action'=>route($routeName.".store"), 'method'=>'POST'])
@include('admin.'.$routeName.'.form')
<button class="btn btn-primary btn-lg float-right" type="submit">{{__('my.add')}}</button>
@endform

@endpage
@endsection