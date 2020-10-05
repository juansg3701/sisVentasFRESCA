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
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
						<h3>Datos De Descarga</h3>
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

				<div id=formulario method='post'>
					<div class="form-group">
						
						Desde:<input type="date" class="" name="desde"><br>
						Hasta:<input type="date" class="" name="hasta"><br>
						


						<a href="{{URL::action('HorarioNominaController2@create',0)}}"><button class="btn btn-success" type="submit">Descargar xls</button></a>
</div>
					</div>
				</div>
			
			</body>
		</div>	
		</div>
	</div>

</div>