@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Clientes</title>
</head>

<body>

	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Reportes</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Valor bruto</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection

@section('tabla')
<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
				<h3 class="pb-2 display-5"> Reporte valor bruto</h3>
			</div><br>
					<div class="card-body">
						<div align="center"><a href="{{url('almacen/reportes/valorbruto')}}"><button class="btn btn-danger">Volver</button></a></div>
						<br>
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>Producto</th>
								<th>Compra total</th>
								<th>Venta total</th>
								<th>Utilidad mensual</th>
								<th>Margen bruto</th>
								<th>Mes</th>
								<th>A&ntilde;o</th>
							</thead>
							@foreach($productos as $pro)
							<tr>
								<td><?php echo $pro->nombre; ?></td>
								<td><?php echo $pro->precio_1; ?></td>
								<td><?php echo $pro->precio_2; ?></td>
								<td><?php echo $pro->precio_3; ?></td>
								<td><?php echo $pro->precio_4; ?>%</td>
								<td><?php echo $mes; ?></td>
								<td><?php echo $year; ?></td>
							</tr>
							@endforeach
						</table>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

