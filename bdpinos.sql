-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 28-11-2011 a las 04:14:52
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `apoderados`
--

CREATE TABLE IF NOT EXISTS `apoderados` (
  `iApodIdApoderado` int(11) NOT NULL AUTO_INCREMENT,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  PRIMARY KEY (`iApodIdApoderado`),
  KEY `fk_Apoderados_Usuarios1` (`Usuarios_iUsuIdUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `apoderados`
--

INSERT INTO `apoderados` (`iApodIdApoderado`, `Usuarios_iUsuIdUsuario`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 15),
(10, 16);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`iCursIdCursos`, `vCursNombreCurso`, `tiCursActivo`, `dCursFechaCreacion`, `iCursDescripcion`, `Seccion_iSeccIdSeccion`) VALUES
(2, 'MATEMATICA', 'A', 1322272090, 'MATEMATICA BASICA', 20),
(3, 'MATEMATICA', 'A', 1322272110, 'MATEMATICA BASICA', 22),
(4, 'MATEMATICA', 'A', 1322272603, 'MATEMATICA BASICA', 22),
(5, 'MATEMATICA', 'A', 1322272845, 'MATEMATICA BASICA', 11),
(6, 'COMUNICACION', 'A', 1322278238, 'INTEGRAL', 20),
(7, 'PERSONAL SOCIAL', 'I', 1322289316, 'GEOGRAFIA', 20),
(8, 'PERSONAL SOCIAL', 'A', 1322289325, 'GEOGRAFIA', 22),
(9, 'PERSONAL SOCIAL', 'A', 1322289348, 'GEOGRAFIA', 11),
(10, 'INGLES', 'A', 1322289370, 'SPANGLSH', 12),
(11, 'COMPUTO', 'A', 1322289422, 'PC', 12),
(12, 'RELIGION', 'A', 1322290268, 'RELIGION', 20),
(13, 'FILOSOFIA', 'A', 1322301544, 'FILOS SOFIA ', 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursosusuarios`
--

CREATE TABLE IF NOT EXISTS `cursosusuarios` (
  `Cursos_iCursIdCursos` int(11) NOT NULL,
  `Usuarios_iUsuIdUsuario` int(11) NOT NULL,
  `tiCursUsuActivo` tinyint(1) DEFAULT NULL,
  `tiCursUsuCompletado` tinyint(1) DEFAULT NULL,
  `tiCursUsuPorcentaje` tinyint(2) DEFAULT NULL,
  `tiCursUsuCalificacion` tinyint(2) DEFAULT NULL,
  `tiCursUsuIniciado` int(10) DEFAULT NULL,
  `tiCursUsuFinalizado` int(10) DEFAULT NULL,
  PRIMARY KEY (`Cursos_iCursIdCursos`,`Usuarios_iUsuIdUsuario`),
  KEY `fk_CursosUsuarios_Usuarios1` (`Usuarios_iUsuIdUsuario`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `docentes`
--

INSERT INTO `docentes` (`iDocIdDocentes`, `tDocEspecialidad`, `Usuarios_iUsuIdUsuario`) VALUES
(1, 'CSS 3 CSS 6', 17);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Volcado de datos para la tabla `grado`
--

INSERT INTO `grado` (`iGradoIdGrado`, `vGradoDescripcion`, `tiGradoEstado`, `PeriodoAcademico_iPerAcaIdPeriodoAcademico`) VALUES
(1, 'PRIMERO', 'I', 6),
(2, 'SEGUNDO', 'I', 6),
(3, 'TERCERO', 'I', 6),
(4, 'CUARTO', 'A', 6),
(5, 'QUINTO', 'A', 6),
(6, 'SEXTO', 'I', 6);

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=160 ;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`iLogIdLog`, `iUsuIdUsuario`, `iLogTimeStamp`, `cAcciIdAccion`) VALUES
(1, 5, 1322272574, 'B'),
(2, NULL, 1322272578, 'B'),
(3, NULL, 1322272578, 'B'),
(4, NULL, 1322272579, 'B'),
(5, NULL, 1322272579, 'B'),
(6, NULL, 1322272583, 'B'),
(7, NULL, 1322272583, 'B'),
(8, NULL, 1322272586, 'B'),
(9, NULL, 1322272586, 'B'),
(10, 5, 1322272589, 'A'),
(11, 5, 1322272787, 'B'),
(12, NULL, 1322272792, 'B'),
(13, NULL, 1322272792, 'B'),
(14, 5, 1322272796, 'A'),
(15, NULL, 1322276009, 'B'),
(16, 5, 1322276013, 'A'),
(17, 5, 1322277281, 'B'),
(18, NULL, 1322277288, 'B'),
(19, NULL, 1322277288, 'B'),
(20, NULL, 1322277373, 'B'),
(21, NULL, 1322277373, 'B'),
(22, NULL, 1322277379, 'B'),
(23, NULL, 1322277380, 'B'),
(24, 5, 1322277506, 'A'),
(25, 5, 1322278206, 'B'),
(26, 5, 1322278210, 'A'),
(27, NULL, 1322289289, 'B'),
(28, NULL, 1322289291, 'B'),
(29, NULL, 1322289291, 'B'),
(30, 5, 1322289294, 'A'),
(31, 5, 1322289990, 'B'),
(32, 5, 1322289993, 'A'),
(33, 5, 1322291199, 'B'),
(34, 5, 1322291203, 'A'),
(35, 5, 1322291981, 'B'),
(36, 5, 1322291986, 'A'),
(37, 5, 1322292394, 'B'),
(38, 5, 1322292398, 'A'),
(39, NULL, 1322292404, 'B'),
(40, NULL, 1322292404, 'B'),
(41, 5, 1322292845, 'B'),
(42, 5, 1322292852, 'A'),
(43, 5, 1322294626, 'B'),
(44, 5, 1322294632, 'A'),
(45, 5, 1322294916, 'B'),
(46, 5, 1322294922, 'A'),
(47, 5, 1322296173, 'B'),
(48, 5, 1322296176, 'A'),
(49, 5, 1322296547, 'B'),
(50, 5, 1322296553, 'A'),
(51, 5, 1322297204, 'B'),
(52, 5, 1322297209, 'A'),
(53, 5, 1322297666, 'B'),
(54, 5, 1322297673, 'A'),
(55, 5, 1322298487, 'B'),
(56, 5, 1322298490, 'A'),
(57, 5, 1322299013, 'B'),
(58, 5, 1322299018, 'A'),
(59, 5, 1322299676, 'B'),
(60, 5, 1322299679, 'A'),
(61, 5, 1322300415, 'B'),
(62, NULL, 1322300604, 'B'),
(63, NULL, 1322300604, 'B'),
(64, 5, 1322300608, 'A'),
(65, 5, 1322300953, 'B'),
(66, 5, 1322300958, 'A'),
(67, 5, 1322302700, 'B'),
(68, 5, 1322302704, 'A'),
(69, 5, 1322303197, 'B'),
(70, 5, 1322303206, 'A'),
(71, 5, 1322303637, 'B'),
(72, 5, 1322303640, 'A'),
(73, 5, 1322303931, 'B'),
(74, 5, 1322303935, 'A'),
(75, 5, 1322304884, 'B'),
(76, 5, 1322304888, 'A'),
(77, 5, 1322306729, 'B'),
(78, 5, 1322306733, 'A'),
(79, 5, 1322307070, 'B'),
(80, NULL, 1322307072, 'B'),
(81, NULL, 1322307074, 'B'),
(82, 5, 1322307077, 'A'),
(83, 5, 1322307279, 'B'),
(84, 5, 1322307282, 'A'),
(85, 5, 1322307891, 'B'),
(86, 5, 1322307894, 'A'),
(87, 5, 1322308426, 'B'),
(88, 5, 1322308429, 'A'),
(89, 5, 1322309056, 'B'),
(90, 5, 1322309205, 'A'),
(91, 5, 1322309974, 'B'),
(92, 5, 1322309977, 'A'),
(93, 5, 1322310453, 'B'),
(94, 5, 1322310456, 'A'),
(95, 5, 1322311983, 'B'),
(96, 5, 1322311986, 'A'),
(97, NULL, 1322331979, 'B'),
(98, 5, 1322331983, 'A'),
(99, 5, 1322332466, 'B'),
(100, 5, 1322332470, 'A'),
(101, 5, 1322332867, 'B'),
(102, 5, 1322332871, 'A'),
(103, 5, 1322424041, 'A'),
(104, NULL, 1322431071, 'B'),
(105, NULL, 1322431130, 'B'),
(106, 5, 1322431134, 'A'),
(107, 5, 1322431776, 'B'),
(108, 5, 1322431780, 'A'),
(109, NULL, 1322444214, 'B'),
(110, 5, 1322444218, 'A'),
(111, 5, 1322444674, 'B'),
(112, 5, 1322444678, 'A'),
(113, 5, 1322445517, 'B'),
(114, 5, 1322445520, 'A'),
(115, NULL, 1322445550, 'B'),
(116, NULL, 1322445550, 'B'),
(117, 5, 1322445831, 'B'),
(118, 5, 1322445833, 'A'),
(119, 5, 1322446205, 'A'),
(120, 5, 1322446223, 'B'),
(121, 5, 1322446230, 'A'),
(122, 5, 1322446428, 'B'),
(123, 5, 1322446431, 'A'),
(124, NULL, 1322450445, 'B'),
(125, 5, 1322450449, 'A'),
(126, 5, 1322450760, 'B'),
(127, 5, 1322450765, 'A'),
(128, 5, 1322451471, 'B'),
(129, 5, 1322451474, 'A'),
(130, NULL, 1322454694, 'B'),
(131, 5, 1322454698, 'A'),
(132, 5, 1322455637, 'B'),
(133, 5, 1322458251, 'A'),
(134, 5, 1322458670, 'B'),
(135, 5, 1322458674, 'A'),
(136, 5, 1322459027, 'B'),
(137, 5, 1322459030, 'A'),
(138, NULL, 1322462775, 'B'),
(139, 5, 1322462778, 'A'),
(140, 5, 1322463432, 'B'),
(141, 5, 1322464638, 'A'),
(142, 5, 1322464700, 'B'),
(143, 5, 1322464703, 'A'),
(144, 5, 1322466133, 'B'),
(145, 5, 1322466191, 'A'),
(146, 5, 1322466513, 'B'),
(147, 5, 1322466518, 'A'),
(148, 5, 1322467400, 'B'),
(149, 5, 1322467404, 'A'),
(150, 5, 1322467915, 'B'),
(151, 5, 1322467918, 'A'),
(152, 5, 1322468724, 'B'),
(153, 5, 1322468727, 'A'),
(154, 5, 1322469126, 'B'),
(155, 5, 1322469129, 'A'),
(156, 5, 1322469924, 'B'),
(157, 5, 1322469928, 'A'),
(158, 5, 1322470127, 'B'),
(159, 5, 1322470130, 'A');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `periodoacademico`
--

INSERT INTO `periodoacademico` (`iPerAcaIdPeriodoAcademico`, `vPerAcaDescripcion`, `cPerAcaEstado`) VALUES
(1, '2010', 'I'),
(6, '2011', 'A');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `seccion`
--

INSERT INTO `seccion` (`iSeccIdSeccion`, `vSeccDescripcion`, `tiSeccEstado`, `Grado_iGradoIdGrado`) VALUES
(11, 'A', 'A', 4),
(12, 'B', 'A', 4),
(13, 'A', 'A', 5),
(30, 'C', 'A', 5),
(20, 'B', 'I', 5);

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
  `vUsuUsuario` varchar(100) DEFAULT NULL,
  `vUsuClave` varchar(100) DEFAULT NULL,
  `vUsuEmail` varchar(150) DEFAULT NULL,
  `cUsuDni` char(8) DEFAULT NULL,
  `vUsuNombre` varchar(100) DEFAULT NULL,
  `vUsuApellidoPat` varchar(100) DEFAULT NULL,
  `vUsuApellidoMat` varchar(100) DEFAULT NULL,
  `cUsuActivo` char(1) DEFAULT NULL,
  `cUsuEstado` char(1) DEFAULT NULL,
  `TipoUsuario_iTiUsuarioIdTipoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`iUsuIdUsuario`),
  KEY `fk_Usuarios_TipoUsuario1` (`TipoUsuario_iTiUsuarioIdTipoUsuario`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`iUsuIdUsuario`, `vUsuUsuario`, `vUsuClave`, `vUsuEmail`, `cUsuDni`, `vUsuNombre`, `vUsuApellidoPat`, `vUsuApellidoMat`, `cUsuActivo`, `cUsuEstado`, `TipoUsuario_iTiUsuarioIdTipoUsuario`) VALUES
(1, 'josuete', '7ed929c1eeb28ed36a931836ddaa0a44', 'josue_11_12t@hotmail.com', '46693577', 'Josue', 'Tello', 'Villarruel', 'A', 'A', 1),
(2, 'director', 'db066a6af94e2614fecf7d205d63c179', 'director@lospinos.com', '76545627', 'Jose', 'Vinces', 'Ortiz', 'A', 'A', 4),
(3, 'profesor', 'baa9f955892a187ee1def7023d30093f', 'profesormate@lospinos.com', '45672854', 'Luis', 'Salazar', 'Lombardi', 'A', 'A', 2),
(4, 'apoderado', '1819cd1bd048e099a9acfffd3b6b62ad', 'apoderado@lospinos.com', '38726534', 'Jose', 'Puma', 'Carranza', 'A', 'A', 3),
(5, 'admin', 'f6a8b6531daad1c669801431eb7dac83', 'admin@lospinos.com', '46683762', 'El Padre', 'El Hijo', 'El Espiritu Santo. Amen', 'A', 'A', 5),
(6, 'JTELLOR', 'bf8334845ac0ada523f1ff8dd11c1b31', 'RENZOT_7@HOTMAIL.COM', '17918476', 'JOSE', 'TELLO', 'RODRIGUEZ', 'A', 'A', 3),
(7, 'JTELLITOS', 'ff025cd491d2ca4a8318ef874fae8878', 'RENZOT_7@HOTMAIL.COM', '17918476', 'JOSE', 'TELLO', 'RODRIGUEZ', 'A', 'A', 3),
(8, 'JTELLITOS', 'ff025cd491d2ca4a8318ef874fae8878', 'RENZOT_7@HOTMAIL.COM', '17918476', 'JOSE', 'TELLO', 'RODRIGUEZ', 'A', 'A', 3),
(9, 'JTELLITOS', 'ff025cd491d2ca4a8318ef874fae8878', 'RENZOT_7@HOTMAIL.COM', '17918476', 'JOSE', 'TELLO', 'RODRIGUEZ', 'A', 'A', 3),
(10, 'JCARTAVIOL', '7574cf44f835835e86606dd278e80e6e', 'RENZOT_7@HOTMAIL.COM', '12345678', 'JUAN', 'CARTAVIO', 'SANCHEZ', 'A', 'A', 3),
(11, 'FGILIP', '31c81171b5d1da4936661ad3f9a06e3a', 'FABICHULO@HOTMAIL.COM', '12345678', 'FABIAN', 'GILII', 'POLLAS', 'A', 'A', 3),
(12, 'EPINTADOE', 'ecbeb15c8d10e9542942573737f3a4b1', 'ERIKCITO@HOTMAIL.COM', '12345677', 'ERIK', 'PINTADO', 'ESTELA', 'A', 'A', 3),
(13, 'VASMATM', '6f520cba197dcccd087de86c8f36a9d5', 'GAIETIN@HOTM.COM', '87654321', 'VLADIMIR', 'ASMAT', 'MEREGILDO', 'A', 'A', 3),
(14, 'CACUNAP', '4baed9b5c51d1d574bdf4c397fbc0bb4', 'CESITAR@APP.COM', '12345672', 'CESAR', 'ACUÃ‘A', 'PERALTA', 'A', 'A', 3),
(15, 'CACUNAP', '4baed9b5c51d1d574bdf4c397fbc0bb4', 'CESITAR@APP.COM', '12345672', 'CESAR', 'ACUÃ‘A', 'PERALTA', 'A', 'A', 3),
(16, 'CPERALTA', 'fc387559daacc15f73a6a88b0722a1f8', 'FABICHULO@HOTMAIL.COM', '29836745', 'JOSE', 'ACUÃ±A', 'PERALTA', 'A', 'A', 3),
(17, 'RMENDOZA', 'ae6a1ad6f48f3725d6d7bf8cfd3a9222', 'FABICHULO@HOTMAIL.COM', '84736256', 'RICARDO', 'MENDOZA', 'DE LOS SANTOS', 'A', 'A', 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
