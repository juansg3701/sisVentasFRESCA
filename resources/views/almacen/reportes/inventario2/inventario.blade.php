@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Reportes</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row" align="center">
			<div align="center"><h3>REPORTES PRODUCTOS-PROVEEDOR</h3></div><br>
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


	<div id=formulario>
	{!!Form::open(array('url'=>'almacen/reportes/inventario2','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
			<div id=formulario>
			<div class="form-group">
			Fecha inicio: <input type="date" class="form-control" name="fechaInicial">
			Fecha final: <input type="date" class="form-control" name="fechaFinal">
			<input type="hidden" class="form-control" name="fechaActual" value="<?php echo date("Y/m/d"); ?>">
			<input type="hidden" class="form-control" name="noProductos" value="0">
			<input type="hidden" class="form-control" name="total" value="0">
			<br>
			<div align="center">
			<button type="submit" class="btn btn-info">Generar Reporte</button>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>
				</div>
			</div>
	{!!Form::close()!!}	
	</div>
</body>
@stop
@section('tabla')
<div align="center"><h3>REPORTES GENERADOS</h3></div>
<div align="center"><br>
<div align="center"><h4>Comparar Gráficas</h4></div>
{!! Form::open(array('url'=>'almacen/reportes/compararGI2','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
	Reporte 1:
  	<select name="id1" class="" >
        @foreach($reportes as $r)
        <option value="{{$r->id_rInventarios}}">No: {{$r->id_rInventarios}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
    </select>&nbsp&nbsp&nbsp&nbsp&nbsp
    Reporte 2:
    <select name="id2" class="">
        @foreach($reportes as $r)
        <option value="{{$r->id_rInventarios}}">No: {{$r->id_rInventarios}}, Fecha: {{$r->fechaActual}}</option>
        @endforeach
    </select><br><br>
    <span class=""><button type="submit" class="">Comparar</button></span><br><br>
      
{!!Form::close()!!} 
</div><br><br>


<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID</th>
							<th>FECHA DE CONSULTA</th>
							<th>FECHA INICIAL</th>
							<th>FECHA FINAL</th> 	
							<th>OPCIONES</th>
						</thead>
						@foreach($reportes as $rep)
						<tr>
							<td>{{ $rep->id_rInventarios}}</td>
							<td>{{ $rep->fechaActual}}</td>
							<td>{{ $rep->fechaInicial}}</td>
							<td>{{ $rep->fechaFinal}}</td>
							
			
							<td>
								<a href="{{URL::action('reportesInventarioEX2@edit',$rep->id_rInventarios)}}"><button class="btn btn-info"><i>Gráfica</i></button></a>
								<a href="{{URL::action('reportesInventarioPDF2@edit',$rep->id_rInventarios)}}"><button class="btn btn-warning"><i>pdf</i></button></a>
								<a href="{{URL::action('reportesInventarioEX2@show',$rep->id_rInventarios)}}"><button class="btn btn-success"><i>xls</i></button></a>
								<a href="" data-target="#modal-delete-{{$rep->id_rInventarios}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>

							</td>
						</tr>
						@include('almacen.reportes.inventario2.modal')	
						@endforeach
					</table>
				</div>
				
			</div>
			</div><br>




</div>	
			
@stop