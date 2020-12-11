@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Impuestos</title>
</head>

<body>
	<!--Control de errores en los campos del formulario-->	
	<div class="container col-sm-12" align="center">
		<div class="row" align="center">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="center">
				@if (count($errors)>0)
				<div class="alert alert-danger" align="center">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{$error}}</li>
						@endforeach
					</ul>
				</div>
				@endif
			</div>
		</div>
	</div>

	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Impuesto</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Inicio</li>
								<li class="active">Editar impuesto</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{!!Form::model($impuestos,['method'=>'PATCH','route'=>['almacen.inventario.producto-sede.impuestoProducto.update',$impuestos->id_impuestos]])!!}
    {{Form::token()}}

    <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR IMPUESTO</h3>
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
										<input type="text" class="form-control" name="nombre" value="{{$impuestos->nombre}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Descripci&oacuten:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="descripcion" value="{{$impuestos->descripcion}}">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Tarifa IVA %:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="valor_impuesto" value="{{$impuestos->valor_impuesto}}" min="1" pattern="^[0-9]+">
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
							@if($impuestos->sede_id_sede==$sed->id_sede)
							<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
							@endif
						@endif
						@endforeach
						@foreach($sedes as $sed)
						@if(Auth::user()->sede_id_sede==$sed->id_sede)
							@if($impuestos->sede_id_sede!=$sed->id_sede)
							<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
							@endif
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
					@if($impuestos->sede_id_sede==$sed->id_sede)
							<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
					@endif
					@endforeach
					@foreach($sedes as $sed)
					@if($impuestos->sede_id_sede!=$sed->id_sede)
							<option value="{{$sed->id_sede}}">{{$sed->nombre_sede}}</option>
					@endif
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
										<a href="{{url('almacen/inventario/producto-sede/impuestoProducto')}}" class="btn btn-danger">Regresar</a>
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