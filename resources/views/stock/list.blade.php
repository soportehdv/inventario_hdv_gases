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
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <a href="{{ route('ventas.create.vista') }}" class="btn btn-success mb-2">Vender</a>
                <a href="{{ route('ventas.descargar', ['filtro', 'fecha_inicio', 'fecha_final', 'id']) }}"
                    class="btn btn-primary mb-2">Descargar</a>
            </div>
        </div>
            <div class="row">
                <div class="col-sm-3">
                    <form method="GET" action="{{ route('stock.list') }}">
                        <label>Ordenar por:</label>
                        <select class="form-control" name="filtro">
                            <option value="1">Hoy </option>
                            <option value="4">Más recientes </option>
                            <option value="3">Antiguos </option>
                        </select>
                </div>

                <div class="col-sm-2" style="padding-top: 0.5em">
                    <button type="submit" class="btn btn-primary  mt-4">Buscar</button>

                </div>
                <!-- Button trigger modal -->
                <div class="col-sm-7" style="padding-top: 0.5em">

                {{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right">
                    Filtrar por fecha
                </button> --}}
                </div>
                
                <!-- Modal -->
                {{-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Seleccione fechas para filtrar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                              <form method="GET" action="{{route('stock.list', ['filtro' => 4])}}">
                                @csrf
                                
                                <div class="form-group">
                                  <label for="exampleInputPassword1">Fecha Inicial</label>
                                  <input type="date" class="form-control" name="fecha_inicial" placeholder="Fecha inicial">
                                </div>
                                
                                  <button type="submit" class="btn btn-primary">Filtrar</button>
                                
                              </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>

            </form>
        




        <div class="container">
            <a href="{{ route('compras.create.vista') }}" class="btn btn-success mb-2" style="float: right">Añadir
                nuevo</a>
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
                        <th>id</th>
                        <th>producto</th>
                        <th>Fecha_ingreso</th>
                        <th>vencimiento</th>
                        <th>unidades</th>
                        <th>lote</th>
                        <th>Estado</th>
                        <th>Acción</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($stock as $stoc)
                        <tr>
                            <th>{{ $stoc->id }}</th>
                            <td>{{ $stoc->producto }}</td>
                            <td>{{ $stoc->fecha_ingreso }}</td>
                            <td>{{ $stoc->fecha_vencimiento }}</td>
                            <td>{{ $stoc->unidades }}</td>
                            <td>{{ $stoc->lote }}</td>
                            @if ($stoc->estados === 'Vacio')
                                <td>
                                    <span class="badge badge-pill badge-danger">Vacio</span>
                                </td>
                            @else()
                                <td>
                                    <span class="badge badge-pill badge-success">Lleno</span>
                                </td>
                            @endif
                            {{-- <td>{{ $stoc->estados }}</td> --}}
                            <td><a href="{{ route('compras.update.vista', $stoc->id) }}"
                                    class="btn btn-primary mb-2">Editar</a>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>



    @endsection
