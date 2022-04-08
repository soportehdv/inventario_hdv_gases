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

        {{-- <div class="row"> --}}

        
        {{-- <div class="small-box bg-info">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div> --}}



        {{-- </div> --}}

        <div class="flexbox-container">
            <div class="small-box bg-red" style="margin-right: 10px;">
                <div class="inner">
                    <h3>{{$clientes->count()}}</h3>           
                    <p>Pedidos</p>
                </div>
                <div class="icon">
                    <i class="fas fa-fw fa-chalkboard-teacher"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div class="small-box bg-info" style="margin-right: 10px;">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>

            <div class="small-box bg-info" style="margin-right: 10px;">
                <div class="inner">
                    <h3>150</h3>
                    <p>New Orders</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <a href="#" class="small-box-footer">
                    More info <i class="fas fa-arrow-circle-right"></i>
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
