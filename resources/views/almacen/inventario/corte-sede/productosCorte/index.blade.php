
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


<div align="center" >
	<div class="input-group" >
		<h3>Automatico</h3>
		<div align="center">
			{!! Form::open(array('url'=>'almacen/inventario/corte-sede/productosCorte','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
				<br>EAN:<input id="tags" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}"></br><br><br><input type="submit" class="btn btn-primary" value="Buscar">
                </br>


                <input type="hidden" class="form-control" name="c_inventario_id_corte" value="{{$id}}">

                
				
					</div>
			{{Form::close()}}

			{!!Form::open(array('url'=>'almacen/inventario/corte-sede/productosCorte','method'=>'POST','autocomplete'=>'off'))!!}
    		{{Form::token()}}

    		
			<br>
			Número de corte:  {{$id}}
			<input type="hidden" class="form-control" name="c_inventario_id_corte" value="{{$id}}">
			<br>
			<br>
	
	
			<?php
			$Enable="disabled";
			?>
			@foreach($productosEAN as $EAN)
			
			Nombre Producto: <input type="text" class="form-control" name="nombre" value="{{$EAN->nombre}}">
			<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
			@if($EAN->nombre!='')
			<?php
			$Enable="enable";
			?>	
			@endif
			
			@endforeach
			<br>
			Cantidad: <br>
			<input type="text" class="form-control" name="cantidad" value="1">
			<br>
			<br>
			Fecha: <input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i:s"); ?>">
			<br> 
			<br>
			<br>
			<br>
			<div align="center">			
				<button href="" class="btn btn-info" type="submit" <?php echo $Enable?>>Guardar productos</button>
				<a href="{{url('almacen/inventario/corte-sede/cortes')}}" class="btn btn-danger">Volver</a>
			</div>
			</div>
{!!Form::close()!!}	
	</div>
	</div>




<div align="center" >
	<div class="input-group" >
		<h3>Manual</h3>
	{!!Form::open(array('url'=>'almacen/inventario/corte-sede/productosCorte','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    		Número de corte: 
			{{$id}}
			<input type="hidden" class="form-control" name="c_inventario_id_corte" value="{{$id}}">
			<br>
			<br>
			Cantidad: <br>
			<input type="text" class="form-control" name="cantidad">
			<br>
			Producto:<br>
			<select name="producto_id_producto" class="form-control">
				@foreach($producto as $p)
				<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
				@endforeach
			</select>
			<br>
			<br>
			Fecha: <input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d H:i:s"); ?>">
			<br>
			<br>
			<br>
			<br>
			<div align="center"> 			
				<button href="" class="btn btn-info" type="submit">Guardar productos</button>
				<a href="{{url('almacen/inventario/corte-sede/cortes')}}" class="btn btn-danger">Volver</a>
			</div>
    {!!Form::close()!!}	
	</div>
	</div>
	


</body>

@stop
@section('tabla')
<div class="form-group">
			<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID </th>
							<th>ID CORTE</th>
							<th>PRODUCTO</th>
							<th>CANTIDAD</th>
							<th>FECHA</th>
							<th>OPCIONES</th>
						</thead>
						
						@foreach($productos as $p)
						<tr>
							<td>{{$p->id_dcorte}}</td>
							<td>{{$p->c_inventario_id_corte}}</td>
							<td>{{$p->producto_id_producto}}</td>
							<td>{{$p->cantidad}}</td>
							<td>{{$p->fecha}}</td>
							
							<td>
						
								<a href="" data-target="#modal-delete-{{$p->id_dcorte}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.inventario.corte-sede.productosCorte.modal')
						@endforeach
					</table>
				</div>
			</div>
			</div><br>
			
		</div>
@stop
