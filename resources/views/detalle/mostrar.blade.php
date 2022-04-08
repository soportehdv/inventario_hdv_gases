@extends('adminlte::page')
@section('title', 'detalles')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>detalles</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <a href="{{ route('detalles.descargar.factura',$venta_id)}}" class="btn btn-primary mb-2">Descargar factura</a>

  
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
            <th scope="col">Producto</th>

           

          </tr>
        </thead>
        <tbody>
            @foreach($detalles as $detalle)
            <tr>
                <th scope="row">{{$detalle->id}}</th>
                <td>{{$detalle->nombre}}</td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
