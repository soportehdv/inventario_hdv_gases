@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Productos</h2>
    </div>
    
  </div>
  @if ($search)
        <div class="alert alert-primary" role="alert">
            Los resultados para su busqueda '{{ $search }}' son:
            <button type="button" class="close" data-dismiss="alert" style="color:white">&times;</button>
        </div>
    @endif
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('productos.create.vista')}}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir nuevo</a>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg) 
      @if(Session::has('alert-' . $msg)) 
        <div class="alert {{'alert-' . $msg}} alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('alert-' . $msg) }} 
        </div>
        
        @endif 
    @endforeach 
    <br>
    <table class="table table-striped table-res">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Serial</th>
            <th scope="col">Nombre</th>
            <th scope="col">Registro Sanitario</th>
            <th scope="col">Presentación (m3)</th>
            <th scope="col">Color</th>
            <th scope="col">Cod barra</th>


            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <th scope="row">{{$producto->id}}</th>
                <td>{{$producto->serial}}</td>
                <td>{{$producto->nombre}}</td>
                <td>{{$producto->registro}}</td>
                <td>{{$producto->presentacion}}</td>
                <td>{{$producto->color}}</td>
                <td>{{$producto->cod_barra}}</td>

                <td>
                  <a href="{{route('productos.update.vista', $producto->id)}}" class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                </td>
                
            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
