@extends ('layouts.admin')
@section ('contenido')
<!--Este archivo maneja la vista principal de la categoría del cliente-->	
<head>
	<title>Categoria cliente</title>
</head>

<body>
	<!--Control de errores en los campos del formulario-->	
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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


	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Cliente</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Cliente</li>
								<li class="active">Categoría Cliente</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div><br>


	{!!Form::open(array('url'=>'almacen/cliente/categoria','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    
	<!--Formulario de registro-->
	<br><br><br>
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR CATEGORÍA</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de registro</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Descripción:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="descripcion">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="" value="<?php echo date("Y/m/d"); ?>" class="form-control" disabled="true">
										<input type="hidden" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="" class="form-control" disabled="true">
											@foreach($usuarios as $usu)
											@if(Auth::user()->id==$usu->user_id_user)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											<input type="hidden" name="empleado_id_empleado" value="{{$usu->id_empleado}}">
											@endif
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="sede_id_sede" class="form-control" disabled="true">
											@foreach($sedes as $s)
											@if( Auth::user()->sede_id_sede ==$s->id_sede)
											<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
											<input type="hidden" name="sede_id_sede" value="{{$s->id_sede}}">
											@endif
											@endforeach
										</select><br>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-12">
										<a href="{{URL::action('CategoriaClienteController@create',0)}}">
										<button href="" class="btn btn-info" type="submit">Registrar categoria</button></a>
										<a href="{{url('almacen/cliente/cliente')}}" class="btn btn-danger">Regresar</a>
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




@section('tabla')
<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">

		<div class="row">
			<div class="col-md-12">

				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">CATEGORIAS REGISTRADAS</h3>
					</div>
					<div class="card-body">
						@include('almacen.cliente.categoria.search')	
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>NOMBRE</th>
								<th>DESCRIPCIÓN</th>	
								<th>EMPLEADO</th>
								<th>SEDE</th>
								<th>FECHA REG.</th>
								<th>OPCIONES</th>
							</thead>
							@foreach($categorias as $cat)
							<tr>
								<td>{{ $cat->nombre}}</td>
								<td>{{ $cat->descripcion}}</td>
								<td>{{ $cat->empleado_id_empleado}}</td>
								<td>{{ $cat->sede_id_sede}}</td>
								<td>{{ $cat->fecha}}</td>
								<td>
									<a href="{{URL::action('CategoriaClienteController@edit',$cat->id_categoria)}}"><button class="btn btn-info">Editar</button></a>
									<a href="" data-target="#modal-delete-{{$cat->id_categoria}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
								</td>
							</tr>
							@include('almacen.cliente.categoria.modal')
							@endforeach
						</table>
					</div>
				{{$categorias->render()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

