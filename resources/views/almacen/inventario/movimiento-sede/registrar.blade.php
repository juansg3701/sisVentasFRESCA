@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Inventario</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
<script src="{{asset('assets/js/jQuery_3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery-ui.min.js')}}"></script>
</head>
<body>

{!!Form::open(array('url'=>'almacen/inventario/movimiento-sede','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}
    <!--Formulario de edición-->	
	<div class="col-md-12">
		<div class="card">
			<div class="card-header" align="center">
				<h3 class="pb-2 display-5">REGISTRAR MOVIMIENTO</h3>
			</div><br>

			<div class="col-sm-12" align="center">
			</div><br>

			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div>
			                <div class="card-body card-block" align="center">

								<datalist id="mylist">
						      		
								@foreach($productoDB as $pb)			
									<option>{{$pb->nombre}}</option>
								@endforeach
						      </datalist>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Producto:</div>
									</div>
									<div class="form-group col-sm-8">
										<input  class="form-control" name="stock_id_stock" placeholder="Buscar..." list="mylist" id="producto_manual">
									</div>
								</div>
								@if(auth()->user()->superusuario==0)
								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Sede salida:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="hidden" name="sede_id_sede" value="{{Auth::user()->sede_id_sede}}">
										<select name="sede_id_sede" class="form-control" disabled="">
											@foreach($sedes as $s)
											@if(Auth::user()->sede_id_sede==$s->id_sede)
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
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
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
											<option value="{{$s->id_sede}}">{{$s->nombre_sede}}</option>
											@endforeach
										</select>
									</div>
								</div>

								<div class="form-row">
									<div class="form-group col-sm-4">
										<div>Cantidad:</div>
									</div>
									<div class="form-group col-sm-8">
										<input type="text" class="form-control" name="cantidad" min="1"  id="cantidadJ" onkeyup="format(this)"  onchange="format(this)">
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
								
								<input type="hidden" name="t_movimiento_id_tmovimiento" value="2">


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
										<button type="submit" class="btn btn-info">Registrar Producto</button>
										
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