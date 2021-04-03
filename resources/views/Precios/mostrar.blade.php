@extends('adminlte::page')
@section('title', 'precioss')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Precios</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{route('precios.create.vista')}}" class="btn btn-primary mb-2">Añadir nuevo</a>
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
            <th scope="col">Precio x unidad</th>


            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($precios as $precio)
            <tr>
                
                <th scope="row">{{$precio->id}}</th>
                <td>{{$precio->titulo}}</td>
                <td>${{$precio->precio}} x {{$precio->unidades}} {{$precio->tipo}}</td>

                <td><a href="{{route('precios.update.vista', $precio->id)}}" class="btn btn-success mb-2">Editar</a>
                </td>
                

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
