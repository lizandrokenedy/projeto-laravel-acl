@extends('layouts.app')

@section('content')
@page(['col'=>12, 'page'=>$page])
@alert(['msg'=>session('msg'), 'status'=>session('status')])
@endalert

<!-- Portfolio Grid -->
<div id="portfolio">
    <div class="container">
        <div class="row">
            @can('consultar')
            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" href="{{route('users.index')}}#portfolioModal1">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="img/portfolio/05-thumbnail.jpg" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>{{__('my.list', ['page'=>__('my.user')])}}</h4>
                    <p class="text-muted">{{__('my.description_card_user')}}</p>
                </div>
            </div>
            @endcan

            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" href="{{route('roles.index')}}#portfolioModal1">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="img/portfolio/04-thumbnail.jpg" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>{{__('my.list', ['page'=>__('my.roles')])}}</h4>
                    <p class="text-muted">{{__('my.description_card_roles')}}</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 portfolio-item">
                <a class="portfolio-link" href="{{route('permissions.index')}}#portfolioModal1">
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content">
                            <i class="fas fa-plus fa-3x"></i>
                        </div>
                    </div>
                    <img class="img-fluid" src="img/portfolio/03-thumbnail.jpg" alt="">
                </a>
                <div class="portfolio-caption">
                    <h4>{{__('my.list', ['page'=>__('my.permissions')])}}</h4>
                    <p class="text-muted">{{__('my.description_card_permission')}}</p>
                </div>
            </div>
        </div>
    </div>
</div>


@endpage


@endsection