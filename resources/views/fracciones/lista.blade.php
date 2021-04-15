@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Fracciones</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('fracciones.create.vista')}}" class="btn btn-primary mb-2">Añadir nuevo</a>
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
            <th scope="col">Unidad</th>
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($fracciones as $fraccion)
            <tr>
                <th scope="row">{{$fraccion->id}}</th>
                <td>{{$fraccion->nombre}}</td>
                <td>{{$fraccion->unidad}}</td>

                <td><a href="{{route('fracciones.update.vista', $fraccion->id)}}" class="btn btn-success mb-2">Editar</a>
                </td>
                

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
