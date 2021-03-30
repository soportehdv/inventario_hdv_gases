@extends('adminlte::page')
@section('title', 'Lotes')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Lotes</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('lotes.create.vista',$producto_id)}}" class="btn btn-primary mb-2">Añadir nuevo</a>
    <br>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Cajas</th>
            <th scope="col">Unidades</th>
            <th scope="col">Precio compra</th>
            <th scope="col">Fecha_vence</th>
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($lotes as $lote)
            <tr>
                <th scope="row">{{$lote->id}}</th>
                <td>{{$lote->nombre}}</td>
                <td>{{$lote->stock}}</td>
                <td>{{$lote->unidades}}</td>
                <td>${{$lote->precio_compra}}</td>
                <td>{{$lote->fecha_vence}}</td>

                <td><a href="{{route('lotes.update.vista', $lote->id)}}" class="btn btn-success mb-2">Detalle</a>
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
