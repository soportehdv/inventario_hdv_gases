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

                <button type="button" onclick="aparece()" class="btn btn-primary mb-2">Agregar precio</button>
                <button type="submit" class="btn btn-success mb-2">Agregar</button>
                <div class="contenido"></div>



                @if($precios)
                    @foreach($precios as $precio)
                        <div class="form-group">
                            <div class="col-sm-6">
                                <input style="display:none;" type="text" class="form-control" name="id_viejos[]" value="{{$precio->id}}" aria-describedby="emailHelp" placeholder="Detallado, individual, al mayor" required>
                            </div>
                                <div class="row">
                                    
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="titulos_viejos[]" value="{{$precio->titulo}}" aria-describedby="emailHelp" placeholder="Detallado, individual, al mayor" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" step="0.01" class="form-control" name="precios_viejos[]" value="{{$precio->precio}}" aria-describedby="emailHelp" placeholder="Precio" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" step="0.01" class="form-control" name="unidades_viejos[]" value="{{$precio->unidades}}" aria-describedby="emailHelp" placeholder="Unidades" required>
                                    </div>
                                    <div class="col-sm-3">
                                        <select name="tipos_viejos[]" class="form-control">
                                            @if($precio->tipo == 'caja')
                                                <option value="caja" >Caja</option>
                                                <option value="unidad">Unidad</option>
                                                <option value="blister">Blister</option>

                                            @elseif($precio->tipo == 'unidad')
                                                <option value="unidad">Unidad</option>
                                                <option value="caja" >Caja</option>
                                                <option value="blister">Blister</option>


                                            @else
                                                <option value="blister">Blister</option>
                                                <option value="caja" >Caja</option>
                                                <option value="unidad">Unidad</option>

                                            @endif

                                    </div>
                                </div>
                        
                        </div>
                    @endforeach
                @endif



              </form>

              

        </div>
    </div>
    
</div>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

<script>
    
    function aparece() {
        
        $('.contenido').append('<div class="form-group"><div class="row"><div class="col-sm-3"><input type="text" class="form-control" name="titulos[]"   placeholder="Detallado, individual, al mayor" required></div><div class="col-sm-3"><input type="number" step="0.01" class="form-control" name="precios[]" value="" aria-describedby="emailHelp" placeholder="Precio" required></div><div class="col-sm-3"><input type="number" step="1" class="form-control" name="unidades[]" value="" placeholder="unidad" required></div><div class="col-sm-3"><select class="form-control" name="tipos[]"><option value="caja">Caja</option><option value="blister">Blister</option><option value="unidad">Unidad</option></select></div></div></div>')
    };
    

    </script>
