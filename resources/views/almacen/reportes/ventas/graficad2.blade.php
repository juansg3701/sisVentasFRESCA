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
          title: 'Gráfica detallado de ventas por total'
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
          title: 'Gráfica detallado de ventas por cantidad'
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
              <h2 class="pb-2 display-5">REPORTE DE VENTAS</h2>
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
                           
                             <br>
                           <b> Ventas generadas el:</b><br>
                            {{$fecha_d}}<br>
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