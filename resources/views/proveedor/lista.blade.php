@extends('adminlte::page')
@section('title', 'Proveedores')

@section('content_header')
    <div class="card" style="height:4em;">
        <div class="card-header">
            <h2>Proveedores</h2>
        </div>

    </div>
    @if ($search)
        <div class="alert alert-primary" role="alert">
            Los resultados para su busqueda '{{ $search }}' son:
            <button type="button" class="close" data-dismiss="alert" style="color:white">&times;</button>
        </div>
    @endif

@endsection

@section('content')

    <div class="container">
        <a href="{{ route('proveedor.create.vista') }}" class="btn btn-primary mb-2"><i class="fas fa-plus-circle"></i>
            Añadir
            nuevo</a>


        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if (Session::has('alert-' . $msg))
                <div class="alert {{ 'alert-' . $msg }} alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    {{ Session::get('alert-' . $msg) }}
                </div>
            @endif
        @endforeach
        <br>
        <table class="table table-striped table-res">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Empresa</th>
                    <th scope="col" style="background-color:#343a40; color:white">N° Remisión</th>
                    <th scope="col">Persona</th>
                    <th scope="col">Cilindros</th>
                    {{-- <th scope="col">Acción</th> --}}
                    <th scope="col">Ver</th>
                    <th scope="col">Descargar pdf</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($proveedores as $proveedor)
                    <tr>
                        <th scope="row">{{ $proveedor->id }}</th>
                        <td>{{ $proveedor->nombre }}</td>
                        <td>{{ $proveedor->remision }}</td>
                        <td>{{ $proveedor->persona }}</td>
                        <td>{{ $proveedor->Ncilindros }}</td>
                        {{-- <td><a href="{{route('proveedor.update.vista', $proveedor->id)}}" class="btn btn-success mb-2"><i class="fas fa-edit"></i> Editar</a>
                </td> --}}
                        <td><a href="{{ route('detalles.ver.remision', $proveedor->id) }}" class="btn btn-success mb-2"><i
                                    class="fas fa-edit"></i> Ver</a>
                        </td>
                        <td>
                            {{-- <a href="{{route('detalles.descargar.factura',$proveedor->id)}}" class="btn btn-primary mb-2"><i class="fas fa-edit"></i> PDF</a> --}}
                            <form method="GET" action="{{ route('detalles.descargar.factura',$proveedor->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-9">
                                        <select class="form-control" name="tipo" required>
                                            @foreach ($tipo as $tip)
                                                <option value="{{ $tip->id }}">{{ $tip->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <button type="submit" class="btn btn-primary">PDF</button>
                                    </div>
                                </div>
                            </form>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
