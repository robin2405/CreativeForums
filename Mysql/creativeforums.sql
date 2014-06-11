-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 01 jun 2014 om 17:39
-- Serverversie: 5.6.16
-- PHP-versie: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `creativeforums`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `last_post_date` datetime DEFAULT NULL,
  `last_user_posted` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `categories`
--

INSERT INTO `categories` (`id`, `category_title`, `category_description`, `last_post_date`, `last_user_posted`) VALUES
(1, 'News', 'Here you can find all the news', '2014-04-10 17:59:12', 35);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `ID` int(10) NOT NULL AUTO_INCREMENT,
  `Sender` int(10) NOT NULL,
  `Target` int(10) NOT NULL,
  `Title` text COLLATE utf8_unicode_ci NOT NULL,
  `Content` text COLLATE utf8_unicode_ci NOT NULL,
  `Date` date NOT NULL,
  `viewed` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `title` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(4) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `post_creator` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` datetime NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=75 ;

--
-- Gegevens worden uitgevoerd voor tabel `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `topic_id`, `post_creator`, `post_content`, `post_date`, `email`) VALUES
(74, 1, 35, 35, '<p>Hello,</p>\r\n<p>&nbsp;</p>\r\n<p>Welcome to the official creative forums website,</p>\r\n<p>i hope you guys like the engine, The engine is an open-source forum and portal engine made with bootstrap and all my php and mysql knowledge, this project has been started in 2012 but got to a hold at some point because i got very bussy working on other peoples sites</p>\r\n<p>If you have any idea to improve the engine do not hesitate to post your idea on the forums we would love to hear your idea.</p>\r\n<p>Also if you find any bug, error, leak,... or simply an improvement to the engine (code-side) please tell us as well.</p>\r\n<p>&nbsp;</p>\r\n<p>Kind regards,</p>\r\n<p>Jasper D.,</p>', '2014-04-10 17:59:12', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `SettingID` int(11) NOT NULL AUTO_INCREMENT,
  `SettingName` text NOT NULL,
  `SettingValue` text NOT NULL,
  PRIMARY KEY (`SettingID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `settings`
--

INSERT INTO `settings` (`SettingID`, `SettingName`, `SettingValue`) VALUES
(1, 'Theme', 'Default'),
(2, 'Root', 'http://localhost/Creative%20Forums/');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(4) NOT NULL,
  `topic_title` varchar(150) NOT NULL,
  `topic_creator` int(11) NOT NULL,
  `topic_last_user` int(11) NOT NULL,
  `topic_date` datetime NOT NULL,
  `topic_reply_date` datetime NOT NULL,
  `topic_views` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Gegevens worden uitgevoerd voor tabel `topics`
--

INSERT INTO `topics` (`id`, `category_id`, `topic_title`, `topic_creator`, `topic_last_user`, `topic_date`, `topic_reply_date`, `topic_views`, `type`, `pid`) VALUES
(35, 1, 'Welcome to Creative forums!', 35, 0, '2014-04-10 17:59:12', '2014-04-10 17:59:12', 8, 0, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8_unicode_ci NOT NULL,
  `rank` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Last_Active` datetime NOT NULL,
  `salt` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `username_2` (`username`),
  UNIQUE KEY `username_3` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `rank`, `Permission`, `Last_Active`, `salt`) VALUES
(35, 'admin', '$2y$10$coiXczbLoCNJ1UyZG6NkjOubQeCadOmK5hbuaJCl4IJeKwhwYjR1S', 'jdemo@live.be', 'Resources/upload/370.png', 'member', 'admin', '2014-06-01 17:39:11', 'v.6ERaDJuMrxDwD');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
