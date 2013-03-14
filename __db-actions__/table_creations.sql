-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Jeu 14 Mars 2013 à 21:45
-- Version du serveur: 5.1.36
-- Version de PHP: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `smsforever`
--

-- --------------------------------------------------------

--
-- Structure de la table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country` varchar(3) NOT NULL,
  `ind_num` varchar(6) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `country`
--

INSERT INTO `country` (`id`, `country`, `ind_num`, `status`) VALUES
(1, 'CMR', '+237', '1'),
(2, 'CIV', '+225', '1'),
(3, 'GHA', '+233', '1');

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
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `country` varchar(3) NOT NULL,
  `reseau_tel` varchar(3) NOT NULL,
  `registered` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `users`
--

