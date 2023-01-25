<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>N° {{ $proveedor->nombre }}</title>
    <style>
        body,
        div,
        table,
        thead,
        tbody,
        tfoot,
        tr,
        th,
        td,
        p {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-size: 8px
        }

        a.comment-indicator:hover+comment {
            background: #ffd;
            position: absolute;
            display: block;
            border: 1px solid black;
        }

        a.comment-indicator {
            background: red;
            display: inline-block;
            border: 1px solid black;
            width: 0.3em;
        }

        comment {
            display: none;
        }

        .verticalText {
            writing-mode: vertical-lr;
            transform: rotate(-90deg);
        }

        /* footer {
            position: fixed;
            bottom: 5cm;
            left: 0cm;
            right: 0cm;
        }
        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
        } */
        /**
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
        @page {
            margin: 0cm 0cm;
        }

        /** Defina ahora los márgenes reales de cada página en el PDF **/
        body {
            margin-top: 4.1cm;
            margin-left: 1cm;
            margin-right: 1cm;
            margin-bottom: 6cm;
        }

        /** Definir las reglas del encabezado **/
        header {
            position: fixed;
            top: 1cm;
            left: 1cm;
            right: 1cm;
            height: 4cm;
            /** Estilos extra personales **/
        }

        /** Definir las reglas del pie de página **/
        footer {
            position: fixed;
            bottom: 0cm;
            left: 1cm;
            right: 1cm;
            height: 6cm;
            /** Estilos extra personales **/
        }
        main{
            left: 1cm;
            right: 1cm;
        }

        .center-ajuste {
            font-size: 7.5px;
            text-align: center;
            line-height: 150%;
        }

        .rotate {
            text-align: center;
            /* white-space: normal; */
            white-space: nowrap;
            vertical-align: middle;
            width: 3em;
            height: 7em;
        }

        .rotate div {
            -moz-transform: rotate(-90.0deg);
            /* FF3.5+ */
            -o-transform: rotate(-90.0deg);
            /* Opera 10.5 */
            -webkit-transform: rotate(-90.0deg);
            /* Saf3.1+, Chrome */
            filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);
            /* IE6,IE7 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
            /* IE8 */
            margin-left: -10em;
            margin-right: -10em;
        }

        .page-break {
            page-break-after: always;
        }

        th {
            padding: 5px;
        }

    </style>


</head>

