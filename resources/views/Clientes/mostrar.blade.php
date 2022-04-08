@extends('adminlte::page')
@section('title', 'Responsables')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Lista de responsables</h2>
        </div>

    </div>
    

@endsection

@section('content')

    <div class="container">

        <div class="row">
            <div class="col-sm-8">
                <a href="{{ route('clientes.create.vista') }}" class="btn btn-primary mt-4"><i class="fas fa-plus-circle"></i> Añadir nuevo</a>

            </div>

            <div class="col-sm-2">
                <form method="GET" action="{{ route('clientes.lista') }}">
                    <label>Ordenar por:</label>
                    <select class="form-control" name="filtro">
                        <option value="1">Más recientes </option>
                        <option value="2">Alfabeticamente </option>
                        <option value="3">Estados </option>


                    </select>
            </div>
            <div class="col-sm-2" style="top: 0.4em">
                <button type="submit" class="btn btn-primary  mt-4"><i class="fas fa-search"></i> Buscar</button>

            </div>
            </form>

        </div>

    </div>
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
    <br>
    <div class="container">

    <table class="table table-striped table-res">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Responsable</th>
                <th scope="col">Cargo</th>
                <th scope="col">Recibió</th>
                <th scope="col">Cargo</th>
                <th scope="col">Ubicación</th>
                <th scope="col">Telefono</th>
                <th scope="col">Producto</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Estado</th>
                <th scope="col">Comentario</th>


                @if (Auth::user()->rol == "admin")
                <th scope="col">Acción</th>
                @endif

            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $cliente)
                <tr>
                    <th scope="row">{{ $cliente->id }}</th>
                    <td>{{ $cliente->responsable }}</td>
                    <td>{{ $cliente->cargo }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->cargorecibe }}</td>
                    <td>{{ $cliente->ubicacion }}</td>
                    <td>{{ $cliente->registro }}</td>
                    <td>{{ $cliente->nombrep }}</td>
                    <td>{{ $cliente->giro }}</td>
                    @if ($cliente->estado === 'pendiente')
                                <td>
                                    <span class="badge badge-pill badge-danger">Pendiente</span>
                                </td>
                            @else()
                                <td>
                                    <span class="badge badge-pill badge-success">Entregado</span>
                                </td>
                            @endif
                    <td style="max-width: 100px;
                    font-size: 16px;
                    overflow: hidden;
                    white-space: nowrap;
                    text-overflow: ellipsis;">
                        {{ $cliente->direccion }}
                    </td>

                    @if (Auth::user()->rol == "admin")
                    <td>
                        <a href="{{ route('clientes.update.vista', $cliente->id) }}"
                            class="btn btn-success mb-2" ><i class="fas fa-edit"></i></a>
                        
                    </td>
                    @endif

                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $clientes->links() }}

    </div>
    </div>
@endsection
