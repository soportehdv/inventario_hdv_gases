@extends('adminlte::page')
@section('title', 'Ventas')

@section('content_header')
    <div class="card">
        <div class="card-header">
            <h2>Ventas</h2>
        </div>

    </div>
    {{-- <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'> --}}
    <link rel='stylesheet prefetch'
        href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css'>

    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> --}}
    {{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script> --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

@endsection

@section('content')

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
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success mt-3"><i class="fa fa-reply-all" aria-hidden="true"></i> Finalizar entrega</button>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-sm-12">
                        <button id="mas" onclick="aparece()" class="btn btn-primary mt-3"><i class="fa fa-plus-circle"></i> Adicionar otro producto</button>
                    </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="">Responsable </label>
                                <select class="form-control" name="cliente_id">
                                    {{-- <option value="0">Generico</option> --}}
                                    @foreach ($clientes as $cliente)
                                        <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            {{--  --}}
                        </div>
                    </div>


                    <div id="venta">
                        <div class="row">


                           
                            <div class="col-sm-4">
                                <label for="">Stock </label>
                                <select class="form-control" name="stock_id">
                                    @foreach ($stocks as $stock)
                                        <option value="{{ $stock->id }}">{{ $stock->producto }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="col-sm-4">
                                <label for="">Unidades </label>
                                <input type="number" class="form-control" name="unidades" required>
                            </div>

                        </div>
                    </div>




                </form>

            </div>
        </div>

    </div>
@endsection


