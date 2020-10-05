@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Editar Proveedor</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar datos del Proveedor: {{$proveedor->nombre_empresa}}</h3>
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
	{!!Form::model($proveedor,['method'=>'PATCH','route'=>['almacen.proveedor.update',$proveedor->id_proveedor]])!!}
    
	 {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			Nombre Empresa<input type="text" class="form-control" name="nombre_empresa" value="{{$proveedor->nombre_empresa}}">
			Contacto<input type="text" class="form-control" name="nombre_proveedor" value="{{$proveedor->nombre_proveedor}}">
			Dirección<input type="text" class="form-control" name="direccion" value="{{$proveedor->direccion}}">
			Correo<input type="email" class="form-control" name="correo" value="{{$proveedor->correo}}">
			Teléfono<input type="number" class="form-control" name="telefono" value="{{$proveedor->telefono}}"><br>
			<div>

				Documento<br>
				@if($proveedor->verificacion_nit=="")
				<div align="center">
				Cédula:
				<input value="{{$proveedor->documento}}" id='id_cedula' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="xxxxxxxxx"  size="30" maxlength="30" enabled>
				<input id='id_falso' type="number" name="verificacion_nit" placeholder="- - - - - - - - -"  size="11" maxlength="11" style="display:none">
				NIT:
				<input value="{{$proveedor->documento}}" id='id_nit' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - - - -"  size="30" maxlength="30" required pattern=""  disabled>-<input value="{{$proveedor->verificacion_nit}}" id='id_digito' type="number"class=""style="width:40px; heigth:1px" name="verificacion_nit" placeholder="y" size="1" maxlength="1" required disabled><br><br>
				</div>
				@else
				<div align="center">
				Cédula:
				<input value="{{$proveedor->documento}}" id='id_cedula' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="xxxxxxxxx"  size="30" maxlength="30" disabled>
				<input id='id_falso' type="number" name="verificacion_nit" placeholder="- - - - - - - - -"  size="11" maxlength="11" style="display:none">
				NIT:
				<input value="{{$proveedor->documento}}" id='id_nit' type="number" class=""style="width:150px; heigth : 1px" name="documento" placeholder="- - - - - - - - -"  size="30" maxlength="30" required pattern=""  enabled>-<input value="{{$proveedor->verificacion_nit}}" id='id_digito' type="number"class=""style="width:40px; heigth:1px" name="verificacion_nit" placeholder="y" size="1" maxlength="1" required enabled><br><br>
				</div>
				@endif
				
			</div>
			<div align="center">
			<button class="btn btn-info" type="submit">Registrar proveedor</button>
			<a href="{{url('almacen/proveedor')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>
{!!Form::close()!!}		
</body>
@stop