<div class="container">
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
						<head>
				<title>Usuario</title>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
			    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
			</head>

<div align="center"><h3>HORARIOS REGISTRADOS</h3></div>

@include('almacen.nomina.horario.filtro.search')
<div class="row">
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
							<td></td>
						</tr>
						
						@endforeach
					</table>
				</div>
				{{$nominas->render()}}

</div><br>
		</div>	
		</div>
	</div>
</div>
</div>