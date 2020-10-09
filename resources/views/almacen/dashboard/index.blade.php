@extends ('layouts.admin')
@section ('contenido')
	
	
<head>
	<title>Proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([

          ['Task', 'Hours per Day'],
          ["<?php echo 'a'?>",<?php echo 3?>],
          ["<?php echo 'b'?>",<?php echo 1?>],
          ["<?php echo 'c'?>",<?php echo 5?>]


        ]);

        var options = {
          title: 'Gráfica de inventarios Productos-Proveedor',  
          is3D: true,        
           pieHole: 0.4,
           opacity: 0.2,
           hAxis: {
       textStyle:{color: '#FFF'}
}
        };


        var chart = new google.visualization.ColumnChart(document.getElementById('columnchart'));

        chart.draw(data, options);

         var chart2 = new google.visualization.PieChart(document.getElementById('piechart'));

        chart2.draw(data, options);

        var chart3 = new google.visualization.AreaChart(document.getElementById('areachart'));

        chart3.draw(data, options);
      }
    </script>
</head>
	<div class="col-sm-12">

			 

	</div>

@stop

@section('tabla')
<div class="container">
	<div class="col-sm-6">
<div id="areachart" style="width: 500px; height: 500px;"></div>
			 

	</div>
	<div class="col-sm-6">

			 <div id="columnchart" style="width: 500px; height: 500px;"></div>
	</div>

		<div class="col-sm-6">
			 <div id="piechart" style="width: 500px; height: 500px;"></div>

	</div>
  </div>
@stop