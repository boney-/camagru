-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 14 Mars 2016 à 16:44
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `camagru`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `photo_id` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2056 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `photo_id`, `comment`, `created_at`) VALUES
(2035, 2, 1, 'Premier commentaire', '2016-03-14 06:23:22'),
(2036, 2, 1, 'Deuxieme comentaire avec des br\npour faire jolie ahahah\nhihi\nhoho\n', '2016-03-14 06:23:44'),
(2037, 2, 1, 'les br ne sont pas prit en compte rip', '2016-03-14 06:24:03'),
(2038, 2, 1, 'Tres joli chat btw!', '2016-03-14 06:24:16'),
(2039, 2, 1, 'test', '2016-03-14 06:43:00'),
(2040, 2, 1, 'retest', '2016-03-14 06:43:12'),
(2041, 2, 1, 'test', '2016-03-14 06:45:12'),
(2042, 2, 1, 'test', '2016-03-14 06:56:17'),
(2043, 2, 1, 'retest', '2016-03-14 06:56:21'),
(2044, 2, 2, 'test', '2016-03-14 06:56:26'),
(2045, 2, 2, 'tres beau chat!', '2016-03-14 06:56:33'),
(2046, 2, 4, 'nice cat!', '2016-03-14 07:28:14'),
(2047, 2, 3, 'Shocked huehuehue', '2016-03-14 07:31:00'),
(2048, 2, 3, 'ow really *-*', '2016-03-14 11:38:30'),
(2049, 2, 3, 'tto\n', '2016-03-14 13:43:46'),
(2050, 2, 3, '.\n', '2016-03-14 13:44:20'),
(2051, 2, 3, '<b>toto</b>', '2016-03-14 13:50:08'),
(2052, 2, 3, '<i>toto</i>', '2016-03-14 13:50:26'),
(2053, 2, 3, '&lt;i&gt;tito&lt;/i&gt;', '2016-03-14 13:52:26'),
(2054, 2, 3, 'erg', '2016-03-14 14:14:38'),
(2055, 2, 3, 'v', '2016-03-14 15:17:53');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `url` varchar(250) NOT NULL,
  `url_mini` varchar(250) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `like_count` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `photo`
--

INSERT INTO `photo` (`id`, `user_id`, `url`, `url_mini`, `title`, `description`, `created_at`, `like_count`) VALUES
(1, 2, 'img/img1.jpg', 'mini/minitoto.jpg', 'TITRE PHOTO 1', 'toto fait popo', '2016-03-09 00:00:00', 2),
(2, 1, 'img/img0.jpg', 'mini tata', 'TITRE PHOTO 0', 'Tata fait un gateau', '2016-03-11 00:00:00', 2),
(3, 2, 'img/img2.jpg', 'img/img2.jpg', 'Shocked!', 'my cat after i ate his meal.', '2016-03-23 00:00:00', 130),
(4, 1, 'img/img3.jpg', 'img/img3.jpg', 'Delicious cat', 'Look what we got for dinner!', '2016-03-31 00:00:00', 122);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirm_at` datetime DEFAULT NULL,
  `reset_token` varchar(60) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `remember_token` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `confirmation_token`, `confirm_at`, `reset_token`, `reset_at`, `remember_token`) VALUES
(1, 'bonay', 'test', 'test', NULL, NULL, NULL, NULL, NULL),
(2, 'og', 'test', 'test', NULL, NULL, NULL, NULL, NULL),
(3, 'vorgz', 'vorgz@hotmail.fr', '$2y$10$bYqJbu8mADU8I4g.m9HP7uO3tP3WKVCjvzjyxj1WwlQgo1WpnWqXG', '4gyoJZHZ6YmymWvvohB8DBjboT3hhwCc4HerQWqOFxJdibXUg3l0vuTYqrlp', '2016-03-01 00:00:00', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `photo_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `vote`
--

INSERT INTO `vote` (`id`, `user_id`, `photo_id`) VALUES
(2, 2, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
