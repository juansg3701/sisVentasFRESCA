<!--Este es el archivo de la ventana modal para carga de excel-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-cargar">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Cargar Archivo xlsx/xls</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
                
			</div>
			
			<div id="formulario">
				<form method="post" id="addproduct" action="/importProducto.php" enctype="multipart/form-data" role="form">
					<!--Activar o desactivar botón de carga dependiendo de la selección de archivo mediante ajax-->
					<input type="" name="probar_juliana" value="{{Auth::user()->id}}">
					<input type="" name="fecha_actual" value="<?php echo date("Y/m/d H:i:s"); ?>">
					<script type="text/javascript">
						$(function(){
				   			$("#inpCargar").change( function(){
							    if ($(this).val() === ""){
							    	$("#btnCargar").prop("disabled", true);
						 		}
						 		if ($(this).val() != ""){
							    	$("#btnCargar").prop("disabled", false);
						 		}
					    	});
					    });
					</script>
		  			<div align="center" class="form-row col-sm">
		  				<div class="col-sm">
		  					<h4>Seleccione un archivo (.xlsx/xls)*</h4><br>
		  				</div>
		  				<div class="col-sm">
		  					<input id="inpCargar" type="file" name="name" placeholder="Archivo (.xlsx)"><br><br>
		  				</div>
		  				<div class="col-sm">
		  					<a><button id="btnCargar" type="submit" class="btn btn-success" disabled="">Cargar archivo</button></a>
		  				</div>
		    			
		  			</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>