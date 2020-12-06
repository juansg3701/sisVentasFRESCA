<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'dashboardController@index');

Route::resource('almacen/excel', 'AcercaDeController');
Route::resource('almacen/excel2', 'ExcelSubController');

Route::resource('almacen/usuario/iniciar', 'IniciarController');
Route::resource('almacen/usuario/registrar', 'RegistrarController');
Route::resource('almacen/usuario/permiso/usuario', 'PermisoUsuarioController');
Route::resource('almacen/usuario/permiso/cargo', 'PermisoCargoController');
Route::resource('almacen/usuario/permiso/cuenta', 'UsersController');


Route::resource('almacen/proveedor', 'ProveedorController');

Route::resource('almacen/cliente/cliente', 'ClienteController');
Route::resource('almacen/cliente/categoria', 'CategoriaClienteController');
Route::resource('almacen/cliente2', 'ClienteController2');


Route::resource('almacen/caja', 'CajaController');
Route::resource('almacen/caja/arqueo', 'CajaController');

Route::resource('almacen/nomina/empleado', 'EmpleadoController');
Route::resource('almacen/nomina/horario', 'HorarioNominaController');
Route::resource('almacen/nomina/lista_horarios', 'HorarioNominaController2');
Route::resource('almacen/nomina/modal', 'HorarioNominaController3');
Route::resource('almacen/nomina/datos', 'HorarioNominaController4');
Route::resource('almacen/nomina/valores', 'ValoresNominaController');

Route::resource('almacen/sede', 'SedeController');

Route::resource('almacen/pagosFactura', 'pagoFacturasController');

Route::resource('almacen/inventario/producto-sede/productoCompleto', 'ProductoSedeController');
Route::resource('almacen/inventario/proveedor-sede', 'ProveedorSedeController');
Route::resource('almacen/inventario/ean', 'registroProductoProveedor');
Route::resource('almacen/inventario/producto-sede/categoriaProducto', 'CategoriaProducto');
Route::resource('almacen/inventario/producto-sede/impuestoProducto', 'ImpuestoProducto');
Route::resource('almacen/inventario/movimiento-sede', 'MovimientoSedeController');
Route::resource('almacen/inventario/corte-sede/cortes', 'CorteSedeController');
Route::resource('almacen/inventario/corte-sede/productosCorte', 'ProductosCorteController');
Route::resource('almacen/inventario/categoriaTransformado', 'CategoriaTransformadoController');

Route::resource('almacen/reportes/inventario', 'reportesInventario');
Route::resource('almacen/reportes/inventario2', 'reportesInventario2');
Route::resource('almacen/reportes/inventario/descargas', 'reportesInventarioEX');
Route::resource('almacen/reportes/inventario/descargas2', 'reportesInventarioPDF');
Route::resource('almacen/reportes/inventario2/descargas', 'reportesInventarioEX2');
Route::resource('almacen/reportes/inventario2/descargas2', 'reportesInventarioPDF2');
Route::resource('almacen/reportes/pedidos/descargas', 'reportesInventarioEXP');
Route::resource('almacen/reportes/pedidos', 'reportesPedidos');
Route::resource('almacen/reportes/pedidos2', 'reportesPedidos2');
Route::resource('almacen/reportes/pedidos/descargas', 'reportesPedidosEX');
Route::resource('almacen/reportes/pedidos2/descargas', 'reportesPedidosEX2');
Route::resource('almacen/reportes/pedidos/descargas2', 'reportesPedidosPDF');
Route::resource('almacen/reportes/pedidos2/descargas2', 'reportesPedidosPDF2');
Route::resource('almacen/reportes/ventas', 'reportesVentas');
Route::resource('almacen/reportes/ventas/descargas', 'reportesVentasEX');
Route::resource('almacen/reportes/ventas/descargas2', 'reportesVentasPDF');
Route::resource('almacen/reportes/pagosCobros/cobros', 'reportesPC2');
Route::resource('almacen/reportes/pagosCobros/pagos', 'reportesPC');
Route::resource('almacen/reportes/pagosCobros/pagos/download', 'reportesPCDescargas');
Route::resource('almacen/reportes/pagosCobros/cobros/download', 'reportesPC2Descargas');
Route::resource('almacen/reportes/pagosCobros/compararGPC1', 'reportesPCComparar');
Route::resource('almacen/reportes/pagosCobros/compararGPC2', 'reportesPC2Comparar');
Route::resource('almacen/reportes/caja/caja', 'reportesCaja');
Route::resource('almacen/reportes/caja/caja/download', 'reportesCajaDescargas');
Route::resource('almacen/reportes/caja/compararGC', 'reportesCajaComparar');

