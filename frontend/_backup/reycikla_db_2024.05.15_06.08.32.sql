-- -------------------------------------------
SET AUTOCOMMIT=0;
START TRANSACTION;
SET SQL_QUOTE_SHOW_CREATE = 1;
SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
-- -------------------------------------------
-- -------------------------------------------
-- START BACKUP
-- -------------------------------------------
-- -------------------------------------------
-- TABLE `audit_data`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_data`;
CREATE TABLE IF NOT EXISTS `audit_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `entry_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKaudit_data819135` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `audit_entry`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_entry`;
CREATE TABLE IF NOT EXISTS `audit_entry` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `duration` float DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `memory_max` int(10) DEFAULT NULL,
  `request_method` varchar(255) NOT NULL,
  `ajax` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKaudit_entr924805` (`user_id`),
  CONSTRAINT `FKaudit_entr924805` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `audit_error`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_error`;
CREATE TABLE IF NOT EXISTS `audit_error` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `message` varchar(1000) NOT NULL,
  `code` int(10) NOT NULL,
  `file` varchar(255) NOT NULL,
  `line` int(10) NOT NULL,
  `trace` varchar(255) DEFAULT NULL,
  `hash` varchar(255) NOT NULL,
  `emailed` int(10) DEFAULT NULL,
  `entry_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKaudit_erro634419` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `audit_javascript`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_javascript`;
CREATE TABLE IF NOT EXISTS `audit_javascript` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created` datetime NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `origin` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `entry_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKaudit_java725050` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `audit_mail`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_mail`;
CREATE TABLE IF NOT EXISTS `audit_mail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
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
  `entry_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKaudit_mail86925` (`entry_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `audit_trail`
-- -------------------------------------------
DROP TABLE IF EXISTS `audit_trail`;
CREATE TABLE IF NOT EXISTS `audit_trail` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `action` varchar(255) NOT NULL,
  `model` varchar(255) DEFAULT NULL,
  `model_id` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `entry_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKaudit_trai798119` (`entry_id`),
  KEY `FKaudit_trai878247` (`user_id`),
  CONSTRAINT `FKaudit_trai878247` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `auth_assignment`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `FKauth_assig411483` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `auth_item`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text DEFAULT NULL,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `auth_item_child`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `auth_rule`
-- -------------------------------------------
DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `cargos`
-- -------------------------------------------
DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `cliente`
-- -------------------------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE IF NOT EXISTS `cliente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `instalacion` varchar(255) NOT NULL,
  `direccion` varchar(1000) NOT NULL,
  `representante` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telefono` varchar(25) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `cargosid` int(10) NOT NULL,
  `grupo_hoteleroid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKcliente33921` (`grupo_hoteleroid`),
  KEY `FKcliente669025` (`cargosid`),
  CONSTRAINT `FKcliente33921` FOREIGN KEY (`grupo_hoteleroid`) REFERENCES `grupo_hotelero` (`id`),
  CONSTRAINT `FKcliente669025` FOREIGN KEY (`cargosid`) REFERENCES `cargos` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `grupo_hotelero`
