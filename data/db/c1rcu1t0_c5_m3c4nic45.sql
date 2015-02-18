-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 04-02-2015 a las 15:13:07
-- Versión del servidor: 5.5.41-MariaDB
-- Versión de PHP: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `c1rcu1t0_c5_m3c4nic45`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignacion`
--

CREATE TABLE IF NOT EXISTS `asignacion` (
  `asignacion_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `sucursal_id` int(10) unsigned NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estatus` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_categorias`
--

CREATE TABLE IF NOT EXISTS `cat_categorias` (
  `categoria_id` int(10) unsigned NOT NULL,
  `categoria` varchar(15) CHARACTER SET latin1 NOT NULL,
  `min` int(3) unsigned NOT NULL,
  `max` int(4) unsigned NOT NULL,
  `puntos` float unsigned NOT NULL,
  `multiplicador` int(2) unsigned NOT NULL DEFAULT '1',
  `fecha_creacion` int(10) unsigned NOT NULL,
  `fecha_actualizacion` int(10) unsigned DEFAULT NULL,
  `estatus` tinyint(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_cp`
--

CREATE TABLE IF NOT EXISTS `cat_cp` (
  `id` int(11) NOT NULL,
  `cp` int(5) unsigned NOT NULL COMMENT 'Codigo Postal',
  `colonia` varchar(60) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mpio` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `edo` tinyint(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cat_estados`
--

CREATE TABLE IF NOT EXISTS `cat_estados` (
  `estado_id` int(2) DEFAULT NULL,
  `nombre` varchar(19) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturacion`
--

CREATE TABLE IF NOT EXISTS `facturacion` (
  `facturacion_id` int(10) unsigned NOT NULL,
  `archivo_id` int(11) NOT NULL,
  `periodo_id` int(11) NOT NULL,
  `mayorista_id` int(11) NOT NULL,
  `no_factura` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_factura` int(10) unsigned NOT NULL,
  `cantidad` float unsigned NOT NULL,
  `sku` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `importe` float unsigned NOT NULL,
  `estatus` tinyint(2) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mayoristas`
--

CREATE TABLE IF NOT EXISTS `mayoristas` (
  `mayorista_id` int(11) unsigned NOT NULL,
  `mayorista` varchar(30) DEFAULT NULL,
  `rfc` varchar(13) NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `estatus` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mod_archivos`
--

CREATE TABLE IF NOT EXISTS `mod_archivos` (
  `archivos_id` int(10) unsigned NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `filename` tinytext NOT NULL,
  `fecha_creacion` int(11) NOT NULL,
  `estatus` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos_canje`
--

CREATE TABLE IF NOT EXISTS `periodos_canje` (
  `id` int(11) NOT NULL,
  `date_start` int(11) NOT NULL,
  `date_end` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_distribuidor`
--

CREATE TABLE IF NOT EXISTS `productos_distribuidor` (
  `productos_distribuidor_id` int(10) unsigned NOT NULL,
  `distribuidor_id` int(10) unsigned NOT NULL,
  `producto_global_id` int(10) unsigned NOT NULL,
  `sku_distribuidor` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` int(10) unsigned NOT NULL,
  `fecha_actualizacion` int(10) unsigned DEFAULT NULL,
  `estatus` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_globales`
--

CREATE TABLE IF NOT EXISTS `productos_globales` (
  `productos_globales_id` int(10) unsigned NOT NULL,
  `sku` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `presentacion` text COLLATE utf8_unicode_ci NOT NULL,
  `precio_piso` float unsigned NOT NULL,
  `fecha_creacion` int(10) unsigned NOT NULL,
  `fecha_actualizacion` int(10) unsigned DEFAULT NULL,
  `estatus` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_homologados`
--

CREATE TABLE IF NOT EXISTS `productos_homologados` (
  `productos_homologados_id` int(10) unsigned NOT NULL,
  `mayorista_id` int(10) unsigned NOT NULL,
  `producto_global_id` int(10) unsigned NOT NULL,
  `sku_mayorista` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creacion` int(10) unsigned NOT NULL,
  `fecha_actualizacion` int(10) unsigned DEFAULT NULL,
  `estatus` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_puntuacion`
--

CREATE TABLE IF NOT EXISTS `productos_puntuacion` (
  `productos_puntuacion_id` int(10) unsigned NOT NULL,
  `producto_global_id` int(10) unsigned NOT NULL,
  `perfil_id` int(10) unsigned NOT NULL,
  `puntos` float unsigned NOT NULL,
  `inversion` float unsigned NOT NULL,
  `porcentaje` float unsigned NOT NULL,
  `fecha_creacion` int(10) unsigned NOT NULL,
  `fecha_actualizacion` int(10) unsigned DEFAULT NULL,
  `estatus` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

CREATE TABLE IF NOT EXISTS `puntos` (
  `puntos_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `facturacion_id` int(10) unsigned NOT NULL,
  `productos_homologados_id` int(10) unsigned NOT NULL,
  `puntos` float unsigned NOT NULL,
  `fecha_creacion` int(10) unsigned NOT NULL,
  `fecha_actualizacion` int(10) unsigned DEFAULT NULL,
  `estatus` tinyint(2) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE IF NOT EXISTS `sucursales` (
  `sucursal_id` int(11) NOT NULL,
  `mayorista_id` int(2) DEFAULT NULL,
  `sucursal` varchar(31) DEFAULT NULL,
  `last_update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `estatus` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_info_adicional_id` int(11) NOT NULL,
  `user_id` varchar(45) DEFAULT NULL,
  `razon_social` varchar(255) DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `domicilio` varchar(255) DEFAULT NULL,
  `estado_id` int(11) DEFAULT NULL,
  `cp_id` int(11) DEFAULT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `celular` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nombre_distribuidor` varchar(255) DEFAULT NULL,
  `nombre_vendedor` varchar(255) DEFAULT NULL,
  `creation_date` int(11) DEFAULT NULL,
  `last_update` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT ' '
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user_info`
--

INSERT INTO `user_info` (`user_info_adicional_id`, `user_id`, `razon_social`, `nombre`, `domicilio`, `estado_id`, `cp_id`, `telefono`, `celular`, `email`, `nombre_distribuidor`, `nombre_vendedor`, `creation_date`, `last_update`, `status`) VALUES
(1, '1', 'null', 'null', 'null', 0, 0, 'null', 'null', 'null', 'null', 'null', 2147483647, 2147483647, -2),
(2, '2', 'Razón S.A. de C.V.', 'Paul Alejandro Soberanes', 'Navío 4655 Int 39 La Calma, zapopan', 1, 64000, '3317853547', '3317853547', 'paulsoberanes@gmail.com', NULL, NULL, 1422943200, 1422943200, 1),
(3, '3', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  ADD PRIMARY KEY (`asignacion_id`);

--
-- Indices de la tabla `cat_categorias`
--
ALTER TABLE `cat_categorias`
  ADD PRIMARY KEY (`categoria_id`);

--
-- Indices de la tabla `cat_cp`
--
ALTER TABLE `cat_cp`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`), ADD KEY `cp` (`cp`);

--
-- Indices de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  ADD PRIMARY KEY (`facturacion_id`);

--
-- Indices de la tabla `mayoristas`
--
ALTER TABLE `mayoristas`
  ADD PRIMARY KEY (`mayorista_id`);

--
-- Indices de la tabla `mod_archivos`
--
ALTER TABLE `mod_archivos`
  ADD PRIMARY KEY (`archivos_id`);

--
-- Indices de la tabla `periodos_canje`
--
ALTER TABLE `periodos_canje`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_distribuidor`
--
ALTER TABLE `productos_distribuidor`
  ADD PRIMARY KEY (`productos_distribuidor_id`);

--
-- Indices de la tabla `productos_globales`
--
ALTER TABLE `productos_globales`
  ADD PRIMARY KEY (`productos_globales_id`);

--
-- Indices de la tabla `productos_homologados`
--
ALTER TABLE `productos_homologados`
  ADD PRIMARY KEY (`productos_homologados_id`);

--
-- Indices de la tabla `productos_puntuacion`
--
ALTER TABLE `productos_puntuacion`
  ADD PRIMARY KEY (`productos_puntuacion_id`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
  ADD PRIMARY KEY (`puntos_id`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`sucursal_id`);

--
-- Indices de la tabla `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_info_adicional_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `asignacion`
--
ALTER TABLE `asignacion`
  MODIFY `asignacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cat_categorias`
--
ALTER TABLE `cat_categorias`
  MODIFY `categoria_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cat_cp`
--
ALTER TABLE `cat_cp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `facturacion`
--
ALTER TABLE `facturacion`
  MODIFY `facturacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mayoristas`
--
ALTER TABLE `mayoristas`
  MODIFY `mayorista_id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `mod_archivos`
--
ALTER TABLE `mod_archivos`
  MODIFY `archivos_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `periodos_canje`
--
ALTER TABLE `periodos_canje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos_distribuidor`
--
ALTER TABLE `productos_distribuidor`
  MODIFY `productos_distribuidor_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos_globales`
--
ALTER TABLE `productos_globales`
  MODIFY `productos_globales_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos_homologados`
--
ALTER TABLE `productos_homologados`
  MODIFY `productos_homologados_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos_puntuacion`
--
ALTER TABLE `productos_puntuacion`
  MODIFY `productos_puntuacion_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
  MODIFY `puntos_id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `sucursal_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_info_adicional_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
