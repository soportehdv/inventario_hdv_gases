<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <style>
            h1{
                text-align: center;
                text-transform: uppercase;
            }
            
        </style>
       
    </head>
    <body>
        <div class="container-fluid">
            <div class="row">
                <div style="font-size:40px; text-align:center; margin-bottom:-10px; margin-top:-25px;" class="col-sm-12">
                    <strong>Factura</strong>
                </div>

            </div>
            <hr>

            <span><strong>Monto total:</strong> ${{$venta->monto}} </span> <br>
            <span><strong>Monto sin impuesto:</strong> ${{($venta->monto*0.87)}}</span><br>
            <span><strong>Fecha y hora:</strong> {{($venta->created_at)}}</span> <br>
        
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Unidades</th>
                            <th scope="col">Precio</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($detalles as $detalle)
                        <tr>
                            <th scope="row">{{$detalle->id}}</th>
                            <td>{{$detalle->nombre}}</td>
                            <td>{{$detalle->unidades}}</td>
                            <td>${{($detalle->precio*$detalle->unidades)}}</td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        
    </div>

    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

</html>