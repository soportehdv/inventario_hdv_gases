@extends('adminlte::page')
@section('title', 'Inicio')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Inicio</h2>
        </div>

    </div>


@endsection

@section('content')

    <div class="container">

        <div class="flexbox-container">
            <div class="small-box bg-red" style="margin-right: 10px;">
                <div class="inner">

                    @php
                        $i = 0;
                    @endphp
                    @foreach ($clientes as $cliente)
                        @if ($cliente->entregado === 0 )
                            @php
                                // $i= $loop->count
                                $i = $i + 1;
                            @endphp
                        @endif
                    @endforeach
                    <h3>{{ $i }}</h3>

                    <p>Pedidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                </div>
                <a href="{{ route('clientes.lista') }}" class="small-box-footer">
                    Ver <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div class="small-box bg-info" style="margin-right: 10px;">
                <div class="inner">
                    @php
                        $jj = 0;
                    @endphp
                    @foreach ($stock as $stoc)
                        @if ($stoc->status === 1)
                            @php
                                // $i= $loop->count
                                $jj = $jj + 1;
                            @endphp
                        @endif
                    @endforeach
                    <h3>{{ $jj }}</h3>
                    <p>Stock</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-warehouse"></i>
                </div>
                <a href="{{ route('stock.list') }}" class="small-box-footer">
                    Ver <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div class="small-box bg-warning" style="margin-right: 10px;">
                <div class="inner">
                    @php
                        $k = 0;
                    @endphp
                    @foreach ($stock as $stoc)
                        @if ($stoc->estado_id === 3)
                            @php
                                // $i= $loop->count
                                $k = $k + 1;
                            @endphp
                        @endif
                    @endforeach
                    <h3>{{ $k }}</h3>
                    <p>En servicio</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-dolly"></i>
                </div>
                <a href="{{ route('stock.list') }}" class="small-box-footer">
                    Ver <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <br>
        <br>
        <h2 align="center"><b>Cantidad en tipos</b></h2>
        <table class="table table-striped table-res">
            <thead align="center">
                <tr>
                    <th>OXIGENO 8.5</th>
                    <th>AIRE MEDICINAL</th>
                    <th>OXIGENO 1M3</th>
                    <th>NITROGENO</th>
                    <th>OXIDO NITRICO</th>
                    <th>DIOXIDO CARBONO</th>
                    <th>HELONTIX</th>

                </tr>
            </thead>
            <tbody align="center">
                <tr>
                    <th>
                        @php
                            $a = 0;
                        @endphp
                        @foreach ($compras as $compra)
                            @if ($compra->tipo === 1)
                                @php
                                    $a = $a + 1;
                                @endphp
                            @endif
                        @endforeach
                        <h3>{{ $a }}</h3>
                    </th>
                    <td>
                        @php
                            $b = 0;
                        @endphp
                        @foreach ($compras as $compra)
                            @if ($compra->tipo === 2)
                                @php
                                    $b = $b + 1;
                                @endphp
                            @endif
                        @endforeach
                        <h3>{{ $b }}</h3>
                    </td>
                    <td>
                        @php
                            $c = 0;
                        @endphp
                        @foreach ($compras as $compra)
                            @if ($compra->tipo === 3)
                                @php
                                    $c = $c + 1;
                                @endphp
                            @endif
                        @endforeach
                        <h3>{{ $c }}</h3>
                    </td>
                    <td>
                        @php
                            $d = 0;
                        @endphp
                        @foreach ($compras as $compra)
                            @if ($compra->tipo === 4)
                                @php
                                    $d = $d + 1;
                                @endphp
                            @endif
                        @endforeach
                        <h3>{{ $d }}</h3>
                    </td>
                    <td>
                        @php
                            $e = 0;
                        @endphp
                        @foreach ($compras as $compra)
                            @if ($compra->tipo === 5)
                                @php
                                    $e = $e + 1;
                                @endphp
                            @endif
                        @endforeach
                        <h3>{{ $e }}</h3>
                    </td>
                    <td>
                        @php
                            $f = 0;
                        @endphp
                        @foreach ($compras as $compra)
                            @if ($compra->tipo === 6)
                                @php
                                    $f = $f + 1;
                                @endphp
                            @endif
                        @endforeach
                        <h3>{{ $f }}</h3>
                    </td>
                    <td>
                        @php
                            $g = 0;
                        @endphp
                        @foreach ($compras as $compra)
                            @if ($compra->tipo === 7)
                                @php
                                    $g = $g + 1;
                                @endphp
                            @endif
                        @endforeach
                        <h3>{{ $g }}</h3>
                    </td>
                </tr>


            </tbody>
        </table>
        <style>
            .flexbox-container {
                display: -ms-flex;
                display: -webkit-flex;
                display: flex;
            }

            .flexbox-container>div {
                width: 33.3%;
                padding: 10px;
            }

        </style>

    </div>

@endsection
