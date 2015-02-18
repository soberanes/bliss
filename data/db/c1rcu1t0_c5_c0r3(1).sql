-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-01-2015 a las 16:35:49
-- Versión del servidor: 5.5.41-MariaDB
-- Versión de PHP: 5.5.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `c1rcu1t0_c5_c0r3`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL DEFAULT '0.00000',
  `line_total` float(20,5) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `price`, `fees`, `line_total`) VALUES
(11, 1, 9, 1, 94596.00000, 0.00000, 94596.00000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL,
  `id_parent` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  `category_order` int(10) unsigned NOT NULL,
  `category_status` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `id_parent`, `name`, `description`, `thumb_img`, `full_img`, `last_update`, `category_order`, `category_status`) VALUES
(1, 0, 'ARTÍCULOS DE VIAJE', '', 'images/catalogo1.png', 'images/catalogo1.png', 1403712181, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `credit` double unsigned NOT NULL,
  `last_update` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `credits`
--

INSERT INTO `credits` (`id`, `user_id`, `credit`, `last_update`) VALUES
(1, 21, 1936.7, 1418855886);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits_history`
--

CREATE TABLE IF NOT EXISTS `credits_history` (
  `id` int(10) unsigned NOT NULL,
  `id_period` int(10) unsigned NOT NULL,
  `id_username` int(10) unsigned NOT NULL,
  `credits` double unsigned NOT NULL,
  `payments` int(10) unsigned NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `credits_history`
--

INSERT INTO `credits_history` (`id`, `id_period`, `id_username`, `credits`, `payments`, `status`) VALUES
(1, 15, 21, 150.1908, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits_periods`
--

CREATE TABLE IF NOT EXISTS `credits_periods` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `from_date` int(10) unsigned NOT NULL,
  `to_date` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `credits_periods`
--

INSERT INTO `credits_periods` (`id`, `name`, `from_date`, `to_date`) VALUES
(1, 'Enero', 1385877600, 1359698399);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_check`
--

CREATE TABLE IF NOT EXISTS `order_check` (
  `id` int(10) unsigned NOT NULL,
  `id_security` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `order_status` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `order_check`
--

INSERT INTO `order_check` (`id`, `id_security`, `user_id`, `total`, `order_date`, `ip`, `order_status`) VALUES
(1, 0, 148, 10958.00000, 1416929069, 2147483647, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_history`
--

CREATE TABLE IF NOT EXISTS `order_history` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `order_status` int(10) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `order_status`, `order_date`, `ip`) VALUES
(1, 1, 1, 1416929069, 2147483647);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_item`
--

CREATE TABLE IF NOT EXISTS `order_item` (
  `id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL,
  `line_total` float(20,5) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `price`, `fees`, `line_total`) VALUES
(1, 1, 117, 1, 10958.00000, 0.00000, 10958.00000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(10) unsigned NOT NULL,
  `name_status` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) unsigned NOT NULL,
  `method_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`id`, `method_id`, `order_id`, `user_id`, `total`) VALUES
(1, 1, 1, 148, 10958.00000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `payment_method`
--

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) unsigned NOT NULL,
  `id_role` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `permission` enum('allow','deny') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id`, `id_role`, `id_resource`, `permission`) VALUES
(1, 1, 1, 'allow');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL,
  `sku` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `other_sku` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned DEFAULT '0',
  `product_status` tinyint(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `sku`, `other_sku`, `description`, `thumb_image`, `full_image`, `last_update`, `product_status`) VALUES
