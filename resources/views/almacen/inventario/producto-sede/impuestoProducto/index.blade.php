@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Producto-Impuestos</title>
</head>

<body>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
							<h1>Impuestos</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Inicio</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{!!Form::open(array('url'=>'almacen/inventario/producto-sede/impuestoProducto','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">M&OacuteDULO IMPUESTOS</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Registrar impuesto</strong>
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
										<div>Descripci&oacuten:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="descripcion">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Tarifa IVA %:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="valor_impuesto" min="0" pattern="^[0-9]+">
									</div>
								</div>

			@if(auth()->user()->superusuario==0)
				<div class="form-row">
					<div class="form-group col-sm-4">
						<div>Sede:</div>
					</div>
					<div class="form-group col-sm-8">
						<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
						<select name="sede_id_sede" class="form-control" disabled="">
						@foreach($sedes as $sed)
						@if(Auth::user()->sede_id_sede==$sed->id_sede)
						
						<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
						@endif
						@endforeach
						</select>
					</div>
				</div>
				
			@else
			<div class="form-row">
				<div class="form-group col-sm-4">
					<div>Sede:</div>
				</div>
				<div class="form-group col-sm-8">
					<select name="sede_id_sede" class="form-control">
					@foreach($sedes as $sed)
					<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
					@endforeach
					</select>
				</div>
			</div>

			@endif
							

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
									<div class="form-group col-sm-12">
										<button class="btn btn-info" type="submit">Registrar</button>
										<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Regresar</a>
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
						<h3 class="pb-2 display-5">IMPUESTOS REGISTRADOS</h3>
					</div>
					<div class="card-body">
						@include('almacen.inventario.producto-sede.impuestoProducto.search')
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
						<thead>
							<th>Id</th>
							<th>NOMBRE</th>
							<th>DESCRIPCI&OacuteN</th>
							<th>TARIFA IVA</th>
							<th>SEDE</th>
							<th>EMPLEADO</th>
							<th>FECHA</th>
							<th colspan="2">OPCIONES</th>
						</thead>
						@foreach($impuestos as $im)
						<tr>
							<td>{{ $im->id_impuestos}}</td>
							<td>{{ $im->nombre}}</td>
							<td>{{ $im->descripcion}}</td>
							<td>{{ $im->valor_impuesto}}</td>
							@foreach($sedes as $s)
								@if($s->id_sede==$im->sede_id_sede)
								<td>{{ $s->nombre_sede}}</td>
								@endif
							@endforeach

							@foreach($usuarios as $u)
								@if($u->id_empleado==$im->empleado_id_empleado)
								<td>{{ $u->nombre}}</td>
								@endif
							@endforeach
							<td>{{ $im->fecha}}</td>
							<td>
								<a href="{{URL::action('ImpuestoProducto@edit',$im->id_impuestos)}}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$im->id_impuestos}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>	
						</tr>
						@include('almacen.inventario.producto-sede.impuestoProducto.modal')
						@endforeach
					</table>
				</div>
				{{$impuestos->render()}}
				</div>
			</div>
		</div>
	</div>
</div>

@stop