-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-03-2019 a las 01:33:41
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `fsolutionslvdb`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `create_list_customer_product_details` (IN `po_id` INTEGER, IN `ct_id` INTEGER, IN `profile_id` INTEGER, IN `cut_date` DATE)  BEGIN
 DECLARE AccountID VARCHAR(45);
 DECLARE v1 INT DEFAULT 0;
  
  
  IF profile_id = 1 THEN

   INSERT INTO purchase_order_details   (purchase_order_id,product_id,purchase_order_date,created_at,updated_at )   
   SELECT  
   po_id,lctdt.product_id,cut_date, CURRENT_TIMESTAMP()  ,CURRENT_TIMESTAMP()  
   FROM list_customer_product lct left join list_customer_product_details lctdt on lct.id =  lctdt.list_customer_product_id   
   where 
   lct.customer_id = ct_id and lct.active = 1;
   
   
   select * from purchase_order_details podt where podt.purchase_order_id = po_id;
   
  ELSEIF profile_id = 2 THEN



  WHILE v1 < 7 DO
  
   INSERT INTO purchase_order_details   (purchase_order_id,product_id,purchase_order_date,created_at,updated_at )   
   SELECT  
   po_id,lctdt.product_id, DATE_ADD(cut_date, INTERVAL v1 DAY), CURRENT_TIMESTAMP()  ,CURRENT_TIMESTAMP()  
   FROM list_customer_product lct left join list_customer_product_details lctdt on lct.id =  lctdt.list_customer_product_id   
   where 
   lct.customer_id = ct_id and lct.active = 1;
   
     SET v1 = v1 + 1;
  END WHILE;

  
   
   SELECT  * FROM list_customer_product lct where lct.customer_id = ct_id and active = 1;
   
   ELSE
   
   SELECT  * FROM list_customer_product lct where lct.customer_id = ct_id and active = 1;
   

   END IF;



   
 END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `branch_office`
--

CREATE TABLE `branch_office` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `main_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `main_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `latitude_longitude_elevation` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `branch_office`
--

