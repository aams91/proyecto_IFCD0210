-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-04-2022 a las 14:19:39
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `pen_arb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entradas`
--

CREATE TABLE `entradas` (
  `id_entrada` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `texto` varchar(1000) DEFAULT NULL,
  `animo` enum('Feliz','Triste','Bien') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `entradas`
--

INSERT INTO `entradas` (`id_entrada`, `id_usuario`, `texto`, `animo`) VALUES
(1, 1, 'Primera entrada.', 'Feliz'),
(2, 1, 'User-friendly reciprocal benchmark', ''),
(5, 1, 'User-centric stable groupware', ''),
(6, 2, 'Inverse reciprocal orchestration', ''),
(7, 3, 'Exclusive global concept', ''),
(8, 4, 'Cloned didactic circuit', ''),
(9, 5, 'Centralized local info-mediaries', ''),
(10, 6, 'Multi-channelled didactic portal', ''),
(11, 7, 'Expanded bottom-line circuit', ''),
(12, 8, 'Face to face system-worthy conglomeration', ''),
(13, 9, 'Monitored coherent monitoring', ''),
(14, 10, 'Business-focused scalable standardization', ''),
(15, 11, 'Networked explicit functionalities', ''),
(16, 12, 'Down-sized methodical success', ''),
(17, 13, 'Versatile object-oriented monitoring', ''),
(18, 14, 'Re-engineered foreground capacity', ''),
(19, 15, 'Robust grid-enabled secured line', ''),
(20, 16, 'Vision-oriented incremental concept', ''),
(21, 17, 'Adaptive interactive artificial intelligence', ''),
(22, 18, 'Balanced content-based workforce', ''),
(23, 19, 'Ergonomic even-keeled contingency', ''),
(24, 20, 'Decentralized bifurcated support', ''),
(25, 21, 'Re-contextualized well-modulated forecast', ''),
(26, 22, 'User-centric multimedia definition', ''),
(27, 23, 'Secured analyzing system engine', ''),
(28, 24, 'Proactive empowering open system', ''),
(29, 25, 'Upgradable mission-critical help-desk', ''),
(30, 26, 'Organized clear-thinking interface', ''),
(31, 27, 'Adaptive asymmetric synergy', ''),
(32, 28, 'Automated eco-centric instruction set', ''),
(33, 29, 'Multi-lateral client-driven attitude', ''),
(34, 30, 'Compatible motivating archive', ''),
(35, 31, 'Progressive bandwidth-monitored neural-net', ''),
(36, 32, 'De-engineered interactive matrix', ''),
(37, 33, 'Multi-lateral attitude-oriented knowledge base', ''),
(38, 34, 'Total tertiary project', ''),
(39, 35, 'Multi-layered stable workforce', ''),
(40, 36, 'Business-focused tertiary attitude', ''),
(41, 37, 'Ameliorated high-level conglomeration', ''),
(42, 38, 'User-friendly homogeneous monitoring', ''),
(43, 39, 'Stand-alone attitude-oriented focus group', ''),
(44, 40, 'Synergistic national functionalities', ''),
(45, 41, 'Phased modular definition', ''),
(46, 42, 'Grass-roots well-modulated focus group', ''),
(47, 43, 'Integrated optimal circuit', ''),
(48, 44, 'Fundamental dedicated flexibility', ''),
(49, 45, 'Advanced 4th generation attitude', ''),
(50, 46, 'Compatible leading edge structure', ''),
(51, 47, 'Switchable uniform initiative', ''),
(52, 48, 'Front-line real-time access', ''),
(53, 49, 'Total systemic attitude', ''),
(54, 50, 'Virtual dynamic groupware', ''),
(55, 2, 'Entrada para ver qué pasa con la vida.', 'Feliz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiquetas`
--

CREATE TABLE `etiquetas` (
  `id_etiqueta` int(11) NOT NULL,
  `nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `etiquetas`
--

INSERT INTO `etiquetas` (`id_etiqueta`, `nombre`) VALUES
(1, 'musica'),
(2, 'compra'),
(3, 'literatura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `etiq_entradas`
--

CREATE TABLE `etiq_entradas` (
  `id_etiq_entrada` int(11) NOT NULL,
  `id_entrada` int(11) NOT NULL,
  `id_etiqueta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `etiq_entradas`
--

INSERT INTO `etiq_entradas` (`id_etiq_entrada`, `id_entrada`, `id_etiqueta`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 55, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `url_imagen` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `nombre`, `clave`, `email`, `url_imagen`) VALUES
(1, 'ams', 'AMS', 'basedatos', 'email@email.com', NULL),
(2, 'ems', 'EMS', 'basedatos', 'email@email.com', NULL),
(3, 'mseedull0', 'Maritsa', 'yuUsFcYSD9', 'mdracey0@homestead.com', 'http://dummyimage.com/250x100.png/5fa2dd/ffffff'),
(4, 'gfinney1', 'Germain', 'zkJ7w2cVm', 'gcanadas1@state.tx.us', 'http://dummyimage.com/104x100.png/dddddd/000000'),
(5, 'rrushbrooke4', 'Rosemarie', 'wcNe8r', 'rhayes4@i2i.jp', 'http://dummyimage.com/118x100.png/5fa2dd/ffffff'),
(6, 'zwhylie5', 'Zorine', 'udjSjAx', 'zlefridge5@flickr.com', 'http://dummyimage.com/246x100.png/dddddd/000000'),
(7, 'dtimblett6', 'Delly', '7iBbXbDdl6pt', 'dmattheus6@ezinearticles.com', 'http://dummyimage.com/215x100.png/5fa2dd/ffffff'),
(8, 'tsnellman7', 'Tonya', 'w42r3Eg0sxh', 'tlerhinan7@sun.com', 'http://dummyimage.com/134x100.png/ff4444/ffffff'),
(9, 'jlaviste8', 'Juli', 'feqfd7d49R1T', 'josherin8@ihg.com', 'http://dummyimage.com/122x100.png/cc0000/ffffff'),
(10, 'mdivina9', 'Meredith', 'erdiqa', 'mby9@cafepress.com', 'http://dummyimage.com/155x100.png/ff4444/ffffff'),
(11, 'dwinborna', 'Denny', 'MQZKqOMF', 'dboudaa@economist.com', 'http://dummyimage.com/160x100.png/dddddd/000000'),
(12, 'gguerinb', 'Gray', 'sWlm6PbQBRu', 'gjosseb@marriott.com', 'http://dummyimage.com/100x100.png/cc0000/ffffff'),
(13, 'thumphreyc', 'Trudi', 'bQU5POx', 'tdoryc@globo.com', 'http://dummyimage.com/215x100.png/ff4444/ffffff'),
(14, 'lalldridged', 'Lucienne', 'rb9u5vJG', 'lpotierd@bbb.org', 'http://dummyimage.com/146x100.png/dddddd/000000'),
(15, 'mwhittame', 'Mandy', 'lbpeG7C', 'mhurndalle@nationalgeographic.com', 'http://dummyimage.com/235x100.png/ff4444/ffffff'),
(16, 'sziemensf', 'Sarita', 'UaaWXVUk8tGw', 'sgaddesf@pbs.org', 'http://dummyimage.com/235x100.png/dddddd/000000'),
(17, 'avegasg', 'Analiese', 'dlznR8m9idJT', 'adimelowg@cdc.gov', 'http://dummyimage.com/149x100.png/dddddd/000000'),
(18, 'lgreenlessh', 'Lynnea', 'VSED8n', 'leelesh@hao123.com', 'http://dummyimage.com/244x100.png/ff4444/ffffff'),
(19, 'docorriganei', 'Daisi', '7JsWdRLT', 'dblazii@myspace.com', 'http://dummyimage.com/202x100.png/ff4444/ffffff'),
(20, 'ehallickj', 'Emalee', '7n0dKp', 'evautinj@google.it', 'http://dummyimage.com/125x100.png/ff4444/ffffff'),
(21, 'dhandasidek', 'Deeann', 'edMp6AUeBin', 'dbarock@icio.us', 'http://dummyimage.com/174x100.png/dddddd/000000'),
(22, 'icranagel', 'Ira', 'CqLQqv1NNJD', 'iodornanl@yolasite.com', 'http://dummyimage.com/142x100.png/dddddd/000000'),
(23, 'dpassom', 'Desdemona', 'OcVZoWtl', 'dmackeigm@sitemeter.com', 'http://dummyimage.com/118x100.png/cc0000/ffffff'),
(24, 'cboamn', 'Courtenay', 'qSP1riBs', 'chickissonn@economist.com', 'http://dummyimage.com/249x100.png/dddddd/000000'),
(25, 'fmurricaneso', 'Fifi', 'oEbxXceK0', 'fcaswallo@g.co', 'http://dummyimage.com/108x100.png/cc0000/ffffff'),
(26, 'cstanbrookep', 'Cindee', 'xDDTyGqD', 'ckittmanp@senate.gov', 'http://dummyimage.com/248x100.png/dddddd/000000'),
(27, 'bmcvicarq', 'Berna', 'BYStvX', 'bfayerbrotherq@vinaora.com', 'http://dummyimage.com/118x100.png/dddddd/000000'),
(28, 'elongstreetr', 'Eolanda', 'V9B1nC', 'ekemmisr@seesaa.net', 'http://dummyimage.com/153x100.png/cc0000/ffffff'),
(29, 'dconews', 'Della', 'jRo9em0F6', 'dleahairs@flavors.me', 'http://dummyimage.com/192x100.png/ff4444/ffffff'),
(30, 'cmorehallt', 'Clarisse', 'cePRkzS', 'ccaddingt@pinterest.com', 'http://dummyimage.com/177x100.png/5fa2dd/ffffff'),
(31, 'lneathwayu', 'Lilian', 'JFwYVO', 'lstoacleyu@parallels.com', 'http://dummyimage.com/198x100.png/5fa2dd/ffffff'),
(32, 'bsclaterv', 'Bobina', 'NL1Yj0', 'bbauserv@1688.com', 'http://dummyimage.com/210x100.png/cc0000/ffffff'),
(33, 'voriganw', 'Veriee', 'OvndFA', 'vblaaschw@samsung.com', 'http://dummyimage.com/155x100.png/dddddd/000000'),
(34, 'egathererx', 'Ediva', 'XhhKLK', 'ematthesiusx@mac.com', 'http://dummyimage.com/157x100.png/cc0000/ffffff'),
(35, 'jtolwoody', 'Jane', 'ckbKrf8XkGGZ', 'jschultzy@list-manage.com', 'http://dummyimage.com/162x100.png/ff4444/ffffff'),
(36, 'jseatterz', 'Jasmin', '9nXx0RHEhgZw', 'jspaldingz@imageshack.us', 'http://dummyimage.com/193x100.png/dddddd/000000'),
(37, 'dcoolbear10', 'Dorthy', 'L7GAkuODUjgh', 'dcolaco10@tuttocitta.it', 'http://dummyimage.com/140x100.png/dddddd/000000'),
(38, 'bbriiginshaw11', 'Bellanca', 'ncROKfk6Iv', 'bbrokenshaw11@nyu.edu', 'http://dummyimage.com/216x100.png/cc0000/ffffff'),
(39, 'kaickin12', 'Kristin', 'YOwOD1SoN', 'kstolze12@nytimes.com', 'http://dummyimage.com/219x100.png/5fa2dd/ffffff'),
(40, 'wtweedlie13', 'Wendi', 'wrS3riOy', 'wpladen13@washingtonpost.com', 'http://dummyimage.com/221x100.png/cc0000/ffffff'),
(41, 'lstarton14', 'Leonanie', '9Ya80f9xkz4t', 'lperrinchief14@sohu.com', 'http://dummyimage.com/151x100.png/cc0000/ffffff'),
(42, 'dtewes15', 'Darrelle', 'JN6CTj', 'dlaweles15@ning.com', 'http://dummyimage.com/193x100.png/dddddd/000000'),
(43, 'lkordt16', 'Licha', 'yuuOhoU6xvuq', 'lpopescu16@usa.gov', 'http://dummyimage.com/238x100.png/dddddd/000000'),
(44, 'mbrowning17', 'Minta', '1zAKQ2DdY', 'mbayldon17@exblog.jp', 'http://dummyimage.com/128x100.png/cc0000/ffffff'),
(45, 'kteresse18', 'Karia', 'p2BwhNXP8', 'ksamwell18@reddit.com', 'http://dummyimage.com/192x100.png/cc0000/ffffff'),
(46, 'cdigiacomo19', 'Corie', 'QacF1GJn', 'cgarrud19@wikispaces.com', 'http://dummyimage.com/181x100.png/5fa2dd/ffffff'),
(47, 'kbarz1a', 'Kellyann', '66fRZBoWHtI', 'koheffernan1a@ibm.com', 'http://dummyimage.com/238x100.png/dddddd/000000'),
(48, 'emcentagart1b', 'Esma', 'nawWahn', 'epicard1b@w3.org', 'http://dummyimage.com/169x100.png/cc0000/ffffff'),
(49, 'kpfeffel1c', 'Kirsten', 'rNbT8VvPgQC', 'kdeme1c@mac.com', 'http://dummyimage.com/140x100.png/cc0000/ffffff'),
(50, 'cjankowski1d', 'Crin', 'awyxCVfEwW', 'cmarch1d@lycos.com', 'http://dummyimage.com/147x100.png/ff4444/ffffff'),
(51, 'mseedull0', 'Maritsa', 'yuUsFcYSD9', 'mdracey0@homestead.com', 'http://dummyimage.com/250x100.png/5fa2dd/ffffff'),
(52, 'gfinney1', 'Germain', 'zkJ7w2cVm', 'gcanadas1@state.tx.us', 'http://dummyimage.com/104x100.png/dddddd/000000'),
(53, 'clittlefield2', 'Cindelyn', '2l28gI4qKu', 'cshiers2@etsy.com', 'http://dummyimage.com/173x100.png/dddddd/000000'),
(54, 'mseedull0', 'Maritsa', 'yuUsFcYSD9', 'mdracey0@homestead.com', 'http://dummyimage.com/250x100.png/5fa2dd/ffffff'),
(55, 'gfinney1', 'Germain', 'zkJ7w2cVm', 'gcanadas1@state.tx.us', 'http://dummyimage.com/104x100.png/dddddd/000000'),
(56, 'clittlefield2', 'Cindelyn', '2l28gI4qKu', 'cshiers2@etsy.com', 'http://dummyimage.com/173x100.png/dddddd/000000'),
(57, 'chillam3', 'Christel', 'gPHw4hHz9', 'cmaccartney3@dedecms.com', 'http://dummyimage.com/166x100.png/ff4444/ffffff'),
(58, 'rrushbrooke4', 'Rosemarie', 'wcNe8r', 'rhayes4@i2i.jp', 'http://dummyimage.com/118x100.png/5fa2dd/ffffff'),
(59, 'zwhylie5', 'Zorine', 'udjSjAx', 'zlefridge5@flickr.com', 'http://dummyimage.com/246x100.png/dddddd/000000'),
(60, 'dtimblett6', 'Delly', '7iBbXbDdl6pt', 'dmattheus6@ezinearticles.com', 'http://dummyimage.com/215x100.png/5fa2dd/ffffff'),
(61, 'tsnellman7', 'Tonya', 'w42r3Eg0sxh', 'tlerhinan7@sun.com', 'http://dummyimage.com/134x100.png/ff4444/ffffff'),
(62, 'jlaviste8', 'Juli', 'feqfd7d49R1T', 'josherin8@ihg.com', 'http://dummyimage.com/122x100.png/cc0000/ffffff'),
(63, 'mdivina9', 'Meredith', 'erdiqa', 'mby9@cafepress.com', 'http://dummyimage.com/155x100.png/ff4444/ffffff'),
(64, 'dwinborna', 'Denny', 'MQZKqOMF', 'dboudaa@economist.com', 'http://dummyimage.com/160x100.png/dddddd/000000'),
(65, 'gguerinb', 'Gray', 'sWlm6PbQBRu', 'gjosseb@marriott.com', 'http://dummyimage.com/100x100.png/cc0000/ffffff'),
(66, 'thumphreyc', 'Trudi', 'bQU5POx', 'tdoryc@globo.com', 'http://dummyimage.com/215x100.png/ff4444/ffffff'),
(67, 'lalldridged', 'Lucienne', 'rb9u5vJG', 'lpotierd@bbb.org', 'http://dummyimage.com/146x100.png/dddddd/000000'),
(68, 'mwhittame', 'Mandy', 'lbpeG7C', 'mhurndalle@nationalgeographic.com', 'http://dummyimage.com/235x100.png/ff4444/ffffff'),
(69, 'sziemensf', 'Sarita', 'UaaWXVUk8tGw', 'sgaddesf@pbs.org', 'http://dummyimage.com/235x100.png/dddddd/000000'),
(70, 'avegasg', 'Analiese', 'dlznR8m9idJT', 'adimelowg@cdc.gov', 'http://dummyimage.com/149x100.png/dddddd/000000'),
(71, 'lgreenlessh', 'Lynnea', 'VSED8n', 'leelesh@hao123.com', 'http://dummyimage.com/244x100.png/ff4444/ffffff'),
(72, 'docorriganei', 'Daisi', '7JsWdRLT', 'dblazii@myspace.com', 'http://dummyimage.com/202x100.png/ff4444/ffffff'),
(73, 'ehallickj', 'Emalee', '7n0dKp', 'evautinj@google.it', 'http://dummyimage.com/125x100.png/ff4444/ffffff'),
(74, 'dhandasidek', 'Deeann', 'edMp6AUeBin', 'dbarock@icio.us', 'http://dummyimage.com/174x100.png/dddddd/000000'),
(75, 'icranagel', 'Ira', 'CqLQqv1NNJD', 'iodornanl@yolasite.com', 'http://dummyimage.com/142x100.png/dddddd/000000'),
(76, 'dpassom', 'Desdemona', 'OcVZoWtl', 'dmackeigm@sitemeter.com', 'http://dummyimage.com/118x100.png/cc0000/ffffff'),
(77, 'cboamn', 'Courtenay', 'qSP1riBs', 'chickissonn@economist.com', 'http://dummyimage.com/249x100.png/dddddd/000000'),
(78, 'fmurricaneso', 'Fifi', 'oEbxXceK0', 'fcaswallo@g.co', 'http://dummyimage.com/108x100.png/cc0000/ffffff'),
(79, 'cstanbrookep', 'Cindee', 'xDDTyGqD', 'ckittmanp@senate.gov', 'http://dummyimage.com/248x100.png/dddddd/000000'),
(80, 'bmcvicarq', 'Berna', 'BYStvX', 'bfayerbrotherq@vinaora.com', 'http://dummyimage.com/118x100.png/dddddd/000000'),
(81, 'elongstreetr', 'Eolanda', 'V9B1nC', 'ekemmisr@seesaa.net', 'http://dummyimage.com/153x100.png/cc0000/ffffff'),
(82, 'dconews', 'Della', 'jRo9em0F6', 'dleahairs@flavors.me', 'http://dummyimage.com/192x100.png/ff4444/ffffff'),
(83, 'cmorehallt', 'Clarisse', 'cePRkzS', 'ccaddingt@pinterest.com', 'http://dummyimage.com/177x100.png/5fa2dd/ffffff'),
(84, 'lneathwayu', 'Lilian', 'JFwYVO', 'lstoacleyu@parallels.com', 'http://dummyimage.com/198x100.png/5fa2dd/ffffff'),
(85, 'bsclaterv', 'Bobina', 'NL1Yj0', 'bbauserv@1688.com', 'http://dummyimage.com/210x100.png/cc0000/ffffff'),
(86, 'voriganw', 'Veriee', 'OvndFA', 'vblaaschw@samsung.com', 'http://dummyimage.com/155x100.png/dddddd/000000'),
(87, 'egathererx', 'Ediva', 'XhhKLK', 'ematthesiusx@mac.com', 'http://dummyimage.com/157x100.png/cc0000/ffffff'),
(88, 'jtolwoody', 'Jane', 'ckbKrf8XkGGZ', 'jschultzy@list-manage.com', 'http://dummyimage.com/162x100.png/ff4444/ffffff'),
(89, 'jseatterz', 'Jasmin', '9nXx0RHEhgZw', 'jspaldingz@imageshack.us', 'http://dummyimage.com/193x100.png/dddddd/000000'),
(90, 'dcoolbear10', 'Dorthy', 'L7GAkuODUjgh', 'dcolaco10@tuttocitta.it', 'http://dummyimage.com/140x100.png/dddddd/000000'),
(91, 'bbriiginshaw11', 'Bellanca', 'ncROKfk6Iv', 'bbrokenshaw11@nyu.edu', 'http://dummyimage.com/216x100.png/cc0000/ffffff'),
(92, 'kaickin12', 'Kristin', 'YOwOD1SoN', 'kstolze12@nytimes.com', 'http://dummyimage.com/219x100.png/5fa2dd/ffffff'),
(93, 'wtweedlie13', 'Wendi', 'wrS3riOy', 'wpladen13@washingtonpost.com', 'http://dummyimage.com/221x100.png/cc0000/ffffff'),
(94, 'lstarton14', 'Leonanie', '9Ya80f9xkz4t', 'lperrinchief14@sohu.com', 'http://dummyimage.com/151x100.png/cc0000/ffffff'),
(95, 'dtewes15', 'Darrelle', 'JN6CTj', 'dlaweles15@ning.com', 'http://dummyimage.com/193x100.png/dddddd/000000'),
(96, 'lkordt16', 'Licha', 'yuuOhoU6xvuq', 'lpopescu16@usa.gov', 'http://dummyimage.com/238x100.png/dddddd/000000'),
(97, 'mbrowning17', 'Minta', '1zAKQ2DdY', 'mbayldon17@exblog.jp', 'http://dummyimage.com/128x100.png/cc0000/ffffff'),
(98, 'kteresse18', 'Karia', 'p2BwhNXP8', 'ksamwell18@reddit.com', 'http://dummyimage.com/192x100.png/cc0000/ffffff'),
(99, 'cdigiacomo19', 'Corie', 'QacF1GJn', 'cgarrud19@wikispaces.com', 'http://dummyimage.com/181x100.png/5fa2dd/ffffff'),
(100, 'kbarz1a', 'Kellyann', '66fRZBoWHtI', 'koheffernan1a@ibm.com', 'http://dummyimage.com/238x100.png/dddddd/000000'),
(101, 'emcentagart1b', 'Esma', 'nawWahn', 'epicard1b@w3.org', 'http://dummyimage.com/169x100.png/cc0000/ffffff'),
(102, 'kpfeffel1c', 'Kirsten', 'rNbT8VvPgQC', 'kdeme1c@mac.com', 'http://dummyimage.com/140x100.png/cc0000/ffffff'),
(103, 'cjankowski1d', 'Crin', 'awyxCVfEwW', 'cmarch1d@lycos.com', 'http://dummyimage.com/147x100.png/ff4444/ffffff');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD PRIMARY KEY (`id_entrada`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- Indices de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  ADD PRIMARY KEY (`id_etiqueta`);

--
-- Indices de la tabla `etiq_entradas`
--
ALTER TABLE `etiq_entradas`
  ADD PRIMARY KEY (`id_etiq_entrada`),
  ADD KEY `fk1_entradas` (`id_entrada`),
  ADD KEY `fk2_etiquetas` (`id_etiqueta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `entradas`
--
ALTER TABLE `entradas`
  MODIFY `id_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `etiquetas`
--
ALTER TABLE `etiquetas`
  MODIFY `id_etiqueta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `etiq_entradas`
--
ALTER TABLE `etiq_entradas`
  MODIFY `id_etiq_entrada` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `entradas`
--
ALTER TABLE `entradas`
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `etiq_entradas`
--
ALTER TABLE `etiq_entradas`
  ADD CONSTRAINT `fk1_entradas` FOREIGN KEY (`id_entrada`) REFERENCES `entradas` (`id_entrada`),
  ADD CONSTRAINT `fk2_etiquetas` FOREIGN KEY (`id_etiqueta`) REFERENCES `etiquetas` (`id_etiqueta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
