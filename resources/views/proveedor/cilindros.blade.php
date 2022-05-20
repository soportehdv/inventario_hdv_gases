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
    @foreach (['danger', 'warning', 'success', 'info'] as $msg) 
      @if(Session::has('alert-' . $msg)) 
        <div class="alert {{'alert-' . $msg}} alert-dismissable">
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          {{ Session::get('alert-' . $msg) }} 
        </div>
        
        @endif 
    @endforeach 
    <br>
    <table class="table table-striped table-res">
        <thead>
          <tr>
            <th scope="col">Remision</th>
            <th scope="col">Lote</th>
            <th scope="col">F-Ven.</th>
            <th scope="col">Serial</th>
            <th scope="col">Sanita.</th>
            <th scope="col">M3</th>
            <th scope="col">Color</th>
            <th scope="col">Limp.</th>
            <th scope="col">Sell</th>
            <th scope="col">Eti.</th>
            <th scope="col">hidro</th>
            <th scope="col">Pint.</th>
            <th scope="col">Eti.</th>
            <th scope="col">env.</th>
            <th scope="col">cant.</th>


          </tr>
        </thead>
        <tbody>
            @foreach($compras as $compra)
            <tr>
                <th>{{ $compra->remision }}</th>
                <td>{{ $compra->lote }}</td>
                <td>{{ $compra->fecha_vencimiento }}</td>
                <td>{{ $compra->producto }}</td>
                <td>{{ $compra->sanitario }}</td>
                <td>{{ $compra->present }}</td>
                <td>{{ $compra->color }}</td>
                <td>{{ $compra->limpieza }}</td>
                <td>{{ $compra->sello }}</td>
                <td>{{ $compra->eti_producto }}</td>
                <td>{{ $compra->prueba }}</td>
                <td>{{ $compra->estandar }}</td>
                <td>{{ $compra->eti_lote }}</td>
                <td>{{ $compra->integridad }}</td>
                <td>{{ $compra->uni }}</td>

            </tr>
          @endforeach
        </tbody>
      </table>
</div>
@endsection
