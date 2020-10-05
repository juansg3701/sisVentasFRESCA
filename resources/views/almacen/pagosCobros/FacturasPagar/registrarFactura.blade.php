@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Facturas por pagar</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Registrar factura por pagar</h3>
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

	{!!Form::open(array('url'=>'almacen/pagosCobros/FacturasPagar','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

	<div id=formulario>
		<div class="form-group">
	
			Nombre Factura: <input type="text" class="form-control" name="nombrepago">
			Descripción: <input type="text" class="form-control" name="descripcion">
			Fecha: <input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i");?>">
			
			Banco: <br>
			<select name="bancos_id_banco" class="form-control">
				@foreach($bancos as $ban)
				<option value="{{$ban->id_banco}}">{{$ban->nombre_banco}}</option>
				@endforeach
			</select>

			Empleado: 
			<select name="empleado_id_empleado" class="form-control">
				<?php 
				$nombre=auth()->user()->name;
				?>		
				
				@foreach($usuarios as $usu)
				@if( Auth::user()->name ==$usu->nombre)
				<option value="{{$usu->id_empleado}}" >{{$usu->nombre}}</option>
				
				@endif
				@endforeach

				@foreach($usuarios as $usu)
				@if( Auth::user()->name !=$usu->nombre)
				<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
				
				@endif
				@endforeach
			</select>

			Total deuda: <input type="text" class="form-control" name="total">
			<input type="hidden" class="form-control" value="0" name="cuotas_restantes">
			Cuotas totales<input type="text" class="form-control" name="cuotas_totales" ><br>

		
			<div align="center">
			<button class="btn btn-info">Añadir</button>
			<a href="{{url('almacen/pagosCobros/FacturasPagar')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>

{!!Form::close()!!}	
</body>

@stop