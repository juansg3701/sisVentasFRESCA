@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Productos</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
<script src="{{asset('assets/js/jQuery_3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
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
							<h1>Movimiento entre sedes</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Inicio</li>
								<li class="active">Editar movimiento</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{!!Form::model($productos,['method'=>'PATCH','route'=>['almacen.inventario.movimiento-sede.update',$movimientos->id_mstock]])!!}
    {{Form::token()}}

    <!--Formulario de edición-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">EDITAR MOVIMIENTO</h3>
			</div><br>


			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div>

							<datalist id="mylist">
						      		
									@foreach($productoDB as $pb)
											
									<option>{{$pb->nombre}}</option>
											
									@endforeach
						      </datalist>

			                <div class="card-body card-block" align="center">
			               
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Producto:</div>
									</div>
									<div class="form-group col-sm-8">

								@foreach($productos as $p)
								@foreach($productoDB as $pb)
								@if($movimientos->stock_id_stock==$p->id_stock)
								@if($pb->id_producto==$p->producto_id_producto)
								<input  class="form-control" name="stock_id_stock" placeholder="Buscar..." list="mylist" value="{{$pb->nombre}}" id="producto_manual">
								@endif
								@endif
								@endforeach
								@endforeach

									</div>
								</div>

								@if(auth()->user()->superusuario==0)
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede salida:</div>
									</div>
									<div class="form-group col-sm-8">
										
										<select name="sede_id_sede" class="form-control" disabled="">
											@foreach($sedes as $s)
											@if($movimientos->sede_id_sede==$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											@endif
											@endforeach
											@foreach($sedes as $s)
											@if($movimientos->sede_id_sede!=$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											@endif
											@endforeach				
										</select>
									</div>
								</div>
								@else
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede salida:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="sede_id_sede" class="form-control">
											@foreach($sedes as $s)
											@if($movimientos->sede_id_sede==$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											@endif
											@endforeach
											@foreach($sedes as $s)
											@if($movimientos->sede_id_sede!=$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											@endif
											@endforeach				
										</select>
									</div>
								</div>
								@endif

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede entrada:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="sede_id_sede2" class="form-control">
											@foreach($sedes as $s)
											@if($movimientos->sede_id_sede2==$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											@endif
											@endforeach

											@foreach($sedes as $s)
											@if($movimientos->sede_id_sede2!=$s->id_sede)
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											@endif
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Cantidad:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="cantidad" min="1"  id="cantidadJ" value="{{$movimientos->cantidad}}" onkeyup="format(this)"  onchange="format(this)">
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Total:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="number" class="form-control" name="total" id="total" value="{{$movimientos->total}}">
									</div>
								</div>

								<input type="hidden" name="t_movimiento_id_tmovimiento" value="{{$movimientos->t_movimiento_id_tmovimiento}}">
								

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="" value="<?php echo date("Y/m/d H:i:s"); ?>" class="form-control" disabled="true">
										<input type="hidden" name="fecha" value="<?php echo date("Y/m/d H:i:s"); ?>" class="form-control">
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
											<input type="hidden" name="id_empleado" value="{{$usu->id_empleado}}">
											@endif
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-12">
										
										@if($movimientos->t_movimiento_id_tmovimiento==2)
										<button type="submit" class="btn btn-info">Registrar Producto</button>
										@else
										<button type="submit" class="btn btn-info" disabled="true">Registrar Producto</button>
										@endif
											<a href="{{url('almacen/inventario/movimiento-sede')}}" class="btn btn-danger">Volver</a>
									</div>
								</div>
			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>
		</div>
	</div>


<script type="text/javascript">
	
	function format(input)
{
const abono =$('#cantidadJ')
        var final = abono.val().replace(',', '.');
        abono.val(final)
}

$( () => {
					

					$("#cantidadJ").keyup(function(e) {
					var cantidadS=document.getElementById('cantidadJ').value;
				
					
						var valorP=0;
						var producto_ma=document.getElementById('producto_manual').value;

						producto_ma=producto_ma.replace(/á/gi,"&aacute;");
						producto_ma=producto_ma.replace(/é/gi,"&eacute;");
						producto_ma=producto_ma.replace(/í/gi,"&iacute;");
						producto_ma=producto_ma.replace(/ó/gi,"&oacute;");
						producto_ma=producto_ma.replace(/ú/gi,"&uacute;");

						producto_ma=producto_ma.replace(/Á/gi,"&Aacute;");
						producto_ma=producto_ma.replace(/É/gi,"&Eacute;");
						producto_ma=producto_ma.replace(/Í/gi,"&Iacute;");
						producto_ma=producto_ma.replace(/Ó/gi,"&Oacute;");
						producto_ma=producto_ma.replace(/Ú/gi,"&Uacute;");
						 @foreach ($productoDB as $p)
								
						 	if ('{{$p->nombre}}'==producto_ma) {
						 		valorP={{$p->costo_compra}}
						 	}
			            @endforeach
						
						

				
					document.getElementById("total").value=cantidadS*valorP;
						
            		});
            		
            		$("#producto_manual").keyup(function(e) {
					var cantidadS=document.getElementById('cantidadJ').value;
				
					
						var valorP=0;
						var producto_ma=document.getElementById('producto_manual').value;

						producto_ma=producto_ma.replace(/á/gi,"&aacute;");
						producto_ma=producto_ma.replace(/é/gi,"&eacute;");
						producto_ma=producto_ma.replace(/í/gi,"&iacute;");
						producto_ma=producto_ma.replace(/ó/gi,"&oacute;");
						producto_ma=producto_ma.replace(/ú/gi,"&uacute;");

						producto_ma=producto_ma.replace(/Á/gi,"&Aacute;");
						producto_ma=producto_ma.replace(/É/gi,"&Eacute;");
						producto_ma=producto_ma.replace(/Í/gi,"&Iacute;");
						producto_ma=producto_ma.replace(/Ó/gi,"&Oacute;");
						producto_ma=producto_ma.replace(/Ú/gi,"&Uacute;");
						 @foreach ($productoDB as $p)
								
						 	if ('{{$p->nombre}}'==producto_ma) {
						 		valorP={{$p->costo_compra}}
						 	}
			            @endforeach
						
						

				
					document.getElementById("total").value=cantidadS*valorP;
						
            		});
				
			});
</script>	
{!!Form::close()!!}		
</body>

@stop