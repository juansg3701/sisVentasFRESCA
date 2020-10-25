-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 25-10-2020 a las 18:17:45
-- Versión del servidor: 8.0.13-4
-- Versión de PHP: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `MTvDp0bqcd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

CREATE TABLE `caja` (
  `id_caja` int(11) NOT NULL,
  `base_monetaria` double DEFAULT NULL,
  `ingresos_efectivo` double NOT NULL,
  `ingresos_electronicos` double NOT NULL,
  `egresos_efectivo` double NOT NULL,
  `egresos_electronicos` double NOT NULL,
  `ventas` double NOT NULL,
  `fecha` datetime NOT NULL,
  `pagos` double NOT NULL,
  `cierre` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_modulo`
--

CREATE TABLE `cargo_modulo` (
  `id_cargoModulo` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cargo_modulo`
--

INSERT INTO `cargo_modulo` (`id_cargoModulo`, `id_cargo`, `id_modulo`) VALUES
(1, 25, 1),
(4, 26, 1),
(8, 1, 1),
(9, 1, 2),
(10, 1, 3),
(12, 1, 5),
(13, 1, 6),
(14, 1, 7),
(15, 1, 8),
(17, 1, 4),
(18, 1, 9);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_cliente`
--

CREATE TABLE `categoria_cliente` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `categoria_cliente`
--

INSERT INTO `categoria_cliente` (`id_categoria`, `nombre`, `descripcion`, `empleado_id_empleado`, `fecha`, `sede_id_sede`) VALUES
(1, 'Institución', 'Central', 1, '2020-10-15', 1),
(2, 'Tienda', 'Minorista', 1, '2019-09-05', 1),
(4, 'tttr', 'ttttr', 2, '2020-10-17', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_producto_trans`
--

CREATE TABLE `categoria_producto_trans` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_empresa` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `verificacion_nit` int(11) DEFAULT NULL,
  `categoria_cliente_id_categoria` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre`, `nombre_empresa`, `direccion`, `telefono`, `correo`, `documento`, `verificacion_nit`, `categoria_cliente_id_categoria`, `sede_id_sede`, `fecha`, `empleado_id_empleado`) VALUES
(8, 'eo', 'e', 'e', 1, 'e@gmail.com', 1223, 0, 1, 3, '2020-10-17', 2),
(9, 'carlos ramirez', 'CR', 'calle 56', 312231, 'car@gmail.com', 123456789, 1, 2, 1, '2020-10-14', 1),
(10, 'Andrea López', 'Empresa G', 'Carrera 27', 31312132, 'and@gmail.com', 1233444555, 0, 2, 1, '2020-10-15', 1),
(11, 'rr', '221cd', 'r', 123, 'r@gmail.com', 2131321, 0, 1, 1, '2020-10-16', 1),
(12, 'Ricardo Sánchez', 'Mercados H', 'Carrera 14 ', 2147483647, 'ricar@gmail.com', 555888988, 7, 2, 1, '2020-10-17', 1),
(13, 'Jhon Suárez', 'JS', 'Carrera 19 ', 317899872, 'js@gmail.com', 126789992, 2, 2, 1, '2020-10-18', 1),
(14, 'Juan sanchéz', 'Empresa JP', 'Carrera 23', 132312123, 'juannn@gmail.com', 111111111, 2, 2, 3, '2020-10-18', 2),
(18, 'k', 'k', 'k', 1, 'k@hotmail.com', 1743, 0, 1, 3, '2020-10-18', 10),
(19, 'Andrea Gomez', 'AG', 'Carrera 18', 321321, 'andreag@gmail.com', 123, 0, 1, 1, '2020-10-23', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `id_descuento` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `valor` double NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detallef` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio_venta` double NOT NULL,
  `total_descuento` double NOT NULL,
  `total_impuesto` double NOT NULL,
  `total` double NOT NULL,
  `factura_id_factura` int(11) NOT NULL,
  `stock_id_stock` int(11) NOT NULL,
  `descuento_id_descuento` int(11) NOT NULL,
  `impuesto_id_impuestos` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `codigo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `tipo_cargo_id_cargo` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `user_id_user` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `correo`, `codigo`, `direccion`, `telefono`, `documento`, `tipo_cargo_id_cargo`, `sede_id_sede`, `user_id_user`, `fecha`) VALUES
(1, 'juan', 'juangomez3701@gmail.com', '321', 'calle 12', 31289362, 3123, 1, 1, 1, '2020-09-13'),
(2, 'holman ', 'holman@gmail.com', '1', 'calle 12', 1234, 3123, 1, 1, 10, '2020-12-12'),
(3, 'juliana', 'juliana@gmail.com', '9876567', 'calle 12', 312782681, 1057612893, 1, 1, 1237, '2020-10-18'),
(4, 'carlos', 'carlos@gmail.com', '98012387', 'calle 12', 98378124, 12931239, 1, 1, 1238, '2020-10-18'),
(5, 'Andres', 'andres@gmail.com', '201562537', 'calle 12 no 12', 2147483647, 2147483647, 1, 1, 1239, '2020-10-18'),
(6, 'Holman rincon', 'holman123@gmail.com', '20188029', 'calle 12', 12313213, 23132, 1, 1, 1240, '2020-10-24'),
(7, 'Holman', 'holman.rincon@uptc.edu.co', '123213121', 'calle 12', 3120930, 1238908123, 1, 1, 1241, '2020-10-24'),
(8, 'prueba120', 'qweyqiwoe@gmail.com', '2019231j1', 'calle 12', 2147483647, 1389012093, 1, 1, 1243, '2020-10-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(11) NOT NULL,
  `pago_total` double NOT NULL,
  `noproductos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `facturapaga` decimal(38,0) NOT NULL,
  `tipo_pago_id_tpago` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE `modulos` (
  `id_modulo` int(11) NOT NULL,
  `nombre` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `modulos`
--

INSERT INTO `modulos` (`id_modulo`, `nombre`) VALUES
(1, 'Permisos'),
(2, 'Empleados'),
(3, 'Proveedores'),
(4, 'Clientes'),
(5, 'Sedes'),
(6, 'Devoluciones'),
(7, 'Inventario'),
(8, 'Facturacion'),
(9, 'Reportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `m_stock`
--

CREATE TABLE `m_stock` (
  `id_mstock` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `stock_id_stock` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `sede_id_sede1` int(11) NOT NULL,
  `t_movimiento_id_tmovimiento` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`) VALUES
('juan@gmail.com', 'dc64e5ed796631e3c49a4487c925d7d690032029785a2b99d0a0c982a3f2a306');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `nombre_empresa` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_proveedor` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `verificacion_nit` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_tiempo`
--

CREATE TABLE `p_tiempo` (
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_inventario`
--

CREATE TABLE `reporte_inventario` (
  `id_rInventario` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_ventas`
--

CREATE TABLE `reporte_ventas` (
  `id_rVentas` int(11) NOT NULL,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

CREATE TABLE `sede` (
  `id_sede` int(11) NOT NULL,
  `nombre_sede` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `sede`
--

INSERT INTO `sede` (`id_sede`, `nombre_sede`, `ciudad`, `descripcion`, `direccion`, `telefono`, `fecha`, `empleado_id_empleado`) VALUES
(1, 'La canasta', 'Sogamoso', 'sede principal', 'calle 12', 0, '2020-09-13', 1),
(2, 'Paraiso', 'Duitama', 'Central', 'calle 15', 0, '2020-09-13', 1),
(3, 'Centro ara', 'Duitama', 'ara', 'calle 12', 0, '2020-09-13', 1),
(4, 'Magdalena paraiso', 'Sogamoso', '5', 'calle 12', 0, '2020-09-13', 1),
(5, 'Duitama Centro', 'Duitama', '--', 'calle 12', 2020, '2020-10-11', 1),
(6, 'Prueba', 'Sogamoso', '--', 'calle 12', 1234, '2020-10-07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `disponibilidad` char(1) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `dado_de_baja` tinyint(1) NOT NULL,
  `transformacion_stock_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cargo`
--

CREATE TABLE `tipo_cargo` (
  `id_cargo` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tipo_cargo`
--

INSERT INTO `tipo_cargo` (`id_cargo`, `nombre`, `descripcion`, `fecha`, `empleado_id_empleado`) VALUES
(1, 'Gerente', 'gerencia', '2020-03-23', 1),
(2, 'cajero', 'caja', '2020-03-23', 1),
(3, 'Vendedor', 'vendedor', '2019-10-24', 1),
(4, 'patinador', 'patinador', '2019-10-24', 1),
(20, 'coordinador', 'ninguna', '2019-10-24', 1),
(23, 'Servicios Generales', 'Servicios', '2020-03-23', 1),
(25, 'Cordiandor de ventas', '---', '2020-10-18', 1),
(26, 'Subgerente', '-----', '2020-10-18', 1),
(28, 'prueba', 'prueba', '2020-10-24', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

CREATE TABLE `tipo_pago` (
  `id_tpago` int(11) NOT NULL,
  `nombre` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripción` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_stock`
--

CREATE TABLE `transformacion_stock` (
  `id_transformacion` int(11) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_movimiento`
--

CREATE TABLE `t_movimiento` (
  `id_tmovimiento` int(11) NOT NULL,
  `descripcion` varchar(45) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caja`
--
ALTER TABLE `caja`
  ADD PRIMARY KEY (`id_caja`),
  ADD KEY `caja_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `caja_sede_fk` (`sede_id_sede`);

--
-- Indices de la tabla `cargo_modulo`
--
ALTER TABLE `cargo_modulo`
  ADD PRIMARY KEY (`id_cargoModulo`);

--
-- Indices de la tabla `categoria_cliente`
--
ALTER TABLE `categoria_cliente`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categoria_producto_trans`
--
ALTER TABLE `categoria_producto_trans`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`),
  ADD KEY `sede_id_sede` (`sede_id_sede`) USING BTREE,
  ADD KEY `categoria_cliente_id_categoria` (`categoria_cliente_id_categoria`);

--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`id_descuento`),
  ADD KEY `descuento_sede_fk` (`sede_id_sede`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detallef`),
  ADD KEY `detalle_factura_descuento_fk` (`descuento_id_descuento`),
  ADD KEY `detalle_factura_factura_fk` (`factura_id_factura`),
  ADD KEY `detalle_factura_impuesto_fk` (`impuesto_id_impuestos`),
  ADD KEY `detalle_factura_producto_fk` (`stock_id_stock`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`id_empleado`),
  ADD KEY `empleado_sede_fk` (`sede_id_sede`),
  ADD KEY `empleado_tipo_cargo_fk` (`tipo_cargo_id_cargo`),
  ADD KEY `empleado_users_fk` (`user_id_user`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `factura_cliente_fk` (`cliente_id_cliente`),
  ADD KEY `factura_empleado_fk` (`empleado_id_empleado`),
  ADD KEY `factura_tipo_pago_fk` (`tipo_pago_id_tpago`);

--
-- Indices de la tabla `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id_modulo`);

--
-- Indices de la tabla `m_stock`
--
ALTER TABLE `m_stock`
  ADD PRIMARY KEY (`id_mstock`),
  ADD KEY `m_stock_sede_fk` (`sede_id_sede`),
  ADD KEY `m_stock_sede_fkv2` (`sede_id_sede1`),
  ADD KEY `m_stock_stock_fk` (`stock_id_stock`),
  ADD KEY `m_stock_t_movimiento_fk` (`t_movimiento_id_tmovimiento`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `p_tiempo`
--
ALTER TABLE `p_tiempo`
  ADD PRIMARY KEY (`id_periodo`);

--
-- Indices de la tabla `reporte_inventario`
--
ALTER TABLE `reporte_inventario`
  ADD PRIMARY KEY (`id_rInventario`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`),
  ADD KEY `sede_id_sede` (`sede_id_sede`);

--
-- Indices de la tabla `reporte_ventas`
--
ALTER TABLE `reporte_ventas`
  ADD PRIMARY KEY (`id_rVentas`);

--
-- Indices de la tabla `sede`
--
ALTER TABLE `sede`
  ADD PRIMARY KEY (`id_sede`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `stock_producto_fk` (`producto_id_producto`),
  ADD KEY `stock_proveedor_fk` (`proveedor_id_proveedor`),
  ADD KEY `stock_sede_fk` (`sede_id_sede`);

--
-- Indices de la tabla `tipo_cargo`
--
ALTER TABLE `tipo_cargo`
  ADD PRIMARY KEY (`id_cargo`);

--
-- Indices de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  ADD PRIMARY KEY (`id_tpago`);

--
-- Indices de la tabla `transformacion_stock`
--
ALTER TABLE `transformacion_stock`
  ADD PRIMARY KEY (`id_transformacion`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`);

--
-- Indices de la tabla `t_movimiento`
--
ALTER TABLE `t_movimiento`
  ADD PRIMARY KEY (`id_tmovimiento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caja`
--
ALTER TABLE `caja`
  MODIFY `id_caja` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargo_modulo`
--
ALTER TABLE `cargo_modulo`
  MODIFY `id_cargoModulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `categoria_cliente`
--
ALTER TABLE `categoria_cliente`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categoria_producto_trans`
--
ALTER TABLE `categoria_producto_trans`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `descuento`
--
ALTER TABLE `descuento`
  MODIFY `id_descuento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detallef` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id_modulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `m_stock`
--
ALTER TABLE `m_stock`
  MODIFY `id_mstock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `p_tiempo`
--
ALTER TABLE `p_tiempo`
  MODIFY `id_periodo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporte_inventario`
--
ALTER TABLE `reporte_inventario`
  MODIFY `id_rInventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reporte_ventas`
--
ALTER TABLE `reporte_ventas`
  MODIFY `id_rVentas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sede`
--
ALTER TABLE `sede`
  MODIFY `id_sede` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_cargo`
--
ALTER TABLE `tipo_cargo`
  MODIFY `id_cargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `tipo_pago`
--
ALTER TABLE `tipo_pago`
  MODIFY `id_tpago` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `transformacion_stock`
--
ALTER TABLE `transformacion_stock`
  MODIFY `id_transformacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `t_movimiento`
--
ALTER TABLE `t_movimiento`
  MODIFY `id_tmovimiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `categoria_cliente_id_categoria` FOREIGN KEY (`categoria_cliente_id_categoria`) REFERENCES `categoria_cliente` (`id_categoria`),
  ADD CONSTRAINT `sede_id_sede` FOREIGN KEY (`sede_id_sede`) REFERENCES `sede` (`id_sede`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
