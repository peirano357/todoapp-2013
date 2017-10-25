-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 16-02-2013 a las 05:16:17
-- Versión del servidor: 5.1.36
-- Versión de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `todo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text,
  `status` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `priority` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Volcar la base de datos para la tabla `event`
--

INSERT INTO `event` (`id`, `title`, `status`, `date`, `priority`) VALUES
(1, 'Head to the RPD station, meet Leon and kill some zombies...', 0, '2013-02-21 19:55:30', 1),
(9, 'this is added from pannel', 0, '0000-00-00 00:00:00', 1),
(7, 'Buy 5 boxes of .357 magnum rounds and some HKS speed loaders', 1, '2013-02-13 22:00:48', 2),
(45, 'Buy new batteries for the Nightvision googles', 1, '2013-02-18 13:30:00', 2);
