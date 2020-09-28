-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 10:45 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `advisewm`
--
DROP DATABASE IF EXISTS `advisewm`;
CREATE DATABASE IF NOT EXISTS `advisewm` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `advisewm`;

-- --------------------------------------------------------

--
-- Table structure for table `articulo`
--

CREATE TABLE `articulo` (
  `Id` int(11) NOT NULL,
  `IdiomaId` int(11) NOT NULL,
  `Titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `Texto` text COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UsuarioCreacion` int(11) NOT NULL,
  `Orden` int(11) DEFAULT NULL,
  `FechaInicio` datetime DEFAULT NULL,
  `FechaFin` datetime DEFAULT NULL,
  `FechaEdicion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UsuarioEdicion` int(11) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articulomultimedia`
--

CREATE TABLE `articulomultimedia` (
  `Id` int(11) NOT NULL,
  `ArticuloId` int(11) NOT NULL,
  `MultimediaRuta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `TipoMultimediaId` int(1) NOT NULL DEFAULT '1',
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `idioma`
--

CREATE TABLE `idioma` (
  `Id` int(11) NOT NULL,
  `NombreEnEspañol` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `NombreOriginal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `Abreviacion` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `RutaBandera` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `informe`
--

CREATE TABLE `informe` (
  `Id` int(11) NOT NULL,
  `IdiomaId` int(11) NOT NULL,
  `Titulo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UsuarioCreacion` int(11) NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `informemultimedia`
--

CREATE TABLE `informemultimedia` (
  `Id` int(11) NOT NULL,
  `InformeId` int(11) NOT NULL,
  `MultimediaRuta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `TipoMultimediaId` int(1) NOT NULL DEFAULT '1',
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `noticia`
--

CREATE TABLE `noticia` (
  `Id` int(11) NOT NULL,
  `IdiomaId` int(11) NOT NULL,
  `Titulo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `Descripcion` varchar(2000) COLLATE utf8_spanish_ci NOT NULL,
  `Texto` text COLLATE utf8_spanish_ci NOT NULL,
  `FechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UsuarioCreacion` int(11) NOT NULL,
  `Orden` int(11) DEFAULT NULL,
  `FechaInicio` datetime DEFAULT NULL,
  `FechaFin` datetime DEFAULT NULL,
  `FechaEdicion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UsuarioEdicion` int(11) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `noticiamultimedia`
--

CREATE TABLE `noticiamultimedia` (
  `Id` int(11) NOT NULL,
  `NoticiaId` int(11) NOT NULL,
  `MultimediaRuta` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `TipoMultimediaId` int(1) NOT NULL DEFAULT '1',
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tipomultimedia`
--

CREATE TABLE `tipomultimedia` (
  `Id` int(11) NOT NULL,
  `Tipo` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Calidad` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tipousuario`
--

CREATE TABLE `tipousuario` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `Apellido` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `CorreoElectronico` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `Contrasena` varchar(32) COLLATE utf8_spanish_ci NOT NULL,
  `TipoUsuarioId` int(11) NOT NULL DEFAULT '1',
  `FechaCreacion` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UsuarioCreacion` int(11) NOT NULL,
  `FechaEdicion` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UsuarioEdicion` int(11) DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UsuarioCreacion` (`UsuarioCreacion`),
  ADD KEY `UsuarioEdicion` (`UsuarioEdicion`),
  ADD KEY `IdiomaId` (`IdiomaId`);

--
-- Indexes for table `articulomultimedia`
--
ALTER TABLE `articulomultimedia`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `TipoMultimediaId` (`TipoMultimediaId`),
  ADD KEY `ArticuloId` (`ArticuloId`);

--
-- Indexes for table `idioma`
--
ALTER TABLE `idioma`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `informe`
--
ALTER TABLE `informe`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UsuarioCreacion` (`UsuarioCreacion`),
  ADD KEY `IdiomaId` (`IdiomaId`);

--
-- Indexes for table `informemultimedia`
--
ALTER TABLE `informemultimedia`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `TipoMultimediaId` (`TipoMultimediaId`),
  ADD KEY `InformeId` (`InformeId`);

--
-- Indexes for table `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `UsuarioCreacion` (`UsuarioCreacion`),
  ADD KEY `UsuarioEdicion` (`UsuarioEdicion`),
  ADD KEY `IdiomaId` (`IdiomaId`);

--
-- Indexes for table `noticiamultimedia`
--
ALTER TABLE `noticiamultimedia`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `TipoMultimediaId` (`TipoMultimediaId`),
  ADD KEY `NoticiaId` (`NoticiaId`);

--
-- Indexes for table `tipomultimedia`
--
ALTER TABLE `tipomultimedia`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Tipo` (`Tipo`);

--
-- Indexes for table `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `TipoNombre` (`Nombre`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Usuario` (`CorreoElectronico`),
  ADD KEY `Tipo` (`TipoUsuarioId`),
  ADD KEY `UsuarioCreacion` (`UsuarioCreacion`),
  ADD KEY `UsuarioUltimaModificacion` (`UsuarioEdicion`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulo`
--
ALTER TABLE `articulo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `articulomultimedia`
--
ALTER TABLE `articulomultimedia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `idioma`
--
ALTER TABLE `idioma`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `informe`
--
ALTER TABLE `informe`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `informemultimedia`
--
ALTER TABLE `informemultimedia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `noticia`
--
ALTER TABLE `noticia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `noticiamultimedia`
--
ALTER TABLE `noticiamultimedia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipomultimedia`
--
ALTER TABLE `tipomultimedia`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `articulo`
--
ALTER TABLE `articulo`
  ADD CONSTRAINT `articulo_ibfk_1` FOREIGN KEY (`UsuarioCreacion`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `articulo_ibfk_2` FOREIGN KEY (`UsuarioEdicion`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `articulo_ibfk_3` FOREIGN KEY (`IdiomaId`) REFERENCES `idioma` (`Id`);

--
-- Constraints for table `articulomultimedia`
--
ALTER TABLE `articulomultimedia`
  ADD CONSTRAINT `articulomultimedia_ibfk_1` FOREIGN KEY (`ArticuloId`) REFERENCES `articulo` (`Id`),
  ADD CONSTRAINT `articulomultimedia_ibfk_2` FOREIGN KEY (`TipoMultimediaId`) REFERENCES `tipomultimedia` (`Id`);

--
-- Constraints for table `informe`
--
ALTER TABLE `informe`
  ADD CONSTRAINT `informe_ibfk_1` FOREIGN KEY (`UsuarioCreacion`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `informe_ibfk_3` FOREIGN KEY (`IdiomaId`) REFERENCES `idioma` (`Id`);

--
-- Constraints for table `informemultimedia`
--
ALTER TABLE `informemultimedia`
  ADD CONSTRAINT `informemultimedia_ibfk_1` FOREIGN KEY (`InformeId`) REFERENCES `informe` (`Id`);

--
-- Constraints for table `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `noticia_ibfk_1` FOREIGN KEY (`UsuarioCreacion`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `noticia_ibfk_2` FOREIGN KEY (`UsuarioEdicion`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `noticia_ibfk_3` FOREIGN KEY (`IdiomaId`) REFERENCES `idioma` (`Id`);

--
-- Constraints for table `noticiamultimedia`
--
ALTER TABLE `noticiamultimedia`
  ADD CONSTRAINT `noticiamultimedia_ibfk_1` FOREIGN KEY (`NoticiaId`) REFERENCES `noticia` (`Id`),
  ADD CONSTRAINT `noticiamultimedia_ibfk_2` FOREIGN KEY (`TipoMultimediaId`) REFERENCES `tipomultimedia` (`Id`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`TipoUsuarioId`) REFERENCES `tipousuario` (`Id`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`UsuarioCreacion`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`UsuarioEdicion`) REFERENCES `usuario` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
