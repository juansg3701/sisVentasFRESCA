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

	{!!Form::model(0,['method'=>'PATCH','route'=>['almacen.reportes.valorbruto.update',0]])!!}
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
										<div>Seleccione el mes:</div>
									</div>
									<div class="form-group col-sm-8">
										<select class="form-control" name="mes">
											
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
										<select class="form-control" name="year">
											 @for($cont=2019; $cont<2051; $cont++)
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
										<select class="form-control" name="opcion">
											 <option value="2">Tabla en aplicaci&oacute;n</option>
											 <option value="1">Reporte en excel</option>
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

</body>
@stop
