@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
</head>

<body>

	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar usuario</h3>
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

	{!!Form::open(array('url'=>'almacen/usuario/registrar','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
	<div id=formulario>


		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            Nombre: <br>
                           
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                           
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                           Correo:<br>
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            Contraseña:<br>
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                           Confirmar contraseña:<br>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

			Código<br>
			<input id="codigo" type="text" class="form-control" name="codigo">
			Cargo<br>
			<select name="tipo_cargo_id_cargo" class="form-control">
				@foreach($cargos as $car)
				<option value="{{$car->id_cargo}}">{{$car->nombre}}</option>
				@endforeach
			</select>
			<div class="form-group">
			Sede<br>
			<select name="sede_id_sede" class="form-control">
				@foreach($sedes as $sed)
				<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
				@endforeach
			</select>
			<br>
			<div align="center">
				<a href="usuario/iniciar/sesionIniciada"><button class="btn btn-info" type="submit">Registrar Usuario</button></a>
				<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>	
		</div>
	</div>
	{!!Form::close()!!}	
</body>

@stop


