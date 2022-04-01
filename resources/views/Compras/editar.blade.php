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
                <form method="POST" action="{{ route('compras.update', $compras->id) }}">
                    @csrf
                    <style>
                        .padding_center{
                            padding-left: 25%;
                        }
                        .texto_radio{
                            text-align: center;        
                        }
                        @media (min-width: 400px) and (max-width: 767px){
                            .padding_center{
                                padding-left: 0px;
                            }
                            .texto_radio{
                                text-align: left
                            }
                            .two-column{
                                width: 50%;
                                float: left;
                            }
                        }
                        @media (min-width: 768px) and (max-width: 1413px){
                            .padding_center{
                                padding-left: 15%;
                            }
                            .texto_radio{
                                text-align: center;
                                height: 57px;
                            }
                            
                        }
                    </style>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Fecha de ingreso </label>
                                <input type="date" class="form-control" name="fecha_ingreso"
                                    value="{{ $compras->fecha_ingreso }}">
                            </div>
                            
                            <div class="col-sm-4">
                                <label for="">N° Remisión </label>
                                <select id="proveedor" name="proveedor_id" class="form-control">
                                    <option value="">Seleccioné un N° de remision</option>
                                    @foreach ($provedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">
                                            @if ($compras->proveedor_id === $proveedor->id) selected='selected' @endif>
                                            {{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {{--  --}}
                            
                            <div class="col-sm-4">
                                <label for="">Lote </label>
                                <input type="number" min="0" class="form-control" name="lote"
                                    value="{{ $compras->lote }}" placeholder="Lote">
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Fecha Vencimiento </label>
                                <input type="date" class="form-control" name="fecha_vencimiento"
                                    value="{{ $compras->fecha_vencimiento }}">
                            </div>
                            <div class="col-sm-4">
                                <label for="">Serial </label>
                                <select id="producto" name="producto_id" class="form-control">
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id }}"
                                            @if ($compras->producto_id === $producto->id) selected='selected' @endif>
                                            {{ $producto->serial }}</option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-sm-4">
                                <label for="exampleInputEmail1">Cantidades </label>
                                <input type="number" min="0" class="form-control" name="unidades"
                                    value="{{ $compras->unidades }}" placeholder="Unidades">

                            </div>

                        </div>
                        <br>

                        <div class="row">
                            <div class="col-md-1 two-column">
                                <div class="texto_radio">
                                    <label for="exampleInputEmail1">Limpieza </label>
                                </div>
                                <div class="padding_center">
                                    <div class="custom-control">
                                        <input class="form-check-input" type="radio" value="{{$compras->limpieza}}" @if ('C' === $compras->limpieza) checked="checked" @endif id="radiolim" name="limpieza">
                                        <label class="form-check-label" for="radiolim">
                                            C
                                        </label>
                                    </div>
                                    <div class="custom-control">
                                        <input class="form-check-input" type="radio" value="{{$compras->limpieza}}" @if ('NC' === $compras->limpieza) checked="checked" @endif id="radiolim2" name="limpieza">
                                        <label class="form-check-label" for="radiolim2">
                                            NC
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 two-column">
                                <div class="texto_radio">
                                <label for="exampleInputEmail1">Sello y capuchon</label>
                                </div>
                                <div class="padding_center">
                                    <div class="custom-control custom-switch">
                                        <input class="form-check-input" type="radio" value="{{$compras->sello}}" @if ('C' === $compras->sello) checked="checked" @endif id="radioSello" name="sello">
                                        <label class="form-check-label" for="radioSello">
                                            C
                                        </label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input class="form-check-input" type="radio" value="{{$compras->sello}}" @if ('NC' === $compras->sello) checked="checked" @endif id="radioSello2" name="sello">
                                        <label class="form-check-label" for="radioSello2">
                                            NC
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 two-column">
                                <div class="texto_radio">
                                <label for="exampleInputEmail1" class="text-center2">Etiquetado de producto</label>
                                </div>
                                <div class="padding_center">
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->eti_producto}}" @if ('C' === $compras->eti_producto) checked="checked" @endif id="radioEtiP" name="eti_producto">
                                    <label class="form-check-label" for="radioEtiP">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->eti_producto}}" @if ('NC' === $compras->eti_producto) checked="checked" @endif id="radioEtiP2" name="eti_producto">
                                    <label class="form-check-label" for="radioEtiP2">
                                        NC
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2 two-column">
                                <div class="texto_radio">
                                <label for="exampleInputEmail1">Prueba hidrostatica</label>
                                </div>
                                <div class="padding_center">
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->prueba}}" @if ('C' === $compras->prueba) checked="checked" @endif id="radioPrueba" name="prueba">
                                    <label class="form-check-label" for="radioPrueba">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->prueba}}" @if ('NC' === $compras->prueba) checked="checked" @endif id="radioPrueba2" name="prueba">
                                    <label class="form-check-label" for="radioPrueba2">
                                        NC
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2 two-column">
                                <div class="texto_radio">
                                <label for="exampleInputEmail1">Estandar de pintura</label>
                                </div>
                                <div class="padding_center">
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->estandar}}" @if ('C' === $compras->estandar) checked="checked" @endif id="radioEstandar" name="estandar">
                                    <label class="form-check-label" for="radioEstandar">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->estandar}}" @if ('NC' === $compras->estandar) checked="checked" @endif id="radioEstandar2" name="estandar">
                                    <label class="form-check-label" for="radioEstandar2">
                                        NC
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-2 two-column">
                                <div class="texto_radio">
                                <label for="exampleInputEmail1">Etiqueta de lote </label>
                                </div>
                                <div class="padding_center">
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->eti_lote}}" @if ('C' === $compras->eti_lote) checked="checked" @endif id="radioEtiLote" name="eti_lote">
                                    <label class="form-check-label" for="radioEtiLote">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="{{$compras->eti_lote}}" @if ('NC' === $compras->eti_lote) checked="checked" @endif id="radioEtiLote2" name="eti_lote">
                                    <label class="form-check-label" for="radioEtiLote2">
                                        NC
                                    </label>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-1 two-column">
                                <div class="texto_radio">
                                <label for="exampleInputEmail1">Envase </label>
                                </div>
                                <div class="padding_center">
                                <div class="custom-control ">
                                    <input class="form-check-input" type="radio" value="{{$compras->integridad}}" @if ('C' === $compras->integridad) checked="checked" @endif id="radioIntegridad" name="integridad">
                                    <label class="form-check-label" for="radioIntegridad">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control ">
                                    <input class="form-check-input" type="radio" value="{{$compras->integridad}}" @if ('NC' === $compras->integridad) checked="checked" @endif id="radioIntegridad2" name="integridad">
                                    <label class="form-check-label" for="radioIntegridad2">
                                        NC
                                    </label>
                                </div>
                                </div>
                            </div>

                        </div>
                        <br>
                        <div class="col-sm-4">
                            <label for="">Estado </label>
                            <select id="estado_id" name="estado_id" class="form-control">
                                <option value="">Seleccioné una estado del producto</option>
                                @foreach ($estado as $estad)
                                    <option value="{{ $estad->id }}"
                                        @if ($compras->estado_id === $estad->id) selected='selected' @endif>
                                        {{ $estad->estado }}</option>
                                @endforeach
                            </select>
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
