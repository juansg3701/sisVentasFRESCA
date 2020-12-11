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
								<li class="active">Productos</li>
								<li class="active">Registrar producto</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
{!!Form::open(array('url'=>'almacen/inventario/producto-sede/productoCompleto','method'=>'POST','autocomplete'=>'off','files'=>'true'))!!}
    {{Form::token()}}
    <form name="form1">

     <!--Formulario de registro-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR PRODUCTO</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="" align="center"></div>
				 	<div class="col-sm-12" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de registro</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">

			                	<div class="form-row">
			                	<div class="form group col-sm-12" align="center">
									<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Nombre:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="text" class="form-control" name="nombre" id="nombre">
									</div>

									<div class="form-group col-sm-1"></div>
							
									<div class="form-group col-sm-2">
										<div>Unidad de medida:</div>
									</div>

									<div class="form-group col-sm-3">
										<select name="unidad_de_medida" id="unidad_de_medida" class="form-control">
											
										<option value="UNIDAD">UNIDAD</option>
										<option value="KILO">KILO</option>
										</select>
									</div>
								</div>

								</div>	
			                	</div>
								
			                	<div class="form-row">
			                	<div class="form group col-sm-12" align="center">
			                	<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Precio No.1:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="number" class="form-control" name="precio_1" id="precio_1" min="1" pattern="^[0-9]+">
									</div>
								
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
										<div>Stock m&iacutenimo:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="number" class="form-control" name="stock_minimo" id="stock_minimo" min="1" pattern="^[0-9]+">
									</div>
								</div>

			                	</div>
			                </div>
								

								
								<div class="form-row">
			                	<div class="form group col-sm-12" align="center">

								<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Precio No.2:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="number" class="form-control" name="precio_2" id="precio_2" min="1" pattern="^[0-9]+">
									</div>
								
									<div class="form-group col-sm-1"></div>
									<div class="form-group col-sm-2">
										<div>Impuesto:</div>
									</div>
									<div class="form-group col-sm-3">
										<select name="impuestos_id_impuestos" class="form-control">
											@foreach($impuestos as $im)
											<option value="{{$im->id_impuestos}}">{{$im->nombre}}</option>
											@endforeach
										</select>
									</div>
								</div>
							</div>
						</div>

						<div class="form-row">
			                	<div class="form group col-sm-12" align="center">

								<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Precio No.3:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="number" class="form-control" name="precio_3" id="precio_3" min="1" pattern="^[0-9]+">
									</div>
									<div class="form-group col-sm-1"></div>
									<div class="form-group col-sm-2">
										<div>Categor&iacutea:</div>
									</div>
									<div class="form-group col-sm-3">
										<select name="categoria_id_categoria" class="form-control">
											@foreach($categorias as $ct)
											<option value="{{$ct->id_categoria}}">{{$ct->nombre}}</option>
											@endforeach
										</select>	
									</div>
								
									
									
								</div>
							</div>
						</div>

						<div class="form-row">
			                	<div class="form group col-sm-12" align="center">

								<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Precio No.4:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="number" class="form-control" name="precio_4" id="precio_4" min="1" pattern="^[0-9]+">
									</div>
									
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
										<div>Descuento:</div>
									</div>
									<div class="form-group col-sm-3">
										<select name="descuento_id_descuento" class="form-control">
											@foreach($descuentos as $d)
											<option value="{{$d->id_descuento}}">{{$d->nombre}}</option>
											@endforeach
										</select>
									</div>
								
									
									
								</div>
							</div>
						</div>

						<div class="form-row">
			                	<div class="form group col-sm-12" align="center">

								<div class="form-row">
									<div class="form-group col-sm-2">
										<div>Costo de compra:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="number" class="form-control" name="costo_compra" id="costo_compra" min="1" pattern="^[0-9]+">
									</div>
									
									<div class="form-group col-sm-1"></div>
									<div class="form-group col-sm-2">
											<div>Imagen:</div>
										</div>
										<div class="form-group col-sm-3">
											<input type="file" name="imagen" class="form-control" placeholder="">
										</div>
								
								</div>
							</div>
						</div>

						<div class="form-row">
			                	<div class="form group col-sm-12" align="center">

								<div class="form-row">
										<div class="form-group col-sm-2">
										<div>PLU:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="text" class="form-control" name="plu" id="plu">
									</div>
									
									
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
										<div>Fecha:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="datetime" name="" value="<?php echo date("Y/m/d H:i:s"); ?>" class="form-control" disabled="true">
										<input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>" class="form-control">
									</div>
								
								</div>
							</div>
						</div>

						<div class="form-row">
			                	<div class="form group col-sm-12" align="center">

								<div class="form-row">
								<div class="form-group col-sm-2">
										<div>EAN:</div>
									</div>
									<div class="form-group col-sm-3">
										<input type="text" class="form-control" name="ean" id="ean">
									</div>
									
									
									<div class="form-group col-sm-1"></div>

									<div class="form-group col-sm-2">
										<div>Empleado:</div>
									</div>
									<div class="form-group col-sm-3">
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
							</div>
						</div>

					

						
								<input type="hidden" name="punto_venta_id_punto_venta" value="1">

								<div class="form-row">
									<div class="form-group col-sm-12">
										<button class="btn btn-info" name="boton1" type="button" onclick="a()">Registrar</button>

										<button type="submit" id="envio" name="envio" style="display: none"></button>
										<a href="{{url('almacen/inventario/producto-sede/productoCompleto')}}" class="btn btn-danger">Regresar</a>
									</div>
								</div>
								
			               </div>
			        	</div>
					</div>
				<div class="" align="center"></div>
				
			</div>

		</div>
	</div>		
	 </form>
{!!Form::close()!!}	
</body>
<!-- jquery para mensajes-->
 <script src="{{asset('assets/js/jQuery.js')}}"></script>
<script type="text/javascript">

	function a(){
		
  var ean = $('#ean').val();
  var nombre = $('#nombre').val();
  var unidad = $('#unidad_de_medida').val();
  var precio1 = $('#precio_1').val();
  var stock = $('#stock_minimo').val();
  var precio2 = $('#precio_2').val();
  var precio3 = $('#precio_3').val();
  var precio4 = $('#precio_4').val();
  var costo_compra = $('#costo_compra').val();

  var excedente=costo_compra*0.35;
  var costo=parseFloat(costo_compra)+parseFloat(excedente);

        
        if(ean==='' || nombre==='' || unidad==='' || precio1==='' || precio2==='' || precio3===''
        	|| precio4==='' || stock==='' || costo_compra===''){
            Swal.fire({
                icon: 'error',
                text: 'Por favor ingrese todos los datos',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });    


        }else {	
        	if(costo<=precio1 && costo<=precio2 && costo<=precio3 && costo<=precio4){
        	 document.getElementById("envio").click(); 
        	}else{
        		Swal.fire({
                icon: 'error',
                text: 'Los precios deben ser mayores al precio de compra',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });  
        	}
        }
    }//IF DEL ENTER
	

</script>
@stop