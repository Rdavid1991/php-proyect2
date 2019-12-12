-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for proyecto_2_php
DROP DATABASE IF EXISTS `proyecto_2_php`;
CREATE DATABASE IF NOT EXISTS `proyecto_2_php` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;
USE `proyecto_2_php`;

-- Dumping structure for procedure proyecto_2_php.active_product
DROP PROCEDURE IF EXISTS `active_product`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `active_product`(
	IN `param_id` INT
)
BEGIN
UPDATE producto
	SET state = "0" 
	WHERE id = param_id;
END//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.archive_product
DROP PROCEDURE IF EXISTS `archive_product`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `archive_product`(
	IN `param_id` INT



)
BEGIN
UPDATE producto
	SET state = "1" 
	WHERE id = param_id;
END//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.consultar_nombre
DROP PROCEDURE IF EXISTS `consultar_nombre`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_nombre`(
	IN `inicio_param` DATE,
	IN `fin_param` DATE



)
BEGIN
	SELECT 
		count(ve.id_producto) cantidad,
		SUM(ve.precio) suma,
		ve.precio p_venta,
		pd.nombre_prod prod,
		ve.fecha fecha
	FROM producto pd
	INNER JOIN ventas_empleado ve
		ON ve.id_producto = pd.id
	WHERE ve.fecha between inicio_param AND fin_param
	GROUP BY pd.nombre_prod, ve.precio;
END//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.consultar_productos
DROP PROCEDURE IF EXISTS `consultar_productos`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_productos`()
    NO SQL
select * from producto where state = 0//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.consultar_productos_archivados
DROP PROCEDURE IF EXISTS `consultar_productos_archivados`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_productos_archivados`()
    NO SQL
select * from producto where state = 1//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.consultar_tipo
DROP PROCEDURE IF EXISTS `consultar_tipo`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_tipo`(
	IN `inicio_param` DATE,
	IN `fin_param` DATE



)
BEGIN
	SELECT 
	count(ve.id_producto) cantidad,
SUM(ve.precio) suma,
ve.precio p_venta,
pd.tipo_prod prod,
ve.fecha fecha
FROM producto pd
INNER JOIN ventas_empleado ve
ON ve.id_producto = pd.id
WHERE ve.fecha between inicio_param AND fin_param
GROUP BY pd.tipo_prod,ve.precio;

END//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.consult_image_name
DROP PROCEDURE IF EXISTS `consult_image_name`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consult_image_name`(
	IN `id_param` INT
)
    NO SQL
select imagen_prod from producto where id = id_param//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.delete_producto
DROP PROCEDURE IF EXISTS `delete_producto`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_producto`(
	IN `param_id` INT



)
BEGIN
	DELETE FROM producto where id = param_id ;
	DELETE FROM ventas_empleado where id_producto = param_id;
END//
DELIMITER ;

-- Dumping structure for table proyecto_2_php.empeado
DROP TABLE IF EXISTS `empeado`;
CREATE TABLE IF NOT EXISTS `empeado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `password_empleado` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `role` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Data exporting was unselected.

-- Dumping structure for procedure proyecto_2_php.insertar_producto
DROP PROCEDURE IF EXISTS `insertar_producto`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto`(
	IN `nombre` VARCHAR(10),
	IN `imagen` VARCHAR(15),
	IN `descripcion` VARCHAR(150),
	IN `tipo` VARCHAR(10),
	IN `precio` VARCHAR(10)

)
    NO SQL
INSERT INTO 
producto (nombre_prod ,imagen_prod, descripcion_prod , tipo_prod , precio_prod)
VALUES (nombre ,imagen, descripcion , tipo , precio)//
DELIMITER ;

-- Dumping structure for table proyecto_2_php.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen_prod` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion_prod` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '' COMMENT 'Combo, Individual',
  `precio_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Contiene los datos de los productos a vender';

-- Data exporting was unselected.

-- Dumping structure for procedure proyecto_2_php.reporte
DROP PROCEDURE IF EXISTS `reporte`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `reporte`()
BEGIN


END//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.save_ventas
DROP PROCEDURE IF EXISTS `save_ventas`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `save_ventas`(
	IN `id_param` INT,
	IN `precio_param` DOUBLE
)
BEGIN
	insert into ventas_empleado (id_producto, precio, fecha) value (id_param, precio_param, (SELECT NOW()));
END//
DELIMITER ;

-- Dumping structure for procedure proyecto_2_php.update_producto
DROP PROCEDURE IF EXISTS `update_producto`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_producto`(
	IN `param_id` INT,
	IN `nombre` VARCHAR(10),
	IN `imagen` VARCHAR(15),
	IN `descripcion` VARCHAR(150),
	IN `tipo` VARCHAR(10),
	IN `precio` VARCHAR(10)



)
    NO SQL
BEGIN
	UPDATE producto
	SET nombre_prod = nombre, imagen_prod = imagen, descripcion_prod = descripcion, tipo_prod = tipo, precio_prod = precio 
	WHERE id = param_id;
END//
DELIMITER ;

-- Dumping structure for table proyecto_2_php.ventas_empleado
DROP TABLE IF EXISTS `ventas_empleado`;
CREATE TABLE IF NOT EXISTS `ventas_empleado` (
  `id_producto` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `precio` double NOT NULL DEFAULT 0,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- Data exporting was unselected.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
