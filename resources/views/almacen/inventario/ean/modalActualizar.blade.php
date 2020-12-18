<!--Este es el archivo de la ventana modal para mostrar información del LOG-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-actualizar-{{$valor_producto}}">

	<!--Información de la ventana emergente-->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Transformación de producto</h4>
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
			</div>
			<div class="modal-body">
				<p>Información:</p>
            </div>
        <!-- datlist para el autocompletado -->
	       <datalist id="mylist">
	       @foreach($producto as $pb)
	       		
				<option>{{ $pb->nombre}}</option>
			
	       @endforeach
	      </datalist>
            {!!Form::open(array('url'=>'almacen/inventario/proveedor-sede','method'=>'POST','autocomplete'=>'off'))!!}
		    {{Form::token()}}
	
		    @foreach($producto as $pb)
			    @if($pb->id_producto==$pb->id_producto)
				      <div class="form-row">
						<div class="form-group col-sm-6">
							<div>Producto:</div>
						</div>
						<div class="form-group col-sm-4">
		                   	{{$pb->nombre}}
						</div>
		            </div>
	            @endif
	        @endforeach

            <div class="form-row">
            <input type="hidden" name="id" value="">
		    <input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>">
		

				<div class="form-group col-sm-6">
					<div>Kilos actuales:</div>

				</div>
				<div class="form-group col-sm-4">
                   
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Kilos utilizados:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<input type="number" class="form-control" name="cantidadRestar" min="1" pattern="^[0-9]+">
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Producto nuevo:</div>
				</div>
				<div class="form-group col-sm-4">
					<input id="buscar2" class="form-control" name="nombre_producto" placeholder="Buscar..." list="mylist">
				</div>
            </div>


            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Cantidad en unidades:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<input type="number" class="form-control" name="cantidad" min="1" pattern="^[0-9]+">
				</div>
            </div>

            <div class="form-row">
						<div class="form-group col-sm-6">
							<div>Total:</div>
						</div>
						<div class="form-group col-sm-4">
							<input type="number" class="form-control" name="total">
						</div>
			</div>


                                    
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Registrar</button>
			</div>

			{!!Form::close()!!}	
		</div>

	</div>
</div>



    



