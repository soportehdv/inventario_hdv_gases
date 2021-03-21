@extends('adminlte::page')
@section('title', 'Proveedores')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Proveedores</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('proveedor.create.vista')}}" class="btn btn-primary mb-2">Añadir nuevo</a>
    <br>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
            <tr>
                <th scope="row">{{$proveedor->id}}</th>
                <td>{{$proveedor->nombre}}</td>
                <td>{{$proveedor->email}}</td>
                <td><a href="{{route('proveedor.update.vista', $proveedor->id)}}" class="btn btn-success mb-2">Editar</a>
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