(2, 'GV-02-14', 'Set Dinamarca', 'Set Dinamarca. Maletas rígidas de 28,24 y 20asa telescópica retráctil de aluminio sistema interno de cuatro ruedas que permiten giro de 360°, asa de mano superior y lateral organizadores internos. Colores plata y gris.', 'resized/CU0000000458.jpg', 'CU0000000458.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `product_category`
--

INSERT INTO `product_category` (`id`, `category_id`, `product_id`) VALUES
(3, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_price`
--

CREATE TABLE IF NOT EXISTS `product_price` (
  `id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `currency` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `product_price`
--

INSERT INTO `product_price` (`id`, `product_id`, `price`, `currency`, `last_update`) VALUES
(2, 2, 192082.00000, 'Puntos', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resource`
--

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(10) unsigned NOT NULL,
  `id_parent` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `resource` varchar(125) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resource`
--

INSERT INTO `resource` (`id`, `id_parent`, `id_type`, `nombre`, `resource`, `descripcion`) VALUES
(1, 0, 1, 'application_index', 'Application\\Controller\\Index/index', ''),
(2, 1, 2, 'application_comoparticipar', 'Application\\Controller\\Index/comoparticipar', ''),
(3, 1, 2, 'application_mispuntos', 'Application\\Controller\\Index/mispuntos', ''),
(4, 1, 2, 'application_catalogo', 'Application\\Controller\\Index/catalogo', ''),
(5, 1, 2, 'application_canjeartupremio', 'Application\\Controller\\Index/canjeartupremio', ''),
(6, 1, 2, 'application_laselecciongepp', 'Application\\Controller\\Index/laselecciongepp', ''),
(7, 1, 2, 'application_tablaposicion', 'Application\\Controller\\Index/tablaposicion', ''),
(8, 1, 2, 'application_incentivos', 'Application\\Controller\\Index/incentivos', ''),
(9, 1, 2, 'application_reconocimientos', 'Application\\Controller\\Index/reconocimientos', ''),
(10, 1, 2, 'application_categoria', 'Application\\Controller\\Index/categoria', ''),
(11, 1, 2, 'application_producto', 'Application\\Controller\\Index/producto', ''),
(12, 1, 2, 'application_carrito', 'Application\\Controller\\Index/carrito', ''),
(13, 1, 2, 'application_checkout', 'Application\\Controller\\Index/checkout', ''),
(14, 0, 1, 'cscategorycmf_index', 'Cscategorycmf\\Controller\\Index/index', 'Categoy'),
(15, 0, 1, 'cscurrencypoints_index', 'Cscurrencypoints\\Controller\\Index/index', 'Cscurrencypoints'),
(18, 0, 1, 'csproductcmf_index', 'Csproductcmf\\Controller\\Index/index', 'csproductcmf'),
(21, 18, 2, 'csproductcmf_controller_index_producto', 'Csproductcmf\\Controller\\Index/producto', 'csproductcmf_controller_index_producto'),
(22, 0, 1, 'cscart_controller_index_carrito', 'Cscart\\Controller\\Index/carrito', 'cscart_controller_index_carrito'),
(23, 0, 1, 'cscheckout_controller_index_checkout', 'Cscheckout\\Controller\\Index/checkout', 'cscheckout_controller_index_checkout'),
(24, 0, 1, 'asignacion_controller_index_index', 'Asignacion\\Controller\\Index/index', 'asignacion_controller_index_index'),
(25, 24, 2, 'asignacion_controller_index_desasignaruta', 'Asignacion\\Controller\\Index/desasignaruta', 'asignacion_controller_index_desasignaruta'),
(26, 24, 2, 'asignacion_controller_index_asignaruta', 'Asignacion\\Controller\\Index/asignaruta', 'asignacion_controller_index_asignaruta'),
(27, 24, 2, 'asignacion_controller_index_buscaempleado', 'Asignacion\\Controller\\Index/buscaempleado', 'asignacion_controller_index_buscaempleado'),
(28, 24, 2, 'asignacion_controller_index_empleadoasi', 'Asignacion\\Controller\\Index/empleadoasi', 'asignacion_controller_index_empleadoasi'),
(29, 1, 2, 'application_controller_index_privacidad', 'Application\\Controller\\Index/privacidad', 'application_controller_index_privacidad'),
(30, 1, 2, 'HistorialCanjes_Controller_Index_index ', 'HistorialCanjes\\Controller\\Index/index ', 'HistorialCanjes_Controller_Index_index '),
(31, 1, 2, 'Bases_Controller_Index_index ', 'Bases\\Controller\\Index/index ', 'Bases_Controller_Index_index '),
(32, 0, 1, 'Registro_Controller_Index_index', 'Registro\\Controller\\Index/index', 'Registro_Controller_Index_index'),
(33, 32, 2, 'Registro_Controller_Index_getinfo', 'Registro\\Controller\\Index/getinfo', 'Registro_Controller_Index_getinfo'),
(34, 32, 2, 'Registro_Controller_Index_saveiu', 'Registro\\Controller\\Index/saveiu', 'Registro_Controller_Index_saveiu'),
(35, 32, 2, 'Registro_Controller_Index_confirmar', 'Registro\\Controller\\Index/confirmar', 'Registro_Controller_Index_confirmar'),
(36, 32, 1, 'Registro_Controller_Participantes_index', 'Registro\\Controller\\Participantes/index', 'Registro_Controller_Participantes_index'),
(37, 32, 2, 'Registro_Controller_Participantes_upload', 'Registro\\Controller\\Participantes/upload', 'Registro_Controller_Participantes_upload'),
(38, 32, 2, 'Registro_Controller_Participantes_process', 'Registro\\Controller\\Participantes/process', 'Registro_Controller_Participantes_process'),
(39, 32, 2, 'Registro_Controller_Participantes_download', 'Registro\\Controller\\Participantes/download', 'Registro_Controller_Participantes_download'),
(40, 0, 1, 'Facturacion_Controller_Index_index', 'Facturacion\\Controller\\Index/index', 'Facturacion_Controller_Index_index'),
(41, 40, 2, 'Facturacion_Controller_Index_upload', 'Facturacion\\Controller\\Index/upload', 'Facturacion_Controller_Index_upload'),
(42, 40, 2, 'Facturacion\\Controller\\Index/download', 'Facturacion\\Controller\\Index/download', 'Facturacion_Controller_Index_download'),
(43, 15, 2, 'Cscurrencypoints_Controller_Detalle_index', 'Cscurrencypoints\\Controller\\Detalle/index', 'Cscurrencypoints_Controller_Detalle_index'),
(44, 1, 2, 'Tutorial_Controller_Index_index', 'Tutorial\\Controller\\Index/index', 'Tutorial_Controller_Index_index');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(40) NOT NULL,
  `id_parent` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `role`, `id_parent`) VALUES
(1, 'Administrador', 0),
(2, 'Vendedor', 0),
(3, 'Gerente', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  `gid` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`, `state`, `gid`) VALUES
(1, 'admin', 'desarrolladorpc@logolinemail.com.mx', 'soberanes', '$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`,`product_id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credits`
--
ALTER TABLE `credits`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credits_history`
--
ALTER TABLE `credits_history`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `credits_periods`
--
ALTER TABLE `credits_periods`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_check`
--
ALTER TABLE `order_check`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `order_history`
--
ALTER TABLE `order_history`
  ADD PRIMARY KEY (`id`), ADD KEY `order_id` (`order_id`);

--
-- Indices de la tabla `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`), ADD KEY `order_id` (`order_id`), ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`), ADD KEY `method_id` (`method_id`), ADD KEY `order_id` (`order_id`), ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `product_price`
--
ALTER TABLE `product_price`
  ADD PRIMARY KEY (`id`), ADD KEY `product_id` (`product_id`);

--
-- Indices de la tabla `resource`
--
ALTER TABLE `resource`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `credits`
--
ALTER TABLE `credits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `credits_history`
--
ALTER TABLE `credits_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `credits_periods`
--
ALTER TABLE `credits_periods`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `order_check`
--
ALTER TABLE `order_check`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

