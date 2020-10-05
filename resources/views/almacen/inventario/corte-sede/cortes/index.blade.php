@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cortes</h3>
		</div>
	</div>
	{!!Form::open(array('url'=>'almacen/inventario/corte-sede/cortes','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
	<div id=formulario>
		<div class="form-group">
			

			Fecha<input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i:s"); ?>">
			<BR>
			Periodo de Tiempo<br>
			<select name="p_tiempo_id_tiempo" class="form-control">
				@foreach($tiempo as $t)
				<option value="{{$t->id_tiempo}}">{{$t->periodo_tiempo}}</option>
				@endforeach
			</select>	
			<br>
			@if(auth()->user()->superusuario==0)
			Sede: 
			<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
		<select name="sede_id_sede" class="form-control" disabled="true">

				@foreach($sede as $s)
				@if( Auth::user()->sede_id_sede ==$s->id_sede)
				<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach

				@foreach($sede as $s)
				@if( Auth::user()->sede_id_sede !=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach
		</select>	
			@else
			Sede: 
		<select name="sede_id_sede" class="form-control">

				@foreach($sede as $s)
				@if( Auth::user()->sede_id_sede ==$s->id_sede)
				<option value="{{$s->id_sede}}" >{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach

				@foreach($sede as $s)
				@if( Auth::user()->sede_id_sede !=$s->id_sede)
				<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
				aa
				@endif
				@endforeach
		</select>	
			@endif
			<br>
			<div align="center">
			<button class="btn btn-info" type="submit" type="button">Realizar nuevo corte</button>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>
{!!Form::close()!!}	
	

</body>

@stop
@section('tabla')
<div class="row">
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Cortes Realizados</h3>
		</div>
	</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id=formulario align="center">
		@include('almacen.inventario.corte-sede.cortes.search')
		
	</div>
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID CORTE</th>
							<th>FECHA</th>	
							<th>PERIODO DE TIEMPO</th>
							<th>SEDE</th>
							<th>OPCIONES</th>					
						</thead>
						@foreach($cortes as $co)
						@if($co->idsede==auth()->user()->sede_id_sede && auth()->user()->superusuario==0)
						<tr>
							<td>{{$co->id_corte}}</td>
							<td>{{$co->fecha}}</td>
							<td>{{$co->p_tiempo_id_tiempo}}</td>
							<td>{{$co->sede_id_sede}}</td>	
							
							<td>
								<a href="{{URL::action('CorteSedeController@edit',$co->id_corte)}}">
								<button href="" class="btn btn-info" >Ver productos</button></a>
		
								
								<a href="" data-target="#modal-delete-{{$co->id_corte}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@endif

						@if(auth()->user()->superusuario==1)
						<tr>
							<td>{{$co->id_corte}}</td>
							<td>{{$co->fecha}}</td>
							<td>{{$co->p_tiempo_id_tiempo}}</td>
							<td>{{$co->sede_id_sede}}</td>	
							
							<td>
								<a href="{{URL::action('CorteSedeController@edit',$co->id_corte)}}">
								<button href="" class="btn btn-info" >Ver productos</button></a>
		
								
								<a href="" data-target="#modal-delete-{{$co->id_corte}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@endif
						
							@include('almacen.inventario.corte-sede.cortes.modal')
						@endforeach
					</table>
				</div>
		
			</div>
			</div><br>

@stop