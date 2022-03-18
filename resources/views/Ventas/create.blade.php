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

<?php $i = 0; ?>

@foreach (['danger', 'warning', 'success', 'info'] as $msg) 
      @if(Session::has('alert-' . $msg)) 
        <div class="alert {{'alert-' . $msg}} alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('alert-' . $msg) }} 
        </div>
        
        @endif 
    @endforeach 
<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('ventas.create')}}">
                @csrf
                <div class="row ">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label for="">Cliente </label>
                            <select class="form-control" name="cliente_id">
                                <option value="0">Generico</option>
                                @foreach($clientes as $cliente)
                                    <option value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-3">Terminar venta</button>
                <button id="mas" onclick="aparece()" class="btn btn-primary mt-3">Agregar producto</button>

               
                <div id="venta">
                    <div class="row" >


                        <div class="col-sm-8">
                            <label for="">Lote </label>
                            <select class="form-control" name="lote_id[]">
                                @foreach($lotes as $lote)
                                    <option value="{{$lote->id}}">{{$lote->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-sm-4">
                            <label for="">Unidades </label>
                            <input type="number" class="form-control" name="unidades[]" required> 
                        </div>

                    </div>
                </div>

                <div id="nueva"></div>

                
               
              </form>

        </div>
    </div>
    
</div>
@endsection

<script>
var i = 0;
function aparece() {
    $button = ' <div class="row" ><div class="col-sm-8"><label for="">Lote </label><select class="form-control" name="lote_id[]">@foreach($lotes as $lote)<option value="{{$lote->id}}">{{$lote->nombre}} - ${{$lote->precio}}</option>@endforeach</select></div><div class="col-sm-4"><label for="">Unidades </label><input type="number" class="form-control" name="unidades[]" required> </div></div>'
  $('#nueva').append($button);
};
</script>

