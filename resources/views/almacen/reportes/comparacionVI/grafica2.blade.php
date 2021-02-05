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

          ['Task', 'Hours per Day'],
 
          ["<?php echo $grafican[0]->remision?>",<?php echo $graficac[0]->cantidad?>],
          ["<?php echo $grafican[1]->remision?>",<?php echo $graficac[1]->cantidad?>]
        ]);

        var options = {
          title: 'Gráfica de pedidos-proveedor'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
   </head>

<body>

	<div class="row">

			 <div id="piechart" style="width: 500px; height: 500px;"></div>

	</div>
	
</body>
@stop



@section('tabla')
<div class="container">
<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>No.Remisión</th>
							<th>No.Productos</th>
							<th>Fecha de solicitud</th>
							<th>Fecha de entrega</th>
							<!--<th>Pago inicial</th>-->
							<th>Proveedor</th>
							<th>Empleado</th>
							<th>Método de pago</th>
							<th>Pago total</th>
								
						</thead>

						@foreach($pedidosProveedor as $pc)
						<tr>
							<td>{{$pc->id_rproveedor}}</td>
							<td>{{$pc->noproductos}}</td>
							<td>{{$pc->fecha_solicitud}}</td>
							<td>{{$pc->fecha_entrega}}</td>
							<!--<td>{{$pc->pago_inicial}}</td>-->
							<td>{{$pc->proveedor}}</td>
							<td>{{$pc->empleado}}</td>
							<td>{{$pc->tipo_pago}}</td>
							<td>{{$pc->pago_total}}</td>


						</tr>
						@include('almacen.facturacion.listaPedidosProveedores.modal')
						@endforeach

					</table>
				</div>
				{{$pedidosProveedor->render()}}
			
			</div><br>
			</div>
			
@stop