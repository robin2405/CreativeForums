-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Genereertijd: 11 apr 2014 om 16:31
-- Serverversie: 5.6.14
-- PHP-versie: 5.5.6

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
(1, 'Nieuws', 'Hier staat al het nieuw', '2014-04-10 17:59:12', 35),
(11, 'Algemeen', 'Vragen? Opmerkingen? Wat dan ook? Hier kun je met alles terecht! ', '2013-11-29 05:50:06', 28);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `gallery`
--

INSERT INTO `gallery` (`id`, `url`) VALUES
(1, '/upload/3566.png');

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

--
-- Gegevens worden uitgevoerd voor tabel `messages`
--

INSERT INTO `messages` (`ID`, `Sender`, `Target`, `Title`, `Content`, `Date`, `viewed`) VALUES
(9, 1, 1, 'Berichtje', '<p>Type hier je berichtje.</p>', '2013-08-24', 0),
(12, 28, 25, 'wast moeilijk', '<p>Type hier je berichtje.</p>', '2013-11-29', 1),
(13, 25, 25, 'RE: wast moeilijk', '<p>Nee twas nie zo moeilijk :p</p>', '2013-11-29', 1),
(14, 25, 28, 'RE: RE: wast moeilijk', '<p>Nee tviel mee&nbsp;<img src="tiny_mce/plugins/emoticons/img/smiley-tongue-out.gif" alt="" /></p>', '2013-11-29', 1),
(15, 25, 25, 'hey', '<p>Type hier je berichtje.</p>', '2013-11-30', 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `notepad`
--

CREATE TABLE IF NOT EXISTS `notepad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `notepad`
--

INSERT INTO `notepad` (`id`, `text`) VALUES
(1, 'Voeg hier notes toe voor admins en vooral features die jasper moet toevoegen aan de website (ideeen)'),
(7, 'Volgorde boards kunnen doen bij boards dinges je weet'),
(8, 'Messchien een chat functie maken?'),
(9, 'een icoon voor naar twitch?');

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

--
-- Gegevens worden uitgevoerd voor tabel `pages`
--

INSERT INTO `pages` (`id`, `content`, `title`) VALUES
(4, '<h1>Forum Regels</h1>\r\n<p>Enkele regels waar je je moet aan houden! Het zijn ze niet allemaal want een paar moet je al weten!</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Ga volwassen met elkaar om, dus niet pesten of schelden.</li>\r\n</ul>\r\n<ul>\r\n<li>Het is verboden om seksuele inhoud te posten zoals website''s of foto''s.</li>\r\n</ul>\r\n<ul>\r\n<li>Maak geen reclame voor je eigen website, tenzij je toestemming hebt om dat te doen.</li>\r\n</ul>\r\n<ul>\r\n<li>Zet goede inhoud en informatie in je topics, zet dus niet 1 of 2 zinnen neer en het daarbij laten. &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Maak het ook niet al te slordig,overzichtelijke topics zijn fijner om te lezen.</li>\r\n</ul>\r\n<ul>\r\n<li>Post je topic maar &eacute;&eacute;n keer, dus niet meerdere keren.</li>\r\n</ul>\r\n<p>&nbsp;</p>\r\n<p style="padding-left: 30px;">&nbsp;&nbsp;<strong><span style="font-size: medium;">De rest spreekt voor zich!</span></strong></p>\r\n<p>&nbsp;</p>\r\n<h3>&nbsp;<span style="text-decoration: underline;">Bedankt RSG-staff</span></h3>', 'Forum Rules'),
(26, 'Leeg...', 'chat'),
(24, '<form action="upload_file.php" enctype="multipart/form-data" method="post">\r\n<p>Alleen fotos zullen werken!</p>\r\n<p><label for="file">Bestand:</label> <input id="file" name="file" type="file" /><br /> <input name="submit" type="submit" value="Submit" /></p>\r\n</form>', 'Uploader (ALLEEN JASPER MAG HIERAAN KOMEN!!!)');

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
(65, 1, 31, 25, '<p>Hello,</p>\r\n<p>&nbsp;</p>\r\n<p>Welcome to the official creative forums website,</p>\r\n<p>i hope you guys like the engine, The engine is an open-source forum and portal engine made with bootstrap and all my php and mysql knowledge, this project has been started in 2012 but got to a hold at some point because i got very bussy working on other peoples sites</p>\r\n<p>If you have any idea to improve the engine do not hesitate to post your idea on the forums we would love to hear your idea.</p>\r\n<p>Also if you find any bug, error, leak,... or simply an improvement to the engine (code-side) please tell us as well.</p>\r\n<p>&nbsp;</p>\r\n<p>Kind regards,</p>\r\n<p>Jasper D.,</p>', '2013-11-22 12:32:41', ''),
(73, 1, 34, 25, '<p>test</p>', '2014-04-08 18:32:19', ''),
(74, 1, 35, 35, 'Hello,\r\n\r\n \r\n\r\nWelcome to the official creative forums website,\r\n\r\ni hope you guys like the engine, The engine is an open-source forum and portal engine made with bootstrap and all my php and mysql knowledge, this project has been started in 2012 but got to a hold at some point because i got very bussy working on other peoples sites\r\n\r\nIf you have any idea to improve the engine do not hesitate to post your idea on the forums we would love to hear your idea.\r\n\r\nAlso if you find any bug, error, leak,... or simply an improvement to the engine (code-side) please tell us as well.\r\n\r\n \r\n\r\nKind regards,\r\n\r\nJasper D.,', '2014-04-10 17:59:12', '');

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
(35, 1, 'Welcome to Creative forums!', 35, 0, '2014-04-10 17:59:12', '2014-04-10 17:59:12', 2, 0, 0);

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
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `username_2` (`username`),
  UNIQUE KEY `username_3` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=36 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar`, `rank`, `Permission`, `Last_Active`) VALUES
(35, 'Admin', '$2y$10$iLUBUsxhY0ZeowdurM.0gOHylBZ.j22CtFVtXnkZbYXyJLG/diZtG', 'jdemo@live.be', 'Resources/upload/2113.png', 'Lead programmer', 'admin', '2014-04-11 16:30:06');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `url` text COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=15 ;

--
-- Gegevens worden uitgevoerd voor tabel `videos`
--

INSERT INTO `videos` (`id`, `url`) VALUES
(1, 'JkeAoqr1HEQ'),
(4, 'adfOMrWA34A'),
(5, 'kdPtDCi2A3c'),
(6, 'gnV-ao_8m5I'),
(8, 'd0FhNrySdX4'),
(9, 'M1EZTgR_X-Q'),
(10, 'FSnlHyHZtDM'),
(11, '16XrS2XwE6Q'),
(12, '0OvQsDAcdAQ'),
(13, 'g4o9EqWxSwc'),
(14, 'rXA_RNRARRY');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
