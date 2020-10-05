@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Sede</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar cuenta</h3>
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

	{!!Form::open(array('url'=>'almacen/pagosCobros/Bancos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario>
		<!--Id: <input type="text" class="form-control" name="id_sede">-->
		Nombre:<input type="text" class="form-control" name="nombre_banco">
		Intereses:<input type="text" class="form-control" name="intereses">
		No. cuenta:<input type="text" class="form-control" name="NoCuenta">
		
		Tipo de cuenta:
		<select name="tipo_cuenta_id_tcuenta" class="form-control">
				@foreach($tcuentas as $tp)
				<option value="{{$tp->id_tcuenta}}">{{$tp->nombre}}</option>
				@endforeach
			</select>
			<br>

			<button class="btn btn-info" type="submit">Registrar</button>
			<a href="{{URL::action('BancoController@index',0)}}" class="btn btn-danger">Volver</a>	
			
			
	</div>
	
{!!Form::close()!!}		
</body>

@stop