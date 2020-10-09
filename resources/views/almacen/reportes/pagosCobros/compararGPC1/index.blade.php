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

            graficaCS[0]=parseInt(<?php echo $atrasados[0]->atrasado?>,10);
        	graficaCS[1]=parseInt(<?php echo $pagos[0]->pago?>,10);

	        data.addRows([["Facturas Atrasadas",graficaCS[0]]]);
	        data.addRows([["Facturas Pagas",graficaCS[1]]]);
          

        var options = {
          title: 'Gráfica de facturas por pagar No.1\nFecha registro: <?php echo $fechaR1?>\nId: <?php echo $id1?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);





          var graficaCS2 = [];


          var data2 = new google.visualization.DataTable();

           	data2.addColumn('string', 'Producto');
           	data2.addColumn('number', 'Cantidad');


           	graficaCS2[0]=parseInt(<?php echo $atrasados2[0]->atrasado?>,10);
        	graficaCS2[1]=parseInt(<?php echo $pagos2[0]->pago?>,10);

	        data2.addRows([["Facturas Atrasadas",graficaCS2[0]]]);
	        data2.addRows([["Facturas Pagas",graficaCS2[1]]]);
          
           
        var options2 = {
          title: 'Gráfica de facturas por pagar No.2\nFecha registro: <?php echo $fechaR2?>\nId: <?php echo $id2?>'
        };

        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));

        chart2.draw(data2, options2);
      }
    </script>
   </head>
<div align="center"><h3>COMPARAR REPORTES DE FACTURAS POR PAGAR<h3></div>
{!! Form::open(array('url'=>'almacen/reportes/pagosCobros/compararGPC1','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

  <select name="id1" class="form-control" >
        @foreach($reportes as $r)
        <option value="{{$r->id_rpc}}">No: {{$r->id_rpc}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
      </select>
      <br>
      <select name="id2" class="form-control">
        @foreach($reportes as $r)
        <option value="{{$r->id_rpc}}">No: {{$r->id_rpc}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
      </select><br>


      <div align="center"><button type="submit" class="btn btn-info">Comparar Gráficas</button></div><br>
      
{!!Form::close()!!} 

       <div align="center"><a href="{{URL::action('reportesPC@index',0)}}"><button class="btn btn-danger">Volver</button></a></div>
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