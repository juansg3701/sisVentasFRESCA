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
          title: 'Gráfica de inventarios Productos-Sede'
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
    <a href="{{url('almacen/reportes/inventario')}}" class="btn btn-danger">Volver</a>
  </div>

</body>
@stop


@section('tabla')

<div class="row">

      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>PLU</th>
              <th>EAN</th>
              <th>CATEGORÍA</th>
              <th>UNIDAD MEDIDA</th>
              <th>PRECIO</th>
              <th>IMPUESTO</th>
              <th>STOCK MÍNIMO</th>
              <th>FECHA REGISTRO</th>
             
            </thead>
            @foreach($productos as $ps)
            <tr>
              <td>{{ $ps->id_producto}}</td>
              <td>{{ $ps->nombre}}</td>
              <td>{{ $ps->plu}}</td>
              <td>{{ $ps->ean}}</td>
              <td>{{ $ps->categoria_id_categoria}}</td>
              <td>{{ $ps->unidad_de_medida}}</td>
              <td>{{ $ps->precio}}</td>
              <td>{{ $ps->impuestos_id_impuestos}}</td>
              <td>{{ $ps->stock_minimo}}</td>
              <td>{{ $ps->fecha_registro}}</td>
              
            </tr>   
            @endforeach
          </table>
        </div>
        {{$productos->render()}}
      </div>
      </div><br>
@stop