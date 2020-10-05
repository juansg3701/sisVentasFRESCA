@extends ('layouts.admin')
@section ('contenido')
<head>
	<title>Pedidos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Productos pedido cliente</h3>
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

<div id=formulario align="center">
	{!! Form::open(array('url'=>'almacen/pedidosDevoluciones/productoPedidoCliente','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
	
		<br>EAN:<input id="tags" class="form-control" name="searchText" placeholder="Buscar...">
		<br>
                <input type="hidden" class="form-control" name="t_p_cliente_id_remision" value="{{$id}}">
		Nombre:
		<input id="buscar2" class="form-control" name="searchText1" placeholder="Buscar..." ><br></br><input type="submit" class="btn btn-primary" value="Buscar">
		</br>
		<br>

	{{Form::close()}}

	{!!Form::open(array('url'=>'almacen/pedidosDevoluciones/productoPedidoCliente','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <div>
    	
    		<div align="center">
    		No. Remisión:  {{$id}}
			<input type="hidden" class="form-control" name="t_p_cliente_id_remision" value="{{$id}}"><br>
			</div>
    		<?php
			$Enable="disabled";
			?>
			
   		<?php
			$Enable="disabled";
			?>
			<?php 
			$contador=0;
			$contador2=0;
			$contadorB=0;
			$contadorB2=0;
			$sedeP=auth()->user()->sede_id_sede;
			$conteoProductos1=count($productosEAN);
			$conteoProductos2=count($productosEAN2);
			$nombre="";
			?>


			@if($conteoProductos1!=0)
			<br>
			<br>
			@foreach($productosEAN as $EAN)

			@if($EAN->cantidad<=$EAN->minimo && $contador2=='0')
			<?php 
			$contador2=1;
			?>
			 <script >
			 	window.alert("Producto con pocas unidades");
			 </script>
			@endif

			
			@if($EAN->cantidad>0 && $contador=='0' && $EAN->disponible=='1')


			<?php 
			$contador=1;
			?>

			Nombre Producto: <input type="text" class="form-control" name="nombre" value="({{$EAN->nombre}}, {{$EAN->nproveedor}})">
			<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
			<br>
			Precio unitario:<input type="text" class="form-control" name="precio_venta" value="{{$EAN->precioU}}">
			<br>
			
			
			Impuesto:
			<select name="impuestos_id_impuestos" class="form-control">

			@foreach($impuestos as $i)
			@if($EAN->impuestos_id_impuestos==$i->id_impuestos)
			<option value="{{$EAN->impuestos_id_impuestos}}">{{$EAN->nombreI}} ({{$i->valor}})</option>
			@endif
			@endforeach

			@foreach($impuestos as $i)
			@if($EAN->impuestos_id_impuestos!=$i->id_impuestos)
			<option value="{{$i->id_impuestos}}">{{$i->nombre}} ({{$i->valor}})</option>
			@endif
			@endforeach


			</select>
			
			
			@if($EAN->nombre!='')
			<?php
			$Enable="enable";
			?>	
			@endif
			@endif
			@endforeach
			@endif

			@if($searchText1!="")
			
			@foreach($productosEAN2 as $EAN)
			
			@if($EAN->cantidad<=$EAN->minimo && $contadorB2=='0')
			<?php 
			$contadorB2=1;
			?>
			 <script >
			 	window.alert("Producto con pocas unidades");
			 </script>
			@endif


			@if($EAN->cantidad>0 && $contadorB=='0' && $EAN->disponible=='1')


			<?php 
			$contadorB=1;
			?>
			Nombre Producto: <input type="text" class="form-control" name="nombre" value="({{$EAN->nombre}}, {{$EAN->nproveedor}})">
			<input type="hidden" class="form-control" name="producto_id_producto" value="{{$EAN->id_producto}}" enable>
			<br>
			Precio unitario:<input type="text" class="form-control" name="precio_venta" value="{{$EAN->precioU}}">
			<br>
			
			
			Impuesto:
			<select name="impuestos_id_impuestos" class="form-control">

			@foreach($impuestos as $i)
			@if($EAN->impuestos_id_impuestos==$i->id_impuestos)
			<option value="{{$EAN->impuestos_id_impuestos}}">{{$EAN->nombreI}} ({{$i->valor}})</option>
			@endif
			@endforeach

			@foreach($impuestos as $i)
			@if($EAN->impuestos_id_impuestos!=$i->id_impuestos)
			<option value="{{$i->id_impuestos}}">{{$i->nombre}} ({{$i->valor}})</option>
			@endif
			@endforeach

			</select>
						
			@if($EAN->nombre!='')
			<?php
			$Enable="enable";
			?>	
			@endif
			@endif
			@endforeach
			@endif


			@if($searchText1!="" && $contadorB!='1' && $contador!='1')
			<script >
			 	window.alert("Producto no disponible");
			 </script>
			@endif

			@if($searchText!="" && $contadorB!='1' && $contador!='1')
			<script >
			 	window.alert("Producto no disponible");
			 </script>
			@endif

			<br>
			Descuento: 
			<select name="descuentos_id_descuento" class="form-control">
			@foreach($descuentos as $des)
			<option value="{{$des->id_descuento}}">{{$des->nombre}}</option>
			@endforeach
			</select>
			<br>
			Cantidad: <br>
			<input type="text" class="form-control" name="cantidad" value="1">
			
			<br>
			Fecha: <input type="datetime-local" class="form-control" name="fecha" value="<?php echo date("Y/m/d h:i"); ?>">

			<br> 

		
		<div align="center">			
			<button href="" class="btn btn-info" type="submit" <?php echo $Enable?>>Registrar productos</button>
			<a href="{{url('almacen/facturacion/listaPedidosClientes')}}" class="btn btn-danger">Volver</a>
		</div>
	</div>


{!!Form::close()!!}
</div>

<br>
</body>

@stop
@section('tabla')

<div class="form-group">
	<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>Remisión</th>
							<th>Id</th>
							<th>Producto</th>
							<th>Cantidad</th>
							<th>Precio unitario</th>
							<th>Impuesto</th>
							<th>Descuento</th>
							<th>Total</th>
							<th>Opciones</th>
						</thead>

						@foreach($detalleCliente as $pc)
						<tr>
							<td>{{$pc->t_p_cliente_id_remision}}</td>
							<td>{{$pc->id_dpcliente}}</td>
							<td>{{$pc->producto_id_producto}}</td>
							<td>{{$pc->cantidad}}</td>
							<td>{{$pc->precio_venta}}</td>
							<td>{{$pc->impuestos_id_impuestos}}</td>
							<td>{{$pc->descuentos_id_descuento}}</td>
							<td>{{$pc->total}}</td>
							<td>
								<a href="" data-target="#modal-delete-{{$pc->id_dpcliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('almacen.pedidosDevoluciones.productoPedidoCliente.modal')
						@endforeach
					</table>
				</div>
				
			</div>
			</div><br>

</div>


@stop