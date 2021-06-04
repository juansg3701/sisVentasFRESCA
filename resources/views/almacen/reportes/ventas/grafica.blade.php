@extends ('layouts.admin')
@section ('contenido')
  <head>
  <title>Reportes</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

         var graficaCS = [];

          var data = new google.visualization.DataTable();

          data.addColumn('string', 'Producto');
          data.addColumn('number', 'Cantidad');

          graficaCS[0]=parseInt(<?php  if($NoPagoD[0]->numero==""){
                echo 0;}else{
                echo $NoPagoD[0]->numero;
                    }?>,10);
          graficaCS[1]=parseInt(<?php  if($NoPagoE[0]->numero==""){
                echo 0;}else{
                echo $NoPagoE[0]->numero;
                    }?>,10);
          graficaCS[2]=parseInt(<?php  if($NoPagoP[0]->numero==""){
                echo 0;}else{
                echo $NoPagoP[0]->numero;
                    }?>,10);

          data.addRows([["Pago datafono",graficaCS[0]]]);
          data.addRows([["Pago efectivo",graficaCS[1]]]);
          data.addRows([["Pago pasarela",graficaCS[2]]]);
          

        var options = {
          title: 'Gráfica de ventas'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
   </head>

<body>
<!--Formulario de búsqueda y opciones-->
  <div class="content">
    <div class="animated fadeIn">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header" align="center">
              <h2 class="pb-2 display-5">REPORTE DE VENTAS</h2>
            </div><br>
            <div class="row" align="center">  
                <div class="col-sm-12" align="center">
                 
                    <div class="row" align="center">
                            <div  class="col-sm-8" align="center">
                                 <div id="piechart" style="width: 620px; height: 300px;"></div>

                            </div>
                            <div class="col-sm-4">
                              <div align="center">
                                <?php 
                             $total_ventas=$NoPagoD[0]->numero+$NoPagoE[0]->numero+$NoPagoP[0]->numero;
                             ?> 
                             <br>
                           <b> Ventas generadas entre:</b><br>
                            {{$r->fechaInicial}} y {{$r->fechaFinal}}<br>
                            <b>Total ventas:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                              </div>
                             <br>
                            <div align="center">
                              <a href="{{url('almacen/reportes/ventas')}}" class="btn btn-danger">Volver</a>
                            </div>
                               
                            </div>

                          </div>
                  
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  
</body>
@stop


@section('tabla')


<!--Tabla de registros realizados-->
<div class="content">
  <div class="animated fadeIn">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header" align="center">
            <h3 class="pb-2 display-5">DETALLE DE REPORTE</h3>
            
            
          </div>

          <div class="card-body">
      
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>ID</th>
              <th>FECHA</th>
              <th>No. PRODUCTOS</th>
              <th>PAGO TOTAL</th>
              <th>METODO DE PAGO</th>
            </thead>
            @foreach($ventas as $ps)
            <tr>
              <td>{{ $ps->id_factura}}</td>
              <td>{{ $ps->fecha}}</td>
              <td>{{ $ps->noproductos}}</td>
              <td>{{ $ps->pago_total}}</td>
              <td>{{ $ps->tipo_pago_id_tpago}}</td>
            </tr>   
            @endforeach
          </table>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

@stop