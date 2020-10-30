<!--Este es el archivo de la ventana modal para mostrar información del LOG-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-infoSede-{{$sed->id_sede}}">
	<!--Información de la ventana emergente-->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Registro de cambios</h4>
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">
				<p>Últimos cambios realizados:</p>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Empleado:</div>
				</div>
				<div class="form-group col-sm-6">
                    {{ $sed->empleado_id_empleado}}
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Fecha:</div>
				</div>
				<div class="form-group col-sm-6">
                    {{ $sed->fecha}}
				</div>
            </div>
                                    
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>