<body>
    {{-- HEADER PDF --}}
    {{-- <header>

    </header> --}}
    <header>
        <table style="width: 100%">
            <colgroup width="169"></colgroup>
            <colgroup width="354"></colgroup>
            <colgroup width="124"></colgroup>
            <colgroup width="101"></colgroup>
            <colgroup width="148"></colgroup>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-right: 1px solid #000000;border-left: 1px solid #000000"
                    rowspan=2 height="30" align="center" valign=middle>
                    <img src="http://www.hdv.gov.co/images/logos/logoHDV1.png" width="158" height="50">
                </td>
                <td style="width:65%; border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center" valign=middle><b style="font-size: 10px">HOSPITAL DEPARTAMENTAL DE VILLAVICENCIO
                        E.S.E. </b></td>
                <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center" valign=middle><b>CÓDIGO FR-SF-149</b></td>
                <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center" valign=middle><b>VERSIÓN 1</b></td>
                <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center" valign=middle><b>PÁGINA 1 DE 1</b></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center" valign=middle><b style="font-size: 10px">FORMATO DE RECEPCIÓN TECNICA DE GASES </b>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    colspan=3 align="center" valign=middle><b>FECHA DE VIGENCIA 19/01/2021</b></td>
            </tr>
        </table>
        <br>
        <div style="left;"><b style="font_size:10px">FECHA (dd-mm-aaaa): </b> <b
                style="text-decoration:underline; font_size:11px; text-transform: uppercase">{{ \Carbon\Carbon::parse($proveedor->created_at)->format('d/m/Y') }}</b>
        </div>
        <br>
        <table style="width: 100%">
            <tr>
                <td><b style="font_size:10px">GAS MEDICINAL </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:<b
                        style="text-decoration:underline; font_size:11px; text-transform: uppercase">{{ $tipo->nombre_id }}</b>
                </td>
                <td><b style="font_size:10px">N° DE CILINDROS: </b><b
                        style="text-decoration:underline; font_size:11px; text-transform: uppercase">{{ $conteo }}</b>
                </td>
                <td><b style="font_size:10px">EMPRESA QUE ENTREGA: </b><b
                        style="text-decoration:underline; font_size:11px; text-transform: uppercase">{{ $proveedor->nombre }}</b>
                </td>
                <td><b style="font_size:10px">NOMBRE DE QUIEN ENTREGA: </b><b
                        style="text-decoration:underline; font_size:11px; text-transform: uppercase">{{ $proveedor->persona }}</b>
                </td>
            </tr>
        </table>
    </header>

    <footer>
        <table style="width: 100%;">

            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    colspan=7 height="10" align="center"><b>OXIGENO LIQUIDO</b></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-left: 1px solid #000000;width:20%" height="10"
                    align="right">FECHA </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-left: 1px solid #000000" align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    rowspan=2 align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    rowspan=2 align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    rowspan=2 align="center"><br></td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000;width: 20%" height="10"
                    align="left" font size="1">PARAMETRO</font>
                </td>
                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-bottom: 1px solid #000000; border-left: 1px solid #000000" align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">NOMBRE DE QUIEN ENTREGA</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">LOTE </font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">NIVEL INICIAL (Kg)</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">NIVEL FINAL (Kg)</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">CANTIDAD (Kg)</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">CERTIFICADO DE CALIDAD</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">PRESI&Oacute;N</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">REALIZA</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
            <tr>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    height="10" align="left" font size="1">REVISA</font>
                </td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="left"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000"
                    align="center"><br></td>
                <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                    align="center"><br></td>
            </tr>
        </table>
        <div style="position:fixed; bottom: 0cm; right: 2cm;left: 2cm;">
            <p>
                C=CONFORME
                <br>
                NC=NO CONFORME
            </p>
        </div>
    </footer>

    <br>
    {{-- CONTENIDO PDF --}}
    <main>
        <table class="table table-striped table-res">
            <thead>
                <tr>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">
                        <p class="center-ajuste">No DE <br>REMISIÓN</p>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">
                        <p class="center-ajuste">LOTE</p>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">
                        <p class="center-ajuste">FECHA DE VENCIMIENTO</p>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">
                        <p class="center-ajuste">SERIAL</p>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">
                        <p class="center-ajuste">No REGISTRO SANITARIO</p>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">PRESENTACION <br>(M3)</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">COLOR</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">LIMPIEZA</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">SELLO Y <br>CAPUCHON</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">ETIQUETA DE <br>PRODUCTO</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">PRUEBA <br>HIDROSTATICA <br>(&lt; 5 AÑOS)</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">ESTANDAR <br>DE PINTURA</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">ETIQUETA <br>DE LOTE</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">INTEGRIDAD <br>DEL ENVASE</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">CANTIDAD</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">
                        <p class="center-ajuste">REALIZA</p>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000">
                        <p class="center-ajuste">REVISA</p>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">APROBADO</div>
                    </th>
                    <th scope="col"
                        style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000"
                        class='rotate'>
                        <div class="center-ajuste">RECHAZADO
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($compras as $compra)
                    <tr>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->remision }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->lote }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->fecha_vencimiento }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->producto }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->sanitario }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->presentacion }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->color }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->limpieza }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->sello }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->eti_producto }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->prueba }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->estandar }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->eti_lote }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->integridad }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->uni }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle></td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle></td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->aprobado }}</td>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000; border-bottom: 1px solid #000000;"
                            align="center" valign=middle>{{ $compra->rechazado }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
    {{-- FOOTER PDF --}}
    {{-- <footer>

    </footer> --}}

</body>

</html>
