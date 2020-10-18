@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Editar categoría cliente</title>
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

	{!!Form::model($categoria,['method'=>'PATCH','route'=>['almacen.cliente.categoria.update',$categoria->id_categoria]])!!}
    {{Form::token()}}


    <!--Formulario de edición-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR CATEGORÍA</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" value="{{$categoria->nombre}}" name="nombre">
									</div>
								</div>
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Descripción:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" value="{{$categoria->descripcion}}" name="descripcion">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="hidden" name="empleado_id_empleado" value="{{Auth::user()->id}}">
										<select name="empleado_id_empleado" class="form-control" readonly>
											@foreach($usuarios as $usu)
											@if(Auth::user()->id==$usu->users_id)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											@endif
											@endforeach

											@foreach($usuarios as $usu)
											@if(Auth::user()->id!=$usu->users_id)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
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
										<input type="hidden" name="sede_id_sede" value="{{Auth::user()->id}}">

										<select name="sede_id_sede" class="form-control" readonly>
											@foreach($sedes as $s)
											@if( Auth::user()->sede_id_sede ==$s->id_sede)
											<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
											aa
											@endif
											@endforeach

											@foreach($sedes as $s)
											@if( Auth::user()->sede_id_sede!=$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											aa
											@endif
											@endforeach
										</select><br>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-12">
										<button href="" class="btn btn-info" type="submit">Registrar</button>
										<a href="{{url('almacen/cliente/categoria')}}" class="btn btn-danger">Regresar</a>
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