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

        graficaCS[0]=parseInt(<?php echo $tp[0]->ief?>,10);
        graficaCS[1]=parseInt(<?php echo $tp[0]->Eef?>,10);
        graficaCS[2]=parseInt(<?php echo $tp[0]->iel?>,10);
        graficaCS[3]=parseInt(<?php echo $tp[0]->Eel?>,10);
        graficaCS[4]=parseInt(<?php echo $tp[0]->bm?>,10);

        data.addRows([["Ingresos Efectivo",graficaCS[0]]]);
        data.addRows([["Egresos Efectivo",graficaCS[1]]]);
        data.addRows([["Ingresos Electrónicos",graficaCS[2]]]);
        data.addRows([["Egresos Electrónicos",graficaCS[3]]]);
        data.addRows([["Base Monetaria",graficaCS[4]]]);
          
        var options = {  
          title: 'Gráfica de caja'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
   </head>

<body>

  <div class="row">
       <div id="piechart" style="width: 620px; height: 300px;"></div>
  </div>

  <div align="center">
    <a href="{{URL::action('reportesCaja@index',0)}}"><button class="btn btn-danger">Volver</button></a>
  </div>

</body>
@stop


@section('tabla')
<div class="container">
<div class="row">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>ID</th>
              <th>FECHA</th>
              <th>BASE MONETARIA</th>
              <th>ING. EFECTIVO</th>
              <th>EGR. EFECTIVO</th>
              <th>ING. ELECTRONICO</th>
              <th>EGR. ELECTRONICO</th>
              <th>SEDE</th>
            </thead>
            @foreach($productos as $ps)
            <tr>
              <td>{{ $ps->id_caja}}</td>
              <td>{{ $ps->fecha}}</td>
              <td>{{ $ps->base_monetaria}}</td>
              <td>{{ $ps->ingresos_efectivo}}</td>
              <td>{{ $ps->egresos_efectivo}}</td>
              <td>{{ $ps->ingresos_electronicos}}</td>
              <td>{{ $ps->egresos_electronicos}}</td>
              <td>{{ $ps->sede}}</td>
            </tr>   
            @endforeach
          </table>
        </div>
        {{$productos->render()}}
      
      </div><br>
      </div>
@stop

