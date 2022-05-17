@extends('adminlte::page')
@section('title', 'precios')

@section('content_header')
<div class="card" style="height:4em;">
    <div class="card-header">
      <h2>precios</h2>
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
            <form method="POST" action="{{(!isset($precio))? route('precios.create'): route('precios.update',$precio->id)}}">
                @csrf
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Nombre </label>
                        <input type="text" class="form-control" name="name" value="{{(isset($precio))? $precio->titulo: ''}}"  placeholder="Nombre">

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Precio </label>
                            <input type="number" class="form-control" step="0.01" name="precio" value="{{(isset($precio))? $precio->precio: ''}}" placeholder="Precio">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Unidades </label>
                            <input type="text" class="form-control" name="unidades" value="{{(isset($precio))? $precio->unidades: ''}}"  placeholder="Unidades">

                        </div>

                        <div class="col-sm-6">
                            <label for="exampleInputEmail1">Tipo (se vende por caja, unidad, etc) </label>
                            <select name="tipo" class="form-control">
                                <option value="unidades">Unidades</option>
                                <option value="caja">Caja</option>
                                <option value="blister">Bliser</option>


                            </select>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mb-2">Agregar</button>



               



              </form>

              

        </div>
    </div>
    
</div>
@endsection
