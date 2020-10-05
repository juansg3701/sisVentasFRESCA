@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Facturas Por Pagar</title>
    <!--<link rel="stylesheet" href="{{ asset('css/Almacen/usuario/styles-iniciar.css') }}" />-->

</head>
<body>
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Editar Datos Sede: {{$facturaPagar->nombrepago}}</h3>
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

	{!!Form::model($facturaPagar,['method'=>'PATCH','route'=>['almacen.pagosCobros.FacturasPagar.update',$facturaPagar->id_ctaspagar]])!!}
    {{Form::token()}}

	<div id=formulario>
		
		

		Nombre Factura: <input type="text" class="form-control" name="nombrepago" value="{{$facturaPagar->nombrepago}}">
		Descripción: <input type="text" class="form-control" name="descripcion" value="{{$facturaPagar->descripcion}}">
		Fecha: <input type="date" class="form-control" name="fecha" value="{{$facturaPagar->fecha}}">			
		Banco: <br>
		<select name="bancos_id_banco" class="form-control" >
			@foreach($bancos as $ban)
			<option value="{{$ban->id_banco}}">{{$ban->nombre_banco}}</option>
			@endforeach
		</select>
		Valor Abono: <input type="text" class="form-control" name="abono" value="{{$facturaPagar->abono}}">
		Total deuda: <input type="text" class="form-control" name="total" value="{{$facturaPagar->total}}">

		<br>
		<button class="btn btn-info" type="submit">Registrar</button>
		<button class="btn btn-danger" type="reset">Cancelar</button>
	</div>
	
{!!Form::close()!!}		
</body>

@stop