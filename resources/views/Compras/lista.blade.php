@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Productos</h2>
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



    <div class="">
        <a href="{{ route('compras.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i> Añadir
            nuevo</a>
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <br>
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
                    <th>Remisión</th>
                    <th>Tipo</th>
                    <th>Lote</th>
                    <th>Vencimiento</th>
                    <th style="background-color:#343a40; color:white;">Serial</th>
                    <th>N° Registro</th>
                    <th>m3</th>
                    <th>Color</th>
                    <th>Unidades</th>
                    {{-- <th>Acción</th> --}}

                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <th>{{ $compra->id }}</th>
                        <td>{{ $compra->remision }}</td>
                        <td>{{ $compra->tipos }}</td>
                        <td>{{ $compra->lote }}</td>
                        <td>{{ $compra->fecha_vencimiento }}</td>
                        <td>{{ $compra->serial }}</td>
                        <td>{{ $compra->registro }}</td>
                        <td>{{ $compra->presentacion }}</td>
                        <td>{{ $compra->color }}</td>
                        <td>{{ $compra->uni }}</td>
                        {{-- <td><a href="{{ route('compras.update.vista', $compra->id) }}"
                                class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                        </td> --}}

                    </tr>
                @endforeach
                

            </tbody>
        </table>
        {{ $compras->links() }}

    </div>



@endsection
