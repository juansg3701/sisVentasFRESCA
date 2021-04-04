@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Reportes</title>
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



    {!!Form::model(0,['method'=>'PATCH','route'=>['almacen.reportes.ventas.update',0]])!!}
    {{Form::token()}}
    
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5"> Reporte de venta diaria</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de consulta</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-12">
										<div>Seleccione la fecha deseada:</div>
									</div>
									<div class="form-group col-sm-12">
										<input type="date" class="form-control" name="fecha_diaria">
									</div>
									<input type="hidden" name="tipo" value="1">
								</div>			
				
		
								<div class="form-row">
									<div class="form-group col-sm-12">
										
										<div align="center">
											<button type="submit" class="btn btn-info">Generar Reporte</button>
											<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
										</div>
									
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

	{!!Form::model(0,['method'=>'PATCH','route'=>['almacen.reportes.ventas.update',0]])!!}
    {{Form::token()}}
    
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5"> Reporte de ventas semanales</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de consulta</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha de semana inicial:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" class="form-control" name="fecha_semana_inicial">
									</div>
								</div>	

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha de semana final:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" class="form-control" name="fecha_semana_final">
									</div>
								</div>
								<input type="hidden" name="tipo" value="2">
			
		
								<div class="form-row">
									<div class="form-group col-sm-12">
										
										<div align="center">
											<button type="submit" class="btn btn-info">Generar Reporte</button>
											<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
										</div>
									
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

	{!!Form::model(0,['method'=>'PATCH','route'=>['almacen.reportes.ventas.update',0]])!!}
    {{Form::token()}}
    
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5"> Reporte de ventas mensual</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de consulta</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha de mes inicial:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" class="form-control" name="fecha_mes_inicial">
									</div>
								</div>	

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha de mes final:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" class="form-control" name="fecha_mes_final">
									</div>
								</div>
				
								<input type="hidden" name="tipo" value="3">
		
								<div class="form-row">
									<div class="form-group col-sm-12">
										
										<div align="center">
											<button type="submit" class="btn btn-info">Generar Reporte</button>
											<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
										</div>
									
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
