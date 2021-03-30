@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Clientes</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('clientes.create.vista')}}" class="btn btn-primary mb-2">Añadir nuevo</a>
    <br>
    <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">DUI</th>
            <th scope="col">Nombre</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <th scope="row">{{$cliente->dui}}</th>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->email}}</td>
                <td>{{$cliente->telefono}}</td>
                <td><a href="{{route('clientes.update.vista', $cliente->id)}}" class="btn btn-success mb-2">Editar</a>
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
