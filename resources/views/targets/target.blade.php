@extends('adminlte::page')
@section('title', 'Inicio')

@section('content_header')
    <div class="card">
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
                        $i=0;
                    @endphp
                    @foreach ($clientes as $cliente)
                        @if($cliente->estado === 'pendiente')                    
                            @php
                                // $i= $loop->count
                                $i=$i+1
                            @endphp
                        @endif

                    @endforeach
                    <h3>{{$i}}</h3>

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
                        $j=0;
                    @endphp
                    @foreach ($stock as $stoc)
                        {{-- @if($cliente->estado === 'pendiente')                     --}}
                            @php
                                // $i= $loop->count
                                $j=$j+1
                            @endphp
                        {{-- @endif --}}

                    @endforeach
                    <h3>{{$j}}</h3>
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
                        $k=0;
                    @endphp
                    @foreach ($stock as $stoc)
                        @if($stoc->estado_id === 3)                    
                            @php
                                // $i= $loop->count
                                $k=$k+1
                            @endphp
                        @endif

                    @endforeach
                    <h3>{{$k}}</h3>
                    <p>En servicio</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-dolly"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Ver <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
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

            

        @endsection
