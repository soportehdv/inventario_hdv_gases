@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
<div class="card" style="height:4em;">
    <div class="card-header">
      <h2>Productos</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('listaprecios.create.vista')}}" class="btn btn-primary mb-2">Añadir nuevo</a>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg) 
      @if(Session::has('alert-' . $msg)) 
        <div class="alert {{'alert-' . $msg}} alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('alert-' . $msg) }} 
        </div>
        
        @endif 
    @endforeach 
    <br>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Título</th>
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($listas as $precios)
            <tr>
                <th scope="row">{{$precios->id}}</th>
                <td>{{$precios->titulo}}</td>

                <td><a href="{{route('listaprecios.update.vista', $precios->id)}}" class="btn btn-success mb-2">Editar</a>
                </td>
                

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
