<!--Este es el archivo de la ventana modal para mostrar información del LOG-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-infoProductos-{{$ps->id_stock}}">
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
				<p>Información:</p>
            </div>

            @foreach($productos as $ps1)
           		 @if($ps1->id_stock==$ps->id_stock)
           	
            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Empleado:</div>
				</div>
				<div class="form-group col-sm-6">
                    @foreach($empleados as $e)
							@if($ps1->empleado_id_empleado==$e->id_empleado)
						{{ $e->nombre}}
							@endif
					@endforeach
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Fecha:</div>
				</div>
				<div class="form-group col-sm-6">
                    {{ $ps1->fecha_registro}}
				</div>
            </div>

            @endif
           	@endforeach

                                    
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>




