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

	
	{!!Form::open(array('url'=>'almacen/reportes/inventario','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    
<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">Registrar reporte stock</h3>
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
										<div>Fecha inicial:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" class="form-control" name="fechaInicial">
									</div>
								</div>
								
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha final:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="date" class="form-control" name="fechaFinal">
									</div>
								</div>

								<input type="hidden" class="form-control" name="fechaActual" value="<?php echo date("Y/m/d"); ?>">
								<input type="hidden" class="form-control" name="noProductos" value="0">
								<input type="hidden" class="form-control" name="total" value="0">
								
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<select name="empleado_id_empleado" class="form-control" disabled="">
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
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="fecha" value="<?php echo date("Y/m/d"); ?>" class="form-control" readonly>
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
@section('tabla')

<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">REPORTES GENERADOS </h3>
						<div align="center"><h4>Comparar Gráficas</h4></div>
						<div class="form-group col-sm-8" align="center">
						{!! Form::open(array('url'=>'almacen/reportes/compararGI1','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

						<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Reporte 1:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="id1" class="form-control">
								        @foreach($reportes as $r)
								        <option value="{{$r->id_rInventario}}">No: {{$r->id_rInventario}}, Fecha: {{$r->fechaActual}}</option>
								        @endforeach
								    </select>
									</div>
						</div>

						<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Reporte 2:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="id2" class="form-control">
									        @foreach($reportes as $r)
									        <option value="{{$r->id_rInventario}}">No: {{$r->id_rInventario}}, Fecha: {{$r->fechaActual}}</option>
									        @endforeach
									    </select>
									</div>
						</div>

					<span class=""><button type="submit" class="btn btn-info">Comparar</button></span>
					      
					{!!Form::close()!!} 
					</div>
				
					</div>

					<div class="card-body">
			
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
						<thead>
							<th>ID</th>
							<th>FECHA INICIAL</th>
							<th>FECHA FINAL</th>
							<th>FECHA REGISTRADA</th>
				
							<th>OPCIONES</th>
						</thead>
						@foreach($reportes as $rep)
						<tr>
							<td>{{ $rep->id_rInventario}}</td>
							<td>{{ $rep->fechaInicial}}</td>
							<td>{{ $rep->fechaFinal}}</td>
							<td>{{ $rep->fechaActual}}</td>
			
							<td>
								<a href="{{URL::action('reportesInventario@edit',$rep->id_rInventario)}}"><button class="btn btn-info">Gráfica</button></a>
								<a href="{{URL::action('reportesInventario@downloadPDFReport',$rep->id_rInventario)}}"><button class="btn btn-warning"><i>pdf</i></button></a>
								<a href="{{URL::action('reportesInventario@downloadExcelReport',$rep->id_rInventario)}}"><button class="btn btn-success"><i>xls</i></button></a>
								<a href="" data-target="#modal-delete-{{$rep->id_rInventario}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.reportes.inventario.modal')
						@endforeach
					</table>
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


			
@stop