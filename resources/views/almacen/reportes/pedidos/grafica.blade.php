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
            @foreach ($pedidosCliente as $pastels)
              ['{{$pastels->id_remision}}',{{$pastels->noproductos}}],
            @endforeach
      	]);

        var options = {
          title: 'Gráfica de pedidos-cliente'
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
    	  <div align="center">
    	  	<a href="{{url('almacen/reportes/pedidos')}}" class="btn btn-danger">Volver</a>
    	  	</div>
  </div>
	
</body>
@stop


@section('tabla')

<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Remisión</th>
							<th>No. Productos</th>
							<th>Fecha de Solicitud</th>
							<th>Fecha de entrega</th>
							<th>Cliente</th>
							<th>Empleado</th>
							<th>Método de Pago</th>
							<th>Total</th>
						</thead>

						@foreach($pedidosCliente as $pc)
						<tr>
							<td>{{$pc->id_remision}}</td>
							<td>{{$pc->noproductos}}</td>
							<td>{{$pc->fecha_solicitud}}</td>
							<td>{{$pc->fecha_entrega}}</td>
							<!--<td>{{$pc->pago_inicial}}</td>-->
							<td>{{$pc->cliente}}</td>
							<td>{{$pc->empleado}}</td>
							<td>{{$pc->tipo_pago}}</td>
							<td>{{$pc->pago_total}}</td>
							

						</tr>
						@include('almacen.facturacion.listaPedidosClientes.modal')
						@endforeach


					</table>
				</div>
				{{$pedidosCliente->render()}}
			</div>
</div><br>
@stop