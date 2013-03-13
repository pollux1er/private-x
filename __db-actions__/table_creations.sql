-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 13 Mars 2013 à 20:49
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `smsforever`
--

-- --------------------------------------------------------

--
-- Structure de la table `sms`
--

CREATE TABLE IF NOT EXISTS `sms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_em` int(11) NOT NULL,
  `num_tel_em` varchar(15) NOT NULL,
  `num_tel_recep` varchar(15) NOT NULL,
  `message` varchar(255) NOT NULL,
  `error_status` varchar(255) NOT NULL,
  `adr_ip_em` varchar(12) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `sms`
--


-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) NOT NULL,
  `passwd` varchar(50) NOT NULL,
  `num_tel` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `country` varchar(3) NOT NULL,
  `reseau_tel` varchar(3) NOT NULL,
  `registered` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `users`
--

