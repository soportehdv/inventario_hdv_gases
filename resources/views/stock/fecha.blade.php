@extends('adminlte::page')
@section('title', 'Filtro')

@section('content_header')
<div class="card" style="height:4em;">
    <div class="card-header">
      <h2>Fechas</h2>
    </div>
    
  </div>
    
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{route('stock.list', ['filtro' => 2])}}">
                @csrf
                
                <div class="form-group">
                  <label for="exampleInputPassword1">Fecha Inicial</label>
                  <input type="date" class="form-control" name="fecha_inicial" placeholder="Fecha inicial">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Fecha final </label>
                    <input type="date" class="form-control" name="fecha_final" placeholder="Fecha final">
                  </div>
                
                <button type="submit" class="btn btn-primary">Agregar</button>
              </form>

        </div>
    </div>
    
</div>
@endsection



