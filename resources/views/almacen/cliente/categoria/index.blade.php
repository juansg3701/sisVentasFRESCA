@extends ('layouts.admin')
@section ('contenido')
<!--Este archivo maneja la vista principal de la categoría del cliente-->	
<head>
	<title>Categoria cliente</title>
</head>

<body>
	<!--Control de errores en los campos del formulario-->	
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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


	<!--Panel superior-->
	<div class="breadcrumbs">
		<div class="breadcrumbs-inner">
			<div class="row m-0">
				<div class="col-sm-4">
					<div class="page-header float-left">
						<div class="page-title">
							<h1>Cliente</h1>
						</div>
					</div>
				</div>
				<div class="col-sm-8">
					<div class="page-header float-right">
						<div class="page-title">
							<ol class="breadcrumb text-right">
								<li class="active">Cliente</li>
								<li class="active">Categoría Cliente</li>
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
				<h3 class="pb-2 display-5">CATEGORÍA CLIENTE</h3>
			</div><br>
			<div class="row" align="center">	
				<div class="col-sm-3" align="center"></div>
				 	<div class="col-sm-6" align="center">
						<div class="card" align="center">
			           
			                <div class="card-body card-block" align="center">
								<div class="form-row">
									<div class="form-group col-sm-12">
										<a href="{{url('almacen/cliente/cliente')}}" class="btn btn-danger">Regresar</a>
									</div>
								</div>	
			               </div>
			        	</div>
					</div>
				<div class="col-sm-3" align="center"></div>
			</div>
		</div>
	</div>	
</body>
@stop




@section('tabla')
<!--Tabla de registros realizados-->
<div class="content">
	<div class="animated fadeIn">

		<div class="row">
			<div class="col-md-12">

				<div class="card">
					<div class="card-header" align="center">
						<h3 class="pb-2 display-5">CATEGORIAS REGISTRADAS</h3>
					</div>
					<div class="card-body">
						@include('almacen.cliente.categoria.search')	
						<table id="bootstrap-data-table" class="table table-striped table-bordered">
							<thead>
								<th>NOMBRE</th>
								<th>DESCRIPCIÓN</th>
								<th>No. COLUMNA</th>	
								<th colspan="2">OPCIONES</th>
							</thead>
							@foreach($categorias as $cat)
							<tr>
								<td>{{ $cat->nombre}}</td>
								<td>{{ $cat->descripcion}}</td>
								<td>{{ $cat->no_precio}}</td>
								<td>
									<a href="{{URL::action('CategoriaClienteController@edit',$cat->id_categoria)}}"><button class="btn btn-outline-primary btn-sm">Editar</button></a>
								</td>
							
								<td>
									<a href="" title="Registro de cambios" data-target="#modal-infoCategoria-{{$cat->id_categoria}}" data-toggle="modal"><button class="btn btn-outline-secondary btn-sm">+</button></a>
								</td>
							</tr>
							@include('almacen.cliente.categoria.modal')
							@include('almacen.cliente.categoria.modalInfoCategoria')
							@endforeach
						</table>
					</div>
				{{$categorias->render()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

