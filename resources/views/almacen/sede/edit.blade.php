@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Sede</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
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

	{!!Form::model($sede,['method'=>'PATCH','route'=>['almacen.sede.update',$sede->id_sede]])!!}
    {{Form::token()}}

	<div class="row" align="center">	
		<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<h3>EDITAR SEDE</h3><br>
						Editar Datos Sede: {{$sede->nombre_sede}}
					</div>
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
											<input type="text" class="form-control" name="nombre_sede" value="{{$sede->nombre_sede}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Ciudad:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="ciudad" value="{{$sede->ciudad}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Descripción:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="descripcion" value="{{$sede->descripcion}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Dirección:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="text" class="form-control" name="direccion" value="{{$sede->direccion}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-4">
											<div>Teléfono:</div>
										</div>
										<div class="form-group col-sm-8">
											<input type="number" class="form-control" name="telefono" value="{{$sede->telefono}}">
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-sm-12">
											<button class="btn btn-info" type="submit">Registrar</button>
											<a href="{{url('almacen/sede')}}" class="btn btn-danger">Regresar</a>
										</div>
									</div>
				               </div>
				        	</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div>
        	</div>
		</div>
	</div>	
{!!Form::close()!!}		
</body>

@stop