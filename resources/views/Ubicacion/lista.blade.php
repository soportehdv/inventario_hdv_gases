@extends('adminlte::page')
@section('title', 'Ubicaciones')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Ubicaciones</h2>
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
    <a href="{{route('listaubicacion.create.vista')}}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir nueva ubicación</a>
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
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($ubicacion as $ubi)
            <tr>
                <th scope="row">{{$ubi->id}}</th>
                <td>{{$ubi->nombre}}</td>

                <td><a href="{{route('listaubicacion.update.vista', $ubi->id)}}" class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                </td>
                

            </tr>
          @endforeach
        </tbody>
      </table>
      {{ $ubicacion->links() }}

</div>
@endsection
