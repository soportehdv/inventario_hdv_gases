@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
<div class="card">
    <div class="card-header">
      <h2>Usuarios</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{(!isset($user))? route('user.create'): route('user.update',$user->id)}}">
                @csrf
                <div class="form-group">
                  <label for="exampleInputEmail1">Email </label>
                  <input type="email" class="form-control" name="email" value="{{(isset($user))?$user->email:''}}" aria-describedby="emailHelp" placeholder="Ingresa email">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" class="form-control" name="password" value="{{(isset($user))? $user->password: ''}}" id="exampleInputPassword1" placeholder="Contraseña">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre </label>
                    <input type="text" class="form-control" name="name" value="{{(isset($user))? $user->name: ''}}" aria-describedby="emailHelp" placeholder="Nombre">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Rol </label>
                    <select class="form-control" name="rol">
                        <option value="admin">Admin</option>
                        <option value="inventario">Inventario</option>
                        <option value="ventas">Ventas</option>

                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Agregar</button>
              </form>

        </div>
    </div>
    
</div>
@endsection
