@extends ('layouts.admin')
@section ('contenido')
  <head>
  <title>Reportes</title>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
         document.getElementById("menuToggle").click();
      var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($ventas as $v)
                  ['{{$v->producto}}',{{$v->total}}],
            @endforeach
      ]);

        
        var options = {  
          title: 'Gráfica detallado de inventario por total'
        };


        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
     

      var data2 = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($ventas as $v)
                  ['{{$v->producto}}',{{$v->cantidad}}],
            @endforeach
      ]);

        
        var options2 = {  
          title: 'Gráfica detallado de inventario por cantidad'
        };


        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);
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
              <h2 class="pb-2 display-5">REPORTE DE INVENTARIO</h2>
            </div><br>
            <div class="row" align="center">  
                <div class="col-sm-12" align="center">
                 
                    <div class="row" align="center">
                            <div  class="col-sm-5" align="center">
                                 <div id="piechart" style="width: 600px; height: 300px;"></div>
                                 
                            </div>
                            <div  class="col-sm-6" align="center">
                            <div id="piechart2" style="width: 600px; height: 300px;"></div>
                            </div>
                    </div>
                    <div class="row" align="center">
                            <div class="col-sm-12">

                              <div align="center">
                                @if($tipo_reporte_detallado=="d")
                                 <br>
                                 <b> Inventario el d&iacute;a:</b><br>
                                  {{$fecha_d}}<br>
                                  <b>Total comprado:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                                @endif

                                @if($tipo_reporte_detallado=="s")
                                <br>
                                 <b> Inventario de la semana No:</b><br>
                                  {{$fecha_d}}<br>
                                  <b>Total comprado:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                                @endif

                                @if($tipo_reporte_detallado=="m")
                                <br>
                                 <b> Inventario del mes:</b><br>
                                  {{$fecha_d}}<br>
                                  <b>Total comprado:</b> $<?php echo number_format($total_ventas , 2 , "," , ".") . "\n";?><br>
                                @endif
                              </div>

                             <br>
                            <div align="center">
                              <a href="{{url('almacen/reportes/inventario')}}" class="btn btn-danger">Volver</a>
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


            <?php
                //$valores2=$fecha_d.'.'.'0'.'.'.'0'.'.'.'m';
                if($tipo_reporte_detallado=='d'){
                  $valores2=$fecha_d.'.'.'0'.'.'.'0'.'.'.'d';
                }else{
                  $valores2=$valor_clave.'.'.$valor_year.'.'.$valor_fecha_final.'.'.$valor_tipo;
                }
                
            ?>

             <div align="center">
              <a href="{{URL::action('reportesInventario@downloadExcelReport',$valores2)}}"><button class="btn btn-outline-success btn-sm">Descargar Excel</button></a>
              <a href="{{URL::action('reportesInventario@downloadPDFReport',$valores2)}}"><button class="btn btn-outline-danger btn-sm">Descargar PDF</button></a>
            </div>
      
            <table id="bootstrap-data-table" class="table table-striped table-bordered">
              <thead>
              <th>PRODUCTO</th>
              <th>CANTIDAD</th>
              <th>TOTAL</th>
            </thead>
            @foreach($ventas as $ps)
            <tr>
              <td>{{ $ps->producto}}</td>
              <td>{{ $ps->cantidad}}</td>

              <td>$<?php echo number_format($ps->total , 2 , "," , ".") . "\n";?></td>
            </tr>   
            @endforeach
          </table>
        </div>
        {{$ventas->render()}}
        </div>
      </div>
    </div>
  </div>
</div>

@stop