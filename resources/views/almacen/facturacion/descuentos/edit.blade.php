@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Descuentos</title>
</head>

<body>
	<div class="row">

		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar datos descuento: {{$descuentos->nombre}}</h3>
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

	{!!Form::model($descuentos,['method'=>'PATCH','route'=>['almacen.facturacion.descuentos.update',$descuentos->id_descuento]])!!}
    {{Form::token()}}

	<div id=formulario>
		Nombre<input type="text" class="form-control" name="nombre" value="{{$descuentos->nombre}}"><br>
			Caracteristica<input type="text" class="form-control" name="caracteristica" value="{{$descuentos->caracteristica}}"><br>
			Porcentaje<input type="text" class="form-control" name="porcentaje" value="{{$descuentos->porcentaje}}"><br>
			@if(auth()->user()->superusuario==0)
			Sede: 
			<select name="sede_id_sede" class="form-control" disabled="">	
			@foreach($sedes as $sed)
			<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
			@endforeach
			</select>
			@else
			Sede: 
			<select name="sede_id_sede" class="form-control">	
			@foreach($sedes as $sed)
			<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
			@endforeach
			</select>
			@endif
			
		<br>
		<div class="contanier" align="center">
			<button class="btn btn-info" type="submit">Registrar</button>
			<a href="{{url('almacen/facturacion/descuentos')}}" class="btn btn-danger">Volver</a>	
		</div>
		
	</div>
	
{!!Form::close()!!}		
</body>

@stop