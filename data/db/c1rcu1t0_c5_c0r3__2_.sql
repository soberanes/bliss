-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 03-02-2015 a las 20:09:46
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
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `price`, `fees`, `line_total`) VALUES
(11, 1, 9, 1, 94596.00000, 0.00000, 94596.00000),
(23, 19, 33, 1, 26059.00000, 0.00000, 26059.00000),
(29, 83, 67, 1, 5547.00000, 0.00000, 5547.00000);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `id_parent`, `name`, `description`, `thumb_img`, `full_img`, `last_update`, `category_order`, `category_status`) VALUES
(1, 0, 'ARTÃCULOS DE VIAJE', '', 'images/catalogo1.png', 'images/catalogo1.png', 1403712181, 1, 1),
(2, 0, 'AVENTURA AL AIRE LIBRE', '', 'images/catalogo2.png', 'images/catalogo2.png', 1403712181, 2, 1),
(3, 0, 'DECORACION Y HOGAR', '', 'images/catalogo3.png', 'images/catalogo3.png', 1403712181, 3, 1),
(4, 0, 'ENTRETENIMIENTO', '', 'images/catalogo4.png', 'images/catalogo4.png', 1403712181, 4, 1),
(5, 0, 'EXPERIENCIAS', '', 'images/catalogo5.png', 'images/catalogo5.png', 1403712181, 5, 1),
(6, 0, 'LÃNEA BLANCA', '', 'images/catalogo6.png', 'images/catalogo6.png', 1403712181, 6, 1),
(7, 0, 'NIÃ‘OS Y BEBES', '', 'images/catalogo7.png', 'images/catalogo7.png', 1403712181, 7, 1),
(8, 0, 'PARA EL', '', 'images/catalogo8.png', 'images/catalogo8.png', 1403712181, 8, 1),
(9, 0, 'PARA ELLA', '', 'images/catalogo9.png', 'images/catalogo9.png', 1403712181, 9, 1),
(10, 0, 'RELOJES', '', 'images/catalogo10.png', 'images/catalogo10.png', 1403712181, 10, 1),
(11, 0, 'SALUD Y BELLEZA', '', 'images/catalogo11.png', 'images/catalogo11.png', 1403712181, 11, 1),
(12, 0, 'TECNOLOGIA', '', 'images/catalogo12.png', 'images/catalogo12.png', 1403712181, 12, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits`
--

CREATE TABLE IF NOT EXISTS `credits` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `credit` double unsigned NOT NULL,
  `last_update` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `credits`
--

INSERT INTO `credits` (`id`, `user_id`, `credit`, `last_update`) VALUES
(1, 21, 1936.7, 1418855886),
(2, 2, 45996.45, 1409696025),
(3, 34, 12906.38, 1418151722),
(4, 90, 8720.7, 1416354040),
(67, 141, 7925.265, 1418841243),
(68, 19, 25626.53, 1418841243),
(69, 28, 20.48056, 1416333789),
(70, 69, 32853.05, 1418841243),
(71, 26, 1217.66, 1418841243),
(72, 29, 685.38, 1418841242),
(73, 24, 9104.117, 1418841243),
(74, 32, 25226.7385, 1418841243),
(75, 25, 8705.66, 1418841242),
(76, 66, 5462.76, 1418841242),
(77, 20, 2424, 1418841242),
(78, 146, 3162.024, 1418841243),
(79, 22, 7331.38, 1418841242),
(80, 136, 710.38, 1418841243),
(81, 101, 1107.138, 1416334087),
(82, 137, 244.876, 1416334088),
(83, 149, 2070.85, 1418841241),
(84, 59, 764.312, 1418228952),
(85, 63, 74.5477, 1418228953),
(86, 62, 402.53, 1418228952),
(87, 112, 10130.612, 1418228953),
(88, 61, 0, 1416334112),
(89, 153, 0, 1416334112),
(90, 156, 0, 1416334113),
(91, 150, 0, 1416334113),
(92, 14, 703.06, 1418228951),
(93, 16, 255.6045, 1418228952),
(94, 7, 0, 1416334115),
(95, 158, 0, 1416334113),
(96, 37, 325.6007, 1418228952),
(97, 118, 3547.53, 1418228951),
(98, 27, 1604.025, 1418228953),
(99, 17, 80.12014, 1418228951),
(100, 116, 0, 1416334115),
(101, 42, 187.5477, 1418228953),
(102, 157, 75.0956, 1418228953),
(103, 58, 0, 1416334114),
(104, 152, 958.98232, 1418151718),
(105, 119, 0, 1416334114),
(106, 155, 0, 1416334114),
(107, 30, 445.5477, 1418228953),
(108, 151, 0, 1416334115),
(109, 114, 0, 1416334115),
(110, 85, 62212.0954, 1418855911),
(111, 80, 28800.84, 1418855910),
(112, 109, 36951.9896, 1418855911),
(113, 126, 46180.84, 1418855910),
(114, 104, 6332.8868, 1418855910),
(115, 128, 7954.1, 1418855908),
(116, 5, 43517.2862, 1418855913),
(117, 10, 8019.9792, 1418855914),
(118, 107, 608.2014, 1418855914),
(119, 84, 27411.3816, 1418232993),
(120, 129, 22849.96112, 1418232993),
(121, 79, 4934.5477, 1418232994),
(122, 71, 11835.5477, 1418232995),
(123, 77, 3322.9792, 1418232995),
(124, 92, 5865.0954, 1418232996),
(125, 127, 6505.8339, 1418232996),
(126, 82, 5535.89, 1418232997),
(127, 31, 10263.98234, 1418855907),
(128, 81, 816.7, 1418233005),
(129, 83, 4164.6007, 1418233004),
(130, 142, 18204.96464, 1418233002),
(131, 72, 55401.1908, 1418233009),
(132, 18, 23487.1908, 1418233009),
(133, 147, 0, 1418151724),
(134, 89, 237, 1418855899),
(135, 160, 0, 1418151724),
(136, 148, 7028, 1419268373),
(137, 91, 2905.35, 1416354041),
(138, 170, 2671.38, 1418151721),
(139, 103, 34.1344, 1418151709),
(140, 36, 42.6679, 1418151710),
(141, 172, 0, 1418151710),
(142, 167, 711.7, 1418151710),
(143, 88, 70.3339, 1418151713),
(144, 123, 604.2014, 1418151714),
(145, 100, 13767.0672, 1418151722),
(146, 35, 3749.948, 1418151722),
(147, 168, 5446.38, 1418151722),
(148, 173, 4003.438, 1418151723),
(149, 162, 978, 1418151723),
(150, 52, 10.98234, 1418151715),
(151, 38, 19643.48056, 1418151723),
(152, 70, 15970.66, 1418151723),
(153, 65, 5111.314, 1418151723),
(154, 145, 3226.69, 1418151723),
(155, 174, 275.0672, 1418151718),
(156, 163, 70.4948, 1418151723),
(157, 166, 8883.76, 1418151720),
(158, 45, 5236.0954, 1418151721),
(159, 40, 29953.6045, 1418151724),
(160, 41, 5070.5477, 1418151721),
(161, 105, 1233.66, 1418151721),
(162, 46, 75.0954, 1418151721),
(163, 197, 2671.38, 1418151721),
(164, 51, 1406.75, 1418151721),
(165, 74, 3130.94, 1418151721),
(166, 75, 1288.75, 1418151721),
(167, 169, 0, 1418151721),
(168, 165, 1233.66, 1418151722),
(169, 99, 3508.452, 1418151722),
(170, 189, 1233.658, 1418151724),
(171, 175, 2.74558, 1418151725),
(172, 176, 7255.474, 1418841242),
(173, 222, 1763.69, 1418841241),
(174, 208, 0, 1418151826),
(175, 200, 150.265, 1418228952),
(176, 214, 2215.06, 1418228953),
(177, 182, 0, 1418151826),
(178, 204, 909.375, 1418228951),
(179, 192, 3231.32, 1418228953),
(180, 201, 51.2014, 1418228950),
(181, 60, 140.9896, 1418228952),
(182, 181, 0, 1418228953),
(183, 179, 0, 1418228953),
(184, 229, 4122.4558, 1418855896),
(185, 233, 209.555, 1418841238),
(186, 236, 2671.38, 1418841238),
(187, 237, 1335.69, 1418841238),
(188, 227, 1335.69, 1418841240),
(189, 238, 1335.69, 1418841240),
(190, 225, 283.5478, 1418841242),
(191, 235, 1335.69, 1418841241),
(192, 239, 1396.2191, 1418841241),
(193, 223, 4144.5761, 1418841243),
(194, 198, 1335.69, 1418841243),
(195, 240, 1335.69, 1418841243),
(196, 110, 2894.38, 1418852818),
(197, 249, 19243.38, 1418855879),
(198, 43, 12968.84, 1418855885),
(199, 53, 12643.78, 1418855885),
(200, 39, 31510, 1418855886),
(201, 48, 21212, 1418855886),
(202, 47, 17280.7, 1418855885),
(203, 23, 12803.84, 1418855886),
(204, 248, 3948.876, 1418855901),
(205, 245, 2020.752, 1418855925),
(206, 64, 3498.9896, 1418855912);

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `credits_history`
--

INSERT INTO `credits_history` (`id`, `id_period`, `id_username`, `credits`, `payments`, `status`) VALUES
(1, 15, 21, 150.1908, 0, 1),
(2, 15, 21, 0, 0, 1),
(3, 16, 2, 42675.3, 0, 1),
(4, 16, 2, 3321.15, 0, 1),
(5, 16, 34, 2671.38, 0, 2),
(6, 16, 34, 0, 0, 1),
(7, 16, 34, 2467.32, 0, 1),
(8, 16, 90, 0, 0, 2),
(9, 16, 90, 0, 0, 2),
(10, 16, 90, 0, 0, 2),
(11, 0, 148, 0, 10958, 1),
(12, 0, 89, 0, 10522, 1),
(13, 0, 20, 0, 8890, 1),
(14, 0, 26, 0, 5547, 1),
(15, 0, 66, 0, 17128, 1),
(16, 0, 29, 0, 11094, 1),
(17, 0, 24, 0, 29945, 1),
(18, 0, 10, 0, 6606, 1),
(19, 0, 136, 0, 12200, 1),
(20, 0, 26, 0, 5547, 1),
(21, 0, 29, 0, 10522, 1),
(22, 0, 136, 0, 17910, 1),
(23, 0, 81, 0, 36931, 1),
(24, 0, 83, 0, 12200, 1),
(25, 0, 110, 0, 24851, 1),
(26, 0, 81, 0, 39128, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credits_periods`
--

CREATE TABLE IF NOT EXISTS `credits_periods` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(60) COLLATE utf8_spanish2_ci NOT NULL,
  `from_date` int(10) unsigned NOT NULL,
  `to_date` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `credits_periods`
--

INSERT INTO `credits_periods` (`id`, `name`, `from_date`, `to_date`) VALUES
(1, 'Enero', 1385877600, 1359698399),
(2, 'Febrero', 1359698400, 1362117599),
(3, 'Marzo', 1362117600, 1364795999),
(4, 'Abril', 1364796000, 1367384399),
(5, 'mayo', 1367384400, 1370062799),
(6, 'junio', 1370062800, 1372654799),
(7, 'julio', 1372654800, 1375333199),
(8, 'agosto', 1375333200, 1378011599),
(9, 'septiembre', 1378011600, 1380603599),
(10, 'octubre', 1380603600, 1383285599),
(11, 'noviembre', 1383285600, 1385877599),
(12, 'diciembre', 1385877600, 1388555999),
(13, 'Junio 2014', 1401602400, 1404194399),
(14, 'Julio 2014', 1, 1),
(15, 'Agosto 2014', 1406872800, 1409551199),
(16, 'Septiembre 2014', 1409551200, 1412143199);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `order_check`
--

INSERT INTO `order_check` (`id`, `id_security`, `user_id`, `total`, `order_date`, `ip`, `order_status`) VALUES
(1, 0, 148, 10958.00000, 1416929069, 2147483647, 3),
(2, 0, 89, 10522.00000, 1416929133, 2147483647, 3),
(3, 0, 20, 8890.00000, 1416931379, 2147483647, 3),
(4, 0, 26, 5547.00000, 1416931969, 2147483647, 3),
(5, 0, 66, 17128.00000, 1416933176, 2147483647, 3),
(6, 0, 29, 11094.00000, 1416961713, 2147483647, 3),
(7, 0, 24, 29945.00000, 1418273839, 2147483647, 3),
(8, 0, 10, 6606.00000, 1418346101, 2147483647, 3),
(9, 0, 136, 12200.00000, 1418837654, 2147483647, 3),
(10, 0, 26, 5547.00000, 1418841878, 2147483647, 3),
(11, 0, 29, 10522.00000, 1418842561, 2147483647, 3),
(12, 0, 136, 17910.00000, 1418845051, 2147483647, 3),
(13, 0, 81, 36931.00000, 1418857836, 2147483647, 3),
(14, 0, 83, 12200.00000, 1418859591, 2147483647, 3),
(15, 0, 110, 24851.00000, 1418859694, 2147483647, 3),
(16, 0, 81, 39128.00000, 1418860004, 2147483647, 3);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `order_history`
--

INSERT INTO `order_history` (`id`, `order_id`, `order_status`, `order_date`, `ip`) VALUES
(1, 1, 1, 1416929069, 2147483647),
(2, 2, 1, 1416929133, 2147483647),
(3, 3, 1, 1416931379, 2147483647),
(4, 4, 1, 1416931969, 2147483647),
(5, 5, 1, 1416933176, 2147483647),
(6, 6, 1, 1416961713, 2147483647),
(7, 7, 1, 1418273839, 2147483647),
(8, 8, 1, 1418346101, 2147483647),
(9, 9, 1, 1418837654, 2147483647),
(10, 10, 1, 1418841878, 2147483647),
(11, 11, 1, 1418842561, 2147483647),
(12, 12, 1, 1418845051, 2147483647),
(13, 13, 1, 1418857836, 2147483647),
(14, 14, 1, 1418859591, 2147483647),
(15, 15, 1, 1418859694, 2147483647),
(16, 16, 1, 1418860004, 2147483647);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `order_item`
--

INSERT INTO `order_item` (`id`, `order_id`, `product_id`, `quantity`, `price`, `fees`, `line_total`) VALUES
(1, 1, 117, 1, 10958.00000, 0.00000, 10958.00000),
(2, 2, 36, 1, 10522.00000, 0.00000, 10522.00000),
(3, 3, 122, 1, 8890.00000, 0.00000, 8890.00000),
(4, 4, 67, 1, 5547.00000, 0.00000, 5547.00000),
(5, 5, 36, 1, 10522.00000, 0.00000, 10522.00000),
(6, 5, 37, 1, 6606.00000, 0.00000, 6606.00000),
(7, 6, 67, 2, 11094.00000, 0.00000, 11094.00000),
(8, 7, 35, 1, 29945.00000, 0.00000, 29945.00000),
(9, 8, 37, 1, 6606.00000, 0.00000, 6606.00000),
(10, 9, 111, 1, 12200.00000, 0.00000, 12200.00000),
(11, 10, 67, 1, 5547.00000, 0.00000, 5547.00000),
(12, 11, 36, 1, 10522.00000, 0.00000, 10522.00000),
(13, 12, 41, 1, 17910.00000, 0.00000, 17910.00000),
(14, 13, 113, 1, 36931.00000, 0.00000, 36931.00000),
(15, 14, 111, 1, 12200.00000, 0.00000, 12200.00000),
(16, 15, 129, 1, 24851.00000, 0.00000, 24851.00000),
(17, 16, 46, 1, 39128.00000, 0.00000, 39128.00000);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `payment`
--

INSERT INTO `payment` (`id`, `method_id`, `order_id`, `user_id`, `total`) VALUES
(1, 1, 1, 148, 10958.00000),
(2, 1, 2, 89, 10522.00000),
(3, 1, 3, 20, 8890.00000),
(4, 1, 4, 26, 5547.00000),
(5, 1, 5, 66, 17128.00000),
(6, 1, 6, 29, 11094.00000),
(7, 1, 7, 24, 29945.00000),
(8, 1, 8, 10, 6606.00000),
(9, 1, 9, 136, 12200.00000),
(10, 1, 10, 26, 5547.00000),
(11, 1, 11, 29, 10522.00000),
(12, 1, 12, 136, 17910.00000),
(13, 1, 13, 81, 36931.00000),
(14, 1, 14, 83, 12200.00000),
(15, 1, 15, 110, 24851.00000),
(16, 1, 16, 81, 39128.00000);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(10) unsigned NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

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
(44, 1, 2, 'Tutorial_Controller_Index_index', 'Tutorial\\Controller\\Index/index', 'Tutorial_Controller_Index_index'),
(45, 0, 1, 'zfcuser/complete', 'zfcuser/complete', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `display_name`, `password`, `state`, `gid`) VALUES
(1, 'admin', 'desarrolladorpc@logolinemail.com.mx', 'soberanes', '$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu', 1, 1),
(2, 'vendedor', 'paul.soberanes@adventa.mx', 'Vendedor', '$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu', 1, 2),
(3, 'gerente', 'paul.soberanes@adventa.mx', 'Gerente', '$2a$08$F8Rxo0h71Qh6Z105ZYO6F.o16dvUZEA9LoX5DJ2yCJ3XIn8hxRhuu', 1, 3);

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
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `credits`
--
ALTER TABLE `credits`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=207;
--
-- AUTO_INCREMENT de la tabla `credits_history`
--
ALTER TABLE `credits_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT de la tabla `credits_periods`
--
ALTER TABLE `credits_periods`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `order_check`
--
ALTER TABLE `order_check`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `order_history`
--
ALTER TABLE `order_history`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT de la tabla `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `product_price`
--
ALTER TABLE `product_price`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `resource`
--
ALTER TABLE `resource`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
