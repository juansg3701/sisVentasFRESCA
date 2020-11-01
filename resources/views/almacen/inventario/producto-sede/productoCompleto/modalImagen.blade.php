<!--Este es el archivo de la ventana modal para mostrar información del LOG-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-infoImagen-{{$ps->id_producto}}">
	<!--Información de la ventana emergente-->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Imagen registrada</h4>
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">
				<p>{{ $ps->nombre}}:</p>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-12">
                    <img src="{{asset('imagenes/articulos/'.$ps->imagen)}}" alt="{{ $ps->nombre}}" height="400px" width="400px" class="img-thumbnail">
				</div>
            </div>
                                    
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}
</div>




