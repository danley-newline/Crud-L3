-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2019 at 09:54 AM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




/*---------REALISER PAR -------------------



KACOU AKA DANIEL  ABRAHAM
BOYOU GNANDE ROLAND DORGELES
SANOGO MOUNIR
KOFFI AUDREY CAMILLE




*/




---
-- -

-- --------------------------------------------------------

--
-- Table structure for table `users` and matiere
--
"dbname=crudl3";

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `contact` varchar(50) NOT NULL,
  `php` float NOT NULL,
  `math` float NOT NULL,
  `anglais` float NOT NULL,
  `moy` float NOT NULL,
  `picture` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
  
 ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
