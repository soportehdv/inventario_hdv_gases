@extends('adminlte::page')
@section('title', 'Proveedores')

@section('content_header')
<div class="card" style="height:4em;">
    <div class="card-header">
      <h2>Proveedores</h2>
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
            <form method="POST" action="{{(!isset($proveedor))? route('proveedor.create'): route('proveedor.update',$proveedor->id)}}">
                @csrf
                
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre empresa</label>
                    <input type="text" class="form-control" name="name" value="{{(isset($proveedor))? $proveedor->nombre: ''}}" aria-describedby="emailHelp" placeholder="Nombre">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">N° remisión </label>
                    <input type="number" class="form-control" name="remision" value="{{(isset($proveedor))?$proveedor->remision:''}}" aria-describedby="emailHelp" placeholder="Ingresa Numero de remisión">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre quien entrega </label>
                    <input type="text" class="form-control" name="persona" value="{{(isset($proveedor))? $proveedor->persona: ''}}" aria-describedby="emailHelp" placeholder="Nombre quien entrega">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">N° de cilindros </label>
                  <input type="number" class="form-control" name="Ncilindros" value="{{(isset($proveedor))?$proveedor->Ncilindros:''}}" aria-describedby="emailHelp" placeholder="Cantidad de cilindros">
                </div>
                
                <button type="submit" class="btn btn-primary">Agregar</button>
              </form>

        </div>
    </div>
    
</div>
@endsection
