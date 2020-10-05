@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body></body>
@stop

@section('tabla')
<div align="center"><h3>HORARIOS REGISTRADOS</h3>

</div>
@include('almacen.nomina.datos.datos')
<div align="center">
	<a href="{{URL::action('HorarioNominaController@index',0)}}"><button class="btn btn-info"><i>Registrar Horario</i></button></a>
	<a href="" data-target="#modal-delete" data-toggle="modal"><button class="btn btn-success"><i>Descargar xls</i></button></a>
		<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
	<br>
</div>


@include('almacen.nomina.lista_horarios.search')

<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID</th>
							<th>NOMBRE</th>
							<th>FECHA</th>
							<th>HORA ENTRADA</th>
							<th>HORA SALIDA</th>
							<th>JORNADA</th>
							<th>No.HORAS</th>
							<th>PAGO</th>
							<th>HORAST</th>
							<th>PAGOT</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($nominas2 as $nom)
						<tr>
							<td>{{ $nom->id}}</td>
							<td>{{ $nom->empleado}}</td>
							<td>{{ $nom->fecha}}</td>
							<td>{{ $nom->horaentrada}}</td>
							<td>{{ $nom->horasalida}}</td>
							<td>{{ $nom->jornada}}</td>
							<td>{{ $nom->no_horas}}</td>
							<td>{{ $nom->pago_sem}}</td>
							<td>{{ $nom->hora_total}}</td>
							<td>{{ $nom->pago_total}}</td>
							<td>
								<a href="" data-target="#modal-delete-{{$nom->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.nomina.lista_horarios.modal')
						@endforeach
					</table>
				</div>
				{{$nominas2->render()}}
			</div>
</div><br>
@stop