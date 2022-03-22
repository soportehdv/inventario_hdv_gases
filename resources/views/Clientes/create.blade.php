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
                                <label for="exampleInputEmail1">Nombre </label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ isset($cliente) ? $cliente->nombre : '' }}" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">

                                <div class="form-group">
                                    <label for="exampleInputEmail1">NIT </label>
                                    <input type="text" class="form-control" name="nit"
                                        value="{{ isset($cliente) ? $cliente->nit : '' }}" placeholder="nit">
                                </div>


                            </div>
                        </div>

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Registro </label>
                                <input type="text" class="form-control" name="registro"
                                    value="{{ isset($cliente) ? $cliente->registro : '' }}" placeholder="Registro">
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">DUI </label>
                                <input type="text" class="form-control" name="dui"
                                    value="{{ isset($cliente) ? $cliente->dui : '' }}" placeholder="Dui">
                            </div>

                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Departamento </label>
                                <input type="text" class="form-control" name="departamento"
                                    value="{{ isset($cliente) ? $cliente->departamento : '' }}"
                                    placeholder="Departamento">
                            </div>
                        </div>

                        <div class="col-sm-4">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Giro </label>
                                <input type="text" class="form-control" name="giro"
                                    value="{{ isset($cliente) ? $cliente->giro : '' }}" placeholder="Giro">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo de responsable </label>
                                <select class="form-control" name="tipo">
                                    {{-- <option value="coordinador">Coordinador</option>
                                    <option value="otros">Otros</option> --}}
                                    @foreach ($array as $item)
                                        <option value="{{ $item }}"
                                            @if ($cliente->tipo === $item) selected='selected' @endif>
                                            {{ $item }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea3">Dirección</label>
                                <textarea class="form-control" name="direccion" id="form"
                                    rows="4"> {{ isset($cliente) ? $cliente->direccion : '' }}</textarea>
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary">Agregar</button>
                </form>

            </div>
        </div>

    </div>
@endsection
