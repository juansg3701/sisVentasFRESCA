-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2020 a las 18:06:46
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `generalfresca`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria_productos`
--

CREATE TABLE `categoria_productos` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(400) COLLATE utf8_spanish2_ci NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `id_impuestos` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `valor` double NOT NULL,
  `descripcion` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `plu` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `ean` varchar(45) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `unidad_de_medida` varchar(45) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` double NOT NULL,
  `stock_minimo` double NOT NULL,
  `fecha_registro` datetime NOT NULL,
  `categoria_id_categoria` int(11) NOT NULL,
  `impuestos_id_impuestos` int(11) NOT NULL,
  `empleado_id_empleado` int(11) NOT NULL
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
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `created_at` datetime(6) NOT NULL,
  `updated_at` datetime(6) NOT NULL,
  `tipo_cargo_id_cargo` int(11) NOT NULL,
  `sede_id_sede` int(11) NOT NULL,
  `superusuario` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `tipo_cargo_id_cargo`, `sede_id_sede`, `superusuario`) VALUES
(1, 'juan12', 'juan@gmail.com', '$2y$10$MdSnZTIALoa1ZRG.8GUwfeljEf6UT0OA5pTFYaSyE3UV7c3iXRx3K', 'xv64TdALYpKy9mS3dNaz6Aqq0BDzTPWKNy0JNeiaGkkN4lhCUuSdCk5dQpHt', '2019-11-06 11:38:48.000000', '2020-10-18 01:19:37.000000', 0, 0, 1),
(10, 'Holman', 'holman@gmail.com', '$2y$10$gvCFGDii3ApTQpdA/5ls5e/XdWDZnl0PSOWcco8/g6QIlRcgMb4PW', '3CKxEhAMK5oC3y3294OvSLaUmGTCMgjNIkKEnGof7kLyju5TpFCfT4fzjovP', '2019-11-06 13:02:24.000000', '2020-10-15 23:38:13.000000', 2, 3, 0),
(11, 'david', 'david@gmail.com', '$2y$10$jGfbqbDQW7YBJjSp/z60eOQ0RwO2Ve9pqitUW2HhvekjAQAug4ph6', 'Qmzh7ZC9WtZ9exZtFD72UiVHutdemAkzTASCgIN8fib7zEb9zAt3hW6igJ1a', '2019-11-09 06:15:10.000000', '2019-11-09 06:21:27.000000', 4, 3, 0),
(12, 'karem', 'karem@gmail.com', '$2y$10$eplCtdNOyH/f9Try1PbMEu3fqa608Z1gAeaQRF6JgGMbFxTGiaXBa', '', '2020-07-10 15:48:31.000000', '2020-07-10 15:48:31.000000', 1, 1, 0),
(13, 'nmnm', 'mananna@gmail.com', '$2y$10$fYp7H/flh7gC0hD.39hgDuZ2f2s39863pnIsSMx3/g5IX19AqpP7W', '', '2020-07-10 15:51:28.000000', '2020-07-10 15:51:28.000000', 1, 1, 0),
(14, 'walter', 'walter@gmail.com', '$2y$10$YdETvioLv0VB7nOkv9N7/Oba21LJUZPcYSU9l8pqozFBuPMmMrrSC', '', '2020-07-10 22:03:32.000000', '2020-07-10 22:03:32.000000', 1, 1, 0),
(15, 'holman2', 'holman2@gmail.com', '$2y$10$60rgh7ii20kE1M3B12wqDOa8Mho3jyV2xKg3j.6R4urJ3rR/701Ba', 'fZlePBB8SzrIxvGjEPPMjFzTP8vsFclWI21eRK1w2Lz96BACOVpo2YSV9DEe', '2020-08-08 23:29:16.000000', '2020-08-31 01:33:47.000000', 1, 2, 0),
(16, 'qq', 'asd@gmail.com', '$2y$10$gcA1O1wJEcvUAcE8mhdEQuWXkMbhh7iCihElmBDZwMWTsQQGyfBB6', '', '2020-10-15 23:57:16.000000', '2020-10-15 23:57:16.000000', 0, 0, 0),
(17, 'q', 'qq@gmail.com', '$2y$10$sUs12m5N9F2nm4U4JVBHweMauV4W4jHPEGP7v1bYoXguSk4Sv0kVm', 'yBJFgelIqpkdvPLRBS8grmhMLwZNt8p302NCDykriFKe8ISKOGa8JYWu7Tn0', '2020-10-16 00:05:28.000000', '2020-10-16 00:11:52.000000', 0, 0, 0),
(18, 'qqqq', 'as@gmail.com', '$2y$10$W4Llp1FnAFwthrBNWZA/I.RehuKAiKRpjjblCIkrRwCW64UpfP/EK', '', '2020-10-16 00:10:02.000000', '2020-10-16 00:10:02.000000', 0, 0, 0),
(19, 'mnm', 'pr@gmail.com', '$2y$10$8tmOPtY8waK8pS.gwijDquSOdo4ChYgJz4nltSo3BsfWf0t16GSM2', '', '2020-10-16 00:11:33.000000', '2020-10-16 00:11:33.000000', 0, 0, 0),
(1236, 'juliana', 'juliana@gmail.com', '$2y$10$IHw2gur2SgibHTF6G4e2CO9YjHWrB9YG.gcJ0XlexXW35SzhT.3m6', '', '2020-10-18 11:02:10.000000', '2020-10-18 11:02:10.000000', 1, 1, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria_productos`
--
ALTER TABLE `categoria_productos`
  ADD PRIMARY KEY (`id_categoria`),
  ADD KEY `empleado_id_empleado` (`empleado_id_empleado`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id_impuestos`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `producto_categoria_fk` (`categoria_id_categoria`),
  ADD KEY `producto_impuesto_fk` (`impuestos_id_impuestos`);

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
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_sede_fk` (`sede_id_sede`),
  ADD KEY `users_tipo_cargo_fk` (`tipo_cargo_id_cargo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

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
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1237;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
