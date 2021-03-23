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
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{(!isset($producto))? route('productos.create'): route('productos.update',$producto->id)}}">
                @csrf
                
                

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Nombre </label>
                    <input type="text" class="form-control" name="name" value="{{(isset($producto))? $producto->nombre: ''}}" aria-describedby="emailHelp" placeholder="Nombre">

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Código de barras </label>
                            <input type="text" class="form-control" name="cod_barra" value="{{(isset($producto))? $producto->cod_barra: ''}}" aria-describedby="emailHelp" placeholder="Código de barras">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Cantidad en stock </label>
                            <input type="number" class="form-control" name="stock" value="{{(isset($producto))? $producto->stock: ''}}" aria-describedby="emailHelp" placeholder="Cantidad en inventario">

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Fecha de vencimiento </label>
                            <input type="date" class="form-control" name="fecha_vence" value="{{(isset($producto))? $producto->fecha_vence: ''}}" aria-describedby="emailHelp" placeholder="Cantidad en inventario">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Costo de adquisición </label>
                            <input type="number" class="form-control" name="costo_compra" value="{{(isset($producto))? $producto->costo_compra: ''}}" aria-describedby="emailHelp" placeholder="Costo por el cual fue comprado">
                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Nombre del laboratorio </label>
                            <input type="text" class="form-control" name="laboratorio" value="{{(isset($producto))? $producto->laboratorio: ''}}" aria-describedby="emailHelp" placeholder="Nombre del laboratorio">
                           
                        </div>
                    </div>
                </div>

                
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Proveedor </label>
                            <select class="form-control" name="proveedor_id">
                                @foreach($proveedores as $proveedor)
                                    <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                                @endforeach
                            </select>

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Ubicación </label>
                            <input type="text" class="form-control" name="ubicacion" value="{{(isset($producto))? $producto->ubicacion: ''}}" aria-describedby="emailHelp" placeholder="Ubicación">
                        </div>
                        

                    </div>
                    
                </div>

                <button type="button" onclick="aparece()" class="btn btn-primary mb-2">Agregar precio</button>

                @if($precios)
                    @foreach($precios as $precio)
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input style="display:none;" type="text" class="form-control" name="id_viejos[]" value="{{$precio->id}}" aria-describedby="emailHelp" placeholder="Detallado, individual, al mayor" required>
                            </div>
                                <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="titulos_viejos[]" value="{{$precio->titulo}}" aria-describedby="emailHelp" placeholder="Detallado, individual, al mayor" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" class="form-control" name="precios_viejos[]" value="{{$precio->precio}}" aria-describedby="emailHelp" placeholder="Precio" required>
                                    </div>
                                </div>
                        
                        </div>
                    @endforeach
                @endif


                <div class="contenido"></div>

                <button type="submit" class="btn btn-success">Agregar</button>
              </form>

        </div>
    </div>
    
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script>
    
    function aparece() {
        
        $('.contenido').append('<div class="form-group"><div class="row"><div class="col-sm-6"><input type="text" class="form-control" name="titulos[]" value="" aria-describedby="emailHelp" placeholder="Detallado, individual, al mayor" required></div><div class="col-sm-6"><input type="number" class="form-control" name="precios[]" value="" aria-describedby="emailHelp" placeholder="Precio" required></div></div></div>')
    };
    

    </script>
