-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-12-2011 a las 04:24:13
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

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
(49, '', 'ren', 'hola', '2011-11-25 04:34:19', 0);

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
(5, 'COMUNICACION', 'I', 1322697775, 'CASTELLANO', 4),
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
(4, 3, 'A', NULL, NULL, NULL, 1322728412);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=106 ;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`iLogIdLog`, `iUsuIdUsuario`, `iLogTimeStamp`, `cAcciIdAccion`) VALUES
(1, 5, 1322694157, 'B'),
(2, 1, 1322694161, 'A'),
(3, 1, 1322694165, 'B'),
(4, NULL, 1322694170, 'B'),
(5, 1, 1322694175, 'A'),
(6, 1, 1322695042, 'B'),
(7, 1, 1322695045, 'A'),
(8, 1, 1322695912, 'B'),
(9, 1, 1322695916, 'A'),
(10, 1, 1322698877, 'B'),
(11, 1, 1322698881, 'A'),
(12, 1, 1322699199, 'B'),
(13, 1, 1322699204, 'A'),
(14, 1, 1322699421, 'B'),
(15, 1, 1322699425, 'A'),
(16, 1, 1322700280, 'B'),
(17, 1, 1322700284, 'A'),
(18, 1, 1322700601, 'B'),
(19, 1, 1322700604, 'A'),
(20, 1, 1322702330, 'B'),
(21, 1, 1322702335, 'A'),
(22, 1, 1322702694, 'B'),
(23, 1, 1322702705, 'A'),
(24, NULL, 1322702725, 'B'),
(25, NULL, 1322702725, 'B'),
(26, 1, 1322703246, 'B'),
(27, 1, 1322703256, 'A'),
(28, 1, 1322704107, 'B'),
(29, NULL, 1322704113, 'A'),
(30, NULL, 1322704284, 'A'),
(31, NULL, 1322704441, 'A'),
(32, NULL, 1322704500, 'A'),
(33, NULL, 1322704576, 'A'),
(34, NULL, 1322704659, 'A'),
(35, NULL, 1322704718, 'A'),
(36, NULL, 1322704860, 'A'),
(37, NULL, 1322704909, 'A'),
(38, NULL, 1322704984, 'B'),
(39, 1, 1322704987, 'A'),
(40, 1, 1322705993, 'B'),
(41, 1, 1322706070, 'A'),
(42, 1, 1322706377, 'B'),
(43, 1, 1322706461, 'A'),
(44, 1, 1322706685, 'B'),
(45, 1, 1322706688, 'A'),
(46, 1, 1322708656, 'B'),
(47, 1, 1322708658, 'A'),
(48, 1, 1322709579, 'B'),
(49, 1, 1322709582, 'A'),
(50, 1, 1322711847, 'B'),
(51, 1, 1322711849, 'A'),
(52, 1, 1322712835, 'B'),
(53, 1, 1322712838, 'A'),
(54, 1, 1322713743, 'B'),
(55, 1, 1322713749, 'A'),
(56, 1, 1322714532, 'B'),
(57, 1, 1322714539, 'A'),
(58, 1, 1322714851, 'B'),
(59, 1, 1322714855, 'A'),
(60, 1, 1322716196, 'B'),
(61, NULL, 1322716199, 'B'),
(62, NULL, 1322716199, 'B'),
(63, 1, 1322716204, 'A'),
(64, 1, 1322716717, 'B'),
(65, 1, 1322716722, 'A'),
(66, 1, 1322717234, 'B'),
(67, 1, 1322717241, 'A'),
(68, 1, 1322717704, 'B'),
(69, 1, 1322717708, 'A'),
(70, 1, 1322718358, 'B'),
(71, 1, 1322718362, 'A'),
(72, 1, 1322718628, 'B'),
(73, NULL, 1322718630, 'B'),
(74, NULL, 1322718630, 'B'),
(75, NULL, 1322718632, 'B'),
(76, NULL, 1322718632, 'B'),
(77, 1, 1322718638, 'A'),
(78, 1, 1322718876, 'B'),
(79, 1, 1322718884, 'A'),
(80, 1, 1322720697, 'B'),
(81, 1, 1322720703, 'A'),
(82, 1, 1322721635, 'B'),
(83, 1, 1322721640, 'A'),
(84, 1, 1322722159, 'B'),
(85, 1, 1322722165, 'A'),
(86, 1, 1322722547, 'B'),
(87, 1, 1322722552, 'A'),
(88, 1, 1322723492, 'B'),
(89, 1, 1322723498, 'A'),
(90, 1, 1322724821, 'B'),
(91, 1, 1322724827, 'A'),
(92, 1, 1322725729, 'B'),
(93, 1, 1322725734, 'A'),
(94, 1, 1322726340, 'B'),
(95, NULL, 1322726340, 'B'),
(96, NULL, 1322726340, 'B'),
(97, NULL, 1322726342, 'B'),
(98, NULL, 1322726342, 'B'),
(99, 1, 1322726346, 'A'),
(100, 1, 1322727158, 'B'),
(101, 1, 1322727182, 'A'),
(102, 1, 1322728322, 'B'),
(103, 1, 1322728337, 'A'),
(104, 1, 1322730426, 'B'),
(105, 1, 1322730434, 'A');

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
  PRIMARY KEY (`iPerAcaIdPeriodoAcademico`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `periodoacademico`
--

INSERT INTO `periodoacademico` (`iPerAcaIdPeriodoAcademico`, `vPerAcaDescripcion`, `cPerAcaEstado`) VALUES
(1, '2011', 'A');

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
