@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Sede</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar datos cuenta: {{$bancos->nombre_banco}}</h3>
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

	{!!Form::model($bancos,['method'=>'PATCH','route'=>['almacen.pagosCobros.Bancos.update',$bancos->id_banco]])!!}
    {{Form::token()}}

	<div id=formulario>
	
		Nombre:<input type="text" class="form-control" value="{{$bancos->nombre_banco}}" name="nombre_banco">
		Intereses:<input type="text" class="form-control" value="{{$bancos->intereses}}" name="intereses">
		No. cuenta:<input type="text" class="form-control" value="{{$bancos->NoCuenta}}" name="NoCuenta">
		Tipo de cuenta:

		<select name="tipo_cuenta_id_tcuenta" class="form-control">

				@foreach($tcuentas as $tp)
					@if($bancos->tipo_cuenta_id_tcuenta==$tp->id_tcuenta
					)
					<option value="{{$tp->id_tcuenta}}">{{$tp->nombre}}</option>
					@endif
				@endforeach

				@foreach($tcuentas as $tp)
					@if($bancos->tipo_cuenta_id_tcuenta!=$tp->id_tcuenta
					)
					<option value="{{$tp->id_tcuenta}}">{{$tp->nombre}}</option>
					@endif
				@endforeach


			</select>
			<br>
			<button class="btn btn-info" type="submit">Registrar</button>
			<a href="{{URL::action('BancoController@index',0)}}" class="btn btn-danger">Volver</a>	
	</div>
	
{!!Form::close()!!}		
</body>

@stop