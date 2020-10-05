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
			<body>
				<div class="row" align="center">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" align="center">
						@if (count($errors)>0)
						<div class="alert alert-danger">
							<ul>
							@foreach ($errors->all() as $error)
								<li>{{$error}}</li>
							@endforeach
							</ul>
						</div>
						@endif
					</div>
				</div>
	{!!Form::open(array('url'=>'almacen/nomina/datos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
				<div id=formulario method='post' align="center">
					<div class="form-group">
						<h3>Filtro Descarga XLS</h3><br>
						Desde: <input type="date" class="" name="desde" value="<?php echo date("Y-m-d"); ?>">
						Hasta: <input type="date" class="" name="hasta" value="<?php echo date("Y-m-d"); ?>"><br><br>
						Empleado:
						<select name="nombre" class="">
							<option>Todos los empleados</option>
							@foreach($usuarios as $usu)
							<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
							@endforeach
						</select><br><br>

						<button class="btn btn-success" type="submit">Descargar</button>
				
				</div>
					</div>
					{!!Form::close()!!}	
				</div>
			
			</body>
		</div>	
		</div>
	</div>

</div>