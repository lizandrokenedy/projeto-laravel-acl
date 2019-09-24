@extends('layouts.app')

@section('content')
@page(['col'=>12, 'page'=>__('my.show_user', ['page'=>$page_edit])])
@alert(['msg'=>session('msg'), 'status'=>session('status')])
@endalert

@breadcrumb(['page'=>$page, 'items'=>$breadcrumb ?? []])
@endbreadcrumb

<p>Nome: {{$register->name}}</p>
<p>E-mail: {{$register->email}}</p>

@if($delete)
    @form(['action'=>route($routeName.".destroy", $register->id), 'method'=>'DELETE'])
        <button class="btn btn-danger btn-lg" type="submit">{{__('my.delete')}}</button>
    @endform
@endif


@endpage
@endsection