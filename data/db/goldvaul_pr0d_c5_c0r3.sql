
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL DEFAULT '0.00000',
  `line_total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`,`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=31 ;

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `price`, `fees`, `line_total`) VALUES
(11, 1, 9, 1, 94596.00000, 0.00000, 94596.00000);

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_parent` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_img` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  `category_order` int(10) unsigned NOT NULL,
  `category_status` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=13 ;

INSERT INTO `category` (`id`, `id_parent`, `name`, `description`, `thumb_img`, `full_img`, `last_update`, `category_order`, `category_status`) VALUES
(1, 0, 'ARTÍCULOS DE VIAJE', '', 'images/catalogo1.png', 'images/catalogo1.png', 1403712181, 1, 1);

CREATE TABLE IF NOT EXISTS `credits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `credit` double unsigned NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=207 ;

INSERT INTO `credits` (`id`, `user_id`, `credit`, `last_update`) VALUES
(1, 21, 1936.7, 1418855886);

CREATE TABLE IF NOT EXISTS `credits_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_period` int(10) unsigned NOT NULL,
  `id_username` int(10) unsigned NOT NULL,
  `credits` double unsigned NOT NULL,
  `payments` int(10) unsigned NOT NULL,
  `status` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=27 ;

INSERT INTO `credits_history` (`id`, `id_period`, `id_username`, `credits`, `payments`, `status`) VALUES
(1, 15, 21, 150.1908, 0, 1);

CREATE TABLE IF NOT EXISTS `credits_periods` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `from_date` int(10) unsigned NOT NULL,
  `to_date` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

INSERT INTO `credits_periods` (`id`, `name`, `from_date`, `to_date`) VALUES
(1, 'Enero', 1385877600, 1359698399);

CREATE TABLE IF NOT EXISTS `order_check` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_security` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  `order_status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

INSERT INTO `order_check` (`id`, `id_security`, `user_id`, `total`, `order_date`, `ip`, `order_status`) VALUES
(1, 0, 148, 10958.00000, 1416929069, 2147483647, 3);

CREATE TABLE IF NOT EXISTS `order_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `order_status` int(10) unsigned NOT NULL,
  `order_date` int(10) unsigned NOT NULL,
  `ip` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

INSERT INTO `order_history` (`id`, `order_id`, `order_status`, `order_date`, `ip`) VALUES
(1, 1, 1, 1416929069, 2147483647);

CREATE TABLE IF NOT EXISTS `order_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `quantity` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `fees` float(20,5) unsigned NOT NULL,
  `line_total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=18 ;

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `price`, `fees`, `line_total`) VALUES
(1, 1, 117, 1, 10958.00000, 0.00000, 10958.00000);

CREATE TABLE IF NOT EXISTS `order_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name_status` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method_id` int(10) unsigned NOT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `total` float(20,5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `method_id` (`method_id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=17 ;

INSERT INTO `payment` (`id`, `method_id`, `order_id`, `user_id`, `total`) VALUES
(1, 1, 1, 148, 10958.00000);

CREATE TABLE IF NOT EXISTS `payment_method` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `id_resource` int(11) NOT NULL,
  `permission` enum('allow','deny') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=334 ;

INSERT INTO `permissions` (`id`, `id_role`, `id_resource`, `permission`) VALUES
(1, 1, 1, 'allow');

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sku` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `other_sku` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `description` text COLLATE utf8_spanish2_ci NOT NULL,
  `thumb_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `full_image` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned DEFAULT '0',
  `product_status` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=170 ;

INSERT INTO `product` (`id`, `sku`, `other_sku`, `description`, `thumb_image`, `full_image`, `last_update`, `product_status`) VALUES
(2, 'GV-02-14', 'Set Dinamarca', 'Set Dinamarca. Maletas rígidas de 28,24 y 20asa telescópica retráctil de aluminio sistema interno de cuatro ruedas que permiten giro de 360°, asa de mano superior y lateral organizadores internos. Colores plata y gris.', 'resized/CU0000000458.jpg', 'CU0000000458.jpg', 0, 1);

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

INSERT INTO `product_category` (`id`, `category_id`, `product_id`) VALUES
(3, 1, 2);

CREATE TABLE IF NOT EXISTS `product_price` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL,
  `price` float(20,5) unsigned NOT NULL,
  `currency` varchar(125) COLLATE utf8_spanish2_ci NOT NULL,
  `last_update` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci AUTO_INCREMENT=170 ;

INSERT INTO `product_price` (`id`, `product_id`, `price`, `currency`, `last_update`) VALUES
(2, 2, 192082.00000, 'Puntos', 0);

CREATE TABLE IF NOT EXISTS `resource` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_parent` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `resource` varchar(125) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=45 ;

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


CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role` varchar(40) NOT NULL,
  `id_parent` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `roles` (`id`, `role`, `id_parent`) VALUES
(1, 'Administrador', 0),
(2, 'Vendedor', 0),
(3, 'Gerente', 0);

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `display_name` varchar(50) DEFAULT NULL,
  `password` varchar(128) NOT NULL,
  `state` smallint(5) unsigned DEFAULT NULL,
  `gid` int(10) unsigned NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=260 ;

INSERT INTO `user` (`id`, `username`, `email`, `display_name`, `password`, `state`, `gid`) VALUES
(1, NULL, 'david.gomez@adventa.mx', 'David Gomez', '$2y$08$74UXLKNDUC9lbGMl0nb.A.L5we3/uyVz/zT8xfPD7n2K3XwKNovxC', 1, 2);
insert into user (username, email, display_name, password, state, gid) values ('admin', 'desarrolladorpc@logolinemail.com.mx', 'soberanes', '$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu', '1', '1'
);