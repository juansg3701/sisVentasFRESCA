@extends ('layouts.admin')
@section ('contenido')
	
<head>
	<title>Interfaz Cargar</title>
</head>

<body>

	<div class="row" align="center">
			<div align="center"><h4>Importar Archivo Excel</h4></div><br>
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

	<div id="formulario">
		<form method="post" id="addproduct" action="/import.php" enctype="multipart/form-data" role="form">
  			<div align="center">
    			<label class="control-label">Seleccione un archivo (.xlsx)*</label><br>
     			<input type="file" name="name"  id="name" placeholder="Archivo (.xlsx)">
				<br><br>
     			<a><button type="submit" class="btn btn-success" onClick="location.reload();">Cargar xls</button></a>
  			</div>
		</form>
	</div>

</body>

@stop
