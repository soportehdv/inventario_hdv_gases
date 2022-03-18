@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Usuarios</h2>
    </div>
    
  </div>
    
@endsection

@section('content')



<div class="container">
    <a href="{{route('compras.create.vista')}}" class="btn btn-primary mb-2">Añadir nuevo</a>
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
            <th>#</th>
            <th>fracion_id</th>
            <th>producto</th>
            <th>Fecha_ingreso</th>
            <th >precio compra</th>
            <th>vencimiento</th>
            <th>unidades</th>
            <th>lote</th>



            <th >Acción</th>

          </tr>
        </thead>
        <tbody>
            @foreach($stock as $stoc)
            <tr>
                <th>{{$stoc->id}}</th>
                <td>{{$stoc->fraccion}}</td>
                <td>{{$stoc->producto}}</td>
                <td>{{$stoc->fecha_ingreso}}</td>
                <td>${{$stoc->precio_compra}}</td>
                <td>{{$stoc->fecha_vencimiento}}</td>
                <td>{{$stoc->unidades}}</td>
                <td>{{$stoc->lote}}</td>
                <td><a href="#" class="btn btn-success mb-2">Editar</a>
                </td>

            </tr>
          @endforeach
         
        </tbody>
      </table>
</div>



@endsection