
@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Cartera abonos</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar cartera</h3>
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


	
{!!Form::open(array('url'=>'almacen/pagosCobros/FacturasCobrar','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario>
		<div class="form-group">

			Nombre cliente:<br>
			<select  name="cliente_id_cliente" class="form-control">
			@foreach($clientesM as $cm)

			@if($cliente!="")
				<option value="{{$cliente}}">{{$clienteN}}</option>
				@endif
				
					<option value="{{$cm->id_cliente}}" >{{$cm->nombre}}</option>
			@endforeach
			</select>

			<input type="hidden" class="form-control" name="cuotas_restantes" value="0"><br>
			Cuotas totales<input type="text" class="form-control" name="cuotas_totales" ><br>

			<input type="hidden" class="form-control" name="factura_id_factura" value="{{$facturaId}}">

			
			Empleado: 
			<select name="empleado_id_empleado" class="form-control">
				@if($empleado!="")
				<option value="{{$empleado}}">{{$empleadoN}}</option>
				@endif

				<?php 
				$nombre=auth()->user()->name;
				?>		
				
				@foreach($usuarios as $usu)
				@if( Auth::user()->name ==$usu->nombre)
				<option value="{{$usu->id_empleado}}" >{{$usu->nombre}}</option>
				aa
				@endif
				@endforeach

				@foreach($usuarios as $usu)
				@if( Auth::user()->name !=$usu->nombre)
				<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
				aa
				@endif
				@endforeach
			</select><br>

			
			<input type="hidden" class="form-control" name="atraso" value="0">
			Fecha<input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i"); ?>"><br>
			Total<input type="text" class="form-control" name="total" value="{{$total}}"><br>

	
			<br>
			<div align="center">
			<button class="btn btn-info" type="submit">Registrar</button>
			<a href="{{url('almacen/pagosCobros/FacturasCobrar')}}" class="btn btn-danger">Volver</a>

		</div>
		</div>
	</div>
{!!Form::close()!!}		


</body>

@stop