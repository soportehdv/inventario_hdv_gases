@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Usuarios</h2>
        </div>

    </div>

@endsection

@section('content')

    <div class="container">
        @if ($errors->any())
            <ul style="padding: initial">
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <li>{{ $error }}</li>
                    </div>
                @endforeach
            </ul>
        @endif
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('user.update', $user->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email </label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}"
                            aria-describedby="emailHelp" placeholder="Ingresa email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" name="password" value="{{ $user->password }}"
                            aria-describedby="emailHelp" placeholder="Contraseña" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Confirmar contraseña</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            value="{{ $user->password }}" aria-describedby="emailHelp" placeholder="Confirmar contraseña"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nombre </label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}"
                            aria-describedby="emailHelp" placeholder="Nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Cargo </label>
                        <input type="text" class="form-control" name="cargo" value="{{ $user->cargo }}"
                            aria-describedby="emailHelp" placeholder="Cargo" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Rol </label>
                        <select class="form-control" name="rol" required>
                            @if ($user->rol === 'servicios')
                                <option value="{{ $user->rol }}">{{ $user->rol }}</option>
                                <option value="admin">Admin</option>
                            @else
                                <option value="{{ $user->rol }}">{{ $user->rol }}</option>
                                <option value="servicios">Servicios</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>

            </div>
        </div>

    </div>
@endsection
