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
										<div>Seleccione tipo de reporte:</div>
									</div>
									<div class="form-group col-sm-12">
										<select class="form-control" name="tipo_reporte">
											<option value="1">General</option>
											<option value="2">Detallado</option>
										</select>
										
									</div>
									
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
								
								<input type="hidden" name="tipo" value="2">
				
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione semana de inicio:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="fecha_semana_inicial">
											 @for($cont=1; $cont<54; $cont++)
											 <option value="{{$cont}}">{{$cont}}</option>
											 @endfor
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione semana fin:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="fecha_semana_final">
											 @for($cont=1; $cont<54; $cont++)
											 <option value="{{$cont}}">{{$cont}}</option>
											 @endfor
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione el a&ntilde;o:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="fecha_year">
											 @for($cont=2019; $cont<2051; $cont++)
											 <option value="{{$cont}}">{{$cont}}</option>
											 @endfor
										</select>
									</div>
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
										<div>Seleccione el mes de inicio:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="fecha_mes_inicial">
											
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
											
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione el mes fin:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="fecha_mes_final">
											
										<option value="1">Enero</option>
										<option value="2">Febrero</option>
										<option value="3">Marzo</option>
										<option value="4">Abril</option>
										<option value="5">Mayo</option>
										<option value="6">Junio</option>
										<option value="7">Julio</option>
										<option value="8">Agosto</option>
										<option value="9">Septiembre</option>
										<option value="10">Octubre</option>
										<option value="11">Noviembre</option>
										<option value="12">Diciembre</option>
											
										</select>
									</div>
								</div>
				
								<input type="hidden" name="tipo" value="3">
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione el a&ntilde;o:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="fecha_year">
											 @for($cont=2019; $cont<2051; $cont++)
											 <option value="{{$cont}}">{{$cont}}</option>
											 @endfor
										</select>
									</div>
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
				<h3 class="pb-2 display-5"> Reporte de ventas </h3>
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
										<div>Seleccione la fecha inicial:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" name="fecha_inicial" class="form-control">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Seleccione la fecha final:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" name="fecha_final" class="form-control">
									</div>
								</div>
				
								<input type="hidden" name="tipo" value="4">
								
								
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
