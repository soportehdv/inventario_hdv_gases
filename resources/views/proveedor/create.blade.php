@extends('adminlte::page')
@section('title', 'Proveedores')

@section('content_header')
<div class="card">
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
                    <label for="exampleInputEmail1">Nombre </label>
                    <input type="text" class="form-control" name="name" value="{{(isset($proveedor))? $proveedor->nombre: ''}}" aria-describedby="emailHelp" placeholder="Nombre">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Email </label>
                    <input type="email" class="form-control" name="email" value="{{(isset($proveedor))?$proveedor->email:''}}" aria-describedby="emailHelp" placeholder="Ingresa email">
                  </div>
                
                <button type="submit" class="btn btn-primary">Agregar</button>
              </form>

        </div>
    </div>
    
</div>
@endsection
