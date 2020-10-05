@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Nueva venta</h3>
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



	{!! Form::open(array('url'=>'almacen/facturacion/listaVentas','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
					Cliente (Documento):
				<br>	
				<input id="cli2" type="text" class="form-control" name="searchText1" placeholder="Buscar..." value="{{$searchText1}}">
				</br>
				<span class="input-group-btn">
					<button type="submit" class="btn btn-primary">Buscar</button>
				</span>
					
			{{Form::close()}}
			<br>

{!!Form::open(array('url'=>'almacen/facturacion/listaVentas','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    

	<div id=formulario>
		<div class="form-group">


			@foreach($BuscarCliente as $bc)
			Cliente: <input type="hidden" class="form-control" name="cliente_id_cliente" value="{{$bc->id_cliente}}">

			<input type="text" class="form-control" name="cliente" value="{{$bc->nombre}}">
			@endforeach
			<br>


			Fecha<input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i"); ?>">
			<br>

			<input type="hidden" class="form-control" name="noproductos" value="0">
			<input type="hidden" class="form-control" name="tipo_pago_id_tpago" value="1">
			
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
			
			<input type="hidden" class="form-control" name="pago_total" value="0">
				<input type="hidden" class="form-control" name="facturaPaga" value="0">
			<br>
			Tipo venta:
			<select name="tiendaodomicilio" class="form-control">
				<option value="0">Tienda</option>
				<option value="1">Domicilio</option>
			</select><br><br>

			<div align="center">
			

			<button type="submit" class="btn btn-info">Registrar productos</button>
			
			</div>
		</div>

	</div>


{!!Form::close()!!}	

	@include('almacen.facturacion.listaVentas.cliente')
<a href="" data-target="#modal-delete" data-toggle="modal">
			<button class="btn btn-info">Añadir cliente nuevo</button></a>
			<a href="{{url('almacen/facturacion/descuentos')}}">
			<button class="btn btn-info">Añadir descuento nuevo</button></a>
			<a href="{{URL::action('facturacionListaVentas@show',0)}}" class="btn btn-warning">Lista de ventas</a>
			<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
</body>

@stop