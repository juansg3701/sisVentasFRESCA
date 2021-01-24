@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Reportes</title>
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

      var data = google.visualization.arrayToDataTable([
          ['Productos', 'mes'],
            @foreach ($productos as $pastels)
              ['{{$pastels->nombre}}',{{$pastels->stock_minimo}}],
            @endforeach
      ]);

  
      var options = {  
        title: 'Gráfica de inventario No.1\nFecha registro: <?php echo $fechaR1?>\nId: <?php echo $id1?>'
      };


      var chart = new google.visualization.PieChart(document.getElementById('piechart'));
      chart.draw(data, options);


    //////////////////////

      var data2 = google.visualization.arrayToDataTable([
          ['Productos2', 'mes'],
            @foreach ($productos2 as $pastels)
              ['{{$pastels->nombre}}',{{$pastels->stock_minimo}}],
            @endforeach
      ]);

  
      var options2 = {  
        title: 'Gráfica de inventario No.2\nFecha registro: <?php echo $fechaR2?>\nId: <?php echo $id2?>'
      };


      var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
      chart2.draw(data2, options2);


      }
    </script>
   </head>

<div align="center"><h3>COMPARAR REPORTES PRODUCTOS-SEDE<h3></div>
{!! Form::open(array('url'=>'almacen/reportes/compararGI1','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

  <select name="id1" class="form-control" >
        @foreach($reportes as $r)
        <option value="{{$r->id_rInventarios}}">No: {{$r->id_rInventarios}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
      </select>
      <br>
      <select name="id2" class="form-control">
        @foreach($reportes as $r)
        <option value="{{$r->id_rInventarios}}">No: {{$r->id_rInventarios}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
      </select><br>


      <div align="center"><button type="submit" class="btn btn-info">Comparar Gráficas</button></div><br>

{!!Form::close()!!} 

      <div align="center"><a href="{{URL::action('reportesInventario@index',0)}}"><button class="btn btn-danger">Volver</button></a></div>
 

</body>
@stop


@section('tabla')
<div class="container">

<div class="col-sm-6">  
   <div id="piechart" style="width: 500px; height: 500px;"></div>
</div>

<div class="col-sm-6">  
  <div id="piechart2" style="width: 500px; height: 500px;"></div>
</div>
 </div>    
@stop