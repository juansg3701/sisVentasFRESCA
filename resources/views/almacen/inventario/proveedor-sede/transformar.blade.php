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
				<h3 class="pb-2 display-5">TRANSFORMAR INVENTARIO</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			                <div class="card-header" align="center">
			                     <strong>Formulario de edición</strong>
			                </div><br>
			                <div class="card-body card-block" align="center">

		{!!Form::model($ps,['method'=>'PATCH','route'=>['almacen.inventario.ean.update',$ps->id_stock]])!!}
    {{Form::token()}}
		    
            <div class="form-row">
            <input type="hidden" name="id" value="{{$ps->id_stock}}">
		    <input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>">
		

				<div class="form-group col-sm-6">
					<div>Kilos actuales:</div>
				</div>
				<div class="form-group col-sm-4">
                   {{ $ps->cantidad}}
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Kilos utilizados:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<input type="number" class="form-control" name="cantidadRestar">
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Producto nuevo:</div>
				</div>
				<div class="form-group col-sm-4">
					<input id="buscar2" class="form-control" name="nombre_producto" placeholder="Buscar..." >
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Transformar a:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<select name="transformacion_stock_id" class="form-control">
						@foreach($categoriaTrans as $c)
						<option value="{{$c->id_categoria}}">{{$c->nombre}}</option>
						@endforeach
					</select>
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Cantidad en unidades:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<input type="number" class="form-control" name="cantidad">
				</div>
            </div>
                                    
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Registrar</button>
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

 <!--opc-->
    <link rel="stylesheet" href="{{asset('//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css')}}">
  <script src="{{asset('https://code.jquery.com/ui/1.12.1/jquery-ui.js')}}"></script>

<script type="text/javascript">
$( function() {
  
alert("aa");
  @if(isset($eanP))
alert("aa");
     var nombrePA = [
            @foreach ($eanP as $e)
              '{{$e->nombre}}',
            @endforeach
      ];

     $( "#buscar2" ).autocomplete({
        
      source: nombrePA
    });
  
  @endif

    
  } );
</script>

@stop