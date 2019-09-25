@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="row">

                        @can('consultar')
                            <a href="{{route('users.index')}}" style="text-decoration: none;">
                                <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                    <div class="card-header">{{__('my.list', ['page'=>__('my.user')])}}</div>
                                    <div class="card-body">
                                        <p class="card-text">{{__('my.description_card_user')}}</p>
                                    </div>
                                </div>
                            </a>   
                        @endcan
                        
                        <a class="ml-3" href="{{route('roles.index')}}" style="text-decoration: none;">
                                <div class="card text-white bg-success mb-3" style="max-width: 18rem;">
                                    <div class="card-header">{{__('my.list', ['page'=>__('my.roles')])}}</div>
                                    <div class="card-body">
                                        <p class="card-text">{{__('my.description_card_roles')}}</p>
                                    </div>
                                </div>
                            </a>
                        <a class="ml-3" href="{{route('permissions.index')}}" style="text-decoration: none;">
                            <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
                                <div class="card-header">{{__('my.list', ['page'=>__('my.permissions')])}}</div>
                                <div class="card-body">
                                    <p class="card-text">{{__('my.description_card_permission')}}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection