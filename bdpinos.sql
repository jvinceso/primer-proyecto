-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-12-2011 a las 11:33:04
-- Versión del servidor: 5.1.58
-- Versión de PHP: 5.3.6-13ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bdpinos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accion`
--

CREATE TABLE IF NOT EXISTS `accion` (
  `cAccIdAccion` char(1) NOT NULL,
  `vAccDescripcion` varchar(300) NOT NULL,
  PRIMARY KEY (`cAccIdAccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `accion`
--

INSERT INTO `accion` (`cAccIdAccion`, `vAccDescripcion`) VALUES
('A', 'Login'),
('B', 'Logout'),
('C', 'Accede a Curso'),
('D', 'Descarga Archivos'),
('E', 'Lee Material'),
('F', 'Descarga Archivos'),
('G', 'Carga Archivos'),
('H', 'Comenta'),
('I', 'Practica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `agenda`
--

CREATE TABLE IF NOT EXISTS `agenda` (
  `iAgeIdAgenda` int(11) NOT NULL AUTO_INCREMENT,
  `tAgeFechaInicio` int(10) NOT NULL,
  `tAgeFechaFin` int(10) NOT NULL,
  `iAgeVisibleDocente` int(11) NOT NULL,
  `iAgeVisibleAlumno` int(11) NOT NULL,
  `iAgeVisibleApoderado` int(11) NOT NULL,
  `tAgeTitulo` text NOT NULL,
  `tAgeContenido` text NOT NULL,
  `tAgeUrlAcceso` int(11) NOT NULL,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  `Cursos_iCursIdCursos` int(11) NOT NULL,
  PRIMARY KEY (`iAgeIdAgenda`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `agenda`
--

INSERT INTO `agenda` (`iAgeIdAgenda`, `tAgeFechaInicio`, `tAgeFechaFin`, `iAgeVisibleDocente`, `iAgeVisibleAlumno`, `iAgeVisibleApoderado`, `tAgeTitulo`, `tAgeContenido`, `tAgeUrlAcceso`, `Usuarios_iUsuIdUsuario`, `Cursos_iCursIdCursos`) VALUES
(1, 1323234000, 1323234000, 0, 0, 0, 'HOAL', 'contenido', 0, 2, 0),
(5, 1323147600, 1323147600, 0, 0, 0, 'HOAL', 'contenido', 0, 2, 2),
(6, 1323925200, 1323925200, 0, 0, 0, 'TELLO GIL', 'contenido', 0, 2, 2),
(7, 1325307600, 1325307600, 0, 0, 0, 'TELLO SONSO', 'contenido', 0, 2, 2),
(8, 1324443600, 1324443600, 0, 0, 0, 'TEMAS', 'contenido', 0, 2, 2),
(9, 1323320400, 1323320400, 0, 0, 0, 'ghgnhj', 'contenido', 0, 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE IF NOT EXISTS `alumnos` (
  `iAlumIdAlumno` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  `Seccion_iSeccIdSeccion` int(11) NOT NULL,
  `Apoderados_iApodIdApoderado` int(11) NOT NULL,
  PRIMARY KEY (`iAlumIdAlumno`),
  KEY `fk_Alumnos_Usuarios1` (`Usuarios_iUsuIdUsuario`),
  KEY `fk_Alumnos_Seccion1` (`Seccion_iSeccIdSeccion`),
  KEY `fk_Alumnos_Apoderados1` (`Apoderados_iApodIdApoderado`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`iAlumIdAlumno`, `Usuarios_iUsuIdUsuario`, `Seccion_iSeccIdSeccion`, `Apoderados_iApodIdApoderado`) VALUES
(1, 18, 3, 1),
(2, 19, 3, 3),
(3, 20, 3, 4),
(4, 21, 3, 5),
(5, 22, 3, 6),
(6, 23, 3, 7),
(7, 24, 3, 8),
(8, 25, 3, 9),
(9, 26, 3, 10),
(10, 27, 3, 11),
(11, 28, 3, 12),
(12, 39, 6, 13),
(13, 40, 6, 14),
(14, 41, 6, 15),
(15, 42, 6, 16),
(16, 43, 6, 17),
(17, 44, 6, 18),
(18, 45, 6, 19),
(19, 46, 6, 20),
(20, 47, 6, 21),
(21, 48, 6, 22),
(22, 61, 8, 25),
(23, 62, 8, 26),
(24, 63, 8, 27),
(25, 64, 8, 28),
(26, 65, 8, 29),
(27, 66, 8, 30),
(28, 67, 8, 31),
(29, 68, 8, 32),
(30, 69, 8, 33),
(31, 70, 8, 34),
(32, 71, 8, 23),
(33, 72, 8, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderados`
--

CREATE TABLE IF NOT EXISTS `apoderados` (
  `iApodIdApoderado` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  PRIMARY KEY (`iApodIdApoderado`),
  KEY `fk_Apoderados_Usuarios1` (`Usuarios_iUsuIdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `apoderados`
--

INSERT INTO `apoderados` (`iApodIdApoderado`, `Usuarios_iUsuIdUsuario`) VALUES
(1, 6),
(2, 7),
(3, 8),
(4, 9),
(5, 10),
(6, 11),
(7, 12),
(8, 13),
(9, 14),
(10, 15),
(11, 16),
(12, 17),
(13, 29),
(14, 30),
(15, 31),
(16, 32),
(17, 33),
(18, 34),
(19, 35),
(20, 36),
(21, 37),
(22, 38),
(23, 49),
(24, 50),
(25, 51),
(26, 52),
(27, 53),
(28, 54),
(29, 55),
(30, 56),
(31, 57),
(32, 58),
(33, 59),
(34, 60);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos`
--

CREATE TABLE IF NOT EXISTS `archivos` (
  `iArchIdArchivo` int(11) NOT NULL,
  `tArchRuta` text,
  `tyArchCreado` tinyint(10) DEFAULT NULL,
  `vArchDescripcion` text,
  `iUsuIdUsuario` int(11) DEFAULT NULL,
  `Lecciones_siLeccIdLeccion` mediumint(8) NOT NULL,
  PRIMARY KEY (`iArchIdArchivo`),
  KEY `fk_Archivos_Lecciones1` (`Lecciones_siLeccIdLeccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE IF NOT EXISTS `cache` (
  `iCachIdCache` int(11) NOT NULL,
  `vCachValor` varchar(45) DEFAULT NULL,
  `iCachTimestamp` int(11) DEFAULT NULL,
  `vCachTiempoEspera` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iCachIdCache`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) NOT NULL DEFAULT '',
  `to` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  `sent` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `recd` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`id`, `from`, `to`, `message`, `sent`, `recd`) VALUES
(1, 'vin', 'Vinces1', 'oe tontin', '2011-11-24 20:29:41', 0),
(2, 'vin', 'Vinces2', 'heble', '2011-11-24 20:29:50', 0),
(3, 'vin', 'Vinces2', 'heble', '2011-11-24 20:30:16', 0),
(4, 'vin', 'Vinces1', 'uno', '2011-11-24 20:30:24', 0),
(5, 'vin', 'Vinces1', 'nro 1', '2011-11-24 20:30:40', 0),
(6, 'vin', 'Vinces2', 'nro 2', '2011-11-24 20:30:46', 0),
(7, 'vin', 'Vinces2', 'heble', '2011-11-24 20:34:27', 0),
(8, 'vin', 'Vinces1', 'hibli', '2011-11-24 20:34:30', 0),
(9, 'ren', 'Vinces1', 'heble', '2011-11-24 20:37:48', 0),
(10, 'ren', 'Vinces1', 'hibli', '2011-11-24 20:37:52', 0),
(11, 'ren', 'ren', 'heble', '2011-11-24 20:39:04', 1),
(12, 'ren', 'ren', 'heble', '2011-11-24 20:39:09', 1),
(13, 'ren', 'vin', 'hibli', '2011-11-24 20:39:14', 1),
(14, 'ren', 'vin', 'gil', '2011-11-24 20:39:24', 1),
(15, 'ren', 'ren', 'renzo', '2011-11-24 20:39:29', 1),
(16, 'ren', 'ren', 'tontin', '2011-11-24 20:39:37', 1),
(17, 'ren', 'ren', 'hola renzo', '2011-11-24 20:40:13', 1),
(18, 'ren', 'vin', 'hola vinces', '2011-11-24 20:40:23', 1),
(19, 'ren', 'ren', 'hola renzot', '2011-11-24 20:40:39', 1),
(20, 'ren', 'ren', 'hello', '2011-11-24 20:43:57', 1),
(21, 'ren', 'vin', 'hillo', '2011-11-24 20:44:04', 1),
(22, 'vin', 'ren', 'heble renzo', '2011-11-24 20:44:34', 1),
(23, 'ren', 'vin', 'que tal vinces', '2011-11-24 20:45:04', 1),
(24, 'ren', 'vin', 'heble', '2011-11-24 21:01:27', 1),
(25, 'vin', 'ren', 'oetontin', '2011-11-24 21:01:32', 1),
(26, 'vin', 'ren', 'que hacesa??', '2011-11-24 21:01:36', 1),
(27, 'ren', 'yer', 'panzil!', '2011-11-24 21:05:32', 1),
(28, 'yer', 'ren', 'narizon', '2011-11-24 21:05:37', 1),
(29, 'ren', 'yer', 'hola', '2011-11-24 21:12:49', 1),
(30, 'ren', 'yer', 'yerita mongolit', '2011-11-24 21:12:53', 1),
(31, 'vin', 'ren', 'narizotassssssssss', '2011-11-24 21:12:55', 1),
(32, 'vin', 'ren', ':D', '2011-11-24 21:12:58', 1),
(33, 'ren', 'vin', 'oe', '2011-11-24 21:13:08', 1),
(34, 'ren', 'vin', 'cara de mi topo', '2011-11-24 21:13:10', 1),
(35, 'ren', 'vin', 'viejo', '2011-11-24 21:13:12', 1),
(36, 'vin', 'ren', 'cara del topo del pepe', '2011-11-24 21:13:14', 1),
(37, 'ren', 'vin', 'el josue es un negrito', '2011-11-24 21:13:47', 1),
(38, 'vin', 'ren', 'chito mongollllllllllll', '2011-11-24 21:14:03', 1),
(39, 'vin', 'ren', 'ahorita lo ve el sarito', '2011-11-24 21:14:35', 1),
(40, 'ren', 'vin', 'el pepe es un caretroooo', '2011-11-24 21:14:54', 1),
(41, 'vin', 'ren', 'el david un pisado', '2011-11-24 21:15:35', 1),
(42, 'ren', 'vin', 'y se maneja una mitraza...', '2011-11-24 21:16:01', 1),
(43, 'ren', 'vin', 'lo escribio la yerita', '2011-11-24 21:19:39', 1),
(44, 'vin', 'ren', 'oihÃ±ougbÃ±-u', '2011-11-24 21:20:05', 1),
(45, 'vin', 'ren', 'b-logb-{', '2011-11-24 21:20:06', 1),
(46, 'vin', 'ren', '-bug-Ã±ou', '2011-11-24 21:20:07', 1),
(47, 'ren', 'vin', 'pepe gil', '2011-11-24 21:20:14', 1),
(48, 'vin', 'ren', 'fdfdf', '2011-11-25 04:09:16', 0),
(49, '', 'ren', 'hola', '2011-11-25 04:34:19', 0),
(50, 'vin', 'ren', 'Hola', '2011-12-06 01:51:53', 0),
(51, '', 'TANIA', 'Hola', '2011-12-06 01:55:55', 0),
(52, '', 'TANIA', 'bienvenidos', '2011-12-06 01:58:50', 0),
(53, '', 'TANIA', 'Hola', '2011-12-06 02:14:43', 0),
(54, '', 'TANIA', 'Hola', '2011-12-06 02:15:06', 0),
(55, '', 'SOTO', 'Hola', '2011-12-06 02:17:24', 0),
(56, '', 'ALVAREZ', 'Hola', '2011-12-06 02:21:34', 0),
(57, 'tsotol', 'ALVAREZ', 'Hola', '2011-12-06 02:24:34', 0),
(58, 'walvarezs', 'SOTO', 'Hola', '2011-12-06 02:25:10', 0),
(59, 'tsotol', 'ALVAREZ', 'Hola', '2011-12-06 02:25:49', 0),
(60, 'tsotol', 'ALVAREZ', 'hola', '2011-12-06 02:32:59', 0),
(61, 'tsotol', 'ALVAREZ', 'gillllllllllllllllllll', '2011-12-06 02:33:05', 0),
(62, 'tsotol', 'ALVAREZ', 'jjjjjjjjjjjjjjj', '2011-12-06 02:34:07', 0),
(63, 'tsotol', 'WALVAREZS', 'Hola', '2011-12-06 02:38:44', 1),
(64, 'walvarezs', 'tsotol', 'que quieres concha... tu mare', '2011-12-06 02:39:01', 1),
(65, 'tsotol', 'walvarezs', 'jajaja', '2011-12-06 02:39:16', 1),
(66, 'tsotol', 'TSOTOL', 'Hola concha...... tu mare', '2011-12-06 02:41:25', 1),
(67, 'WALVAREZS', 'TSOTOL', 'Hola', '2011-12-06 02:42:07', 1),
(68, 'TSOTOL', 'WALVAREZS', 'Hola', '2011-12-06 02:42:41', 1),
(69, 'WALVAREZS', 'TSOTOL', 'hola muÃ±eca preciosa vida de mivida', '2011-12-06 02:42:53', 1),
(70, 'WALVAREZS', 'TSOTOL', 'ytyytytytyhfgtyftyftyf', '2011-12-06 02:43:15', 1),
(71, 'WALVAREZS', 'TSOTOL', 'iouififhlbhkvgfkcfg', '2011-12-06 02:43:22', 1),
(72, 'TSOTOL', 'WALVAREZS', 'gjvgjfgfcgjvfgjhvgjvgjvgjv', '2011-12-06 02:43:27', 1),
(73, 'TSOTOL', 'WALVAREZS', 'HOLA', '2011-12-06 10:01:47', 1),
(74, 'WALVAREZS', 'TSOTOL', 'QUIERES MI VIDA', '2011-12-06 10:01:55', 1),
(75, 'TSOTOL', 'WALVAREZS', 'Hola', '2011-12-06 11:15:13', 1),
(76, 'TSOTOL', 'WALVAREZS', 'Holas     ssssss', '2011-12-06 11:17:06', 1),
(77, 'TSOTOL', 'WALVAREZS', 'Hola', '2011-12-06 11:19:32', 1),
(78, 'TSOTOL', 'TSOTOL', 'Hola', '2011-12-07 16:36:34', 1),
(79, 'TSOTOL', 'TSOTOL', 'GIL', '2011-12-07 16:36:52', 1),
(80, 'TSOTOL', 'TSOTOL', 'TELLO GIL', '2011-12-07 16:37:04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chatmensajes`
--

CREATE TABLE IF NOT EXISTS `chatmensajes` (
  `iChatMensIdChatMensaje` int(11) NOT NULL,
  `Chat_iChatIdChat` int(11) NOT NULL,
  PRIMARY KEY (`iChatMensIdChatMensaje`),
  KEY `fk_ChatMensajes_Chat1` (`Chat_iChatIdChat`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuracion`
--

CREATE TABLE IF NOT EXISTS `configuracion` (
  `cConfValor` char(1) DEFAULT NULL,
  `cConfTipo` char(1) DEFAULT NULL,
  `tConfDescripcion` text,
  KEY `cConfValor` (`cConfValor`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `configuracion`
--

INSERT INTO `configuracion` (`cConfValor`, `cConfTipo`, `tConfDescripcion`) VALUES
('P', '1', 'PRIMERO'),
('P', '2', 'SEGUNDO'),
('P', '3', 'TERCERO'),
('P', '4', 'CUARTO'),
('P', '5', 'QUINTO'),
('P', '6', 'SEXTO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contenidos`
--

CREATE TABLE IF NOT EXISTS `contenidos` (
  `iContIdContenido` mediumint(8) NOT NULL,
  `vContNombre` varchar(50) DEFAULT NULL,
  `vContDescripcion` longtext,
  `iContIdContenidoPadre` mediumint(8) DEFAULT NULL,
  `tiContEstado` tinyint(1) DEFAULT NULL,
  `tiContPublicado` tinyint(1) DEFAULT NULL,
  `Lecciones_siLeccIdLeccion` mediumint(8) NOT NULL,
  PRIMARY KEY (`iContIdContenido`),
  KEY `fk_Contenidos_Lecciones1` (`Lecciones_siLeccIdLeccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE IF NOT EXISTS `cursos` (
  `iCursIdCursos` int(11) NOT NULL AUTO_INCREMENT,
  `vCursNombreCurso` varchar(150) DEFAULT NULL,
  `tiCursActivo` char(1) DEFAULT NULL,
  `dCursFechaCreacion` int(11) DEFAULT NULL,
  `iCursDescripcion` text,
  `Seccion_iSeccIdSeccion` int(11) NOT NULL,
  PRIMARY KEY (`iCursIdCursos`),
  KEY `Seccion_iSeccIdSeccion` (`Seccion_iSeccIdSeccion`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`iCursIdCursos`, `vCursNombreCurso`, `tiCursActivo`, `dCursFechaCreacion`, `iCursDescripcion`, `Seccion_iSeccIdSeccion`) VALUES
(1, 'MATEMATICA', 'A', 1322697619, 'MATEMATICA BASICA', 2),
(2, 'MATEMATICA', 'A', 1322697651, 'MATEMATICA BASICA', 5),
(3, 'MATEMATICA', 'A', 1322697660, 'LOGICA Y RAZONAMIENTO', 3),
(4, 'MATEMATICA', 'A', 1322697754, 'LOGICA Y RAZONAMIENTO', 6),
(5, 'COMUNICACION', 'A', 1322697775, 'CASTELLANO', 4),
(6, 'CIENCIA Y AMBIENTE', 'A', 1322697874, 'CTA', 3),
(7, 'COMUNICACION', 'A', 1322700943, 'GRAMATICA', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursosusuarios`
--

CREATE TABLE IF NOT EXISTS `cursosusuarios` (
  `Cursos_iCursIdCursos` int(11) NOT NULL,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  `tiCursUsuActivo` char(1) DEFAULT NULL,
  `tiCursUsuCompletado` tinyint(1) DEFAULT NULL,
  `tiCursUsuPorcentaje` tinyint(2) DEFAULT NULL,
  `tiCursUsuCalificacion` tinyint(2) DEFAULT NULL,
  `tiCursUsuFechaRegistro` int(10) DEFAULT NULL,
  PRIMARY KEY (`Cursos_iCursIdCursos`,`Usuarios_iUsuIdUsuario`),
  KEY `fk_CursosUsuarios_Usuarios1` (`Usuarios_iUsuIdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cursosusuarios`
--

INSERT INTO `cursosusuarios` (`Cursos_iCursIdCursos`, `Usuarios_iUsuIdUsuario`, `tiCursUsuActivo`, `tiCursUsuCompletado`, `tiCursUsuPorcentaje`, `tiCursUsuCalificacion`, `tiCursUsuFechaRegistro`) VALUES
(3, 2, 'A', NULL, NULL, NULL, 1322728398),
(4, 3, 'A', NULL, NULL, NULL, 1322728412),
(6, 28, 'A', NULL, NULL, NULL, 1322767850),
(3, 28, 'A', NULL, NULL, NULL, 1322767850),
(6, 27, 'A', NULL, NULL, NULL, 1322767850),
(3, 27, 'A', NULL, NULL, NULL, 1322767850),
(6, 26, 'A', NULL, NULL, NULL, 1322767850),
(3, 26, 'A', NULL, NULL, NULL, 1322767850),
(6, 25, 'A', NULL, NULL, NULL, 1322767850),
(3, 25, 'A', NULL, NULL, NULL, 1322767850),
(6, 24, 'A', NULL, NULL, NULL, 1322767850),
(3, 24, 'A', NULL, NULL, NULL, 1322767850),
(6, 23, 'A', NULL, NULL, NULL, 1322767850),
(3, 23, 'A', NULL, NULL, NULL, 1322767850),
(6, 22, 'A', NULL, NULL, NULL, 1322767850),
(3, 22, 'A', NULL, NULL, NULL, 1322767850),
(6, 21, 'A', NULL, NULL, NULL, 1322767850),
(3, 21, 'A', NULL, NULL, NULL, 1322767850),
(6, 20, 'A', NULL, NULL, NULL, 1322767850),
(3, 20, 'A', NULL, NULL, NULL, 1322767850),
(6, 19, 'A', NULL, NULL, NULL, 1322767850),
(3, 19, 'A', NULL, NULL, NULL, 1322767850),
(6, 18, 'A', NULL, NULL, NULL, 1322767850),
(3, 18, 'A', NULL, NULL, NULL, 1322767850),
(4, 39, 'A', NULL, NULL, NULL, 1322767873),
(7, 39, 'A', NULL, NULL, NULL, 1322767873),
(4, 40, 'A', NULL, NULL, NULL, 1322767873),
(7, 40, 'A', NULL, NULL, NULL, 1322767873),
(4, 41, 'A', NULL, NULL, NULL, 1322767873),
(7, 41, 'A', NULL, NULL, NULL, 1322767873),
(4, 42, 'A', NULL, NULL, NULL, 1322767873),
(7, 42, 'A', NULL, NULL, NULL, 1322767873),
(4, 43, 'A', NULL, NULL, NULL, 1322767873),
(7, 43, 'A', NULL, NULL, NULL, 1322767873),
(4, 44, 'A', NULL, NULL, NULL, 1322767873),
(7, 44, 'A', NULL, NULL, NULL, 1322767873),
(4, 45, 'A', NULL, NULL, NULL, 1322767873),
(7, 45, 'A', NULL, NULL, NULL, 1322767873),
(4, 46, 'A', NULL, NULL, NULL, 1322767873),
(7, 46, 'A', NULL, NULL, NULL, 1322767873),
(4, 47, 'A', NULL, NULL, NULL, 1322767873),
(7, 47, 'A', NULL, NULL, NULL, 1322767873),
(4, 48, 'A', NULL, NULL, NULL, 1322767873),
(7, 48, 'A', NULL, NULL, NULL, 1322767873),
(1, 2, 'E', NULL, NULL, NULL, 1323132647),
(6, 5, 'E', NULL, NULL, NULL, 1323133002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos_lecciones`
--

CREATE TABLE IF NOT EXISTS `cursos_lecciones` (
  `Cursos_iCursIdCursos` int(11) NOT NULL,
  `Lecciones_siLeccIdLeccion` mediumint(8) NOT NULL,
  `tCurLeccDescripcion` text,
  PRIMARY KEY (`Cursos_iCursIdCursos`,`Lecciones_siLeccIdLeccion`),
  KEY `fk_Cursos_has_Lecciones_Lecciones1` (`Lecciones_siLeccIdLeccion`),
  KEY `fk_Cursos_has_Lecciones_Cursos1` (`Cursos_iCursIdCursos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `director`
--

CREATE TABLE IF NOT EXISTS `director` (
  `iDireIdDirector` int(11) NOT NULL,
  `tiDireEstado` tinyint(1) DEFAULT NULL,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  PRIMARY KEY (`iDireIdDirector`),
  KEY `fk_Director_Usuarios1` (`Usuarios_iUsuIdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `docentes`
--

CREATE TABLE IF NOT EXISTS `docentes` (
  `iDocIdDocentes` int(11) NOT NULL AUTO_INCREMENT,
  `tDocEspecialidad` text,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  PRIMARY KEY (`iDocIdDocentes`),
  KEY `fk_Docentes_Usuarios` (`Usuarios_iUsuIdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`iDocIdDocentes`, `tDocEspecialidad`, `Usuarios_iUsuIdUsuario`) VALUES
(1, 'PEDAGOGA', 2),
(2, 'LICENCIADA EN EDUCACION PRIMARIA', 3),
(3, 'LICENCIADO EN MATEMATICA', 4),
(4, 'DOCTORADO EN EDUCACION PRIMARIA', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `tiEveIdEvento` tinyint(3) NOT NULL AUTO_INCREMENT,
  `iUsuIdUsuario` int(11) DEFAULT NULL,
  `iEveCreado` int(10) DEFAULT NULL,
  `tiEveEstado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`tiEveIdEvento`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examen`
--

CREATE TABLE IF NOT EXISTS `examen` (
  `iExamIdExamen` int(11) NOT NULL,
  `iContIdContenido` mediumint(8) DEFAULT NULL,
  `vExamNombre` varchar(255) DEFAULT NULL,
  `tiExamPuntEsperada` tinyint(2) DEFAULT NULL,
  `tExamInstrucciones` text,
  `tiExamDuracion` tinyint(4) DEFAULT NULL,
  `Lecciones_siLeccIdLeccion` mediumint(8) NOT NULL,
  PRIMARY KEY (`iExamIdExamen`),
  KEY `fk_Examen_Lecciones1` (`Lecciones_siLeccIdLeccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `examenes_alumnos`
--

CREATE TABLE IF NOT EXISTS `examenes_alumnos` (
  `ExamComidExamenesCompletos` int(11) NOT NULL,
  `tiExamComEstado` tinyint(1) DEFAULT NULL,
  `iExamComCreado` int(10) DEFAULT NULL,
  `iExamComHInicio` int(10) DEFAULT NULL,
  `iExamComHFin` int(10) DEFAULT NULL,
  `iExamComTiempo` int(10) DEFAULT NULL,
  `iExamComEstado` tinyint(1) DEFAULT NULL,
  `iExamComExamen` longtext,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  `Examen_iExamIdExamen` int(11) NOT NULL,
  PRIMARY KEY (`ExamComidExamenesCompletos`),
  KEY `fk_Examenes_Alumnos_Usuarios1` (`Usuarios_iUsuIdUsuario`),
  KEY `fk_Examenes_Alumnos_Examen1` (`Examen_iExamIdExamen`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grado`
--

CREATE TABLE IF NOT EXISTS `grado` (
  `iGradoIdGrado` int(11) NOT NULL AUTO_INCREMENT,
  `vGradoDescripcion` varchar(50) DEFAULT NULL,
  `tiGradoEstado` char(1) DEFAULT NULL,
  `PeriodoAcademico_iPerAcaIdPeriodoAcademico` int(11) NOT NULL,
  PRIMARY KEY (`iGradoIdGrado`),
  KEY `fk_Grado_PeriodoAcademico1` (`PeriodoAcademico_iPerAcaIdPeriodoAcademico`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`iGradoIdGrado`, `vGradoDescripcion`, `tiGradoEstado`, `PeriodoAcademico_iPerAcaIdPeriodoAcademico`) VALUES
(1, 'PRIMERO', 'I', 1),
(2, 'SEGUNDO', 'A', 1),
(3, 'TERCERO', 'A', 1),
(4, 'CUARTO', 'A', 1),
(5, 'QUINTO', 'I', 1),
(6, 'SEXTO', 'A', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lecciones`
--

CREATE TABLE IF NOT EXISTS `lecciones` (
  `siLeccIdLeccion` mediumint(8) NOT NULL AUTO_INCREMENT,
  `vLeccNombre` varchar(150) DEFAULT NULL,
  `tiLeccEstado` tinyint(1) DEFAULT NULL,
  `tLeccMetaDatos` text,
  `iLeccCreado` int(10) DEFAULT NULL,
  PRIMARY KEY (`siLeccIdLeccion`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `iLogIdLog` int(11) NOT NULL AUTO_INCREMENT,
  `iUsuIdUsuario` int(11) DEFAULT NULL,
  `iLogTimeStamp` int(10) DEFAULT NULL,
  `cAcciIdAccion` char(1) DEFAULT NULL,
  PRIMARY KEY (`iLogIdLog`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=260 ;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`iLogIdLog`, `iUsuIdUsuario`, `iLogTimeStamp`, `cAcciIdAccion`) VALUES
(1, 1, 1323147317, 'B'),
(2, 1, 1323147321, 'A'),
(3, 1, 1323147655, 'B'),
(4, NULL, 1323147671, 'B'),
(5, 2, 1323147720, 'A'),
(6, NULL, 1323150621, 'B'),
(7, NULL, 1323150632, 'B'),
(8, NULL, 1323150662, 'B'),
(9, NULL, 1323150683, 'B'),
(10, NULL, 1323150700, 'B'),
(11, NULL, 1323150709, 'B'),
(12, 2, 1323150714, 'A'),
(13, NULL, 1323150836, 'B'),
(14, NULL, 1323150869, 'B'),
(15, 24, 1323150875, 'A'),
(16, 24, 1323151296, 'B'),
(17, 39, 1323151300, 'A'),
(18, 2, 1323151316, 'B'),
(19, 2, 1323151322, 'A'),
(20, 2, 1323152460, 'B'),
(21, 2, 1323152778, 'A'),
(22, 39, 1323152884, 'A'),
(23, 39, 1323153256, 'B'),
(24, 39, 1323153258, 'A'),
(25, 2, 1323153493, 'B'),
(26, 2, 1323153499, 'A'),
(27, 39, 1323153823, 'B'),
(28, 39, 1323153824, 'A'),
(29, 39, 1323154095, 'B'),
(30, NULL, 1323154095, 'B'),
(31, 39, 1323154096, 'A'),
(32, 2, 1323154106, 'B'),
(33, 2, 1323154111, 'A'),
(34, 2, 1323154546, 'B'),
(35, 2, 1323154550, 'A'),
(36, 2, 1323155664, 'B'),
(37, 2, 1323155672, 'A'),
(38, 39, 1323155690, 'B'),
(39, 39, 1323155692, 'A'),
(40, NULL, 1323155764, 'B'),
(41, 39, 1323155766, 'A'),
(42, 2, 1323156084, 'B'),
(43, 2, 1323156089, 'A'),
(44, 39, 1323156282, 'B'),
(45, NULL, 1323156282, 'B'),
(46, 39, 1323156284, 'A'),
(47, 2, 1323156767, 'B'),
(48, 2, 1323156772, 'A'),
(49, 2, 1323157081, 'B'),
(50, 39, 1323157084, 'B'),
(51, 2, 1323157095, 'A'),
(52, 39, 1323157098, 'A'),
(53, NULL, 1323157261, 'B'),
(54, NULL, 1323157265, 'B'),
(55, 2, 1323157272, 'A'),
(56, 39, 1323157273, 'A'),
(57, NULL, 1323157336, 'B'),
(58, NULL, 1323157347, 'B'),
(59, 39, 1323157350, 'A'),
(60, 2, 1323157354, 'A'),
(61, 2, 1323161511, 'B'),
(62, 2, 1323161517, 'A'),
(63, 2, 1323161798, 'B'),
(64, 2, 1323161803, 'A'),
(65, 2, 1323183679, 'B'),
(66, 39, 1323183692, 'B'),
(67, 39, 1323183695, 'A'),
(68, 2, 1323183701, 'A'),
(69, NULL, 1323188074, 'B'),
(70, 39, 1323188076, 'A'),
(71, NULL, 1323188086, 'B'),
(72, 2, 1323188096, 'A'),
(73, 39, 1323188404, 'B'),
(74, 39, 1323188406, 'A'),
(75, 1, 1323237428, 'A'),
(76, 1, 1323237650, 'B'),
(77, 1, 1323237656, 'A'),
(78, 1, 1323238059, 'B'),
(79, 2, 1323238064, 'A'),
(80, 2, 1323238653, 'B'),
(81, 2, 1323238661, 'A'),
(82, 2, 1323240074, 'B'),
(83, 2, 1323240085, 'A'),
(84, 2, 1323240798, 'B'),
(85, 2, 1323240805, 'A'),
(86, 2, 1323242384, 'B'),
(87, 2, 1323242400, 'A'),
(88, 2, 1323245283, 'B'),
(89, 2, 1323250570, 'A'),
(90, 2, 1323255015, 'B'),
(91, 1, 1323255057, 'A'),
(92, 1, 1323255535, 'B'),
(93, 2, 1323255540, 'A'),
(94, 2, 1323256389, 'B'),
(95, 2, 1323256401, 'A'),
(96, 2, 1323257466, 'B'),
(97, 2, 1323257472, 'A'),
(98, 2, 1323258433, 'B'),
(99, 2, 1323258438, 'A'),
(100, 2, 1323261379, 'B'),
(101, 2, 1323261385, 'A'),
(102, 2, 1323263474, 'B'),
(103, 2, 1323263479, 'A'),
(104, 2, 1323263826, 'B'),
(105, NULL, 1323263848, 'B'),
(106, 2, 1323263856, 'A'),
(107, 2, 1323264266, 'B'),
(108, 2, 1323264272, 'A'),
(109, 2, 1323264625, 'B'),
(110, 2, 1323264632, 'A'),
(111, 2, 1323265144, 'B'),
(112, 2, 1323265151, 'A'),
(113, 2, 1323265941, 'B'),
(114, 2, 1323266233, 'A'),
(115, 2, 1323267171, 'B'),
(116, 2, 1323267176, 'A'),
(117, 2, 1323270024, 'B'),
(118, NULL, 1323270024, 'B'),
(119, 2, 1323270030, 'A'),
(120, 2, 1323270370, 'B'),
(121, 2, 1323270379, 'A'),
(122, 2, 1323271446, 'B'),
(123, 2, 1323271452, 'A'),
(124, 2, 1323286810, 'A'),
(125, 2, 1323287471, 'B'),
(126, 2, 1323287479, 'A'),
(127, 2, 1323288253, 'B'),
(128, 2, 1323288260, 'A'),
(129, 2, 1323288670, 'B'),
(130, 2, 1323288679, 'A'),
(131, 2, 1323289205, 'B'),
(132, 2, 1323289212, 'A'),
(133, 2, 1323290975, 'B'),
(134, 2, 1323290981, 'A'),
(135, 2, 1323292418, 'B'),
(136, 2, 1323292468, 'A'),
(137, 2, 1323292752, 'B'),
(138, 2, 1323292757, 'A'),
(139, 2, 1323293116, 'B'),
(140, 2, 1323293122, 'A'),
(141, 2, 1323293641, 'B'),
(142, 2, 1323293648, 'A'),
(143, 2, 1323295277, 'B'),
(144, 2, 1323295282, 'A'),
(145, 2, 1323295630, 'A'),
(146, 2, 1323296466, 'B'),
(147, 2, 1323296470, 'A'),
(148, 2, 1323296718, 'B'),
(149, 2, 1323296722, 'A'),
(150, 2, 1323297467, 'B'),
(151, 2, 1323297682, 'A'),
(152, 2, 1323299076, 'B'),
(153, 2, 1323299081, 'A'),
(154, 2, 1323309834, 'B'),
(155, NULL, 1323310153, 'B'),
(156, 2, 1323310154, 'A'),
(157, 2, 1323379084, 'A'),
(158, 2, 1323379166, 'A'),
(159, 2, 1323413557, 'A'),
(160, 2, 1323413857, 'B'),
(161, 2, 1323413862, 'A'),
(162, 2, 1323414257, 'B'),
(163, 2, 1323414264, 'A'),
(164, 2, 1323414854, 'B'),
(165, 2, 1323414858, 'A'),
(166, 2, 1323415108, 'B'),
(167, 2, 1323415113, 'A'),
(168, 2, 1323416919, 'B'),
(169, 2, 1323416925, 'A'),
(170, 2, 1323417397, 'B'),
(171, 2, 1323417402, 'A'),
(172, 2, 1323418389, 'B'),
(173, 2, 1323418396, 'A'),
(174, 2, 1323418634, 'B'),
(175, 2, 1323418640, 'A'),
(176, 2, 1323418855, 'B'),
(177, 2, 1323418859, 'A'),
(178, 2, 1323419245, 'B'),
(179, 2, 1323419249, 'A'),
(180, 2, 1323427591, 'B'),
(181, 2, 1323427595, 'A'),
(182, 2, 1323428257, 'B'),
(183, 2, 1323428261, 'A'),
(184, 2, 1323428659, 'B'),
(185, 2, 1323428665, 'A'),
(186, 2, 1323430427, 'B'),
(187, 2, 1323430432, 'A'),
(188, 2, 1323431421, 'B'),
(189, 2, 1323431426, 'A'),
(190, 2, 1323436828, 'B'),
(191, 2, 1323436833, 'A'),
(192, 2, 1323437860, 'B'),
(193, 2, 1323437866, 'A'),
(194, 2, 1323438076, 'B'),
(195, 2, 1323438101, 'A'),
(196, 2, 1323438465, 'B'),
(197, 2, 1323438480, 'A'),
(198, 2, 1323438684, 'B'),
(199, 2, 1323438688, 'A'),
(200, 2, 1323439836, 'B'),
(201, 2, 1323439840, 'A'),
(202, 2, 1323441070, 'B'),
(203, 2, 1323441076, 'A'),
(204, 2, 1323447367, 'B'),
(205, 2, 1323447373, 'A'),
(206, 2, 1323447737, 'B'),
(207, 2, 1323447742, 'A'),
(208, 2, 1323447971, 'B'),
(209, 2, 1323447976, 'A'),
(210, 2, 1323448858, 'B'),
(211, 2, 1323448866, 'A'),
(212, 2, 1323450151, 'B'),
(213, 2, 1323450157, 'A'),
(214, 2, 1323453066, 'B'),
(215, 2, 1323453071, 'A'),
(216, 2, 1323457805, 'B'),
(217, 2, 1323457926, 'A'),
(218, 2, 1323458219, 'B'),
(219, NULL, 1323458224, 'B'),
(220, NULL, 1323458224, 'B'),
(221, NULL, 1323458229, 'B'),
(222, NULL, 1323458229, 'B'),
(223, 2, 1323458234, 'A'),
(224, 2, 1323460095, 'B'),
(225, 2, 1323460103, 'A'),
(226, 2, 1323480708, 'A'),
(227, 2, 1323501956, 'B'),
(228, 2, 1323501962, 'A'),
(229, 2, 1323502310, 'B'),
(230, 2, 1323502317, 'A'),
(231, 2, 1323503041, 'B'),
(232, 2, 1323503047, 'A'),
(233, 2, 1323503501, 'B'),
(234, 2, 1323503543, 'A'),
(235, 2, 1323503880, 'B'),
(236, 2, 1323503885, 'A'),
(237, 2, 1323507380, 'B'),
(238, 2, 1323507385, 'A'),
(239, 2, 1323508990, 'B'),
(240, 2, 1323508994, 'A'),
(241, 2, 1323527658, 'B'),
(242, NULL, 1323527665, 'B'),
(243, 2, 1323527675, 'A'),
(244, 2, 1323527872, 'B'),
(245, 2, 1323527879, 'A'),
(246, 2, 1323529131, 'B'),
(247, 2, 1323529136, 'A'),
(248, 2, 1323529381, 'B'),
(249, NULL, 1323529386, 'B'),
(250, 2, 1323529397, 'A'),
(251, 2, 1323530134, 'B'),
(252, NULL, 1323530243, 'B'),
(253, 2, 1323530250, 'A'),
(254, 2, 1323531022, 'B'),
(255, 2, 1323531030, 'A'),
(256, 2, 1323531652, 'B'),
(257, 2, 1323531656, 'A'),
(258, 2, 1323533066, 'B'),
(259, 2, 1323533070, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
  `idMenu` int(11) NOT NULL AUTO_INCREMENT,
  `Descripcion` varchar(40) DEFAULT NULL,
  `Tipo` char(1) DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  `Estado` char(1) DEFAULT NULL,
  PRIMARY KEY (`idMenu`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `menu`
--

INSERT INTO `menu` (`idMenu`, `Descripcion`, `Tipo`, `url`, `Estado`) VALUES
(1, 'Pagina Principal', '1', '/alumno/principal', 'A'),
(2, 'Mis Cursos', '1', '/alumno/cursos', 'A'),
(3, 'Mi Agenda', '1', '/alumno/agenda', 'A'),
(4, 'Mi Progreso', '1', '/alumno/progreso', 'A'),
(5, 'Red Social', '1', '/alumno/redsocial', 'A'),
(6, 'Pagina Principal', '5', '/admin/principal', 'A'),
(7, 'Cursos', '5', '/admin/cursos', 'A'),
(8, 'Usuarios', '5', '/admin/usuarios', 'A'),
(9, 'Informes', '5', '/admin/informes', 'A'),
(10, 'Red Social', '5', '/admin/redsocial', 'A'),
(11, 'Panel de Control', '5', '/admin/panel', 'A'),
(12, 'Administracion de la Plataforma', '5', '/admin/plataforma', 'A'),
(13, 'Pagina Principal', '4', '/director/principal', 'A'),
(14, 'Cursos', '4', '/director/cursos', 'A'),
(15, 'Informes', '4', '/director/informes', 'A'),
(16, 'Pagina Principal', '2', '/docente/principal', 'A'),
(17, 'Mis Cursos', '2', '/docente/cursos', 'A'),
(18, 'Mi Agenda', '2', '/docente/agenda', 'A'),
(19, 'Informes', '2', '/docente/informes', 'A'),
(20, 'Red Social', '2', '/docente/redsocial', 'A'),
(21, 'Pagina Principal', '3', '/apoderado/principal', 'A'),
(22, 'Informes', '3', '/apoderado/informes', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulos`
--

CREATE TABLE IF NOT EXISTS `modulos` (
  `idModulos` int(11) NOT NULL,
  PRIMARY KEY (`idModulos`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodoacademico`
--

CREATE TABLE IF NOT EXISTS `periodoacademico` (
  `iPerAcaIdPeriodoAcademico` int(11) NOT NULL AUTO_INCREMENT,
  `vPerAcaDescripcion` char(4) DEFAULT NULL,
  `cPerAcaEstado` char(1) DEFAULT NULL,
  `cPerAcaNotas` char(1) NOT NULL,
  PRIMARY KEY (`iPerAcaIdPeriodoAcademico`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `periodoacademico`
--

INSERT INTO `periodoacademico` (`iPerAcaIdPeriodoAcademico`, `vPerAcaDescripcion`, `cPerAcaEstado`, `cPerAcaNotas`) VALUES
(1, '2011', 'A', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE IF NOT EXISTS `preguntas` (
  `iPregIdPreguntas` int(11) NOT NULL,
  `tPregDescripcion` text,
  `tiPregTipo` varchar(45) DEFAULT NULL,
  `TipoPregunta_iTipoPreIdTipoPregunta` int(11) NOT NULL,
  PRIMARY KEY (`iPregIdPreguntas`),
  KEY `fk_Preguntas_TipoPregunta1` (`TipoPregunta_iTipoPreIdTipoPregunta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_examen`
--

CREATE TABLE IF NOT EXISTS `preguntas_examen` (
  `Preguntas_iPregIdPreguntas` int(11) NOT NULL,
  `Examen_iExamIdExamen` int(11) NOT NULL,
  PRIMARY KEY (`Preguntas_iPregIdPreguntas`,`Examen_iExamIdExamen`),
  KEY `fk_Preguntas_has_Examen_Examen1` (`Examen_iExamIdExamen`),
  KEY `fk_Preguntas_has_Examen_Preguntas1` (`Preguntas_iPregIdPreguntas`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registroavance`
--

CREATE TABLE IF NOT EXISTS `registroavance` (
  `idRegistroAvance` int(11) NOT NULL,
  `tRegAvaDescripcion` text,
  `CursosUsuarios_Cursos_iCursIdCursos` int(11) NOT NULL,
  `CursosUsuarios_Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  `TipoAvance_idTipoAvance` int(11) NOT NULL,
  PRIMARY KEY (`idRegistroAvance`),
  KEY `fk_RegistroAvance_CursosUsuarios1` (`CursosUsuarios_Cursos_iCursIdCursos`,`CursosUsuarios_Usuarios_iUsuIdUsuario`),
  KEY `fk_RegistroAvance_TipoAvance1` (`TipoAvance_idTipoAvance`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

CREATE TABLE IF NOT EXISTS `seccion` (
  `iSeccIdSeccion` int(11) NOT NULL AUTO_INCREMENT,
  `vSeccDescripcion` varchar(20) DEFAULT NULL,
  `tiSeccEstado` char(1) DEFAULT NULL,
  `Grado_iGradoIdGrado` int(11) NOT NULL,
  PRIMARY KEY (`iSeccIdSeccion`),
  KEY `fk_Seccion_Grado1` (`Grado_iGradoIdGrado`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`iSeccIdSeccion`, `vSeccDescripcion`, `tiSeccEstado`, `Grado_iGradoIdGrado`) VALUES
(1, 'A', 'A', 3),
(2, 'A', 'A', 2),
(3, 'A', 'A', 4),
(4, 'A', 'A', 6),
(5, 'B', 'A', 2),
(6, 'B', 'A', 4),
(7, 'B', 'A', 3),
(8, 'C', 'A', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipoavance`
--

CREATE TABLE IF NOT EXISTS `tipoavance` (
  `idTipoAvance` int(11) NOT NULL,
  `vTipAvaDescripcion` varchar(45) DEFAULT NULL,
  `cTipAvaValor` char(1) DEFAULT NULL,
  `tiTipAvaEstado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idTipoAvance`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopregunta`
--

CREATE TABLE IF NOT EXISTS `tipopregunta` (
  `iTipoPreIdTipoPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `vTipoPreDescripcion` varchar(50) DEFAULT NULL,
  `vTipoPreValor` varchar(50) DEFAULT NULL,
  `tiTipoPreEstado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`iTipoPreIdTipoPregunta`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE IF NOT EXISTS `tipousuario` (
  `iTiUsuarioIdTipoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `vDescripcion` varchar(50) DEFAULT NULL,
  `vUrl` varchar(200) NOT NULL,
  `Estado` char(1) NOT NULL,
  PRIMARY KEY (`iTiUsuarioIdTipoUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`iTiUsuarioIdTipoUsuario`, `vDescripcion`, `vUrl`, `Estado`) VALUES
(1, 'Alumno', 'alumno/alumno_principal.php', 'A'),
(2, 'Docente', 'docente/docente_principal.php', 'A'),
(3, 'Apoderado', 'apoderado/apoderado_principal.php', 'A'),
(4, 'Director', 'director/director_principal.php', 'A'),
(5, 'Administrador', 'admin/admin_principal.php', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `iUsuIdUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `vUsuUsuario` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `vUsuClave` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `vUsuEmail` varchar(150) CHARACTER SET latin1 DEFAULT NULL,
  `cUsuDni` char(8) CHARACTER SET latin1 DEFAULT NULL,
  `vUsuNombre` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `vUsuApellidoPat` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `vUsuApellidoMat` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `cSexo` char(1) CHARACTER SET latin1 NOT NULL,
  `tFoto` text CHARACTER SET latin1 NOT NULL,
  `cUsuActivo` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `cUsuEstado` char(1) CHARACTER SET latin1 DEFAULT NULL,
  `TipoUsuario_iTiUsuarioIdTipoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`iUsuIdUsuario`),
  KEY `fk_Usuarios_TipoUsuario1` (`TipoUsuario_iTiUsuarioIdTipoUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=73 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`iUsuIdUsuario`, `vUsuUsuario`, `vUsuClave`, `vUsuEmail`, `cUsuDni`, `vUsuNombre`, `vUsuApellidoPat`, `vUsuApellidoMat`, `cSexo`, `tFoto`, `cUsuActivo`, `cUsuEstado`, `TipoUsuario_iTiUsuarioIdTipoUsuario`) VALUES
(1, 'admin', 'f6a8b6531daad1c669801431eb7dac83', 'admin@lospinos.com', '46683762', 'Uriol', 'Garcia', 'Perez', 'M', '', 'A', 'A', 5),
(2, 'TSOTOL', '060b18fb9d7632c96c1c2e05bef84892', 'TANIA_SOTO12@HOTMAIL.COM', '47382987', 'TANIA', 'SOTO', 'LOPEZ', 'F', '', 'A', 'A', 2),
(3, 'CDIAZP', 'd84e670ef7d9b7977256719e2e2788d9', 'CLOTILDE112@HOTMAIL.COM', '34823411', 'CLOTILDE', 'DIAZ', 'PEREZ', 'F', '', 'A', 'A', 2),
(4, 'JPEREZP', '1c4ed2080e87427fbad00b5b781a2e46', 'JPEREZPERA@HOTMAIL.COM', '18762543', 'JUAN', 'PEREZ', 'PERALTA', 'M', '', 'A', 'A', 2),
(5, 'JPAREDESS', '8cf3ded3561ffea3f25c63982d2afd7d', 'JESUS_PAR34@HOTMAIL.COM', '18273647', 'JESUS', 'PAREDES', 'SALAZAR', 'M', '', 'A', 'A', 2),
(6, 'LALCANTARAS', '6ee38a5ba31c273422818f304e57e7d2', 'LALCANTARA@HOTMAIL.COM', '28736456', 'LUIS', 'ALCANTARA', 'SOLANO', 'M', '', 'A', 'A', 3),
(7, 'CBLASU', '6feed0af1037a3c4b6286d727365fd95', 'CBLAS@HOTMAIL.COM', '74635267', 'CARLOS', 'BLAS', 'URTEAGA', 'M', '', 'A', 'A', 3),
(8, 'MPRETELM', 'e1c96fc096e418e5b60f2829664a4c41', 'MAIOPRETELL@HOTMAIL.COM', '67453677', 'MARIO', 'PRETEL', 'MONTOYA', 'M', '', 'A', 'A', 3),
(9, 'MCORTIJOZ', '5b52002e403d07ab270e06a7fd061ea8', 'MOISESCORTIJO_1234@HOTMAIL.COM', '16253678', 'MOISES', 'CORTIJO', 'ZAVALETA', 'M', '', 'A', 'A', 3),
(10, 'CCAMACHOV', '2387e67e087486022d6fbf6ff798a56f', 'CAMACHO12_@HOTMAIL.COM', '46372819', 'CESAR', 'CAMACHO', 'VALVERDE', 'M', '', 'A', 'A', 3),
(11, 'EFERNANDEZC', 'ba1e42401b85ba905a8c568041d202e7', 'EVDA@HOTMAIL.COM', '87387024', 'EVERT', 'FERNANDEZ', 'CERNA', 'M', '', 'A', 'A', 3),
(12, 'MKOGAK', 'e595cfc3e94c2a3f0e069d4734415b36', 'MANOLITO@HOTMAIL.COM', '64892374', 'MANOLO', 'KOGA', 'KOGA', 'M', '', 'A', 'A', 3),
(13, 'RMONTOYAC', '48659789222072ea38362a5c527d4548', 'ROSA_LUZ@HOTMAIL.COM', '98237489', 'ROSA', 'MONTOYA', 'CASTRO', 'F', '', 'A', 'A', 3),
(14, 'JRODRIGUEZL', '643843b63b6202b0c34c4676b26111bb', 'JOSUE_2302@HOTMAIL.COM', '83492634', 'JOSUE', 'RODRIGUEZ', 'LOZANO', 'M', '', 'A', 'A', 3),
(15, 'MVALERIANOO', 'e2b49d6254771a6ca6f0d62a0e26c23a', 'MARIA2323@HOTMAIL.COM', '84936572', 'MARIA', 'VALERIANO', 'ORTIZ', 'F', '', 'A', 'A', 3),
(16, 'LVELASQUEZA', '042ad65939da9bc7c8ff7453d23e5705', 'LRODRIG@HOTMAIL.COM', '12381987', 'LUISA', 'VELASQUEZ', 'AGUILAR', 'F', '', 'A', 'A', 3),
(17, 'CVISALOTM', '997d0c8ed746a81fe85280e42d9282df', 'LUZ_DIVINA@HOTMAIL.COM', '82374923', 'CARMEN', 'VISALOT', 'MARQUINA', 'F', '', 'A', 'A', 3),
(18, 'TALCANTARAR', 'b77bf9dfc0078fe20173443a6bddcf5d', 'THIRZA_EE@HOTMAIL.COM', '74635267', 'THIRZA', 'ALCANTARA', 'RIVERA', 'F', 'main/fotos/18.jpg', 'A', 'A', 1),
(19, 'JBLASA', '799d0b639ddee548fc7cb4f2ad74b156', 'JBLAS@HOTMAIL.COM', '23423423', 'JHON', 'BLAS', 'ALVAREZ', 'M', 'main/fotos/19.jpg', 'A', 'A', 1),
(20, 'ABUENOL', '4c7cdbc357b6cb1eb53018eb3471b755', 'ABUENOL@HOTMAIL.COM', '43534534', 'ANA', 'BUENO', 'LAZARO', 'F', 'main/fotos/20.jpg', 'A', 'A', 1),
(21, 'OCORTIJOC', '7887bdc99fa2796a09b6d693f981cd79', 'OMARCORTI23@HOTMAIL.COM', '46456546', 'OMAR', 'CORTIJO', 'CANAZA', 'M', 'main/fotos/21.jpg', 'A', 'A', 1),
(22, 'MFERNANDEZC', 'bcb6c262a04efd5cb8865d622008e345', 'MOISES_FER@HOTMAIL.COM', '93849349', 'MOISES', 'FERNANDEZ', 'CORDOVA', 'F', 'main/fotos/22.jpg', 'A', 'A', 1),
(23, 'HKOGAM', 'ca9ab58faf36304e8356d23adac94d6b', 'HELAMAN@HOTMAIL.COM', '63469875', 'HELAMAN', 'KOGA', 'MEZA', 'M', 'main/fotos/23.jpg', 'A', 'A', 1),
(24, 'EMONTOYAC', 'cbfc5ee981e0c9adebdb113db7e13a12', 'EMONT@HOTMAIL.COM', '18349399', 'EDUARDO', 'MONTOYA', 'CONHY', 'M', 'main/fotos/24.jpg', 'A', 'A', 1),
(25, 'JRODRIGUEZG', '2232b35fa8a7742b5525d373ccb03ed9', 'JOSER@HOTMAIL.COM', '47736372', 'JOSEPH', 'RODRIGUEZ', 'GUTIERREZ', 'M', 'main/fotos/25.jpg', 'A', 'A', 1),
(26, 'FVALERIANOS', '7cf26b648850625a1ab8f1d19c8fe4ec', 'FATIMITA@HOTMAIL.COM', '48737738', 'FATIMA', 'VALERIANO', 'SOLANO', 'F', 'main/fotos/26.jpg', 'A', 'A', 1),
(27, 'KVELASQUEZD', '2827e361f63dcf1234152ec872f119b5', 'KAROLLIT@HOTMAIL.COM', '56345756', 'KAROL', 'VELASQUEZ', 'DEL AGUILA', 'F', 'main/fotos/27.jpg', 'A', 'A', 1),
(28, 'MVISALOTO', 'b1bca2229e65e584ac4b7992052fc0fd', 'MARCI_@HOTMAIL.COM', '56456546', 'MARCO', 'VISALOT', 'ORBEGOSO', 'M', 'main/fotos/28.jpg', 'A', 'A', 1),
(29, 'CALVAREZG', '3b2c9379e66f9859496b539298d0fa8c', 'CLAUDO_IBF@HOTMAIL.COM', '39485737', 'CARLOS', 'ALVAREZ', 'GUADALAJARA', 'M', '', 'A', 'A', 3),
(30, 'RMARQUINAM', '2334d64b131eb7a5e4e20851c0d3d939', 'ROSAMAR12@HOTMAIL.COM', '65435435', 'ROSA', 'MARQUINA', 'MELENDEZ', 'F', '', 'A', 'A', 3),
(31, 'LGARCIAM', '77f14bceae42342be0b8e0d45c70f437', 'LUISITO@HOTMAIL.COM', '84834848', 'LUIS', 'GARCIA', 'MONTANA', 'M', '', 'A', 'A', 3),
(32, 'CZAVALETAM', 'c43c1f4bea73538d18e7f972f7a82a63', 'CZAVALET@HOTMAIL.COM', '48278239', 'CARLA', 'ZAVALETA', 'MERCADO', 'F', '', 'A', 'A', 3),
(33, 'LJOAQUINO', 'd2438103e98f19558bcc22aa6521df25', 'LJOAC@HOTMAIL.COM', '34252232', 'LUZ', 'JOAQUIN', 'TENORIO', 'F', '', 'A', 'A', 3),
(34, 'SLLANOSL', 'db640b897bfaa52633be9b4b1ea6377a', 'STEPHANICITA@HOTMAIL.COM', '46727388', 'STEPHANY', 'LLANOS', 'LLANOS', 'F', '', 'A', 'A', 3),
(35, 'CMUÑOZS', '9d947e3ad4064071e0fc2f840e62f0fe', 'CMUÃ±OZSALVA@HOTMAIL.COM', '57474367', 'CARLOS', 'MUÑOZ', 'SALVATIERRA', 'M', '', 'A', 'A', 3),
(36, 'JNAVARRETEP', 'c70d280bff821b597a3ff857a90f23f6', 'JOSESITTT@HOTMAIL.COM', '84357346', 'JOSE', 'NAVARRETE', 'PEREZ', 'M', '', 'A', 'A', 3),
(37, 'MCHIGNEC', 'c6ca2f49996fbcad706836f7f06fe804', 'CHIGNEMAR@HOTMAIL.COM', '43563225', 'MARIA', 'CHIGNE', 'CHAVEZ', 'F', '', 'A', 'A', 3),
(38, 'HROJASL', '0ff08527d9768b89f5bb4cd0a0171f3d', 'HUMBERTITOT@HOTMAIL.COM', '17283789', 'HUMBERTO', 'ROJAS', 'LOPEZ', 'M', '', 'A', 'A', 3),
(39, 'WALVAREZS', 'b3f92da6c0c204fab15db0fc5728f36c', 'WAAL@HOTMAIL.COM', '23432423', 'WALTER FRANCISCO', 'ALVAREZ', 'SALVADOR', 'M', 'main/fotos/39.jpg', 'A', 'A', 1),
(40, 'FCASTROM', 'acb1a2dcec42fe633ddda9a254543a3d', 'FABRI@HOTMAIL.COM', '73692371', 'FABRICIO', 'CASTRO', 'MARQUINA', 'M', 'main/fotos/40.jpg', 'A', 'A', 1),
(41, 'EGARCIAV', '25f2f1e695f5634f10c22eb476bbadd7', 'BOY_ERICK@HOTMAIL.COM', '45452355', 'ERICK WILFREDO', 'GARCIA', 'VELASQUEZ', 'M', 'main/fotos/41.jpg', 'A', 'A', 1),
(42, 'NGILZ', '9a766a18827f02e80bed22289a3c78ab', 'NICOLMAIOL@HOTMAIL.COM', '21464564', 'NICOL MARIOL', 'GIL', 'ZAVALETA', 'F', 'main/fotos/42.jpg', 'A', 'A', 1),
(43, 'EJOAQUINO', 'ec20c6f29da81f28a99fa61fdefdd659', 'ERIKAROZA@HOTMAIL.COM', '45637463', 'ERIKA ROZANA', 'JOAQUIN', 'ORBEGOSO', 'F', 'main/fotos/43.jpg', 'A', 'A', 1),
(44, 'SLLANOSR', 'a5da80a4beca52fcb394c982896ebc18', 'STEPHY@HOTMAIL.COM', '87364872', 'STEPHANY', 'LLANOS', 'RODRIGUEZ', 'F', 'main/fotos/44.jpg', 'A', 'A', 1),
(45, 'JMUÑOZG', 'c43f1e93bb0963000d848578ede7420a', 'JHANFRANCO_12@HOTMAIL.COM', '46574365', 'JHANFRANCO', 'MUÑOZ', 'GAMBOA', 'F', 'main/fotos/45.jpg', 'A', 'A', 1),
(46, 'ENAVARRETEP', '8ae78086c815a388e19523932196bcd4', 'ELENITA@HOTMAIL.COM', '76574836', 'ELENA', 'NAVARRETE', 'PEREZ', 'F', 'main/fotos/46.jpg', 'A', 'A', 1),
(47, 'ONUREÑAC', '3f0447b1de4900277cff24a59bd519cf', 'ORLAN@HOTMAIL.COM', '45465464', 'ORLANDO', 'NUREÑA', 'CHIGNE', 'M', 'main/fotos/47.jpg', 'A', 'A', 1),
(48, 'JROJASS', 'bb0d79f719c1f75800423320f711bf1c', 'JORGITO@HOTMAIL.COM', '46546456', 'JORGE MANLIO GONZALO', 'ROJAS', 'SEGURA', 'M', 'main/fotos/48.jpg', 'A', 'A', 1),
(49, 'CABANTOQ', '73d23f098921f51637a0f2323398f50c', 'CLUDINIO@HOTMAIL.COM', '46463899', 'CLAUDIO', 'ABANTO', 'QUISPE', 'M', '', 'A', 'A', 3),
(50, 'JBECERRAM', '0738aa686a69588678138f40be6fe4e0', 'JUANIUY@HOTMAIL.COM', '56456465', 'JUAN', 'BECERRA', 'MUÑOZ', 'M', '', 'A', 'A', 3),
(51, 'VAGUILART', '13285600ace6552a3e46a45443012b7f', 'VANE_123@HOTMAIL.COM', '72346329', 'VANESA', 'AGUILAR', 'TORRES', 'F', '', 'A', 'A', 3),
(52, 'MDEPAZMONTOYA', 'c3871d29093951cdbf05908f1eff0c6a', 'MARTINDE_PAZ@HOTMAIL.COM', '45323423', 'MARTIN', 'DE PAZ', 'MONTOYA', 'M', '', 'A', 'A', 3),
(53, 'DESPINOLAV', '687c6f8dac5b554c9bbbdee5dc46d6ca', 'ESPIN_DIEG23@HOTMAIL.COM', '32424242', 'DIEGO', 'ESPINOLA', 'VALLEJO', 'M', '', 'A', 'A', 3),
(54, 'RESPINOZAG', '24a55bbd58e0edc71792af39f48408a7', 'RICARMENDO@HOTMAIL.COM', '23423421', 'RICARDO', 'ESPINOZA', 'GUARNIZ', 'M', '', 'A', 'A', 3),
(55, 'THORNAR', '73e913b63d37e8d72435dbafae8e0a71', 'TERESITA_12@HOTMAIL.COM', '61243641', 'TERESA', 'HORNA', 'RODRIGUEZ', 'F', '', 'A', 'A', 3),
(56, 'GLEONM', 'd0dcada447ed6c0865f2b7a4607f3763', 'GABRILEON@HOTMAIL.COM', '67512381', 'GABRIEL', 'LEON', 'MARQUEZ', 'M', '', 'A', 'A', 3),
(57, 'EOSORIOH', '4d6cc949cdb65b7c3aff6d462c2745a0', 'ERIKK@HOTMAIL.COM', '12423535', 'ERICK', 'OSORIO', 'HUAMAN', 'M', '', 'A', 'A', 3),
(58, 'RESTELITAL', 'c64695cdc9ebbc6e99f2c38e3a705162', 'RINALEZ@HOTMAIL.COM', '14324542', 'RINA', 'ESTELITA', 'LEZAMA', 'F', '', 'A', 'A', 3),
(59, 'MROJASU', '03bca81b5ca792b3e98103ca98fe04b2', 'MARLONROJ@HOTMAIL.COM', '34782383', 'MARLON', 'ROJAS', 'URQUIZO', 'M', '', 'A', 'A', 3),
(60, 'PSANCHEZJ', '3d2fe1d446dbe6446c8dd751e6e386bf', 'PABILTO34@HOTMAIL.COM', '19373748', 'PABLO', 'SANCHEZ', 'JAVEZ', 'M', '', 'A', 'A', 3),
(61, 'ACASTILLOA', '8cf5c293dab0ad1f9e8016afc1ae1e68', 'ANGICAST_22@HOTMAIL.COM', '19646546', 'ANGIE', 'CASTILLO', 'AGUILAR', 'F', 'main/fotos/61.jpg', 'A', 'A', 1),
(62, 'ADEPAZL', 'e1542dd20a72fc1b0d9b9e5587e31e9b', 'ALESSA_64@HOTMAIL.COM', '18493573', 'ALESSANDRA', 'DE PAZ', 'LOPEZ', 'F', 'main/fotos/62.jpg', 'A', 'A', 1),
(63, 'JESPINOLAS', '93cba5a23df8db6d31bcb78f6658189e', 'SEVI_KOT@HOTMAIL.COM', '29834926', 'JEFFERSON', 'ESPINOLA', 'SEVILLANO', 'M', 'main/fotos/63.jpg', 'A', 'A', 1),
(64, 'JESPINOZAM', '03084beea524d479bd0e5be7748968f2', 'JESUSESPI_BROTHER@HOTMAIL.COM', '19831296', 'JESUS', 'ESPINOZA', 'MOZANAPON', 'M', 'main/fotos/64.jpg', 'A', 'A', 1),
(65, 'FHUAMANH', '0d2e928c0c2cf9b07cc8e22e35ecbfbb', 'FABICINIO@HOTMAIL.COM', '12736983', 'FABIO', 'HUAMAN', 'HORNA', 'M', 'main/fotos/65.jpg', 'A', 'A', 1),
(66, 'ALEONM', '5acd90672ad0afb4f69d9bbc05a4ab50', 'ANGHELO1@HOTMAIL.COM', '13142543', 'ANGHELO', 'LEON', 'MEDINA', 'M', 'main/fotos/66.jpg', 'A', 'A', 1),
(67, 'AOSORIOG', 'cc518dfd215076d55e0c94b4d06e929b', '12ANTONIO@HOTMAIL.COM', '23474345', 'ANTONIO', 'OSORIO', 'GUEVARA', 'M', 'main/fotos/67.jpg', 'A', 'A', 1),
(68, 'MRODRIGUEZE', '64b5b02c5d39c73fe2dc6e30e2f2431d', 'MAURI12@HOTMAIL.COM', '12875194', 'MAURICIO', 'RODRIGUEZ', 'ESTELITA', 'M', 'main/fotos/68.jpg', 'A', 'A', 1),
(69, 'MROJASP', 'd1b081e587c6db23a33861712e661f47', 'MICHELIT@HOTMAIL.COM', '32742792', 'MICHEL', 'ROJAS', 'PACAYA', 'M', 'main/fotos/69.jpg', 'A', 'A', 1),
(70, 'RSANCHEZV', '63a6d4d25e575474730cb43f62ad7206', 'RODRIGUITO@HOTMAIL.COM', '45761964', 'RODRIGO', 'SANCHEZ', 'VASQUEZ', 'M', 'main/fotos/70.jpg', 'A', 'A', 1),
(71, 'DABANTOV', 'b85dee1d9e62cb82a3b5f9527cae7130', 'DAVIDABAN@HOTMAIL.COM', '12424534', 'DAVID', 'ABANTO', 'VASQUEZ', 'M', 'main/fotos/71.jpg', 'A', 'A', 1),
(72, 'KBECERRAA', 'be4bb1b343f122e812cdfd04976010b4', 'KBECE22@HOTMAIL.COM', '45724273', 'KEVIN', 'BECERRA', 'ARBAIZA', 'M', 'main/fotos/72.jpg', 'A', 'A', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
