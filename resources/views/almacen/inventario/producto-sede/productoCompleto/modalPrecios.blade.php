
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-precios">
	<!--Información de la ventana emergente-->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Precios por cliente:</h4>
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">
				<p>Información:</p>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Costo de compra:</div>
				</div>
				<div class="form-group col-sm-6">
                   {{ $ps->costo_compra}}
				</div>
            </div>
            
            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Precio No.1:</div>
				</div>
				<div class="form-group col-sm-6">
                   {{ $ps->precio_1}}
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Precio No.2:</div>
				</div>
				<div class="form-group col-sm-6">
                   {{ $ps->precio_2}}
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Precio No.3:</div>
				</div>
				<div class="form-group col-sm-6">
                   {{ $ps->precio_3}}
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Precio No.4:</div>
				</div>
				<div class="form-group col-sm-6">
                   {{ $ps->precio_4}}
				</div>
            </div>

            
                
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>
		</div>
	</div>
</div>




