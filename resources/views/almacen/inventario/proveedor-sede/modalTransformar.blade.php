<!--Este es el archivo de la ventana modal para mostrar información del LOG-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-transformar-{{$ps->id_stock}}">
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
            {!!Form::open(array('url'=>'almacen/inventario/proveedor-sede','method'=>'POST','autocomplete'=>'off'))!!}
		    {{Form::token()}}
		    
            <div class="form-row">
            <input type="hidden" name="id" value="{{$ps->id_stock}}">
		    <input type="hidden" name="fecha_registro" value="<?php echo date("Y/m/d H:i:s"); ?>">
		    @foreach($usuarios as $usu)
			@if(Auth::user()->id==$usu->user_id_user)
			<input type="hidden" name="empleado_id_empleado" value="{{$usu->id_empleado}}">
			@endif
			@endforeach

				<div class="form-group col-sm-6">
					<div>Kilos actuales:</div>
				</div>
				<div class="form-group col-sm-4">
                   {{ $ps->cantidad}}
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Kilos utilizados:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<input type="number" class="form-control" name="cantidadRestar">
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Producto nuevo:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<select name="producto_id_producto" class="form-control">
						@foreach($eanP as $p)
						<option value="{{$p->id_producto}}">{{$p->nombre}}</option>
						@endforeach
					</select>
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Transformar a:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<select name="transformacion_stock_id" class="form-control">
						@foreach($categoriaTrans as $c)
						<option value="{{$c->id_categoria}}">{{$c->nombre}}</option>
						@endforeach
					</select>
				</div>
            </div>

            <div class="form-row">
				<div class="form-group col-sm-6">
					<div>Cantidad en unidades:</div>
				</div>
				<div class="form-group col-sm-4">
                   	<input type="number" class="form-control" name="cantidad">
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




