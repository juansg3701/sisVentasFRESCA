@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
</head>

<body>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Registrar usuario</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li><a href="#">Inicio</a></li>
								<li class="active">Registrar usuario</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{!!Form::open(array('url'=>'almacen/usuario/registrar','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
      <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR USUARIO</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de registro</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">

			                	<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
			                		<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

		                                @if ($errors->has('name'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('name') }}</strong>
		                                    </span>
		                                @endif
									</div>
										</div>
                       			 </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        	<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Correo:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

		                                @if ($errors->has('email'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('email') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
                                
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">

                        	<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Contraseña:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="password" type="password" class="form-control" name="password">

		                                @if ($errors->has('password'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">

                        	<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Confirmar contraseña:</div>
									</div>
									<div class="form-group col-sm-8">
										<input id="password-confirm" type="password" class="form-control" name="password_confirmation">

		                                @if ($errors->has('password_confirmation'))
		                                    <span class="help-block">
		                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
		                                    </span>
		                                @endif
									</div>
								</div>
                        </div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Código:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="codigo">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Dirección:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="direccion">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Telefono:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="telefono">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Documento:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<input id="codigo" type="text" class="form-control" name="documento">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Cargo:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="tipo_cargo_id_cargo" class="form-control">
											@foreach($cargos as $car)
											<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="sede_id_sede" class="form-control">
											@foreach($sedes as $sed)
											<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
											@endforeach
										</select>
									</div>
								</div>
								@if(Auth::user()->superusuario==1)
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Superusuario:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="superusuario" class="form-control">
											
											<option value="0">Normal</option>
											<option value="1">Superusuario</option>
											
										</select>
									</div>
								</div>
								@else
								<input id="codigo" type="hidden" class="form-control" name="superusuario" value="0">
								@endif
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-12">
										<a href="usuario/iniciar/sesionIniciada"><button class="btn btn-info" type="submit">Registrar Usuario</button></a>
										<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
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


