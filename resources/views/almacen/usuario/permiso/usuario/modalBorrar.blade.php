<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-borrar">
	
<!--Formulario de búsqueda y opciones-->
<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" align="left">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">

						<div class="row" align="center">	
							<div class="col-sm-12" align="center"></div>
								<div class="col-sm-12" align="center">
									<div class="card" align="center">
										<div class="card-header" align="center">
											<strong></strong>
										</div>
										<div class="card-body card-block" align="center">
											<div id=formulario>
												<div class="form-group">
													<!--Incluir la ventana modal de búsqueda-->	
												{!!Form::model(0,['method'=>'PATCH','route'=>['almacen.usuario.permiso.usuario.update',0]])!!}
    												{{Form::token()}}

										<div id=formulario align="center">
													
													<br>
													Cargo:
														<select name="id_cargo" class="form-control">
													@foreach($cargos as $car)
													<option name="id_cargo" value="{{$car->id_cargo}}">{{$car->nombre}}</option>
													@endforeach
												</select>
										<br>
												Módulo:
													<select name="id_modulo" class="form-control">
													@foreach($mod as $m)
													<option name="id_modulo" value="{{$m->id_modulo}}">{{$m->nombre}}</option>
													@endforeach
												</select>

										<br>
										<br>
													<div align="center">
													<button type="submit" class="btn btn-info">Eliminar permiso</button>
													<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
													</div>
												</div>

										{!!Form::close()!!}	
												</div>
											</div>
										</div>
									</div>
								</div>
							<div class="col-sm-12" align="center"></div>
						</div>
	
			</div>
			
		</div>
	</div>


	

</div>