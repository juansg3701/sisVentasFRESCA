@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
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
								<li class="active">Registro de inventario</li>
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
				<h3 class="pb-2 display-5">REGISTRAR INVENTARIO</h3>
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
							<div class="form-group col-sm-3" align="right">
								<div>EAN:</div>
							</div>
							<div class="form-group col-sm-6">
							{!! Form::open(array('url'=>'almacen/inventario/ean','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

								
								<div class="input-group">
								<input type="text" class="form-control" name="searchText" placeholder="Buscar..." value="{{$searchText}}">
								
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary">Buscar</button>
								</span>
									</div>
							{{Form::close()}}
							</div>
							<div class="form-group col-sm-3">
							</div>
						</div>


			{!!Form::open(array('url'=>'almacen/inventario/ean','method'=>'POST','autocomplete'=>'off'))!!}
		    {{Form::token()}}
			<div id=formulario>
				<div class="form-group">

						<div class="form-row">
			                <div class="form group col-sm-12" align="center">
			                <div class="form-row">
							@foreach($pEAN as $pE)
							Producto automático:
							<input type="hidden" class="form-control" name="producto_id_producto" value="{{$pE->id_producto}}">
							<input type="text" class="form-control" name="producto" value="{{$pE->nombre}}" disabled="true">
							@endforeach

					<?php
					$valor=count($pEAN);
					?>
							@if($valor==0)
							Producto<br>
							<select name="producto_id_producto" class="form-control">
								@foreach($producto as $p)
								<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
								@endforeach
							</select>
							@endif
					
					@if(auth()->user()->superusuario==0)
						Sede: <br>
						<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
				<select name="sede_id_sede" class="form-control" disabled="">

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
						Sede: <br>
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
							</div>
						</div>
					</div>
					
					Proveedor<br>
					<select name="proveedor_id_proveedor" class="form-control">
							@foreach($proveedor as $pr)
						<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
						@endforeach
					</select>
					Disponible<br>
					<select name="disponibilidad" class="form-control">
							
						<option value="1">Disponible</option>
						<option value="0">No disponible</option>
			
					</select>
					Cantidad<br>
					<input type="text" class="form-control" name="cantidad">
					<br>
					<div align="center">
					<button type="submit" class="btn btn-info">Registrar Producto</button><a href="{{url('almacen/inventario/proveedor-sede')}}" class="btn btn-danger">Volver</a>
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