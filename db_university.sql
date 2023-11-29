-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 09:34 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `university`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `name`) VALUES
(1, 'Ciencias Computacionales'),
(2, 'Astronomia III'),
(3, 'Anatomia II'),
(5, 'Biologia'),
(6, 'Matematica'),
(7, 'Algebra'),
(8, 'Calculo'),
(9, 'Ingenieria Civil'),
(10, 'Ingenieria Mecanica'),
(11, 'Programacion');

-- --------------------------------------------------------

--
-- Table structure for table `courses_alumnos`
--

CREATE TABLE `courses_alumnos` (
  `course_id` int(11) NOT NULL,
  `alumno_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses_alumnos`
--

INSERT INTO `courses_alumnos` (`course_id`, `alumno_id`) VALUES
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cursos_maestros`
--

CREATE TABLE `cursos_maestros` (
  `course_id` int(11) NOT NULL,
  `maestro_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cursos_maestros`
--

INSERT INTO `cursos_maestros` (`course_id`, `maestro_id`) VALUES
(1, 2),
(2, 5),
(6, 10),
(7, 6),
(8, 11),
(9, 20),
(11, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrador'),
(2, 'Maestro'),
(3, 'Alumno');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `dni` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `dni`, `name`, `email`, `password`, `address`, `birthday`, `role_id`, `estado`) VALUES
(2, '1234838543', 'Harold Carazas', 'maestro@maestro', 'maestro', 'St. Georgia, Av. Principal', '2002-05-25', 2, 'activo'),
(3, '4335643758', 'Paul Herrera', 'alumno@alumno', 'alumno', 'North Pilgrim, Av. Saint George Washington', '2005-04-16', 3, 'activo'),
(4, '5534565645', 'Niver Copa', 'test@test', 'maestro', 'Lima, Av. Los Santos, incorporado', '2003-02-10', 2, 'activo'),
(5, '3535756457', 'Isaias Zuniga', 'test1@test1', 'maestro', 'Sty. Dennis, Casinki', '2002-05-25', 2, 'activo'),
(6, '4674674674', 'Diego Huarsaya', 'diego@diego', 'maestro', 'Peru, quinto piso', '2005-04-16', 2, 'activo'),
(9, '0950042408', 'Administrador', 'admin@admin', 'admin', 'Provenza Residencial', '2003-02-10', 1, 'inactivo'),
(10, '3543543464', 'Jesus Chele', 'jesus@jesus', 'maestro', 'Urdesa Norte', '2004-03-30', 2, 'activo'),
(11, '3542343433', 'Arturo Knezevich', 'arturo@arturo', 'maestro', 'Vergeles por la cuarta encomienda', '1999-10-23', 2, 'activo'),
(12, '231435334', 'Valeria Saenz', 'valeria@valeria', 'alumno', 'Duran norte por donde no hay tierra', '2001-11-22', 3, 'activo'),
(14, '2525345445', 'Gustavo Aquino', 'aquino@aquino', 'maestro', 'Victor Hugo Sicouret y Alberto Nuques', '2008-07-27', 2, 'activo'),
(18, '32542534524', 'Victor Ortiz', 'victor@victor', 'alumno', 'Victor Hugo Sicouret y Alberto Nuques', '2001-11-12', 3, 'activo'),
(20, NULL, 'Jonathan Litardo', 'jonathan@jonathan', NULL, 'Rexburg, Idaho', '2003-01-28', 2, 'activo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses_alumnos`
--
ALTER TABLE `courses_alumnos`
  ADD PRIMARY KEY (`course_id`,`alumno_id`),
  ADD KEY `alumno_id` (`alumno_id`);

--
-- Indexes for table `cursos_maestros`
--
ALTER TABLE `cursos_maestros`
  ADD PRIMARY KEY (`course_id`,`maestro_id`),
  ADD KEY `maestro_id` (`maestro_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `dni` (`dni`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses_alumnos`
--
ALTER TABLE `courses_alumnos`
  ADD CONSTRAINT `courses_alumnos_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `courses_alumnos_ibfk_2` FOREIGN KEY (`alumno_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `cursos_maestros`
--
ALTER TABLE `cursos_maestros`
  ADD CONSTRAINT `cursos_maestros_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `cursos_maestros_ibfk_2` FOREIGN KEY (`maestro_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
