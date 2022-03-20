@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Productos</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('productos.create.vista')}}" class="btn btn-primary mb-2">Añadir nuevo</a>
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
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Ubicacion</th>
            <th scope="col">Registro Sanitario</th>
            <th scope="col">Componente</th>
            <th scope="col">Cod barra</th>


            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <th scope="row">{{$producto->id}}</th>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->ubicacion}}</td>
                <td>{{$producto->registro}}</td>
                <td>{{$producto->componente}}</td>
                <td>{{$producto->cod_barra}}</td>

                <td>
                  <a href="{{route('productos.update.vista', $producto->id)}}" class="btn btn-success mb-2">Editar</a>
                </td>
                
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
