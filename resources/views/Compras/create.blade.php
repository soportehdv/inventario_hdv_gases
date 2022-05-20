@extends('adminlte::page')
@section('title', 'Productos')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Crear nuevo producto</h2>
        </div>

    </div>

@endsection

@section('content')



    <div class="container">
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
                    <style>
                        .padding_center{
                            padding-left: 25%;
                        }
                        .texto_radio{
                            text-align: center;        
                        }
                        .upper{
                            text-transform: uppercase;
                        }
                        @media (min-width: 360px) and (max-width: 767px){
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
                            <div class="col-sm-3">
                                <label for="">N° Remisión </label>
                                <select id="proveedor" name="proveedor_id" class="form-control" required>
                                    <option value="">N° de remision</option>
                                    @foreach ($proveedores as $proveedor)                                    
                                        @if($proveedor->Ncilindros != $proveedor->contador)
                                                <option value="{{ $proveedor->id }}">
                                                    {{ $proveedor->remision }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="">Tipos </label>
                                <select id="tipo" name="tipo" class="form-control" required>
                                    <option value="">Seleccioné un tipo</option>
                                    @foreach ($tipo as $tip)
                                        <option value="{{ $tip->id }}">
                                            {{ $tip->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-3">
                                <label for="">Lote </label>
                                <input type="text" class="form-control upper" name="lote" value="" placeholder="Lote" required>
                            </div>                                          
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">Fecha Vencimiento </label>
                                <input type="date" class="form-control upper" name="fecha_vencimiento" value="" required>
                            </div>                         
                            

                        </div>
                        <br>
                        

                    <div class="row">
                        
                        <div class="col-sm-3">
                            <label for="exampleInputEmail1">Serial </label>
                        <input type="text" autocomplete="on" class="form-control upper" name="serial" value="{{(isset($producto))? $producto->serial: ''}}" aria-describedby="emailHelp" placeholder="Serial" required>
                        <ul id="lista_id"></ul>
                        </div>
                        <div class="col-sm-3">
                            <label for="">Registro sanitario </label>
                            <input type="text" class="form-control upper" name="registro" value="{{(isset($producto))? $producto->registro: ''}}" placeholder="Registro sanitario" required>
                        </div>
                        
                        <div>
                            @foreach ($proveedores as $pro)

                            <input type="hidden" class="form-control upper"  name="contador" value="{{$pro->contador}}">
                            @endforeach
                        </div>
                        <div class="col-sm-3">
                            <label for="">Presentación (m3) </label>
                        <input type="number" class="form-control upper" step="0.1" name="presentacion" value="{{(isset($producto))? $producto->presentacion: ''}}" placeholder="Presentación" required>

                        </div>
                        <div class="col-sm-3">
                            <label for="">Color </label>
                            <input type="text" class="form-control upper" name="color" value="{{(isset($producto))? $producto->color: ''}}" placeholder="Color" required>
                        </div>
                        

                        
                    </div>
                    {{-- <br> --}}
                        <div class="row">
                            

                    
                            <div class="col-sm-3">
                                <label for="exampleInputEmail1">Cantidades </label>
                                <input type="number" min="1" max="1" class="form-control upper" name="unidades" value=""
                                    placeholder="Unidades" required>

                            </div>                          

                            <div class="col-sm-3">
                                <label for="">Estado </label>
                                <select id="estado_id" name="estado_id" class="form-control" required>
                                    <option value="">Seleccioné una estado del producto</option>
                                    @foreach ($estado as $estad)
                                        <option value="{{ $estad->id }}">
                                            {{ $estad->estado }}</option>
                                    @endforeach
                                </select>
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
                                        <input class="form-check-input" type="radio" value="C" id="radiolim" name="limpieza" required>
                                        <label class="form-check-label" for="radiolim">
                                            C
                                        </label>
                                    </div>
                                    <div class="custom-control">
                                        <input class="form-check-input" type="radio" value="NC" id="radiolim2" name="limpieza" required>
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
                                        <input class="form-check-input" type="radio" value="C" id="radioSello" name="sello" required>
                                        <label class="form-check-label" for="radioSello">
                                            C
                                        </label>
                                    </div>
                                    <div class="custom-control custom-switch">
                                        <input class="form-check-input" type="radio" value="NC" id="radioSello2" name="sello" required>
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
                                    <input class="form-check-input" type="radio" value="C" id="radioEtiP" name="eti_producto" required>
                                    <label class="form-check-label" for="radioEtiP">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="NC" id="radioEtiP2" name="eti_producto" re<input class="form-check-input" type="radio" value="C" id="radioEtiP" name="eti_producto" required>
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
                                    <input class="form-check-input" type="radio" value="C" id="radioPrueba" name="prueba" required>
                                    <label class="form-check-label" for="radioPrueba">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="NC" id="radioPrueba2" name="prueba" required>
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
                                    <input class="form-check-input" type="radio" value="C" id="radioEstandar" name="estandar" required>
                                    <label class="form-check-label" for="radioEstandar">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="NC" id="radioEstandar2" name="estandar" required>
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
                                    <input class="form-check-input" type="radio" value="C" id="radioEtiLote" name="eti_lote" required>
                                    <label class="form-check-label" for="radioEtiLote">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control custom-switch">
                                    <input class="form-check-input" type="radio" value="NC" id="radioEtiLote2" name="eti_lote" required>
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
                                    <input class="form-check-input" type="radio" value="C" id="radioIntegridad" name="integridad" required>
                                    <label class="form-check-label" for="radioIntegridad">
                                        C
                                    </label>
                                </div>
                                <div class="custom-control ">
                                    <input class="form-check-input" type="radio" value="NC" id="radioIntegridad2" name="integridad" required>
                                    <label class="form-check-label" for="radioIntegridad2">
                                        NC
                                    </label>
                                </div>
                                </div>
                            </div>

                        </div>
                        <br>
                        



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
