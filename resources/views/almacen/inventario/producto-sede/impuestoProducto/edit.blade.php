@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Impuestos</title>
</head>

<body>
	<div class="row">

		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Impuesto: {{$impuestos->nombre}}</h3>
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

	{!!Form::model($impuestos,['method'=>'PATCH','route'=>['almacen.inventario.producto-sede.impuestoProducto.update',$impuestos->id_impuestos]])!!}
    {{Form::token()}}

	<div id=formulario align="center">
		Nombre:<input type="text" class="form-control" value="{{$impuestos->nombre}}" name="nombre">
		Valor:<input type="text" class="form-control" value="{{$impuestos->valor}}" name="valor">
		<br>
		<button class="btn btn-info" type="submit">Registrar</button>
		<a href="{{url('almacen/inventario/producto-sede/impuestoProducto')}}" class="btn btn-danger">Volver</a>
	</div>
	
{!!Form::close()!!}		
</body>

@stop