Route::resource('almacen/reportes/bancos/bancos', 'reportesBancos');
Route::resource('almacen/reportes/bancos/compararGB', 'reportesBancosComparar');
Route::resource('almacen/reportes/bancos/bancos/download', 'reportesBancosDescargas');

Route::resource('almacen/reportes/compararG', 'reporteVentasComparar');
Route::resource('almacen/reportes/compararGI1', 'reporteInventarioC1');
Route::resource('almacen/reportes/compararGI2', 'reporteInventarioC2');
Route::resource('almacen/reportes/compararGP1', 'reportePedidosC1');
Route::resource('almacen/reportes/compararGP2', 'reportePedidosC2');
Route::resource('almacen/reportes/nomina', 'reportesNomina');

Route::resource('almacen/pagosCobros/FacturasCobrar', 'facturasCobrarController');
Route::resource('almacen/pagosCobros/TicketCartera', 'facturasCobrarTController');
Route::resource('almacen/pagosCobros/AbonosCartera', 'facturasCobrarDetalleController');
Route::resource('almacen/pagosCobros/AbonosPagos', 'FacturasPagarDetalleController');
Route::resource('almacen/pagosCobros/Bancos', 'BancoController');

Route::resource('almacen/pagosCobros/FacturasPagar', 'FacturasPagarController');

Route::resource('almacen/facturacion/listaVentas', 'facturacionListaVentas');
Route::resource('almacen/facturacion/listaVentas/Factura', 'FacturaController');
Route::resource('almacen/facturacion/listaPedidosClientes', 'facturacionListaPedidosClientes');

Route::resource('almacen/facturacion/listaPedidosProveedores', 'facturacionListaPedidosProveedor');
Route::resource('almacen/facturacion/cuentasBancarias', 'facturacionCBancarias');

Route::resource('almacen/pedidosDevoluciones/productoPedidoCliente', 'productoPedidoCliente');
Route::resource('almacen/pedidosDevoluciones/productoPedidoProveedor', 'productoPedidoProveedor');
Route::resource('almacen/pedidosDevoluciones/devoluciones', 'devoluciones');
Route::resource('almacen/pedidosDevoluciones/abonoCliente', 'AbonoPCController');
Route::resource('almacen/pedidosDevoluciones/abonoCliente/TicketCliente', 'AbonoTCController');
Route::resource('almacen/pedidosDevoluciones/abonoProveedor/TicketProveedor', 'AbonoTPController');
Route::resource('almacen/pedidosDevoluciones/abonoProveedor', 'AbonoPPController');
Route::resource('almacen/pedidosDevoluciones/devolucionIgual', 'DevIgualController');
Route::resource('almacen/pedidosDevoluciones/devolucionMayor', 'DevMayorController');
Route::resource('almacen/pedidosDevoluciones/pagoEfectivoCliente', 'pagoEfectivoCliente');
Route::resource('almacen/pedidosDevoluciones/pagoEfectivoC', 'pagoAClienteController');
Route::resource('almacen/pedidosDevoluciones/pagoEfectivoP', 'pagoPClienteController');


Route::resource('layouts/admin', 'admin');

Route::resource('almacen/facturacion/ventasProductos', 'productoVentas');
Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('almacen/facturacion/ventasProductos', 'productoVentas');
Route::resource('almacen/facturacion/estadoVenta', 'estado');
Route::resource('almacen/facturacion/pagoEfectivo', 'pagoEfectivo');
Route::resource('almacen/facturacion/pagoElectronico', 'pagoElectronico');

Route::resource('almacen/facturacion/TicketFactura', 'facturacionTListaVentas');
Route::resource('almacen/facturacion/FacturaVenta', 'facturacionFListaVentas');
Route::resource('almacen/inventario/producto-sede/descuentos', 'DescuentoProducto');

Route::get('downloadExcel', 'ProductoSedeController@downloadExcel');