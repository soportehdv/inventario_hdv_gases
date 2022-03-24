@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Ingreso de productos</h2>
        </div>

    </div>

@endsection

@section('content')



    <div class="">
        <a href="{{ route('compras.create.vista') }}" class="btn btn-primary mb-2">Añadir nuevo</a>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
        <br>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Serial</th>
                    <th>Codigo</th>
                    <th>N° Registro</th>
                    <th>Color</th>
                    <th>m3</th>
                    <th>Fracción</th>
                    <th>Lote</th>
                    <th>Ingreso</th>
                    <th>Proveedor</th>
                    <th>Unidades</th>
                    <th>Precio Compra</th>
                    <th>Precio unitario</th>


                    <th>Acción</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <th>{{ $compra->id }}</th>
                        <td>{{ $compra->producto }}</td>
                        <td>{{ $compra->barras }}</td>
                        <td>{{ $compra->sanitario }}</td>
                        <td>{{ $compra->color }}</td>
                        <td>{{ $compra->present }}</td>
                        <td>{{ $compra->fraccion }}</td>
                        <td>{{ $compra->nlote }}</td>
                        <td>{{ $compra->fecha_ingreso }}</td>
                        <td>{{ $compra->proveedor }}</td>
                        <td>{{ $compra->unidades }}</td>
                        <td>${{ $compra->precio_compra }}</td>
                        <td>${{ $compra->costo_unitario }}</td>
                        <td><a href="{{ route('compras.update.vista', $compra->id) }}"
                                class="btn btn-success mb-2">Editar</a>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>



@endsection
