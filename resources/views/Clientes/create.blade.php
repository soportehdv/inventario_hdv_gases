@extends('adminlte::page')
@section('title', 'Clientes')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Nuevo cliente</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{(!isset($cliente))? route('clientes.create'): route('clientes.update',$cliente->id)}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">DUI </label>
                    <input type="text" class="form-control" name="dui" value="{{(isset($cliente))? $cliente->dui: ''}}" aria-describedby="emailHelp" placeholder="Dui">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre </label>
                    <input type="text" class="form-control" name="name" value="{{(isset($cliente))? $cliente->nombre: ''}}" aria-describedby="emailHelp" placeholder="Nombre">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Email </label>
                  <input type="email" class="form-control" name="email" value="{{(isset($cliente))?$cliente->email:''}}" aria-describedby="emailHelp" placeholder="Ingresa email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">telefono</label>
                  <input type="text" class="form-control" name="telefono" value="{{(isset($cliente))? $cliente->telefono: ''}}" id="exampleInputPassword1" placeholder="telefono">
                </div>
               
                
                <button type="submit" class="btn btn-primary">Agregar</button>
              </form>

        </div>
    </div>
    
</div>
@endsection
