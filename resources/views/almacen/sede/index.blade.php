@extends ('layouts.admin')
@section ('contenido')
<!--Este archivo maneja la vista principal del módulo de sedes-->		
<head>
	<title>Proveedores</title>
	<!--importar ajax para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	


<div class="row" align="center">	
	 	<div class="col-sm-12" align="center">
			<div class="card" align="center">
				<div class="row" align="center">
					<div class="col-sm-12" align="center">
						<h2>SEDES</h2>
					</div>
				</div>

				<div class="row" align="center">	
					<div class="col-sm-3" align="center"></div>
					 	<div class="col-sm-6" align="center">
							<div class="card" align="center">
				                <div class="card-header" align="center">
				                     <strong>Establecer filtros</strong>
				                </div>
				                <div class="card-body card-block" align="center">
									<div id=formulario>
										<div class="form-group">
											<!--Incluir la ventana modal de búsqueda y carga de excel-->	
											@include('almacen.sede.search')
											<div align="center">
												<!--Enlaces y botones para llamar las funciones de registro, descarga de excel y la ventana modal para carga de excel-->
												<a href="{{URL::action('SedeController@create',0)}}"><button class="btn btn-info">Registrar Sede</button></a>	
												<a href="{{url('/')}}" class="btn btn-danger">Regresar</a>
											</div>
										</div>
									</div>
				               </div>
				        	</div>
						</div>
					<div class="col-sm-3" align="center"></div>
				</div>



        	</div>
		</div>
</div>









</body>
@endsection
@section('tabla')
<!--Tabla de registros realizados en la tabla de proveedor en la base de datos-->	
<div class="row" align="center">
	<div class="col-sm-12" align="center">
		<h3>SEDES REGISTRADAS</h3>
	</div>
</div><br>

<div class="row m-t-30">
    <div class="col-md-12">
        <!-- DATA TABLE-->
        <div class="table-responsive m-b-40">
            <table class="table table-borderless table-striped table-earning">
                <thead>
					<th>ID</th>
					<th>NOMBRE</th>
					<th>CIUDAD</th>
					<th>DESCRIPCIÓN</th>
					<th>DIRECCIÓN</th>
					<th>TELÉFONO</th>
					<th>OPCIONES</th>
				</thead>
				@foreach($sedes as $sed)
				<tr>
					<td>{{ $sed->id_sede}}</td>
					<td>{{ $sed->nombre_sede}}</td>
					<td>{{ $sed->ciudad}}</td>
					<td>{{ $sed->descripcion}}</td>
					<td>{{ $sed->direccion}}</td>
					<td>{{ $sed->telefono}}</td>
					<td>		
	                    <div class="table-data-feature">
							<a href="{{URL::action('SedeController@edit',$sed->id_sede)}}"><button class="item" data-toggle="tooltip" data-placement="top" title="Edit"><i class="zmdi zmdi-edit"></i></button></a>
							
							@if(isset($sed->id_sede))
@include('almacen.sede.modal')
							<a href="" data-target="#modal-delete-{{$sed->id_sede}}" data-toggle="modal"><button class="item" ><i class="zmdi zmdi-delete"></i></button></a>
							<a href="" data-target="#modal-delete-{{$sed->id_sede}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							@endif
							
	                    </div>
                	</td>
				</tr>
				
				
				@endforeach
            </table>
        </div>
        {{$sedes->render()}}
		<!-- END DATA TABLE-->
    </div>

</div>

@endsection



@include('almacen.sede.mod')
