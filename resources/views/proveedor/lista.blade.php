@extends('adminlte::page')
@section('title', 'Proveedores')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Proveedores</h2>
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
    <a href="{{route('proveedor.create.vista')}}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir nuevo</a>
    
    
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
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">N° Remisión</th>
            <th scope="col">Acción</th>
            <th scope="col">Descargas</th>


          </tr>
        </thead>
        <tbody>
            @foreach($proveedores as $proveedor)
            <tr>
                <th scope="row">{{$proveedor->id}}</th>
                <td>{{$proveedor->nombre}}</td>
                <td>{{$proveedor->remision}}</td>
                <td><a href="{{route('proveedor.update.vista', $proveedor->id)}}" class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                </td>
                <td><a href="{{route('detalles.descargar.factura',$proveedor->id)}}" class="btn btn-primary mb-2"><i class="fas fa-edit"></i> Descargar</a>
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
