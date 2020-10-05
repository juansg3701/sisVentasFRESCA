@extends ('layouts.admin')
@section ('contenido')
		
<head>
	<title>Proveedor</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Proveedores</h3>
		</div>
	</div>

	<div id=formulario>
		<div class="form-group">
			@include('almacen.proveedor.search')<br>
			<div  align="center">
			<a href="{{URL::action('ProveedorController@create',0)}}"><button class="btn btn-info">Registrar Proveedor</button></a>	
			<a href="{{URL::action('AcercaDeController@create',0)}}"><button class="btn btn-success">Descargar xls</button></a>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			
			</div>
		</div>
	</div>
</body>
@stop

@section('tabla')
<h3>Lista de Proveedores</h3><br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Nombre Empresa</th>
					<th>Contacto</th>
					<th>Dirección</th>
					<th>Correo</th>
					<th>Teléfono</th>
					<th>No. Documento</th>
					<th>Dígito de verificación NIT</th>
					<th>OPCIONES</th>
				</thead>
				@foreach($proveedores as $pro)
				<tr>
					<td>{{ $pro->id_proveedor}}</td>
					<td>{{ $pro->nombre_empresa}}</td>
					<td>{{ $pro->nombre_proveedor}}</td>
					<td>{{ $pro->direccion}}</td>
					<td>{{ $pro->correo}}</td>
					<td>{{ $pro->telefono}}</td>
					<td>{{ $pro->documento}}</td>
					<td>{{ $pro->verificacion_nit}}</td>
					<td>
						<a href="{{URL::action('ProveedorController@edit',$pro->id_proveedor)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$pro->id_proveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				@include('almacen.proveedor.modal')
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div><br>
@stop