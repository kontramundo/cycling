# ************************************************************
# Sequel Pro SQL dump
# Versión 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: 127.0.0.1 (MySQL 5.6.15)
# Base de datos: cycling
# Tiempo de Generación: 2014-02-28 22:30:32 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Volcado de tabla usuarios
# ------------------------------------------------------------

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(45) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(250) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `pais` int(11) NOT NULL,
  `fecha_registro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `borrado` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `email`, `nombre`, `apellidos`, `fecha_nacimiento`, `pais`, `fecha_registro`, `borrado`)
VALUES
	(3,'kontramundo','3608a6d1a05aba23ea390e5f3b48203dbb7241f7','heisenb3rg@gmail.com','SALVADOR','SANCHEZ','1988-09-02',1,'2014-02-28 21:44:11',0);

/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;



--
-- Dumping routines (PROCEDURE) for database 'cycling'
--
DELIMITER ;;

# Dump of PROCEDURE registrar_usuario
# ------------------------------------------------------------

/*!50003 DROP PROCEDURE IF EXISTS `registrar_usuario` */;;
/*!50003 SET SESSION SQL_MODE="NO_AUTO_VALUE_ON_ZERO"*/;;
/*!50003 CREATE*/ /*!50020 DEFINER=`root`@`localhost`*/ /*!50003 PROCEDURE `registrar_usuario`(
IN nombre varchar(50),
IN apellido varchar(120),
IN mail varchar(120),
IN user varchar(120),
IN pass varchar(120),
IN nacimiento date,
IN pais int,
OUT mensaje varchar(10)
)
BEGIN
	DECLARE v_user varchar(120);
	SET v_user=(SELECT id_usuario FROM usuarios WHERE usuario=user);
	IF (v_user>0) THEN
		SET mensaje="no";
	ELSE
		START TRANSACTION;
		INSERT INTO usuarios (usuario,password,nombre,apellidos,fecha_nacimiento,pais,email)
		VALUES (user,sha1(pass),UPPER(nombre),UPPER(apellido),nacimiento,pais,mail);
		IF LAST_INSERT_ID()>0 THEN
			SET mensaje="ok";
			COMMIT;
		ELSE
			SET mensaje="Error";
			ROLLBACK;
		END IF;
	END IF;
	
	SELECT mensaje;
END */;;

/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;;
DELIMITER ;

/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
