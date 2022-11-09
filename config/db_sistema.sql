-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-11-2022 a las 22:08:26
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_sistema`
--
CREATE DATABASE IF NOT EXISTS `db_sistema` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci;
USE `db_sistema`;

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_persona` (`personaid` BIGINT)   BEGIN
	declare existe_persona int;
	declare id int;
	set existe_persona = (select count(*) from persona where idpersona = personaid);
	if existe_persona > 0 then
		#en caso de borrar el registro se aplica la siguiente sentencia
		#delete from persona where idpersona = personaid;
        
		#en esta bd los registros no se borran, solo se pasan a inactivos
		update persona set status=0 where idpersona = personaid;

		set id = 1;
	else
		set id = 0;
	end if;
	select id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insert_personas` (IN `nom` VARCHAR(100), IN `ape` VARCHAR(100), IN `tel` BIGINT, IN `ema` VARCHAR(100))   BEGIN
	declare existe_persona int;
	declare id int;
	set existe_persona = (select count(*) from persona where email = ema);
	if existe_persona = 0 then
    	INSERT INTO persona (nombre, apellido, telefono, email) VALUES(nom, ape, tel, ema);
	set id = last_insert_id();
	else
		set id = 0;
	end if;
	select id;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `search_persona` (`busqueda` VARCHAR(100))   BEGIN
	select idpersona, nombre, apellido, telefono, email
    from persona 
    where 
    (nombre like concat('%',busqueda,'%') 
    or apellido like concat('%',busqueda,'%') 	
    or telefono like concat('%',busqueda,'%') 
    or email like concat('%',busqueda,'%'))
    and status != 0;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_persona` ()   BEGIN
    	SELECT nombre, apellido, telefono, email
        FROM persona
        WHERE idpersona != 0
        ORDER BY idpersona DESC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `select_personas` (`id` BIGINT)   BEGIN
    	SELECT idpersona,nombre, apellido, telefono, email
        FROM persona
        WHERE idpersona = 1 AND status != 0;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `update_persona` (IN `id` BIGINT, IN `nom` VARCHAR(100), IN `ape` VARCHAR(100), IN `tel` BIGINT, IN `ema` VARCHAR(100))   BEGIN
    #declaración de variables
	declare existe_persona int;
	declare existe_email int;
        declare idp int;
    #estableciendo el resultado de la consulta en la variable
	set existe_persona = (select count(*) from persona where idpersona = id);
    #comprobando el contenido de la variable, si es mayor a 0 es por que en la consuta anterior arrojo datos y se almacenarón en la variable
	if existe_persona > 0 then
		set existe_email = (select count(*) from persona where email = ema and idpersona != id);
		if existe_email = 0 then
			update persona set nombre = nom, apellido=ape, telefono=tel, email=ema where idpersona = id;
			set idp=id;
		else
			set idp=0;
		end if;
	else
		set idp = 0;
	end if;
	select idp;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `nombre`, `apellido`, `telefono`, `email`, `datecreated`, `status`) VALUES
(1, 'Nicolas', 'Carrasco', 999423029, 'ncarrasco@gmail.com', '2022-11-02 14:50:04', 1),
(2, 'Anais', 'Carrasco', 912345678, 'anais@correo.cl', '2022-11-02 15:47:08', 1),
(3, 'Maria', 'Hormazabal', 998745612, 'maria@correo.cl', '2022-11-02 15:47:08', 1),
(4, 'Alonso', 'Carrasco', 914253647, 'alonso@correo.cl', '2022-11-02 15:47:08', 0),
(5, 'Sergio', 'Cares', 996857485, 'sergio@correo.cl', '2022-11-02 15:47:08', 1),
(6, 'Carlos', 'Cuadrado', 12312312, 'ccuadrado@correo.cl', '2022-11-02 15:47:08', 0),
(7, 'Ivan', 'Ramirez', 12312312, 'iramirez@gmail.com', '2022-11-07 11:22:42', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarea`
--

CREATE TABLE `tarea` (
  `idtarea` bigint(20) NOT NULL,
  `nombreTarea` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_fin` datetime DEFAULT NULL,
  `idpersona` bigint(20) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tarea`
--

INSERT INTO `tarea` (`idtarea`, `nombreTarea`, `descripcion`, `fecha_inicio`, `fecha_fin`, `idpersona`, `status`) VALUES
(1, 'Maquetear Web', 'Maquetear con HTML y CSS', '2022-11-02 00:00:00', NULL, 1, 'Activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`);

--
-- Indices de la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD PRIMARY KEY (`idtarea`),
  ADD KEY `tarea_persona_fk` (`idpersona`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tarea`
--
ALTER TABLE `tarea`
  MODIFY `idtarea` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tarea`
--
ALTER TABLE `tarea`
  ADD CONSTRAINT `tarea_ibfk_1` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`),
  ADD CONSTRAINT `tarea_persona_fk` FOREIGN KEY (`idpersona`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