-- -------------------------------------------
DROP TABLE IF EXISTS `grupo_hotelero`;
CREATE TABLE IF NOT EXISTS `grupo_hotelero` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `grupo` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `migration`
-- -------------------------------------------
DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `productos`
-- -------------------------------------------
DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `producto` varchar(255) NOT NULL,
  `descripcion` varchar(1000) DEFAULT NULL,
  `um` varchar(25) NOT NULL,
  `precio` decimal(19,3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `productos_solicitud`
-- -------------------------------------------
DROP TABLE IF EXISTS `productos_solicitud`;
CREATE TABLE IF NOT EXISTS `productos_solicitud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `productosid` int(10) NOT NULL,
  `solicitudid` int(10) NOT NULL,
  `cant` int(10) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FKproductos_421589` (`productosid`),
  KEY `FKproductos_630227` (`solicitudid`),
  CONSTRAINT `FKproductos_421589` FOREIGN KEY (`productosid`) REFERENCES `productos` (`id`),
  CONSTRAINT `FKproductos_630227` FOREIGN KEY (`solicitudid`) REFERENCES `solicitud` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `recogida`
-- -------------------------------------------
DROP TABLE IF EXISTS `recogida`;
CREATE TABLE IF NOT EXISTS `recogida` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transportistaid` int(11) NOT NULL,
  `solicitudid` int(11) NOT NULL,
  `fecha_recogida` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `transportistaid` (`transportistaid`,`solicitudid`),
  KEY `fk_solicitud` (`solicitudid`),
  CONSTRAINT `fk_solicitud` FOREIGN KEY (`solicitudid`) REFERENCES `solicitud` (`id`),
  CONSTRAINT `fk_transportista` FOREIGN KEY (`transportistaid`) REFERENCES `transportista` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `rol`
-- -------------------------------------------
DROP TABLE IF EXISTS `rol`;
CREATE TABLE IF NOT EXISTS `rol` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `solicitud`
-- -------------------------------------------
DROP TABLE IF EXISTS `solicitud`;
CREATE TABLE IF NOT EXISTS `solicitud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `fecha_solic` date DEFAULT NULL,
  `fecha_rec` date DEFAULT NULL,
  `fecha_aprob` date DEFAULT NULL,
  `fecha_ejec` date DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1',
  `clienteid` int(10) NOT NULL,
  `tipo_estado_solicitudid` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FKsolicitud310717` (`tipo_estado_solicitudid`),
  KEY `FKsolicitud944503` (`clienteid`),
  CONSTRAINT `FKsolicitud310717` FOREIGN KEY (`tipo_estado_solicitudid`) REFERENCES `tipo_estado_solicitud` (`id`),
  CONSTRAINT `FKsolicitud944503` FOREIGN KEY (`clienteid`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `tipo_estado_solicitud`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_estado_solicitud`;
CREATE TABLE IF NOT EXISTS `tipo_estado_solicitud` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `estado` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `tipo_producto`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_producto`;
CREATE TABLE IF NOT EXISTS `tipo_producto` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `status` tinyint(1) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `tipo_producto_productos`
-- -------------------------------------------
DROP TABLE IF EXISTS `tipo_producto_productos`;
CREATE TABLE IF NOT EXISTS `tipo_producto_productos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipo_productoid` int(10) NOT NULL,
  `productosid` int(10) NOT NULL,
  `cant` decimal(16,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `FKtipo_produ682932` (`tipo_productoid`),
  KEY `FKtipo_produ808849` (`productosid`),
  CONSTRAINT `FKtipo_produ682932` FOREIGN KEY (`tipo_productoid`) REFERENCES `tipo_producto` (`id`),
  CONSTRAINT `FKtipo_produ808849` FOREIGN KEY (`productosid`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `transportista`
-- -------------------------------------------
DROP TABLE IF EXISTS `transportista`;
CREATE TABLE IF NOT EXISTS `transportista` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vehiculo` varchar(255) NOT NULL,
  `chofer` varchar(1000) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE `user`
-- -------------------------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `last_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `passwordResetToken` (`password_reset_token`),
  KEY `fkempresa` (`empresaid`),
  KEY `fkrol` (`rolid`),
  CONSTRAINT `FKuser411215` FOREIGN KEY (`rolid`) REFERENCES `rol` (`id`),
  CONSTRAINT `FKuser600754` FOREIGN KEY (`empresaid`) REFERENCES `cliente` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- -------------------------------------------
-- TABLE DATA auth_assignment
-- -------------------------------------------
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('instalacion','5','1714261603');
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('Instalacion','8','1715713832');
INSERT INTO `auth_assignment` (`item_name`,`user_id`,`created_at`) VALUES
('SiteAdmin','1','1715714770');



-- -------------------------------------------
-- TABLE DATA auth_item
-- -------------------------------------------
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('crear_salva_bd','2','Permite al usuario crear salvas de la Base de datos del sistema','','','1715716365','1715716365');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('eliminar_salva_bd','2','Permite al usuario eliminar una salva de la base de datos','','','1715745876','1715745876');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('gestionar_bd','2','Permite al usuario realizar todas las operaciones sobre la base de datos','','','1715714701','1715714701');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('Gestor','1','','','','1715713193','1715713193');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('Instalacion','1','Usuario para las Instalaciones  hoteleras y extrahoteleras','','','1715713125','1715713125');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('SiteAdmin','1','Usuario Administrador del Sitio','','','1715712994','1715712994');
INSERT INTO `auth_item` (`name`,`type`,`description`,`rule_name`,`data`,`created_at`,`updated_at`) VALUES
('ver_bd','2','Permite al usuario ver las salvas de existentes de la base de datos','','','1715714641','1715714641');



-- -------------------------------------------
-- TABLE DATA auth_item_child
-- -------------------------------------------
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('gestionar_bd','crear_salva_bd');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('gestionar_bd','eliminar_salva_bd');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('gestionar_bd','ver_bd');
INSERT INTO `auth_item_child` (`parent`,`child`) VALUES
('SiteAdmin','gestionar_bd');



-- -------------------------------------------
-- TABLE DATA cargos
-- -------------------------------------------
INSERT INTO `cargos` (`id`,`cargo`,`status`) VALUES
('1','Director General','1');
INSERT INTO `cargos` (`id`,`cargo`,`status`) VALUES
('2','Recepcionista','1');



-- -------------------------------------------
-- TABLE DATA cliente
-- -------------------------------------------
INSERT INTO `cliente` (`id`,`instalacion`,`direccion`,`representante`,`email`,`telefono`,`status`,`cargosid`,`grupo_hoteleroid`) VALUES
('1','Hotel Cayo Guiyermo','Calle 4ta No.28 e/ ciruela y modelo','Carlor Luis Suarez','carlos@cguillermo.cu','+537-550-0166','1','1','2');
INSERT INTO `cliente` (`id`,`instalacion`,`direccion`,`representante`,`email`,`telefono`,`status`,`cargosid`,`grupo_hoteleroid`) VALUES
('2','Casa Juana','Circunvalación Norte Km 13','Juana Inez Castañeda','sederg01@gmail.com','+535-542-9875','1','1','1');
INSERT INTO `cliente` (`id`,`instalacion`,`direccion`,`representante`,`email`,`telefono`,`status`,`cargosid`,`grupo_hoteleroid`) VALUES
('3','Hostal Las Delicias','Circunvalación Sur Km 1','Raciel  Delgado','lasdeicias@gmail.com','','1','1','2');



-- -------------------------------------------
-- TABLE DATA grupo_hotelero
-- -------------------------------------------
INSERT INTO `grupo_hotelero` (`id`,`grupo`,`status`) VALUES
('1','Cubanacan','1');
INSERT INTO `grupo_hotelero` (`id`,`grupo`,`status`) VALUES
('2','Gaviota','1');



-- -------------------------------------------
-- TABLE DATA productos
-- -------------------------------------------
INSERT INTO `productos` (`id`,`producto`,`descripcion`,`um`,`precio`,`status`) VALUES
('1','Tumbona de Playa','Cama de playa para exteriores','1','234.230','1');
INSERT INTO `productos` (`id`,`producto`,`descripcion`,`um`,`precio`,`status`) VALUES
('2','Mesas comedor','Mesa de comedor de 4 plazas','1','100.000','1');
INSERT INTO `productos` (`id`,`producto`,`descripcion`,`um`,`precio`,`status`) VALUES
('3','Repiza plastica','Repiza decorativa interior','1','56.000','1');



-- -------------------------------------------
-- TABLE DATA productos_solicitud
-- -------------------------------------------
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('1','1','1','1231','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('2','2','2','15','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('3','3','2','4','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('4','1','2','30','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('5','1','3','4','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('6','2','4','8','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('7','2','5','8','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('8','2','6','1231','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('9','3','6','23','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('10','1','6','30','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('11','2','7','34','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('12','3','7','545','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('13','2','8','56','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('14','1','8','4','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('15','2','9','6','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('16','3','9','2','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('17','3','10','4','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('18','1','11','434','1');
INSERT INTO `productos_solicitud` (`id`,`productosid`,`solicitudid`,`cant`,`status`) VALUES
('19','2','12','15','1');



-- -------------------------------------------
-- TABLE DATA recogida
-- -------------------------------------------
INSERT INTO `recogida` (`id`,`transportistaid`,`solicitudid`,`fecha_recogida`,`status`) VALUES
('1','1','1','2024-04-02','1');
INSERT INTO `recogida` (`id`,`transportistaid`,`solicitudid`,`fecha_recogida`,`status`) VALUES
('2','1','4','2024-04-18','1');
INSERT INTO `recogida` (`id`,`transportistaid`,`solicitudid`,`fecha_recogida`,`status`) VALUES
('3','1','5','2024-05-16','1');
INSERT INTO `recogida` (`id`,`transportistaid`,`solicitudid`,`fecha_recogida`,`status`) VALUES
('4','1','6','2024-04-11','1');
INSERT INTO `recogida` (`id`,`transportistaid`,`solicitudid`,`fecha_recogida`,`status`) VALUES
('5','1','8','2024-05-03','1');



-- -------------------------------------------
-- TABLE DATA rol
-- -------------------------------------------
INSERT INTO `rol` (`id`,`rol`,`status`) VALUES
('1','SiteAdmin','1');
INSERT INTO `rol` (`id`,`rol`,`status`) VALUES
('2','Instalacion','1');
INSERT INTO `rol` (`id`,`rol`,`status`) VALUES
('3','Gestor','1');



-- -------------------------------------------
-- TABLE DATA solicitud
-- -------------------------------------------
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('1','2024-03-26','2024-04-02','2024-04-01','','1','1','3');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('2','2024-03-29','2024-04-01','2024-04-01','','1','2','5');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('3','2024-03-30','2024-04-01','2024-04-01','','0','3','3');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('4','2024-03-30','2024-04-02','2024-04-01','2024-04-02','1','3','4');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('5','2024-03-30','2024-04-02','2024-04-02','2024-04-02','1','3','4');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('6','2024-04-02','2024-04-02','2024-04-02','','1','1','3');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('7','2024-04-08','','','','1','2','1');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('8','2024-04-24','2024-04-28','2024-04-27','','1','2','3');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('9','2024-04-27','','','','1','2','1');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('10','2024-04-27','','','','1','2','1');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('11','2024-04-27','','','','1','2','1');
INSERT INTO `solicitud` (`id`,`fecha_solic`,`fecha_rec`,`fecha_aprob`,`fecha_ejec`,`status`,`clienteid`,`tipo_estado_solicitudid`) VALUES
('12','2024-04-27','','','','1','2','1');



-- -------------------------------------------
-- TABLE DATA tipo_estado_solicitud
-- -------------------------------------------
INSERT INTO `tipo_estado_solicitud` (`id`,`estado`,`status`) VALUES
('1','Solicitado','1');
INSERT INTO `tipo_estado_solicitud` (`id`,`estado`,`status`) VALUES
('2','Aprobado','1');
INSERT INTO `tipo_estado_solicitud` (`id`,`estado`,`status`) VALUES
('3','Pendiente a recogida','1');
INSERT INTO `tipo_estado_solicitud` (`id`,`estado`,`status`) VALUES
('4','Atendida','1');
INSERT INTO `tipo_estado_solicitud` (`id`,`estado`,`status`) VALUES
('5','Rechazada','1');



-- -------------------------------------------
-- TABLE DATA tipo_producto
-- -------------------------------------------
INSERT INTO `tipo_producto` (`id`,`tipo`,`status`) VALUES
('1','Plástico','1');
INSERT INTO `tipo_producto` (`id`,`tipo`,`status`) VALUES
('2','Vidrio','1');
INSERT INTO `tipo_producto` (`id`,`tipo`,`status`) VALUES
('3','Madera','1');



-- -------------------------------------------
-- TABLE DATA tipo_producto_productos
-- -------------------------------------------
INSERT INTO `tipo_producto_productos` (`id`,`tipo_productoid`,`productosid`,`cant`,`status`) VALUES
('1','1','1','0.53','1');
INSERT INTO `tipo_producto_productos` (`id`,`tipo_productoid`,`productosid`,`cant`,`status`) VALUES
('2','3','2','12.56','1');
INSERT INTO `tipo_producto_productos` (`id`,`tipo_productoid`,`productosid`,`cant`,`status`) VALUES
('3','2','2','2.35','1');
INSERT INTO `tipo_producto_productos` (`id`,`tipo_productoid`,`productosid`,`cant`,`status`) VALUES
('4','1','3','0.23','1');
INSERT INTO `tipo_producto_productos` (`id`,`tipo_productoid`,`productosid`,`cant`,`status`) VALUES
('5','2','3','1.23','1');



-- -------------------------------------------
-- TABLE DATA transportista
-- -------------------------------------------
INSERT INTO `transportista` (`id`,`vehiculo`,`chofer`,`status`) VALUES
('1','H4539664','Jose Garcia Ruis','1');



-- -------------------------------------------
-- TABLE DATA user
-- -------------------------------------------
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`rolid`,`empresaid`,`municipio`,`created_at`,`updated_at`,`last_login`) VALUES
('1','sederg','-9AhOtcj8wjTP_HStMYhMXZ_z6Dal3gf','$2y$13$U2xTXDsHr3qBgNDurzePnuW3zSq9LJDxDBpHIoRe8q/PCXOpnyv8C','','sederg01@gmail.com','10','1','','','1619021305','1619021305','1714871656');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`rolid`,`empresaid`,`municipio`,`created_at`,`updated_at`,`last_login`) VALUES
('5','juana','4DyidG7XxKfQmDvNZ9mPSyCDvj8Aa0n0','$2y$13$1k530nnYZwJZS4dsCSeBeudbyaJOikMp3i8FfWYb5ASh4v009SXXm','','juana@gmail.com','10','2','2','','1712519269','1714786523','1714965290');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`rolid`,`empresaid`,`municipio`,`created_at`,`updated_at`,`last_login`) VALUES
('6','admin','XX1Upt2O-mtwxP1Ik-pS5km52WSX3Q3Q','$2y$13$WCvkvs8o7Ew7Z.IQ1NpR7.xPMbCa55JVhYC0nfDNqXKhLsqCkcz56','','admin@jrrecicla.com','10','3','','','1712520510','1712520510','1712520510');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`rolid`,`empresaid`,`municipio`,`created_at`,`updated_at`,`last_login`) VALUES
('7','cguillermo','bJj1FjPCZMw4CR3qn9POmF5IeC7rUP3T','$2y$13$LLcFWxGTMgAsd30kUzLC4OSFlBkML2Hp991JfvsA9RL7kXVzGgjJi','','cguillermo@gmail.com','10','2','3','','1715713371','1715713371','1715713371');
INSERT INTO `user` (`id`,`username`,`auth_key`,`password_hash`,`password_reset_token`,`email`,`status`,`rolid`,`empresaid`,`municipio`,`created_at`,`updated_at`,`last_login`) VALUES
('8','continental','9Mk_LMF8p4SfjrSb2mRFtwAXV6r1RUmt','$2y$13$B/NND66z9YEaICLcIKXxXuphGXrJPsq3Kgff.XVG5J5xPajNk6zqW','','continental@gmail.com','10','2','2','','1715713831','1715713831','1715713831');



-- -------------------------------------------
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
COMMIT;
-- -------------------------------------------
-- -------------------------------------------
-- END BACKUP
-- -------------------------------------------
