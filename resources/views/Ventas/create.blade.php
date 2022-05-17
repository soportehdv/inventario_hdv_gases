@extends('adminlte::page')
@section('title', 'Ventas')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Ventas</h2>
        </div>

    </div>
    {{-- <link rel='stylesheet prefetch'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script> --}}


@endsection

@section('content')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <?php $i = 0; ?>

    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if (Session::has('alert-' . $msg))
            <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                {{ Session::get('alert-' . $msg) }}
            </div>
        @endif
    @endforeach
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('ventas.create') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-3">
                            <button type="submit" class="btn btn-success mt-3"><i class="fa fa-reply-all"
                                    aria-hidden="true"></i> Finalizar entrega</button>
                        </div>
                        
                    </div>
                    <br>


                    <table class="table">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Unidades</th>
                                <th><a href="javascript:void(0)" class="btn btn-success addRow">+</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    <select class="form-control" name="cliente_id[]" id="select-pendiente" required>
                                        @foreach ($clientes as $cliente)
                                            @if ($cliente->estado === 'pendiente')
                                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <select class="form-control" name="stock_id[]" required>
                                        @foreach ($stocks as $stock)
                                            @if ($stock->unidades != 0)
                                                <option value="{{ $stock->id }}">{{ $stock->producto }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </th>
                                <th>
                                    <input type="number" min="1" max="1" class="form-control" name="unidades[]" required>
                                </th>
                                <input type="hidden" class="form-control" name="user[]" value='{{Auth::user()->id}}'required>
                                <th><a href="javascript:void(0)" class="btn btn-danger deleteRow">-</a></th>                                
                            </tr>

                        </tbody>

                    </table>
                    <script>
                        $('thead').on('click', '.addRow', function(){
                            var tr = "<tr>"+
                                        "<th>"+
                                            "<select class='form-control' name='cliente_id[]' id='select-pendiente' required>"+
                                                "@foreach ($clientes as $cliente)"+
                                                    "@if ($cliente->estado === 'pendiente')"+
                                                        "<option value='{{ $cliente->id }}'>{{ $cliente->nombre }}</option>"+
                                                    "@endif"+
                                                "@endforeach"+
                                            "</select>"+
                                        "</th>"+
                                        "<th>"+
                                            "<select class='form-control' name='stock_id[]' required>"+
                                                "@foreach ($stocks as $stock)"+
                                                    "@if ($stock->unidades != 0)"+
                                                        "<option value='{{ $stock->id }}'>{{ $stock->producto }}</option>"+
                                                    "@endif"+
                                                "@endforeach"+
                                            "</select>"+
                                        "</th>"+
                                        "<th>"+
                                            "<input type='number' min='1' max='1' class='form-control' name='unidades[]' required>"+
                                        "</th>"+
                                        "<input type='hidden' class='form-control' name='user[]' value='{{Auth::user()->id}}'required>"+
                                        "<th><a href='javascript:void(0)' class='btn btn-danger deleteRow'>-</a></th>"+
                                    "</tr>"
                            $('tbody').append(tr);
                        });
                        $('tbody').on('click', '.deleteRow', function(){
                            $(this).parent().parent().remove();
                        });
                    </script>





                </form>
                <br>
                <h3 align="center">Pedidos pendientes</h3>

                        <div class="row" style="font-weight: 700">
                            <div class="col-sm-3">ID</div>
                            <div class="col-sm-3">Responsable</div>
                            <div class="col-sm-3">Producto</div>
                            <div class="col-sm-3">Cantidad</div>
                        </div>
                       
                    
                        <div class="row">
                    
                        @foreach ($clientes as $cliente)
                            @if ($cliente->estado === 'pendiente')
                                {{-- <tr> --}}
                                    <div class="col-sm-3">{{ $cliente->id }}</div>
                                    <div class="col-sm-3">{{ $cliente->nombre }}</div>
                                    <div class="col-sm-3">{{ $cliente->tipo }}</div>
                                    <div class="col-sm-3">{{ $cliente->cantidad }}</div>


                                {{-- </tr> --}}
                            @endif
                        @endforeach
                        </div>
                

            </div>
        </div>

    </div>

@endsection
