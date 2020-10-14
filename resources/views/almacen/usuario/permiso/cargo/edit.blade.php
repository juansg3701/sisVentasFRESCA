@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Cargo</title>
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

	{!!Form::model($cargo,['method'=>'PATCH','route'=>['almacen.usuario.permiso.cargo.update',$cargo->id_cargo]])!!}
    {{Form::token()}}
    <div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR CARGO</h3>
			</div><br>

			<div class="col-sm-12" align="center">
				Editar datos de: {{$cargo->nombre}}
			</div><br>

			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="nombre" value="{{$cargo->nombre}}">
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Descripción:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="descripcion" value="{{$cargo->descripcion}}">
									</div>
								</div>

								<input type="datetime" class="form-control" name="fecha" value="{{$cargo->fecha}}" style="display:none">

								<input type="hidden" class="form-control" name="empleado_id_empleado" value="{{$cargo->empleado_id_empleado}}">
								
								<div class="form-row">
									<div class="form-group col-sm-12">
										<button class="btn btn-info" type="submit">Registrar</button>
										<a href="{{url('almacen/usuario/permiso/cargo')}}" class="btn btn-danger">Volver</a>
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