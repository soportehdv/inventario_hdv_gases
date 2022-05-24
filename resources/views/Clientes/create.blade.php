@extends('adminlte::page')

@section('title', 'Responsables')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Crear nuevo pedido</h2>
        </div>

    </div>

@endsection
@php
// listado de tipos
$array = ['Coordinador', 'Camillero', 'Emfermero', 'administracion', 'otros'];
@endphp

@section('content')

    <div class="container">
        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
        <div class="card">
            <div class="card-body">
                <form id="form" method="POST" action="{{route('clientes.create')}}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Responsable </label>
                                <input type="text" class="form-control" name="responsable"
                                    value="{{ Auth::user()->name }}" placeholder="" disabled>
                            </div>
                        </div>

                    
                    <div class="col-sm-4">
                        <label for="">Ubicación </label>
                        <select id="departamento" name="departamento" class="form-control" required>
                            <option value="">Seleccioné una ubicación</option>
                            @foreach ($ubicacion as $ubi)
                                <option value="{{  $ubi->id }}" >
                                    {{ $ubi->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nombre recibe </label>
                            <input type="text" class="form-control" name="name"
                                value="" placeholder="Nombre" required>
                        </div>
                    </div>
                </div>

                    <div class="row">
                        

                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cargo recibe</label>
                                    <input type="text" class="form-control" name="cargorecibe"
                                        value="" placeholder="Cargo recibe" required>
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono </label>
                                <input type="text" class="form-control" name="registro"
                                    value="" placeholder="Telefono" required>
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <label for="">Tipo de gas </label>
                            <select id="tipo" name="tipo" class="form-control" required>
                                <option value="">Seleccioné un tipo de gas</option>        
                                <option value="oxigeno_8.5">Oxigeno 8.5</option>
                                <option value="aire_medicinal">Aire medicinal</option>
                                <option value="oxigeno_1m3">Oxigeno 1m3</option>
                                <option value="nitrogeno">Nitrogeno</option>
                                <option value="oxido_nitrico">Oxido nitrico</option>
                                <option value="dioxido_carbono">Dioxido carbono</option>
                                <option value="helontix">Helontix</option>
                            </select>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Cantidad </label>
                                <input type="number" min="1" class="form-control" name="cantidad"
                                    value="" placeholder="Cantidad" required>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea3">Comentario </label>
                                <textarea class="form-control" name="direccion" id="form"
                                    rows="4"></textarea>
                            </div>
                        </div>
                        
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>

            </div>
        </div>

    </div>
@endsection
