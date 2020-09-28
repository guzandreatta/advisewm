-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2017 at 10:50 PM
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

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`Id`, `Nombre`, `Apellido`, `CorreoElectronico`, `Contrasena`, `TipoUsuarioId`, `FechaCreacion`, `UsuarioCreacion`, `FechaEdicion`, `UsuarioEdicion`, `Activo`) VALUES
(1, 'Germán', 'Brea', 'german@von-studio.com', 'b7736c6e0fb40cb0b88ba1381ee13109', 1, '2017-05-04 09:34:53', 1, '2017-05-25 17:50:41', NULL, 1),
(2, 'Guzmán', 'Andreatta', 'guzman@von-studio.com', 'e1e45dc9654871a32489f6c5c26f0d34', 1, '2017-05-25 17:47:48', 1, '2017-05-25 17:47:48', NULL, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
