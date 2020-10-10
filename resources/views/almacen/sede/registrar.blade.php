@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Sede</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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

	{!!Form::open(array('url'=>'almacen/sede','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}




		<div class="col-md-12">
			<div class="card">
				<div class="card-header" align="center">
					<h3 class="pb-2 display-5">REGISTRAR SEDE</h3>
				</div><br>


				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Formulario de registro</strong>
				                </div><br>
				                <div class="card-body card-block" align="center">
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Nombre:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="nombre_sede">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Ciudad:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="ciudad">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Descripción:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="descripcion">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Dirección:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="direccion">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Teléfono:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="number" class="form-control" name="telefono">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-12">
											<button class="btn btn-info" type="submit">Registrar</button>
											<a href="{{url('almacen/sede')}}" class="btn btn-danger">Regresar</a>
										</div>
									</div>
				               </div>
				        	</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div>


			</div>
		</div>

			                       
{!!Form::close()!!}		
</body>

@stop