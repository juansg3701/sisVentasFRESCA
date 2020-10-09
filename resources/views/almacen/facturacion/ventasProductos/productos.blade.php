@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Ventas</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
  
</head>

<body>
	
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Productos</h3>
		</div>
	</div>


<div align="center" id=formulario>
	<div class="input-group"  >
		<h3>Automatico</h3>
		<div align="center">
			{!! Form::open(array('url'=>'almacen/facturacion/ventasProductos','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
			
                <br>EAN:<input id="tags" class="form-control" name="searchText" placeholder="Buscar..." >
                </br><br>
                <input type="hidden" class="form-control" name="factura_id_factura" value="{{$id}}">
					Nombre:
					<input id="buscar2" class="form-control" name="searchText1" placeholder="Buscar..." ></br><br><br><input type="submit" class="btn btn-primary" value="Buscar">
					</br>
			{{Form::close()}}


			{!!Form::open(array('url'=>'almacen/facturacion/ventasProductos','method'=>'POST','autocomplete'=>'off'))!!}
    		{{Form::token()}}


			<br>
    		Número de factura:  {{$id}}
			<input type="hidden" class="form-control" name="factura_id_factura" value="{{$id}}">
			<br>
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

	
			@if($searchText!="" && $contadorB!='1' && $contador!='1')
			<script >
			 	window.alert("Producto no disponible");
			 </script>
			@endif

			@if($searchText1!="" && $contadorB!='1' && $contador!='1')
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
			<br>
			Fecha: <input type="datetime" class="form-control" name="fecha" value="<?php echo date("Y/m/d"); ?>">

			<br> 
			
			<input type="hidden" class="form-control" name="total" value="0">
			@foreach($facturas as $f)
					@if($f->id_factura==$id)
						@if($f->facturaPaga=='1')
							<?php
							$Enable="disabled";
							?>
						@endif
					@endif
			@endforeach

			<br>
			<br>
			<br>
			<div align="center">			
				<button href="" class="btn btn-info" type="submit" <?php echo $Enable?>>Guardar productos</button>
			<a href="{{URL::action('facturacionListaVentas@show',0)}}" class="btn btn-danger">Volver</a>
			</div>
			</div>

{!!Form::close()!!}	
	</div>
	</div>


</body>

@stop
@section('tabla')
<div class="container">
<div class="form-group">
		<div class="row">
				<div class="table-responsive">
					<table class="table table-striped table-bordered table-condensed table-hover">
						<thead>
							<th>ID </th>
							<th>ID FACTURA</th>
							<th>PRODUCTO</th>
							<th>PROVEEDOR</th>
							<th>CANTIDAD</th>
							<th>PRECIO UNITARIO</th>
							<th>IMPUESTO</th>
							<th>DESCUENTO</th>
							<th>PAGO TOTAL</th>
							<th>OPCIONES</th>

						</thead>
						
						@foreach($productos as $p)
						<tr>
							<td>{{$p->id_detallef}}</td>
							<td>{{$p->factura_id_factura}}</td>
							<td>{{$p->producto_id_producto}}</td>
							<td>{{$p->nproveedor}}</td>
							<td>{{$p->cantidad}}</td>
							<td>{{$p->precio_venta}}</td>
							<td>{{$p->impuestos_id_impuestos}}</td>
							<td>{{$p->descuentos_id_descuento}}</td>
							<td>{{$p->total}}</td>

							<td>
						
								<a href="" data-target="#modal-delete-{{$p->id_detallef}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
							@include('almacen.facturacion.ventasProductos.modal')
						@endforeach
					</table>
					<div align="center">
						
					@foreach($facturas as $f)
					@if($f->id_factura==$id && $f->pago_total!=0)
							@if($f->tipo_pago_id_tpago=='1'  && $f->facturaPaga=='0')
							
							<a href="" data-target="#modal-pagar-{{$id}}" data-toggle="modal"><button href="" class="btn btn-info">Pagar</button></a>
							

							<a href="
								{{URL::action('FacturaController@edit',$id)}}" target="_blank"><button class="btn btn-warning" disabled="true">Generar Factura</button></a>
							<a href="
								{{URL::action('FacturaController@create',$id)}}" target="_blank"><button class="btn btn-primary" disabled="true">Generar XML</button></a>
							@else
							<a href="" data-target="#modal-pagar-{{$id}}" data-toggle="modal"><button href="" class="btn btn-info" disabled="true">Pagar</button></a>
							
							<a href="
								{{URL::action('FacturaController@edit',$id)}}" target="_blank"><button class="btn btn-warning">Generar Factura</button></a>
							<a href="
								{{URL::action('FacturaController@show',$id)}}" target="_blank"><button class="btn btn-primary">Generar XML</button></a>
							@endif
					
					@endif
					
					@endforeach
					
				@include('almacen.facturacion.pagoEfectivo.pago')
				</div>
				</div>
				
			
			</div><br>
		</div>
		</div>
@stop



