@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Usuarios</h2>
        </div>

    </div>
    @if ($search)
        <div class="alert alert-primary" role="alert">
            Los resultados para su busqueda '{{ $search }}' son:
            <button type="button" class="close" data-dismiss="alert" style="color:white">&times;</button>
        </div>
    @endif

@endsection

@section('content')



    <div class="container">
        <a href="{{ route('user.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir nuevo</a>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
        <br>
        <table class="table table-striped table-res">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Cargo</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Acción</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->cargo }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->rol }}</td>
                        <td><a href="{{ route('user.update.vista', $user->id) }}" class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
      {{ $users->links() }}

    </div>



@endsection
