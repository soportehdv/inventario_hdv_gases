

@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Productos</h2>
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
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>
        <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>

    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{(!isset($producto))? route('compras.create'): route('productos.update',$producto->id)}}">
                @csrf
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Proveedor </label>
                           
                            <select name="proveedor_id" class="selectpicker form-control show-menu-arrow" 
                            data-style="form-control" 
                            data-live-search="true" 
                            title="-- Elige el proveedor --">
                                @foreach($proveedores as $proveedor)
                                    <option data-tokens="{{$proveedor->nombre}}" value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Fecha de ingreso </label>
                            <input type="date" class="form-control" name="fecha_ingreso" value="{{(isset($producto))? $producto->cod_barra: ''}}" >
                        </div>

                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Fecha Vencimiento </label>
                            <input type="date" class="form-control" name="fecha_vencimiento" value="{{(isset($producto))? $producto->cod_barra: ''}}" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="">Producto </label>
                            <select id="producto" name="producto_id" class="selectpicker form-control show-menu-arrow" 
                            data-style="form-control" 
                            data-live-search="true" 
                            title="-- Elige el Producto --">
                                @foreach($productos as $producto)
                                    <option data-tokens="{{$producto->nombre}}" value="{{$producto->id}}">{{$producto->nombre}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-sm-4">
                            <label for="">Fracción</label>
                            <select id="fraccion" name="fraccion_id" class="selectpicker form-control show-menu-arrow" 
                            data-style="form-control" 
                            data-live-search="true" 
                            title="-- Elige la fracción --">
                                @foreach($fracciones as $fraccion)
                                    <option data-tokens="{{$fraccion->nombre}}" value="{{$fraccion->id}}">{{$fraccion->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">
                            <label for="">Precio compra </label>
                            <input type="number" min="0" class="form-control" name="precio_compra" value="{{(isset($producto))? $producto->componente: ''}}" placeholder="Precio compra">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Unidades </label>
                        <input type="number" min="0" class="form-control" name="unidades" value="{{(isset($producto))? $producto->componente: ''}}" placeholder="Precio compra">

                    </div>

                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Número de lote </label>
                        <input type="number" min="0" class="form-control" name="nlote" value="{{(isset($producto))? $producto->cod_barra: ''}}" aria-describedby="emailHelp" placeholder="Código de barras">
                    </div>

                    <div class="col-sm-4">
                        <label for="exampleInputEmail1">Costo unitario </label>
                        <input type="number" min="0" class="form-control" name="costo_unitario" value="{{(isset($producto))? $producto->cod_barra: ''}}" aria-describedby="emailHelp" placeholder="Código de barras">
                    </div>
                </div>
                
               <input class="btn btn-success" type="submit" value="Comprar" />

              </form>

              

        </div>
    </div>
    
</div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script>
   
     $('.selectpicker').selectpicker({
    style: 'btn-default'
  });
   </script>

