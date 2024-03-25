-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-03-2024 a las 19:00:48
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reycikla_db`
--
CREATE DATABASE IF NOT EXISTS `reycikla_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `reycikla_db`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_data`
--

CREATE TABLE `audit_data` (
  `id` int(10) NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `entry_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_entry`
--

CREATE TABLE `audit_entry` (
  `id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `duration` float DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `memory_max` int(10) DEFAULT NULL,
  `request_method` varchar(255) NOT NULL,
  `ajax` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_error`
--

CREATE TABLE `audit_error` (
  `id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `message` varchar(1000) NOT NULL,
  `code` int(10) NOT NULL,
  `file` varchar(255) NOT NULL,
  `line` int(10) NOT NULL,
  `trace` varchar(255) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `emailed` int(10) DEFAULT NULL,
  `entry_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_javascript`
--

CREATE TABLE `audit_javascript` (
  `id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `entry_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_mail`
--

CREATE TABLE `audit_mail` (
  `id` int(10) NOT NULL,
  `created` datetime NOT NULL,
  `successful` int(10) NOT NULL,
  `from` varchar(255) NOT NULL,
  `to` varchar(255) NOT NULL,
  `reply` varchar(255) NOT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `bcc` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `html` varchar(255) DEFAULT NULL,
  `data` varchar(255) NOT NULL,
  `entry_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `audit_trail`
--

CREATE TABLE `audit_trail` (
  `id` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `model_id` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `entry_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `id` int(10) NOT NULL,
  `cargo` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id` int(10) NOT NULL,
  `instalacion` varchar(255) NOT NULL,
  `direccion` varchar(1000) NOT NULL,
  `representante` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `cargosid` int(10) NOT NULL,
  `grupo_hoteleroid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_hotelero`
--

CREATE TABLE `grupo_hotelero` (
  `id` int(10) NOT NULL,
  `grupo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `producto` varchar(255) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `um` varchar(25) NOT NULL,
  `precio` decimal(19,3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_solicitud`
--

CREATE TABLE `productos_solicitud` (
  `id` int(10) NOT NULL,
  `productosid` int(10) NOT NULL,
  `solicitudid` int(10) NOT NULL,
  `cant` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `rol` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `rol`) VALUES
(1, 'SiteAdmin'),
(2, 'instalacion'),
(3, 'gestor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `id` int(10) NOT NULL,
  `fecha_rec` date NOT NULL,
  `fecha_aprob` date NOT NULL,
  `fecha_ejec` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `clienteid` int(10) NOT NULL,
  `tipo_estado_solicitudid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_estado_solicitud`
--

CREATE TABLE `tipo_estado_solicitud` (
  `id` int(10) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto`
--

CREATE TABLE `tipo_producto` (
  `id` int(10) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_producto_productos`
--

CREATE TABLE `tipo_producto_productos` (
  `id` int(10) NOT NULL,
  `tipo_productoid` int(10) NOT NULL,
  `productosid` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `rolid` int(11) NOT NULL,
  `empresaid` int(10) DEFAULT NULL,
  `municipio` varchar(500) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `last_login` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `rolid`, `empresaid`, `municipio`, `created_at`, `updated_at`, `last_login`) VALUES
(1, 'sederg', '-9AhOtcj8wjTP_HStMYhMXZ_z6Dal3gf', '$2y$13$U2xTXDsHr3qBgNDurzePnuW3zSq9LJDxDBpHIoRe8q/PCXOpnyv8C', NULL, 'sederg01@gmail.com', 10, 1, NULL, NULL, 1619021305, 1619021305, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `audit_data`
--
ALTER TABLE `audit_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKaudit_data819135` (`entry_id`);

--
-- Indices de la tabla `audit_entry`
--
ALTER TABLE `audit_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKaudit_entr924805` (`user_id`);

--
-- Indices de la tabla `audit_error`
--
ALTER TABLE `audit_error`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKaudit_erro634419` (`entry_id`);

--
-- Indices de la tabla `audit_javascript`
--
ALTER TABLE `audit_javascript`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKaudit_java725050` (`entry_id`);

--
-- Indices de la tabla `audit_mail`
--
ALTER TABLE `audit_mail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKaudit_mail86925` (`entry_id`);

--
-- Indices de la tabla `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKaudit_trai798119` (`entry_id`),
  ADD KEY `FKaudit_trai878247` (`user_id`);

--
-- Indices de la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Indices de la tabla `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Indices de la tabla `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Indices de la tabla `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKcliente33921` (`grupo_hoteleroid`),
  ADD KEY `FKcliente669025` (`cargosid`);

--
-- Indices de la tabla `grupo_hotelero`
--
ALTER TABLE `grupo_hotelero`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos_solicitud`
--
ALTER TABLE `productos_solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKproductos_421589` (`productosid`),
  ADD KEY `FKproductos_630227` (`solicitudid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKsolicitud310717` (`tipo_estado_solicitudid`),
  ADD KEY `FKsolicitud944503` (`clienteid`);

--
-- Indices de la tabla `tipo_estado_solicitud`
--
ALTER TABLE `tipo_estado_solicitud`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_producto_productos`
--
ALTER TABLE `tipo_producto_productos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKtipo_produ682932` (`tipo_productoid`),
  ADD KEY `FKtipo_produ808849` (`productosid`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `passwordResetToken` (`password_reset_token`),
  ADD KEY `fkempresa` (`empresaid`),
  ADD KEY `fkrol` (`rolid`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `audit_data`
--
ALTER TABLE `audit_data`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `audit_entry`
--
ALTER TABLE `audit_entry`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `audit_error`
--
ALTER TABLE `audit_error`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `audit_javascript`
--
ALTER TABLE `audit_javascript`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `audit_mail`
--
ALTER TABLE `audit_mail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `audit_trail`
--
ALTER TABLE `audit_trail`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `grupo_hotelero`
--
ALTER TABLE `grupo_hotelero`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos_solicitud`
--
ALTER TABLE `productos_solicitud`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_estado_solicitud`
--
ALTER TABLE `tipo_estado_solicitud`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_producto`
--
ALTER TABLE `tipo_producto`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_producto_productos`
--
ALTER TABLE `tipo_producto_productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `audit_entry`
--
ALTER TABLE `audit_entry`
  ADD CONSTRAINT `FKaudit_entr924805` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `audit_trail`
--
ALTER TABLE `audit_trail`
  ADD CONSTRAINT `FKaudit_trai878247` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `FKauth_assig411483` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FKcliente33921` FOREIGN KEY (`grupo_hoteleroid`) REFERENCES `grupo_hotelero` (`id`),
  ADD CONSTRAINT `FKcliente669025` FOREIGN KEY (`cargosid`) REFERENCES `cargos` (`id`);

--
-- Filtros para la tabla `productos_solicitud`
--
ALTER TABLE `productos_solicitud`
  ADD CONSTRAINT `FKproductos_421589` FOREIGN KEY (`productosid`) REFERENCES `productos` (`id`),
  ADD CONSTRAINT `FKproductos_630227` FOREIGN KEY (`solicitudid`) REFERENCES `solicitud` (`id`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `FKsolicitud310717` FOREIGN KEY (`tipo_estado_solicitudid`) REFERENCES `tipo_estado_solicitud` (`id`),
  ADD CONSTRAINT `FKsolicitud944503` FOREIGN KEY (`clienteid`) REFERENCES `cliente` (`id`);

--
-- Filtros para la tabla `tipo_producto_productos`
--
ALTER TABLE `tipo_producto_productos`
  ADD CONSTRAINT `FKtipo_produ682932` FOREIGN KEY (`tipo_productoid`) REFERENCES `tipo_producto` (`id`),
  ADD CONSTRAINT `FKtipo_produ808849` FOREIGN KEY (`productosid`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FKuser411215` FOREIGN KEY (`rolid`) REFERENCES `rol` (`id`),
  ADD CONSTRAINT `FKuser600754` FOREIGN KEY (`empresaid`) REFERENCES `cliente` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
