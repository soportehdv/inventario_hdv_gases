@extends('adminlte::page')
@section('title', 'listaprecioss')

@section('content_header')
<div class="card" style="height:4em;">
    <div class="card-header">
      <h2>Lista precios</h2>
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
            <form method="POST" action="{{(!isset($listaprecios))? route('listaprecios.create'): route('listaprecios.update',$listaprecios->id)}}">
                @csrf
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="exampleInputEmail1">Título </label>
                        <input type="text" class="form-control" name="titulo" value="{{(isset($listaprecios))? $listaprecios->titulo: ''}}" aria-describedby="emailHelp" placeholder="Detallado, menudeo">

                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-success mb-2">Agregar</button>

              

               



              </form>

              

        </div>
    </div>
    
</div>
@endsection

