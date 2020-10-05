<?php
include "database.php";
$datos = $con->query("select * from proveedor");
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h1>Importar Datos de un archivo EXCEL con PP</h1>

 <form method="post" id="addproduct" action="almacen/excel2/import.php" enctype="multipart/form-data" role="form">
  <div>
    <label class="col-lg-2 control-label">Archivo (.xlsx)*</label>
      <input type="file" name="name"  id="name" placeholder="Archivo (.xlsx)"><br><br>
     <a><button type="submit" class="btn btn-success">Cargar xls</button></a>
  </div>
</form>

<p>Formato de los datos [Rut/Rfc, Nombre, Apellidos, Direccion, Email, Telefono]</p>


<?php if($datos->num_rows>0):?>
	<h3>Datos</h3>
	<p>Resultados <?php echo $datos->num_rows; ?></p>
	<table border="1">
	<thead>
			<th>Id</th>
			<th>Nombre Empresa</th>
			<th>Contacto</th>
			<th>Dirección</th>
			<th>Correo</th>
			<th>Teléfono</th>
			<th>No. Documento</th>
			<th>Dígito de verificación NIT</th>
	</thead>
	<?php while($d= $datos->fetch_object()):?>
		<tr>
		<td><?php echo $d->id_proveedor; ?></td>
		<td><?php echo $d->nombre_empresa; ?></td>
		<td><?php echo $d->nombre_proveedor; ?></td>
		<td><?php echo $d->direccion; ?></td>
		<td><?php echo $d->correo; ?></td>
		<td><?php echo $d->telefono; ?></td>
		<td><?php echo $d->documento; ?></td>
		<td><?php echo $d->verificacion_nit; ?></td>
		</tr>

	<?php endwhile; ?>
</table>
<?php else:?>
	<h3>No hay Datos</h3>
<?php endif; ?>

</body>
</html>