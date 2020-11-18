@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos proveedor</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->


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

	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Inventario</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Inventario</li>
								<li class="active">Edici&oacuten de inventario</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR INVENTARIO</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">
							
						
	{!!Form::model($stock,['method'=>'PATCH','route'=>['almacen.inventario.proveedor-sede.update',$stock->id_stock]])!!}
    {{Form::token()}}

			<div id=formulario>
				<div class="form-group">

						
							<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Producto:</div>
								</div>
								<div class="form-group col-sm-8">
									<select name="producto_id_producto" class="form-control" value="{{$stock->producto_id_producto}}">
										@foreach($producto as $p)
										@if($stock->producto_id_producto==$p->id_producto)
										<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
										@endif
										@endforeach

										@foreach($producto as $p)
										@if($stock->producto_id_producto!=$p->id_producto)
										<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
										@endif
										@endforeach
									</select>
								</div>
							</div>
					
					@if(auth()->user()->superusuario==0)
					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Sede:</div>
								</div>
						<div class="form-group col-sm-8">
							<input type="hidden" name="sede_id_sede" value="{{$stock->sede_id_sede}}">
							<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}" disabled="">
								@foreach($sede as $s)
								@if($stock->sede_id_sede==$s->id_sede)
								<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
								@endif
								@endforeach
								@foreach($sede as $s)
								@if($stock->sede_id_sede!=$s->id_sede)
								<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>
						 
						
					@else
					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Sede:</div>
								</div>
						<div class="form-group col-sm-8">
							<select name="sede_id_sede" class="form-control" value="{{$stock->sede_id_sede}}">
								@foreach($sede as $s)
								@if($stock->sede_id_sede==$s->id_sede)
								<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
								@endif
								@endforeach
								@foreach($sede as $s)
								@if($stock->sede_id_sede!=$s->id_sede)
								<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>
				
					@endif
					
					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Proveedor:</div>
								</div>
						<div class="form-group col-sm-8">
							<select name="proveedor_id_proveedor" class="form-control" value="{{$stock->proveedor_id_proveedor}}">
								@foreach($proveedor as $pr)
								@if($stock->proveedor_id_proveedor==$pr->id_proveedor)
								<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
								@endif
								@endforeach

								@foreach($proveedor as $pr)
								@if($stock->proveedor_id_proveedor!=$pr->id_proveedor)
								<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
								@endif
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Disponibilidad:</div>
								</div>
						<div class="form-group col-sm-8">
							<select name="disponibilidad" class="form-control" value="{{$stock->disponibilidad}}">
									
								@if($stock->disponibilidad=='1')
								<option value="1">Disponible</option>
								<option value="0">No disponible</option>
								@endif
								@if($stock->disponibilidad=='0')
								<option value="0">No disponible</option>
								<option value="1">Disponible</option>
								@endif
								
					
							</select>
						</div>
					</div>

					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Cantidad:</div>
								</div>
						<div class="form-group col-sm-8">
							<input type="text" class="form-control" name="cantidad" value="{{$stock->cantidad}}">
			
						</div>
					</div>

					<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Transformación:</div>
									</div>
									<div class="form-group col-sm-8">
										

										<select name="transformacion_stock_id" class="form-control" value="{{$stock->transformacion_stock_id}}">
											@foreach($transformacion as $t)
											@if($stock->transformacion_stock_id==$t->id_categoria)
											<option value="{{$t->id_categoria}}">{{$t->nombre}}</option>
											@endif
											@endforeach

											@foreach($transformacion as $t)
											@if($stock->transformacion_stock_id!=$t->id_categoria)
											<option value="{{$t->id_categoria}}">{{$t->nombre}}</option>
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
										<input type="datetime" name="" value="<?php echo date("Y/m/d H:i:s"); ?>" class="form-control" disabled="true">
										<input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>" class="form-control">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="" class="form-control" disabled="true">
											@foreach($usuarios as $usu)
											@if(Auth::user()->id==$usu->user_id_user)
											<option value="{{$usu->id_empleado}}">{{$usu->nombre}}</option>
											<input type="hidden" name="empleado_id_empleado" value="{{$usu->id_empleado}}">
											@endif
											@endforeach
										</select>
									</div>
								</div>
								
								<div align="center">
								<button type="submit" class="btn btn-info">Registrar Producto</button>

								<a href="{{url('almacen/inventario/proveedor-sede')}}"><button type="button" class="btn btn-danger">Volver</button></a>
								</div>
								
					
			
				</div>
			</div>
		{!!Form::close()!!}	

							
			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>

		</div>
	</div>		                       



</body>

@stop