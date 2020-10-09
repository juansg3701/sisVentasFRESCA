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
              ['({{$pastels->nombre}}, {{$pastels->nombre_proveedor}})',{{$pastels->cantidad}}],
            @endforeach
      ]);

        

        var options = {  
          title: 'Gráfica de inventarios Productos-Proveedor'
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
   <a href="{{url('almacen/reportes/inventario2')}}" class="btn btn-danger">Volver</a>
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
              <th>NOMBRE</th>
              <th>PLU</th>
              <th>EAN</th>
              <th>SEDE</th>
              <th>PROVEEDOR</th>
              <th>CANTIDAD</th>
              <th>DISPONIBILIDAD</th>
              <th>FECHA REGISTRO</th> 
            </thead>
          @foreach($productos as $ps)
            <tr>
              <td>{{ $ps->id_stock}}</td>
              <td>{{ $ps->nombre}}</td>
              <td>{{ $ps->plu}}</td>
              <td>{{ $ps->ean}}</td>
              <td>{{ $ps->nombre_sede}}</td>
              <td>{{ $ps->nombre_proveedor}}</td>
              <td>{{ $ps->cantidad}}</td>
              @if($ps->disponibilidad=='1')
              <td>Disponible</td>
              @endif
              @if($ps->disponibilidad=='0')
              <td>No disponible</td>
              @endif
              <td>{{ $ps->fecha_registro}}</td>
            </tr>  
          @endforeach

          </table>
        </div>
      </div><br>
      </div>
@stop