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
            <th scope="col">Nombre</th>
            <th scope="col">Tipo</th>
            <th scope="col">Departamento</th>
            <th scope="col">Registro</th>
            <th scope="col">NIT</th>
            <th scope="col">Giro</th>
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr>
                <th scope="row">{{$cliente->id}}</th>
                <td>{{$cliente->nombre}}</td>
                <td>{{$cliente->tipo}}</td>
                <td>{{$cliente->departamento}}</td>
                <td>{{$cliente->registro}}</td>
                <td>{{$cliente->nit}}</td>
                <td>{{$cliente->giro}}</td>


                <td><a href="{{route('clientes.update.vista', $cliente->id)}}" class="btn btn-success mb-2">Editar</a>
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
