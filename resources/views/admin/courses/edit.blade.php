@extends('layouts.app')

@section('content')
@page(['col'=>12, 'page'=>__('my.edit_user', ['page'=>$page_edit])])
@alert(['msg'=>session('msg'), 'status'=>session('status')])
@endalert

@breadcrumb(['page'=>$page, 'items'=>$breadcrumb ?? []])
@endbreadcrumb

@form(['action'=>route($routeName.".update", $register->id), 'method'=>'PUT'])
@include('admin.'.$routeName.'.form')
<button class="btn btn-primary btn-lg float-right" type="submit">{{__('my.edit')}}</button>
@endform

@endpage
@endsection