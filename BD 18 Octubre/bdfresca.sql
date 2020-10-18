-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 18-10-2020 a las 15:44:04
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bdfresca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caja`
--

DROP TABLE IF EXISTS `caja`;
CREATE TABLE IF NOT EXISTS `caja` (
  `id_caja` int(11) NOT NULL AUTO_INCREMENT,
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
  `sede_id_sede` int(11) NOT NULL,
  PRIMARY KEY (`id_caja`),
  KEY `caja_empleado_fk` (`empleado_id_empleado`),
  KEY `caja_sede_fk` (`sede_id_sede`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo_modulo`
--

DROP TABLE IF EXISTS `cargo_modulo`;
CREATE TABLE IF NOT EXISTS `cargo_modulo` (
  `id_cargoModulo` int(11) NOT NULL AUTO_INCREMENT,
  `id_cargo` int(11) NOT NULL,
  `id_modulo` int(11) NOT NULL,
  PRIMARY KEY (`id_cargoModulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_cliente`
--

DROP TABLE IF EXISTS `categoria_cliente`;
CREATE TABLE IF NOT EXISTS `categoria_cliente` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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

DROP TABLE IF EXISTS `categoria_producto_trans`;
CREATE TABLE IF NOT EXISTS `categoria_producto_trans` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_categoria`),
  KEY `empleado_id_empleado` (`empleado_id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_empresa` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `verificacion_nit` int(11) DEFAULT NULL,
  `categoria_cliente_id_categoria` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  KEY `empleado_id_empleado` (`empleado_id_empleado`),
  KEY `sede_id_sede` (`sede_id_sede`) USING BTREE,
  KEY `categoria_cliente_id_categoria` (`categoria_cliente_id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(14, 'Juan sanchéz', 'Empresa JP', 'Carrera 23', 132312123, 'juannn@gmail.com', 111111111, 2, 2, 3, '2020-10-18', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

DROP TABLE IF EXISTS `descuento`;
CREATE TABLE IF NOT EXISTS `descuento` (
  `id_descuento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` double NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_descuento`),
  KEY `descuento_sede_fk` (`sede_id_sede`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

DROP TABLE IF EXISTS `detalle_factura`;
CREATE TABLE IF NOT EXISTS `detalle_factura` (
  `id_detallef` int(11) NOT NULL AUTO_INCREMENT,
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
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_detallef`),
  KEY `detalle_factura_descuento_fk` (`descuento_id_descuento`),
  KEY `detalle_factura_factura_fk` (`factura_id_factura`),
  KEY `detalle_factura_impuesto_fk` (`impuesto_id_impuestos`),
  KEY `detalle_factura_producto_fk` (`stock_id_stock`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `codigo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `documento` int(11) NOT NULL,
  `tipo_cargo_id_cargo` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_empleado`),
  KEY `empleado_sede_fk` (`sede_id_sede`),
  KEY `empleado_tipo_cargo_fk` (`tipo_cargo_id_cargo`),
  KEY `empleado_users_fk` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`id_empleado`, `nombre`, `correo`, `contrasena`, `codigo`, `direccion`, `telefono`, `documento`, `tipo_cargo_id_cargo`, `sede_id_sede`, `users_id`, `fecha`) VALUES
(1, 'juan', 'juan@gmail.com', '123', '321', 'calle 12', 31289362, 3123, 1, 1, 1, '2020-09-13'),
(2, 'holman ', 'holman@gmail.com', '123', '1', 'calle 12', 1234, 3123, 1, 1, 10, '2020-12-12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

DROP TABLE IF EXISTS `factura`;
CREATE TABLE IF NOT EXISTS `factura` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `pago_total` double NOT NULL,
  `noproductos` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `facturapaga` decimal(38,0) NOT NULL,
  `tipo_pago_id_tpago` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `cliente_id_cliente` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `factura_cliente_fk` (`cliente_id_cliente`),
  KEY `factura_empleado_fk` (`empleado_id_empleado`),
  KEY `factura_tipo_pago_fk` (`tipo_pago_id_tpago`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

DROP TABLE IF EXISTS `modulos`;
CREATE TABLE IF NOT EXISTS `modulos` (
  `id_modulo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_modulo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `m_stock`
--

DROP TABLE IF EXISTS `m_stock`;
CREATE TABLE IF NOT EXISTS `m_stock` (
  `id_mstock` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime NOT NULL,
  `stock_id_stock` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `sede_id_sede1` int(11) NOT NULL,
  `t_movimiento_id_tmovimiento` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_mstock`),
  KEY `m_stock_sede_fk` (`sede_id_sede`),
  KEY `m_stock_sede_fkv2` (`sede_id_sede1`),
  KEY `m_stock_stock_fk` (`stock_id_stock`),
  KEY `m_stock_t_movimiento_fk` (`t_movimiento_id_tmovimiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

DROP TABLE IF EXISTS `proveedor`;
CREATE TABLE IF NOT EXISTS `proveedor` (
  `id_proveedor` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empresa` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_proveedor` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `documento` int(11) NOT NULL,
  `verificacion_nit` int(11) DEFAULT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_proveedor`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `p_tiempo`
--

DROP TABLE IF EXISTS `p_tiempo`;
CREATE TABLE IF NOT EXISTS `p_tiempo` (
  `id_periodo` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `p_tiempo_id` double NOT NULL,
  PRIMARY KEY (`p_tiempo_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_inventario`
--

DROP TABLE IF EXISTS `reporte_inventario`;
CREATE TABLE IF NOT EXISTS `reporte_inventario` (
  `id_rInventario` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  PRIMARY KEY (`id_rInventario`),
  KEY `empleado_id_empleado` (`empleado_id_empleado`),
  KEY `sede_id_sede` (`sede_id_sede`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reporte_ventas`
--

DROP TABLE IF EXISTS `reporte_ventas`;
CREATE TABLE IF NOT EXISTS `reporte_ventas` (
  `id_rVentas` int(11) NOT NULL AUTO_INCREMENT,
  `fechaInicial` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `fechaActual` date NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_rVentas`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sede`
--

DROP TABLE IF EXISTS `sede`;
CREATE TABLE IF NOT EXISTS `sede` (
  `id_sede` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sede` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `ciudad` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `telefono` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_sede`),
  KEY `empleado_id_empleado` (`empleado_id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `disponibilidad` char(1) COLLATE utf8_spanish2_ci NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `producto_id_producto` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `proveedor_id_proveedor` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `dado_de_baja` tinyint(1) NOT NULL,
  `transformacion_stock_id` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `stock_producto_fk` (`producto_id_producto`),
  KEY `stock_proveedor_fk` (`proveedor_id_proveedor`),
  KEY `stock_sede_fk` (`sede_id_sede`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cargo`
--

DROP TABLE IF EXISTS `tipo_cargo`;
CREATE TABLE IF NOT EXISTS `tipo_cargo` (
  `id_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` date NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  PRIMARY KEY (`id_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
(24, 'prueba', '--', '2020-08-30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_pago`
--

DROP TABLE IF EXISTS `tipo_pago`;
CREATE TABLE IF NOT EXISTS `tipo_pago` (
  `id_tpago` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `descripción` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_tpago`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transformacion_stock`
--

DROP TABLE IF EXISTS `transformacion_stock`;
CREATE TABLE IF NOT EXISTS `transformacion_stock` (
  `id_transformacion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`id_transformacion`),
  KEY `empleado_id_empleado` (`empleado_id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `t_movimiento`
--

DROP TABLE IF EXISTS `t_movimiento`;
CREATE TABLE IF NOT EXISTS `t_movimiento` (
  `id_tmovimiento` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id_tmovimiento`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `categoria_cliente_id_categoria` FOREIGN KEY (`categoria_cliente_id_categoria`) REFERENCES `categoria_cliente` (`id_categoria`),
  ADD CONSTRAINT `empleado_id_empleado` FOREIGN KEY (`empleado_id_empleado`) REFERENCES `empleado` (`id_empleado`),
  ADD CONSTRAINT `sede_id_sede` FOREIGN KEY (`sede_id_sede`) REFERENCES `sede` (`id_sede`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
