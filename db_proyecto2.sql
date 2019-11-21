-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para proyecto_2_php
CREATE DATABASE IF NOT EXISTS `proyecto_2_php` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;
USE `proyecto_2_php`;

-- Volcando estructura para procedimiento proyecto_2_php.consultar_id
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_id`(
	IN `nombre` VARCHAR(10)

)
    NO SQL
select id from producto where nombre = nombre//
DELIMITER ;

-- Volcando estructura para procedimiento proyecto_2_php.consultar_productos
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_productos`()
    NO SQL
select * from producto as pd
inner join imagen_producto as ip
	on ip.id_producto = pd.id//
DELIMITER ;

-- Volcando estructura para tabla proyecto_2_php.empeado
CREATE TABLE IF NOT EXISTS `empeado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `password_empleado` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `role` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento proyecto_2_php.guardar_imagen
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `guardar_imagen`(
	IN `nombre` VARCHAR(50),
	IN `id` VARCHAR(10)



)
    NO SQL
insert INTO 
imagen_producto (nombre_img,id_producto)
VALUES (nombre,id)//
DELIMITER ;

-- Volcando estructura para tabla proyecto_2_php.imagen_producto
CREATE TABLE IF NOT EXISTS `imagen_producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_img` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
  `id_producto` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento proyecto_2_php.insertar_producto
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto`(
	IN `nombre` VARCHAR(10),
	IN `description` VARCHAR(150),
	IN `tipo` VARCHAR(10),
	IN `precio` VARCHAR(10)


)
    NO SQL
INSERT INTO 
producto (nombre_prod , descripcion_prod , tipo_prod , precio_prod)
VALUES (nombre , descripcion , tipo , precio)//
DELIMITER ;

-- Volcando estructura para tabla proyecto_2_php.producto
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion_prod` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '' COMMENT 'Combo, Individual',
  `precio_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Contiene los datos de los productos a vender';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla proyecto_2_php.ventas_empleado
CREATE TABLE IF NOT EXISTS `ventas_empleado` (
  `id_producto` int(11) NOT NULL,
  `id_empleado` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
