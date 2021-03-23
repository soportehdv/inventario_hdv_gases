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
    <br>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Código</th>
            <th scope="col">Nombre</th>
            <th scope="col">Stock</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Laboratorio</th>
            <th scope="col">Fecha_vence</th>


            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
            <tr>
                <th scope="row">{{$producto->cod_barra}}</th>
                <td>{{$producto->producto_nombre}}</td>
                <td>{{$producto->stock}}</td>
                <td>{{$producto->nombre_proveedor}}</td>
                <td>{{$producto->laboratorio}}</td>
                <td>{{$producto->fecha_vence}}</td>

                <td><a href="{{route('productos.update.vista', $producto->id)}}" class="btn btn-success mb-2">Detalle</a>
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
