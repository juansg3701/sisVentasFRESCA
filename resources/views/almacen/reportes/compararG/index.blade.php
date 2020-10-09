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

            graficaCS[0]=parseInt(<?php echo $NoPagoD[0]->numero?>,10);
           graficaCS[1]=parseInt(<?php echo $NoPagoE[0]->numero?>,10);
          graficaCS[2]=parseInt(<?php echo $NoPagoP[0]->numero?>,10);
           graficaCS[3]=parseInt(<?php echo $NoPagoC[0]->numero?>,10);

           data.addRows([["Pago efectivo",graficaCS[0]]]);
           data.addRows([["Pago datafono",graficaCS[1]]]);
           data.addRows([["Pago pasarela",graficaCS[2]]]);
           data.addRows([["Pago cartera",graficaCS[3]]]);
          

        var options = {
          title: 'Gráfica de ventas No.1\nFecha registro: <?php echo $fechaR1?>\nId: <?php echo $id1?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);





          var graficaCS2 = [];


          var data2 = new google.visualization.DataTable();

           data2.addColumn('string', 'Producto');
           data2.addColumn('number', 'Cantidad');

            graficaCS2[0]=parseInt(<?php echo $NoPagoD2[0]->numero?>,10);
           graficaCS2[1]=parseInt(<?php echo $NoPagoE2[0]->numero?>,10);
          graficaCS2[2]=parseInt(<?php echo $NoPagoP2[0]->numero?>,10);
           graficaCS2[3]=parseInt(<?php echo $NoPagoC2[0]->numero?>,10);

           data2.addRows([["Pago efectivo",graficaCS2[0]]]);
           data2.addRows([["Pago datafono",graficaCS2[1]]]);
           data2.addRows([["Pago pasarela",graficaCS2[2]]]);
           data2.addRows([["Pago cartera",graficaCS2[3]]]);
          
           
        var options2 = {
          title: 'Gráfica de ventas No.2\nFecha registro: <?php echo $fechaR2?>\nId: <?php echo $id2?>'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);
      }
    </script>
   </head>
<div align="center"><h3>COMPARAR REPORTES DE VENTAS<h3></div>
{!! Form::open(array('url'=>'almacen/reportes/compararG','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

  <select name="id1" class="form-control" >
        @foreach($reportes as $r)
        <option value="{{$r->id_rVentas}}">No: {{$r->id_rVentas}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
      </select>
      <br>
      <select name="id2" class="form-control">
        @foreach($reportes as $r)
        <option value="{{$r->id_rVentas}}">No: {{$r->id_rVentas}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
      </select><br>


      <div align="center"><button type="submit" class="btn btn-info">Comparar Gráficas</button></div><br>
      
{!!Form::close()!!} 

       <div align="center"><a href="{{URL::action('reportesVentas@index',0)}}"><button class="btn btn-danger">Volver</button></a></div>
<body>

</body>
@stop


@section('tabla')
<div class="container">
<div class="col-sm-6">
  
   <div id="piechart" style="width: 500px; height: 500px;"></div>
</div>

<div class="col-sm-6">  
  <div id="piechart2" style="width: 500px; height: 500px;"></div></div>
</div>     
@stop