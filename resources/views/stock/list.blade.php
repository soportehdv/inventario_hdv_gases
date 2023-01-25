@extends('adminlte::page')
@section('title', 'Usuarios')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Almacen</h2>
        </div>

    </div>


@endsection

@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach


    <div class="container">

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Seleccione fechas para filtrar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="GET" action="{{ route('stock.fecha', ['filtro' => 4]) }}">
                            @csrf

                            <div class="form-group">
                                <label for="exampleInputPassword1">Fecha Inicial</label>
                                <input type="date" class="form-control" name="fecha_inicial" placeholder="Fecha inicial">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Fecha Final</label>
                                <input type="date" class="form-control" name="fecha_final" placeholder="Fecha final">
                            </div>

                            <button type="submit" class="btn btn-primary">Filtrar</button>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <form method="GET" action="{{ route('stock.list') }}">
                    <label>Ordenar por:</label>
                    <select class="form-control" name="filtro">
                        <option value="1">Hoy </option>
                        <option value="2">Más recientes </option>
                    </select>
            </div>

            <div class="col-sm-2" style="padding-top: 0.5em;">
                <button type="submit" class="btn btn-primary  mt-4">Buscar</button>

            </div>
            <!-- Button trigger modal -->
            <div class="col-sm-7" style="padding-top: 0.5em">

                <button type="button" class="btn btn-primary ajustarSize" data-toggle="modal" data-target="#exampleModal"
                    style="float: right"><i class="fas fa-filter"></i>
                    Filtrar por fecha
                </button>
            </div>

        </div>

        </form>





        <div class="container">
            <br>
            <table class="table table-res table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th style="background-color:#343a40; color:white;">Serial</th>
                        <th>Fecha_ingreso</th>
                        <th>Vencimiento</th>
                        <th>Un.</th>
                        <th>Tipo</th>
                        <th>Ubicacion</th>
                        <th>Estado</th>

                        @if (Auth::user()->rol == 'admin')
                            <th>Acción</th>
                        @endif


                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock as $stoc)
                        <tr>
                            <th>{{ $stoc->id }}</th>
                            <td style="text-transform: uppercase">{{ $stoc->serial }}</td>
                            <td>{{ $stoc->created_at }}</td>
                            <td>{{ $stoc->fecha_vencimiento }}</td>
                            <td>{{ $stoc->uni }}</td>
                            {{-- <td>{{ $stoc->lote }}</td> --}}
                            <td>{{ $stoc->tipos_n }}</td>
                            @if ($stoc->estado_ubi === 'Bodega')
                                <td>
                                    <span class="badge badge-pill badge-success">{{ $stoc->estado_ubi }}</span>
                                </td>
                            @else
                                <td>
                                    <span class="badge badge-pill badge-danger">{{ $stoc->estado_ubi }}</span>
                                </td>
                            @endif


                            @if ($stoc->estados === 'Vacio')
                                <td>
                                    <span class="badge badge-pill badge-danger">Vacio</span>
                                </td>
                            @elseif ($stoc->estados === 'Lleno')
                                <td>
                                    <span class="badge badge-pill badge-success">Lleno</span>
                                </td>
                            @elseif ($stoc->estados === 'En servicio')
                                <td>
                                    <span class="badge badge-pill badge-warning">En servicio</span>
                                </td>
                            @endif
                            @if (Auth::user()->rol == 'admin')
                                <td>
                                    <a href="{{ route('compras.update.Car', $stoc->id) }}" onclick="return confirm('¿Esta seguro que dese entregar al proveedor el cilindo con seria: ?{{$stoc->serial}}')"
                                        class="btn btn-primary mb-2"><i class="fas fa-shipping-fast"></i></a>
                                </td>
                            @endif

                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $stock->links() }}


        </div>



    @endsection
