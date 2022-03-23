@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Crear nuevo producto</h2>
        </div>

    </div>

@endsection

@section('content')



    <div class="container">
        <div class="row">

            <form method="GET" action="{{ route('compras.create') }}">
                <div class="input-group col-sm-8">
                    <div class="form-outline">
                        <input type="search" id="form1" class="form-control" placeholder="Buscar por serial" />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <br>


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
                <form method="POST" action="{{ route('compras.create') }}">
                    @csrf

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Proveedor </label>

                                <select name="proveedor_id" class="form-control">
                                    @foreach ($proveedores as $proveedor)
                                        <option value="">Seleccioné un proveedor</option>
                                        <option value="{{ $proveedor->id }}">
                                            {{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Fecha de ingreso </label>
                                <input type="date" class="form-control" name="fecha_ingreso" value="">
                            </div>

                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Fecha Vencimiento </label>
                                <input type="date" class="form-control" name="fecha_vencimiento" value="">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="">Producto </label>
                                <select id="producto" name="producto_id" class="form-control">
                                    <option value="">Seleccioné un producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}">
                                            {{ $producto->serial }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-sm-4">
                                <label for="">Fracción</label>
                                <select id="fraccion" name="fraccion_id" class="form-control">
                                    <option value="">Seleccioné una fracción</option>
                                    @foreach ($fracciones as $fraccion)
                                        <option value="{{ $fraccion->id }}">
                                            {{ $fraccion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <label for="">Precio compra </label>
                                <input type="number" min="0" class="form-control" name="precio_compra" value=""
                                    placeholder="Precio compra">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Unidades </label>
                            <input type="number" min="0" class="form-control" name="unidades" value=""
                                placeholder="Precio compra">

                        </div>

                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Número de lote </label>
                            <input type="number" min="0" class="form-control" name="nlote" value=""
                                aria-describedby="emailHelp" placeholder="Numero de lote">
                        </div>

                        <div class="col-sm-4">
                            <label for="exampleInputEmail1">Costo unitario </label>
                            <input type="number" min="0" class="form-control" name="costo_unitario" value=""
                                aria-describedby="emailHelp" placeholder="Valor unitario">
                        </div>
                    </div>
                    <br>
                    <input class="btn btn-success" type="submit" value="Ingresar" />

                </form>



            </div>
        </div>

    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
<script>
    $('.selectpicker').selectpicker({
        style: 'btn-default'
    });
</script>
