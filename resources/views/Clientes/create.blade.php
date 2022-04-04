@extends('adminlte::page')

@section('title', 'Responsables')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Crear nuevo responsable</h2>
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
                <form id="form" method="POST"
                    action="{{ !isset($cliente) ? route('clientes.create') : route('clientes.update', $cliente->id) }}">
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
                            <div class="form-group">
                                <label for="exampleInputEmail1">Estado </label>
                                {{-- @if ( $clientes->estado === 1) --}}
                                    {{-- <input type="text" class="form-control" name="estado"
                                        value="{{$cliente->estado}}"  disabled> --}}
                                        <input type="text" class="form-control" name="estado"
                                    value="{{ isset($cliente) ? $cliente->estado : '' }}">
                                {{-- @else
                                    <input type="text" class="form-control" name="estado"
                                        value="Entregado" disabled>
                                @endif --}}
                                
                            </div>

                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nombre recibe </label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ isset($cliente) ? $cliente->nombre : '' }}" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Cargo recibe</label>
                                    <input type="text" class="form-control" name="cargorecibe"
                                        value="{{ isset($cliente) ? $cliente->cargorecibe : '' }}" placeholder="Cargo recibe">
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Telefono </label>
                                <input type="text" class="form-control" name="registro"
                                    value="{{ isset($cliente) ? $cliente->registro : '' }}" placeholder="Telefono">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        

                        
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
                            <label for="">Producto </label>
                            <select id="producto" name="producto" class="form-control" required>
                                <option value="">Seleccioné un producto</option>
                                @foreach ($productos as $producto)
                                    <option value="{{  $producto->id }}" >
                                        {{ $producto->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Cantidad: </label>
                                <input type="text" class="form-control" name="giro"
                                    value="{{ isset($cliente) ? $cliente->giro : '' }}" placeholder="Cantidad">
                            </div>
                        </div>
                    </div>
                    

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea3">Comentario <span>(No es obligatorio)</span></label>
                                <textarea class="form-control" name="direccion" id="form"
                                    rows="4"> {{isset($cliente)?$cliente->direccion:''}}</textarea>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>

            </div>
        </div>

    </div>
@endsection
