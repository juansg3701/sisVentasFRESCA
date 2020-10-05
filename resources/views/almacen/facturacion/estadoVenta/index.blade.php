@extends ('layouts.admin')
@section ('contenido')
	<head>
	<title>Facturación</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->
</head>

<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Estado de la compra de: {{$id}}</h3>
				{{$estadoTx}}
			
				<br>
				<br>

			<a href="{{URL::action('facturacionListaVentas@show',0)}}"><button class="btn btn-info" >Regresar</button></a>
	

		</div>
	</div>


	
</body>
@stop
