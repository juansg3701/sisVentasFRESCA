@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Producto-Impuestos</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Descuentos</h3>
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
	{!!Form::open(array('url'=>'almacen/facturacion/descuentos','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			<h3>Registrar Nuevo descuento</h3>
			Nombre<input type="text" class="form-control" name="nombre"><br>
			Caracteristica<input type="text" class="form-control" name="caracteristica"><br>
			Porcentaje<input type="text" class="form-control" name="porcentaje"><br>
				
			@if(auth()->user()->superusuario==0)
				Sede: 
				<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
				<select name="sede_id_sede" class="form-control" disabled="">
				@foreach($sedes as $sed)
				@if(Auth::user()->sede_id_sede==$sed->id_sede)
				
				<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
				@endif
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
			<div align="center">
				<button href="" class="btn btn-info" type="submit">Registrar descuento</button>
				<a href="{{url('almacen/facturacion/listaVentas')}}" class="btn btn-danger">Volver</a>
			</div>	
		</div>
	</div>
	{!!Form::close()!!}	
</body>
@stop

@section('tabla')
<h3>Lista de impuestos</h3>
	Nombre del descuento: 
	@include('almacen.facturacion.descuentos.search')	
	<div class="row">

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Id</th>
							<th>NOMBRE</th>
							<th>CARACTERÍSTICA</th>
							<th>PORCENTAJE</th>
							<th>SEDE</th>
							<th>OPCIONES</th>
						</thead>
						@foreach($descuentos as $des)
						@if($des->sedeId==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>{{ $des->id_descuento}}</td>
							<td>{{ $des->nombre}}</td>
							<td>{{ $des->caracteristica}}</td>
							<td>{{ $des->porcentaje}}</td>
							<td>{{ $des->sede_id_sede}}</td>
							<td>
								<a href="{{URL::action('DescuentoProducto@edit',$des->id_descuento)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$des->id_descuento}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@endif
						@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{ $des->id_descuento}}</td>
							<td>{{ $des->nombre}}</td>
							<td>{{ $des->caracteristica}}</td>
							<td>{{ $des->porcentaje}}</td>
							<td>{{ $des->sede_id_sede}}</td>
							<td>
								<a href="{{URL::action('DescuentoProducto@edit',$des->id_descuento)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$des->id_descuento}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@endif
						
						@include('almacen.facturacion.descuentos.modal')
						@endforeach
					</table>
				</div>
				{{$descuentos->render()}}
			</div>
	</div><br>
@stop