INSERT INTO `branch_office` (`id`, `name`, `main_phone`, `main_address`, `latitude_longitude_elevation`, `customer_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'KFC Iserra', '31234521', 'Iserra', '12345', 1, 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `category`
--

INSERT INTO `category` (`id`, `name`, `short_name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'FRZ', 'FRZ', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(2, 'REF', 'REF', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(3, 'DRY', 'DRY', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `main_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `main_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `profile_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id`, `name`, `main_phone`, `main_address`, `profile_id`, `active`, `created_at`, `updated_at`) VALUES
(1, 'KFC', '7222254', 'CC Iserra 100', 2, 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(2, 'Latam', '3322145', 'Aeropuesto Internacional', 2, 1, '2019-02-26 01:46:44', '2019-02-26 01:46:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `list_customer_product`
--

CREATE TABLE `list_customer_product` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `users_lm_id` int(10) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `list_customer_product`
--

INSERT INTO `list_customer_product` (`id`, `name`, `description`, `customer_id`, `users_lm_id`, `active`, `created_at`, `updated_at`) VALUES
(2, 'Lista KFC', 'Lista KFC', 1, 1, 1, '2019-02-26 01:23:32', '2019-02-26 01:23:32');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `list_customer_product_details`
--

CREATE TABLE `list_customer_product_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `list_customer_product_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `suggest` tinyint(1) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `list_customer_product_details`
--

INSERT INTO `list_customer_product_details` (`id`, `list_customer_product_id`, `product_id`, `suggest`, `priority`, `active`, `created_at`, `updated_at`) VALUES
(3, 2, 1, 0, 1, 1, '2019-02-26 01:45:30', '2019-02-26 01:45:30'),
(4, 2, 2, 1, 2, 1, '2019-02-26 01:45:30', '2019-02-26 01:45:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_02_11_205420_create_rol_table', 1),
(2, '2019_02_11_205520_create_status_table', 1),
(3, '2019_02_11_205703_create_section_table', 1),
(4, '2019_02_11_210417_create_profile_table', 1),
(5, '2019_02_11_210455_create_category_table', 1),
(6, '2019_02_11_210603_create_unit_table', 1),
(7, '2019_02_11_210853_create_sections_rol_table', 1),
(8, '2019_02_11_211020_create_customer_table', 1),
(9, '2019_02_11_211318_create_notification_days_table', 1),
(10, '2019_02_11_211319_create_branch_office_table', 1),
(11, '2019_02_11_211320_create_users_table', 1),
(12, '2019_02_11_211659_create_product_table', 1),
(13, '2019_02_11_211804_create_list_customer_product_table', 1),
(14, '2019_02_11_211914_create_list_customer_product_details_table', 1),
(15, '2019_02_11_212130_create_purchase_order_table', 1),
(16, '2019_02_11_212233_create_purchase_order_details_table', 1),
(17, '2019_02_26_090309_create_task_table', 1),
(18, '2019_02_26_090511_create_order_management_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificationdays`
--

CREATE TABLE `notificationdays` (
  `id` int(10) UNSIGNED NOT NULL,
  `day` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `until_this_time` smallint(6) NOT NULL,
  `send_notification` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `customer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `notificationdays`
--

INSERT INTO `notificationdays` (`id`, `day`, `until_this_time`, `send_notification`, `active`, `customer_id`, `created_at`, `updated_at`) VALUES
(1, 'Martes', 14, 1, 1, 2, '2019-02-26 01:46:44', '2019-02-26 01:46:44');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `order_management`
--

CREATE TABLE `order_management` (
  `id` int(10) UNSIGNED NOT NULL,
  `task_id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `from` date NOT NULL,
  `name_of_day` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `hour_of_day` time NOT NULL,
  `notify` tinyint(1) NOT NULL DEFAULT '0',
  `initial_day_notify` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `notify_from` time NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `order_management`
--

INSERT INTO `order_management` (`id`, `task_id`, `customer_id`, `from`, `name_of_day`, `hour_of_day`, `notify`, `initial_day_notify`, `notify_from`, `active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2019-02-27', 'Martes', '15:00:00', 1, 'Viernes', '09:00:00', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

CREATE TABLE `product` (
  `id` int(10) UNSIGNED NOT NULL,
  `cod_fs` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `item` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `pronunciation_in_english` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `packsize` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `unit_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `product`
--

INSERT INTO `product` (`id`, `cod_fs`, `item`, `name`, `pronunciation_in_english`, `description`, `packsize`, `picture_url`, `category_id`, `unit_id`, `active`, `created_at`, `updated_at`) VALUES
(1, '001', '1', 'DESSERT APPLE CROSTATA', 'DESSERT APPLE CROSTATA', 'DESSERT APPLE CROSTATA', '1/24 CT', 'https:', 1, 1, 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(2, '002', '100', 'BASE2', 'BASE DOS', '', '5 LB', 'http://192.168.230.128/foodsolutionslrv/public/images/1551145335.png', 1, 4, 0, '2019-02-26 01:42:15', '2019-02-26 01:42:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Perfil 1', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(2, 'Perfil 2', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer_id` int(10) UNSIGNED NOT NULL,
  `branch_office_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_quantity` double NOT NULL,
  `purchase_order_number` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_order_url` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cut_date` datetime DEFAULT NULL,
  `status_id` int(10) UNSIGNED NOT NULL,
  `users_create_id` int(10) UNSIGNED NOT NULL,
  `users_lm_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `customer_id`, `branch_office_id`, `description`, `total_quantity`, `purchase_order_number`, `purchase_order_url`, `cut_date`, `status_id`, `users_create_id`, `users_lm_id`, `created_at`, `updated_at`) VALUES
(19, 1, 1, '', 0, '', '', '2019-03-05 15:00:00', 2, 1, 1, '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(20, 1, 1, '', 0, '', '', '2019-03-12 15:00:00', 1, 1, 1, '2019-03-07 02:03:39', '2019-03-07 02:03:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchase_order_details`
--

CREATE TABLE `purchase_order_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `purchase_order_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` double DEFAULT NULL,
  `purchase_order_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `purchase_order_details`
--

INSERT INTO `purchase_order_details` (`id`, `purchase_order_id`, `product_id`, `quantity`, `purchase_order_date`, `created_at`, `updated_at`) VALUES
(126, 19, 1, NULL, '2019-03-11', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(127, 19, 2, NULL, '2019-03-11', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(129, 19, 1, NULL, '2019-03-12', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(130, 19, 2, NULL, '2019-03-12', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(132, 19, 1, NULL, '2019-03-13', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(133, 19, 2, NULL, '2019-03-13', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(135, 19, 1, NULL, '2019-03-14', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(136, 19, 2, NULL, '2019-03-14', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(138, 19, 1, NULL, '2019-03-15', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(139, 19, 2, NULL, '2019-03-15', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(141, 19, 1, NULL, '2019-03-16', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(142, 19, 2, NULL, '2019-03-16', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(144, 19, 1, NULL, '2019-03-17', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(145, 19, 2, NULL, '2019-03-17', '2019-02-27 01:38:23', '2019-02-27 01:38:23'),
(147, 20, 1, NULL, '2019-03-18', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(148, 20, 2, NULL, '2019-03-18', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(150, 20, 1, NULL, '2019-03-19', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(151, 20, 2, NULL, '2019-03-19', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(153, 20, 1, NULL, '2019-03-20', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(154, 20, 2, NULL, '2019-03-20', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(156, 20, 1, NULL, '2019-03-21', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(157, 20, 2, NULL, '2019-03-21', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(159, 20, 1, NULL, '2019-03-22', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(160, 20, 2, NULL, '2019-03-22', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(162, 20, 1, NULL, '2019-03-23', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(163, 20, 2, NULL, '2019-03-23', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(165, 20, 1, NULL, '2019-03-24', '2019-03-07 02:03:39', '2019-03-07 02:03:39'),
(166, 20, 2, NULL, '2019-03-24', '2019-03-07 02:03:39', '2019-03-07 02:03:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Administrador', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(2, 'Distribuidor', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(3, 'Suscursal', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section`
--

CREATE TABLE `section` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `section_rol`
--

CREATE TABLE `section_rol` (
  `rol_id` int(10) UNSIGNED NOT NULL,
  `section_id` int(10) UNSIGNED NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

CREATE TABLE `status` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `name`, `description`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Creado', 'Pedido creado.', 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14'),
(2, 'No confirmado', 'Pedido no confirmado por el cliente.', 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14'),
(3, 'Generado', 'Pedido autorizado por el cliente.', 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14'),
(4, 'Alistamiento', 'Pedido en curso esta en alistamiento.', 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14'),
(5, 'Transito', 'Pedido en curso esta en transito.', 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14'),
(6, 'Entregado', 'Pedido en curso esta en entregado.', 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `task`
--

CREATE TABLE `task` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `task`
--

INSERT INTO `task` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Gestionar Pedido', 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unit`
--

CREATE TABLE `unit` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `short_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `unit`
--

INSERT INTO `unit` (`id`, `name`, `short_name`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Cajas', 'Cajas', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(2, 'Unidades', 'Unidades', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(3, 'Kg', 'Kg', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13'),
(4, 'Libras', 'Libras', 1, '2019-02-25 20:43:13', '2019-02-25 20:43:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `branch_office` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `landline` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `latitude_longitude_elevation` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `rol_id` int(10) UNSIGNED DEFAULT NULL,
  `customer_id` int(10) UNSIGNED DEFAULT NULL,
  `branch_office_cf_id` int(10) UNSIGNED DEFAULT NULL,
  `confirmed` tinyint(1) DEFAULT '0',
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `email`, `branch_office`, `mobile_phone`, `landline`, `address`, `latitude_longitude_elevation`, `rol_id`, `customer_id`, `branch_office_cf_id`, `confirmed`, `confirmation_code`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Adminplt', '$2y$10$FNdmf2a72HpenyTfxgPoN.H6VMmdkAE.MvyNL0c2nfxG7GlUXrMhS', 'Administrador Plataforma', 'jfar07@hotmail.com', 'all', 'false', 'false', 'false', 'false', 1, NULL, NULL, 1, NULL, 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14'),
(2, 'fsdis001', '$2y$10$3jfjEM5tOy6MAmcg6lw/zOrA9kwZbqZwhA1X4wVkFETtRNEJOs7c2', 'Distribuidor de la Plataforma', 'no-reply@foodsolutionsmarket.com', 'all', 'false', 'false', 'false', 'false', 2, NULL, NULL, 1, NULL, 1, '2019-02-25 20:43:14', '2019-02-25 20:43:14');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `branch_office`
--
ALTER TABLE `branch_office`
  ADD PRIMARY KEY (`id`),
  ADD KEY `branch_office_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_profile_id_foreign` (`profile_id`);

--
-- Indices de la tabla `list_customer_product`
--
ALTER TABLE `list_customer_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_customer_product_customer_id_foreign` (`customer_id`),
  ADD KEY `list_customer_product_users_lm_id_foreign` (`users_lm_id`);

--
-- Indices de la tabla `list_customer_product_details`
--
ALTER TABLE `list_customer_product_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `list_customer_product_details_list_customer_product_id_foreign` (`list_customer_product_id`),
  ADD KEY `list_customer_product_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificationdays`
--
ALTER TABLE `notificationdays`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notificationdays_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `order_management`
--
ALTER TABLE `order_management`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_management_task_id_foreign` (`task_id`),
  ADD KEY `order_management_customer_id_foreign` (`customer_id`);

--
-- Indices de la tabla `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category_id_foreign` (`category_id`),
  ADD KEY `product_unit_id_foreign` (`unit_id`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_customer_id_foreign` (`customer_id`),
  ADD KEY `purchase_order_branch_office_id_foreign` (`branch_office_id`),
  ADD KEY `purchase_order_status_id_foreign` (`status_id`),
  ADD KEY `purchase_order_users_create_id_foreign` (`users_create_id`),
  ADD KEY `purchase_order_users_lm_id_foreign` (`users_lm_id`);

--
-- Indices de la tabla `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `purchase_order_details_purchase_order_id_foreign` (`purchase_order_id`),
  ADD KEY `purchase_order_details_product_id_foreign` (`product_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `section_rol`
--
ALTER TABLE `section_rol`
  ADD KEY `section_rol_rol_id_foreign` (`rol_id`),
  ADD KEY `section_rol_section_id_foreign` (`section_id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_rol_id_foreign` (`rol_id`),
  ADD KEY `users_customer_id_foreign` (`customer_id`),
  ADD KEY `users_branch_office_cf_id_foreign` (`branch_office_cf_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `branch_office`
--
ALTER TABLE `branch_office`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `list_customer_product`
--
ALTER TABLE `list_customer_product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `list_customer_product_details`
--
ALTER TABLE `list_customer_product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `notificationdays`
--
ALTER TABLE `notificationdays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `order_management`
--
ALTER TABLE `order_management`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `product`
--
ALTER TABLE `product`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `section`
--
ALTER TABLE `section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `task`
--
ALTER TABLE `task`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `branch_office`
--
ALTER TABLE `branch_office`
  ADD CONSTRAINT `branch_office_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_profile_id_foreign` FOREIGN KEY (`profile_id`) REFERENCES `profile` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `list_customer_product`
--
ALTER TABLE `list_customer_product`
  ADD CONSTRAINT `list_customer_product_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_customer_product_users_lm_id_foreign` FOREIGN KEY (`users_lm_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `list_customer_product_details`
--
ALTER TABLE `list_customer_product_details`
  ADD CONSTRAINT `list_customer_product_details_list_customer_product_id_foreign` FOREIGN KEY (`list_customer_product_id`) REFERENCES `list_customer_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `list_customer_product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `notificationdays`
--
ALTER TABLE `notificationdays`
  ADD CONSTRAINT `notificationdays_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `order_management`
--
ALTER TABLE `order_management`
  ADD CONSTRAINT `order_management_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_management_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_unit_id_foreign` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD CONSTRAINT `purchase_order_branch_office_id_foreign` FOREIGN KEY (`branch_office_id`) REFERENCES `branch_office` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_users_create_id_foreign` FOREIGN KEY (`users_create_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_users_lm_id_foreign` FOREIGN KEY (`users_lm_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `purchase_order_details`
--
ALTER TABLE `purchase_order_details`
  ADD CONSTRAINT `purchase_order_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `purchase_order_details_purchase_order_id_foreign` FOREIGN KEY (`purchase_order_id`) REFERENCES `purchase_order` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `section_rol`
--
ALTER TABLE `section_rol`
  ADD CONSTRAINT `section_rol_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_rol_section_id_foreign` FOREIGN KEY (`section_id`) REFERENCES `section` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_branch_office_cf_id_foreign` FOREIGN KEY (`branch_office_cf_id`) REFERENCES `branch_office` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_rol_id_foreign` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
