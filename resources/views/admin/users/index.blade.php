@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
          @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
          @endif

          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Lista de Usuários</li>
            </ol>
          </nav>

          <form class="form-inline" method="GET" action="{{route('users.index')}}">
            <div class="form-group mb-2">
              <a href="#">Adicionar</a>
            </div>
            <div class="form-group mx-sm-3 mb-2">
              <input type="search" class="form-control" name="search" placeholder="Busca" value="{{$search}}">
            </div>
            <button type="submit" class="btn btn-primary mb-2">Busca</button>
            <a class="btn btn-primary mb-2 ml-2" href="{{route('users.index')}}">Limpar</a>
          </form>

          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($list as $key => $value )

              <tr>
                <th scope="row">{{$value->id}}</th>
                <td>{{$value->name}}</td>
                <td>{{$value->email}}</td>
              </tr>
              @endforeach


            </tbody>
          </table>

          @if(!$search)
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