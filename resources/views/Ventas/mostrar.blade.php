@extends('adminlte::page')
@section('title', 'Ventas')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Ventas</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

@foreach (['danger', 'warning', 'success', 'info'] as $msg) 
      @if(Session::has('alert-' . $msg)) 
        <div class="alert {{'alert-' . $msg}} alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('alert-' . $msg) }} 
        </div>
        
        @endif 
    @endforeach 
<div class="container">
  <div class="row">
    <div class="col-sm-12">
      <a href="{{route('ventas.create.vista')}}" class="btn btn-success mb-2">Vender</a>
    <a href="{{route('ventas.descargar', ['filtro', 'fecha_inicio', 'fecha_final', 'id'])}}" 
      class="btn btn-primary mb-2">Descargar</a>

      <div class="col-sm-2">
        <form method="GET" action="{{route('ventas.lista')}}">
          <label>Ordenar por:</label>
          <select class="form-control" name="filtro">
            <option value="6">Hoy </option>
            <option value="4">Más recientes </option>
            <option value="5">Antiguos </option>
  
          </select>
      </div>
      <div class="col-sm-2">
        <button type="submit" class="btn btn-primary  mt-4">Buscar</button>
  
      </div>
    </form>
    </div>

  </div>
    

      

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
            <th scope="col">Cliente</th>
            <th scope="col">Monto</th>
            <th scope="col">Fecha</th>
            <th scope="col">Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($ventas as $venta)
            <tr>
                <th scope="row">{{$venta->id}}</th>
                <td>{{$venta->cliente}}</td>
                <td>${{$venta->monto}}</td>
                <td>{{$venta->Fecha}}</td>

                <td><a href="{{route('ventas.detalle', $venta->id)}}" class="btn btn-success mb-2">Detalle</a>
                </td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
