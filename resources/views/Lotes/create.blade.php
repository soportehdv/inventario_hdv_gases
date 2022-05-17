@extends('adminlte::page')
@section('title', 'Lotes')

@section('content_header')
<div class="card" style="height:4em;">
    <div class="card-header">
      <h2>Nuevo Lote</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg) 
      @if(Session::has('alert-' . $msg)) 
        <div class="alert {{'alert-' . $msg}} alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('alert-' . $msg) }} 
        </div>
        
        @endif 
    @endforeach 
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{(!isset($lote))? route('lotes.create', $producto_id): route('lotes.update',$lote->id)}}">
                @csrf

                <div class="row">
                    <div class="col-sm-12">
                        <label>Proveedor</label>
                        <select name="proveedor_id" class="form-control">
                            @foreach($proveedores as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                            @endforeach
                        </select>

                    </div>
                    
                </div>
                
                

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Nombre </label>
                    <input type="text" class="form-control" name="name" value="{{(isset($lote))? $lote->nombre: ''}}" aria-describedby="emailHelp" placeholder="Nombre del lote">

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Fecha de vencimiento </label>
                            <input type="date" class="form-control" name="fecha_vence" value="{{(isset($lote))? $lote->fecha_vence: ''}}" aria-describedby="emailHelp" placeholder="Fecha de vencimiento">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Unidades </label>
                            <input type="number" class="form-control" name="unidades" value="{{(isset($lote))? $lote->unidades: ''}}" aria-describedby="emailHelp" placeholder="Cantidad (cajas) en inventario">

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Costo de adquisición </label>
                            <input type="number" class="form-control" name="precio_compra"  step="0.01" value="{{(isset($lote))? $lote->precio_compra: ''}}" aria-describedby="emailHelp" placeholder="Costo por el cual fue comprado el lote completo">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <label>Precio</label>
                        <select name="precio_id" class="form-control">
                            @foreach($precios as $precio)
                                <option value="{{$precio->id}}">{{$precio->titulo}}</option>
                            @endforeach
                        </select>

                    </div>
                    
                </div>

                <div class="form-group">
                    <label>En caso de aplicar...</label>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Cantidad de blister (por caja) </label>
                            <input type="number" class="form-control" name="blister" value="{{(isset($lote))? $lote->blister: ''}}" aria-describedby="emailHelp" placeholder="Cantidad de blister">

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Cantidad de unidades (por blister) </label>
                            <input type="text" class="form-control" name="unidad_blister" value="{{(isset($lote))? $lote->unidad_blister: ''}}" aria-describedby="emailHelp" placeholder="Nombre del laboratorio">
                           
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-success">Agregar</button>
              </form>

        </div>
    </div>
    
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

