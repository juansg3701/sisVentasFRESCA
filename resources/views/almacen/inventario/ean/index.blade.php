@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
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
		<datalist id="mylist2">
       @foreach($producto as $p)
			<option>{{ $p->ean}}</option>
       @endforeach
      </datalist>
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
							<div class="form-group col-sm-2" align="right">
								<div>EAN:</div>
							</div>
							<?php
					$valor=count($pEAN);
					?>
							<div class="form-group col-sm-6">

							{!! Form::open(array('url'=>'almacen/inventario/ean','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}

								
								<div class="input-group">
								<input type="text" class="form-control" name="searchText" placeholder="Buscar..." list="mylist2" value="{{$searchText}}">
							
								<span class="input-group-btn">
									<button type="submit" class="btn btn-primary">Buscar</button>
								</span>
									</div>
							{{Form::close()}}
							</div>
							<div class="form-group col-sm-3">
									
									@if($valor!=0)
										<?php
										 
										foreach($pEAN as $pE){
										 $valor_producto=$pE->id_producto;
										}

										?>

									<a href="{{URL::action('ProductoSedeController@edit',$valor_producto)}}"><button class="btn btn-outline-primary btn-sm">Editar producto</button></a>

									@endif
								
								
							</div>
							<div class="form-group col-sm-1">
								
							</div>
						</div>


							
			{!!Form::open(array('url'=>'almacen/inventario/ean','method'=>'POST','autocomplete'=>'off'))!!}
		    {{Form::token()}}
			<div id=formulario>
				<div class="form-group">

							@foreach($pEAN as $pE)
							<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Producto automático:</div>
								</div>
								<div class="form-group col-sm-8">
									<input type="hidden" class="form-control" name="producto_id_producto" value="{{$pE->nombre}}">
									<input type="text" class="form-control" name="producto" value="{{$pE->nombre}}" disabled="true">
								</div>
							</div>
							@endforeach

					
							@if($valor==0)
								<!-- datlist para el autocompletado -->
						       <datalist id="mylist">
						       @foreach($producto as $p)
									<option>{{ $p->nombre}}</option>
						       @endforeach
						      </datalist>

						      

							<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Producto manual:</div>
								</div>
								<div class="form-group col-sm-8">
									<input  class="form-control" name="producto_id_producto" placeholder="Buscar..." list="mylist" id="producto_manual">
								</div>
							</div>
							
							@endif
					
					@if(auth()->user()->superusuario==0)
					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Sede:</div>
								</div>
						<div class="form-group col-sm-8">
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
						</div>
					</div>
						 
						
					@else
					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Sede:</div>
								</div>
						<div class="form-group col-sm-8">
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
						</div>
					</div>
				
					@endif
					
					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Proveedor:</div>
								</div>
						<div class="form-group col-sm-8">
							<select name="proveedor_id_proveedor" class="form-control">
									@foreach($proveedor as $pr)
								<option value="{{$pr->id_proveedor}}">{{$pr->nombre_proveedor}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Disponibilidad:</div>
								</div>
						<div class="form-group col-sm-8">
							<select name="disponibilidad" class="form-control">
							
								<option value="1">Disponible</option>
								<option value="0">No disponible</option>
					
							</select>
						</div>
					</div>

					<div class="form-row">
								<div class="form-group col-sm-4">
									<div>Cantidad:</div>
								</div>
						<div class="form-group col-sm-8">
							
								<input type="text" step="any" class="form-control" name="cantidad" min="1" id="cantidadJ" onkeyup="format(this)"  onchange="format(this)" >
						</div>
					</div>

					<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Transformación:</div>
									</div>
									<div class="form-group col-sm-8">
										<select name="transformacion_stock_id" class="form-control">
											@foreach($transformacion as $t)
											@if($t->nombre=="Sin transformar")
											<option value="{{$t->id_categoria}}">{{$t->nombre}}</option>
											@endif
											@endforeach

											@foreach($transformacion as $t)
											@if($t->nombre!="Sin transformar")
											<option value="{{$t->id_categoria}}">{{$t->nombre}}</option>
											@endif
											@endforeach
										</select>
									</div>
								</div>

					<div class="form-row">
						<div class="form-group col-sm-4">
							<div>No. de factura:</div>
						</div>
						<div class="form-group col-sm-8">
							<input type="text" class="form-control" name="noFactura">
						</div>
					</div>

					<div class="form-row">
						<div class="form-group col-sm-4">
							<div>Total:</div>
						</div>
						<div class="form-group col-sm-8">
							<input type="number" class="form-control" name="total" id="total">
						</div>
					</div>

					<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="datetime" name="" value="<?php echo date("Y/m/d H:i:s"); ?>" class="form-control" disabled="true">
										<input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>">
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
					<a href="{{url('almacen/inventario/proveedor-sede')}}">
					<button type="button" class="btn btn-danger">Volver</button></a>
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
				
						if("<?php echo $valor;?>"!=0){
						var valorP="<?php 
						foreach($pEAN as $p){
							echo $p->costo_compra;
						}
						?>";
						}else{
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
						 @foreach ($producto as $p)
								
						 	if ('{{$p->nombre}}'==producto_ma) {
						 		valorP={{$p->costo_compra}}
						 	}
			            @endforeach
						
						}

				
					document.getElementById("total").value=cantidadS*valorP;
						
            		});
				
			});
			
		</script>
</body>

@stop