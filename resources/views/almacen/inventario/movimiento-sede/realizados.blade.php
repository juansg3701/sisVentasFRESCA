<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-update-{{$mv->id_mstock}}">
	
	{{Form::Open(array('action'=>array('MovimientoSedeController@show',$mv->id_mstock), 'method'=>'patch'))}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Realizar movimiento</h4>
			</div>
			<div class="modal-body">
				<p>¿Desea realizar el movimiento?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>