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
DROP DATABASE IF EXISTS `proyecto_2_php`;
CREATE DATABASE IF NOT EXISTS `proyecto_2_php` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci */;
USE `proyecto_2_php`;

-- Volcando estructura para procedimiento proyecto_2_php.active_product
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

-- Volcando estructura para procedimiento proyecto_2_php.archive_product
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

-- Volcando estructura para procedimiento proyecto_2_php.consultar_nombre
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

-- Volcando estructura para procedimiento proyecto_2_php.consultar_productos
DROP PROCEDURE IF EXISTS `consultar_productos`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_productos`()
    NO SQL
select * from producto where state = 0 order by tipo_prod//
DELIMITER ;

-- Volcando estructura para procedimiento proyecto_2_php.consultar_productos_archivados
DROP PROCEDURE IF EXISTS `consultar_productos_archivados`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consultar_productos_archivados`()
    NO SQL
select * from producto where state = 1//
DELIMITER ;

-- Volcando estructura para procedimiento proyecto_2_php.consultar_tipo
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

-- Volcando estructura para procedimiento proyecto_2_php.consult_image_name
DROP PROCEDURE IF EXISTS `consult_image_name`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `consult_image_name`(
	IN `id_param` INT
)
    NO SQL
select imagen_prod from producto where id = id_param//
DELIMITER ;

-- Volcando estructura para procedimiento proyecto_2_php.delete_producto
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

-- Volcando estructura para tabla proyecto_2_php.empleado
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE IF NOT EXISTS `empleado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_empleado` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `password_empleado` varchar(250) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  `role` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento proyecto_2_php.insertar_producto
DROP PROCEDURE IF EXISTS `insertar_producto`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_producto`(
	IN `nombre` VARCHAR(100),
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

-- Volcando estructura para procedimiento proyecto_2_php.insertar_usuario
DROP PROCEDURE IF EXISTS `insertar_usuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuario`(
	IN `user_param` VARCHAR(50),
	IN `pass_param` VARCHAR(50)
,
	IN `role_param` VARCHAR(50)
)
BEGIN
	insert into empleado (nombre_empleado,password_empleado,role) values(user_param, pass_param,role_param);
END//
DELIMITER ;

-- Volcando estructura para tabla proyecto_2_php.producto
DROP TABLE IF EXISTS `producto`;
CREATE TABLE IF NOT EXISTS `producto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_prod` varchar(100) COLLATE utf8mb4_spanish_ci NOT NULL,
  `imagen_prod` varchar(15) COLLATE utf8mb4_spanish_ci NOT NULL,
  `descripcion_prod` varchar(150) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `tipo_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL DEFAULT '' COMMENT 'Combo, Individual',
  `precio_prod` varchar(10) COLLATE utf8mb4_spanish_ci NOT NULL,
  `state` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci COMMENT='Contiene los datos de los productos a vender';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento proyecto_2_php.save_sales
DROP PROCEDURE IF EXISTS `save_sales`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `save_sales`(
	IN `id_param` INT,
	IN `precio_param` DOUBLE


,
	IN `id_user_param` INT

)
BEGIN
	insert into ventas_empleado (id_producto,id_empleado, precio, fecha) value (id_param,id_user_param, precio_param, (SELECT NOW()));
END//
DELIMITER ;

-- Volcando estructura para procedimiento proyecto_2_php.update_producto
DROP PROCEDURE IF EXISTS `update_producto`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_producto`(
	IN `param_id` INT,
	IN `nombre` VARCHAR(100),
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

-- Volcando estructura para procedimiento proyecto_2_php.validar_usuario
DROP PROCEDURE IF EXISTS `validar_usuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `validar_usuario`(
	IN `param_user` VARCHAR(50),
	IN `param_pass` VARCHAR(50)








)
BEGIN
	SET @s = CONCAT("SELECT count(*) FROM empleado 
                WHERE nombre_empleado = '", param_user ,"' AND password_empleado = '" , param_pass,"'"); 
         PREPARE stmt FROM @s;
         EXECUTE stmt;
         DEALLOCATE PREPARE stmt; 
END//
DELIMITER ;

-- Volcando estructura para tabla proyecto_2_php.ventas_empleado
DROP TABLE IF EXISTS `ventas_empleado`;
CREATE TABLE IF NOT EXISTS `ventas_empleado` (
  `id_producto` int(11) NOT NULL,
  `id_empleado` int(11) DEFAULT NULL,
  `precio` double NOT NULL DEFAULT 0,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento proyecto_2_php.verificar_usuario
DROP PROCEDURE IF EXISTS `verificar_usuario`;
DELIMITER //
CREATE DEFINER=`root`@`localhost` PROCEDURE `verificar_usuario`(
	IN `user_param` VARCHAR(50)


)
BEGIN
	select id, role from empleado where nombre_empleado = user_param;
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
