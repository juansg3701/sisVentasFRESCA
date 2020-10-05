@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Usuario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar datos del Cliente: {{$cliente->nombre}}</h3>
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
	{!!Form::model($cliente,['method'=>'PATCH','route'=>['almacen.cliente.update',$cliente->id_cliente]])!!}
    
	 {{Form::token()}}

	<div id=formulario>
		<div class="form-group">
			Nombre<input type="text" class="form-control" name="nombre" value="{{$cliente->nombre}}">
			Dirección<input type="text" class="form-control" name="direccion" value="{{$cliente->direccion}}">
			Correo
			<input type="text" class="form-control" name="correo" value="{{$cliente->correo}}">
			Teléfono<input type="text" class="form-control" name="telefono" value="{{$cliente->telefono}}">
			Nombre Empresa<input type="text" class="form-control" name="nombre_empresa" value="{{$cliente->nombre_empresa}}">
			Cartera<br>
			<select name="cartera_activa" class="form-control">
				@if($cliente->cartera_activa=='1')
				<option value="1">Activa</option>
				<option value="0">Inactiva</option>
				@endif
				@if($cliente->cartera_activa=='0')
				<option value="0">Inactiva</option>
				<option value="1">Activa</option>
				@endif
			</select>	

			<div>

				Documento<br>
				@if($cliente->verificacion_nit=="")
				Cédula:
				<input value="{{$cliente->documento}}" id='id_cedula' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="xxxxxxxxx"  size="30" maxlength="30" enabled>
				<input id='id_falso' type="number" name="verificacion_nit" placeholder="- - - - - - - - -"  size="11" maxlength="11" style="display:none">
				NIT:
				<input value="{{$cliente->documento}}" id='id_nit' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - - - -"  size="30" maxlength="30" required pattern=""  disabled>-<input value="{{$cliente->verificacion_nit}}" id='id_digito' type="number"class=""style="width:40px; heigth:1px" name="verificacion_nit" placeholder="y" size="1" maxlength="1" required disabled>

				@else
				Cédula:
				<input value="{{$cliente->documento}}" id='id_cedula' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="xxxxxxxxx"  size="30" maxlength="30" disabled>
				<input id='id_falso' type="number" name="verificacion_nit" placeholder="- - - - - - - - -"  size="11" maxlength="11" style="display:none">
				NIT:
				<input value="{{$cliente->documento}}" id='id_nit' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - - - -"  size="30" maxlength="30" required pattern=""  enabled>-<input value="{{$cliente->verificacion_nit}}" id='id_digito' type="number"class=""style="width:40px; heigth:1px" name="verificacion_nit" placeholder="y" size="1" maxlength="1" required enabled>
				@endif
				
				<div align="center">
				<br><br>


				</div>
			</div>

			<br>
			<div align="center">
			<button class="btn btn-info" type="submit">Registrar Cliente</button>
			<a href="{{url('almacen/cliente')}}" class="btn btn-danger">Volver</a>

		</div>
		</div>
	</div>
{!!Form::close()!!}		
</body>

@stop