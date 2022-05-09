@extends('adminlte::page')
@section('title', 'Ventas')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Ventas</h2>
        </div>

    </div>
    <link rel='stylesheet prefetch'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


@endsection

@section('content')


    <?php $i = 0; ?>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('ventas.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success mt-3"><i class="fa fa-reply-all"
                                    aria-hidden="true"></i> Finalizar entrega</button>
                        </div>
                    </div>
                    <br>
                    <div class="row">

                    </div>
                    <div class="row ">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Pendientes por entregar </label>
                                <select class="form-control" name="cliente_id" id="select-pendiente">
                                    <option value="">Seleccione persona para entregar producto</option>
                                    @foreach ($clientes as $cliente)
                                        @if ($cliente->estado === 'pendiente')
                                            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Stock </label>
                            <select class="form-control" name="stock_id">
                                @foreach ($stocks as $stock)
                                    @if ($stock->unidades != 0)
                                        <option value="{{ $stock->id }}">{{ $stock->producto }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="">Unidades </label>
                            <input type="number" class="form-control" name="unidades" required>
                        </div>

                    </div>


                   
                </form>
                <br>
                <h3 align="center">Pedidos pendientes</h3>

                <table class="table table-striped table-res">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Responsable</th>
                            <th scope="col">producto</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            @if ($cliente->estado === 'pendiente')
                                <tr>
                                    <th scope="row">{{ $cliente->id }}</th>
                                    <td>{{ $cliente->nombre }}</td>
                                    <td>{{ $cliente->direccion }}</td>

                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

    </div>

@endsection
