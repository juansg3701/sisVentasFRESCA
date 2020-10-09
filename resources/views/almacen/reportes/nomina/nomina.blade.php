@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Reportes</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Nómina</h3>
		</div>
	</div>


<div id=formulario>
		<div class="form-group" align="center">
			Nombre del empleado:
			@include('almacen.reportes.nomina.search')<br>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
		</div>
	</div>


</body>
@stop
@section('tabla')
<div class="container">
<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>Nombre Empleado</th>
							<th>No. Horas</th>
							<th>Pago Total</th>
							<th>Opciones</th>
							
						</thead>
						@foreach($usuarios as $usu)
						<tr>
							<td>{{ $usu->id_empleado}}</td>
							<td>{{ $usu->nombre}}</td>
							<td>{{ $usu->horaTotal}}</td>
							<td>{{ $usu->pagoTotal}}</td>
							<td>
							{!! Form::open(array('url'=>'almacen/nomina/lista_horarios','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
							<div align="">
								<input type="hidden" class="" name="searchText1" value="2020-01-01">
								<input type="hidden" class="" name="searchText2" value="<?php echo date("Y-m-d"); ?>">
								<input type="hidden" class="" name="searchText3" placeholder="Buscar..." value="{{$usu->id_empleado}}">
								<span class="">
									<button type="submit" class="btn btn-info">Ver Detalles</button>
								</span>
							</div><br>
							{{Form::close()}}
							</td>
							
							
						</tr>
						
						@endforeach
					</table>
				</div>
				{{$usuarios->render()}}
		</div><br>
		</div>
@stop