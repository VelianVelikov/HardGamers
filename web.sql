-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 11, 2014 at 11:11 AM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a8656780_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `avps`
--

CREATE TABLE `avps` (
  `arg` varchar(20) NOT NULL DEFAULT '',
  `value_s` text NOT NULL,
  `value_i` int(11) NOT NULL DEFAULT '0',
  `value_u` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`arg`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avps`
--

INSERT INTO `avps` VALUES('lastcleantime', '', 0, 1397227926);

-- --------------------------------------------------------

--
-- Table structure for table `bans`
--

CREATE TABLE `bans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addedby` int(10) unsigned NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '',
  `first` int(11) DEFAULT NULL,
  `last` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `first_last` (`first`,`last`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `bans`
--

INSERT INTO `bans` VALUES(8, '2014-02-26 16:18:06', 1, 'Ïñóâàíå', 1314082837, 1314082837);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` VALUES(1, 'Îêîëî ñàéòà');
INSERT INTO `categories` VALUES(2, 'Íîâîñòè');
INSERT INTO `categories` VALUES(3, 'Ñêîðîøíè úïäåéòè ');
INSERT INTO `categories` VALUES(4, 'Èíòåðåñíè ôàêòè');
INSERT INTO `categories` VALUES(5, 'Äðóãè');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `sitename` varchar(255) NOT NULL,
  `sitedomain` varchar(255) NOT NULL,
  `sitemail` varchar(255) NOT NULL,
  `important` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `siteonline` enum('yes','no') NOT NULL,
  `siteclreg` enum('yes','no') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` VALUES(1, 'Hard-Gamers', 'http://hard-gamers.webatu.com', 'velianstoychev@gmail.com', '', 'yes', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` VALUES(3, 'LOL :: Ôèíàëèòå íà Áúëãàðñêàòà Ëèãà', 'Ùå ïðåäàâàìå íà æèâî ïî Twitch.', '2014-04-20');
INSERT INTO `events` VALUES(10, 'WEBLOZ 14 Ôèíàëúò', 'Ôèíàëúò íà ñúñòåçàíèåòî WEBLOZ 14', '2014-04-14');
INSERT INTO `events` VALUES(5, 'OPS 2 :: Âðú÷âàíe íà íàãðàäèòå îò òóðíèðà', 'Ïîáåäèòåëèòå îò òóðíèðà ùå ñè ïîëó÷àò òðîôåÿ.', '2014-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `gamecat`
--

CREATE TABLE `gamecat` (
  `game_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gamecat`
--

INSERT INTO `gamecat` VALUES(1, 'League of Legends', 'http://www.ingato.com/images/lol_icon.png');
INSERT INTO `gamecat` VALUES(2, 'Dota 2', 'http://www.ozlegacy.com/images/dota2_icon.png');
INSERT INTO `gamecat` VALUES(3, 'GTA IV', 'http://www.psu.com/forums/dbtech/vbshop/images/items/GTAIV.jpg');
INSERT INTO `gamecat` VALUES(4, 'Call of Duty', 'http://img.uptodown.com/icons/mini/call-of-duty.png');

-- --------------------------------------------------------

--
-- Table structure for table `gameplays`
--

CREATE TABLE `gameplays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `game` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `added` (`added`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Dumping data for table `gameplays`
--

INSERT INTO `gameplays` VALUES(35, 1, '2014-02-17 17:48:41', 'Ïðåäè ãîäèíè Samsung ñà èìàëè âúçìîæíîñò äà çàêóïÿò Android, íî ñà ñå ïðèñìåëè íà ðàçðàáîò÷èöèòå', 'http://www.youtube.com/watch?v=85cx6ZwrHDk', 'Ïðåç 2003 ãîäèíà, èíæåíåðúò Àíäè Ðóáèí, çàåäíî ñ íÿêîëêî ñâîè êîëåãè çàïî÷âà ðàçðàáîòâàíåòî íà íîâ ïðîåêò íàðå÷åí Android. Ãîäèíà ïî-êúñíî, çà äà ïðîäúëæè äà ñúùåñòâóâà ìîáèëíàòà ïëàòôîðìà ñå å íóæäàåëà îò ïîäêðåïàòà íà ãîëÿìà êîìïàíèÿ, çàòîâà Ðóáèí è ñêðîìíèÿò ìó åêèï çàïî÷âàò äà òúðñÿò ñïàñåíèåòî çà ñâîåòî òâîðåíèå.\r\n\r\nÈíòåðåñíîòî å, ÷å òî÷íî â òîçè ìîìåíò íå ñà ñå ïîÿâèëè Google, îïðàâÿéêè ïîëîæåíèåòî, êàòî âçåìàò ïîä êðèëîòî ñè ïðîåêòà Android. Ïúðâèÿò ãëàñåí çà íîâ ñîáñòâåíèê íà îïåðàöèîííàòà ñèñòåìà ñà áèëè Samsung. Ìàëîáðîéíèÿò åêèï íà Ðóáèí, íàáðîÿâàù 8 äóøè îòïúòóâàë çà Þæíà Êîðåÿ, êúäåòî ñå ñðåùíàëè ñ 20 ìåíèäæúðè îò Samsung. Ñëåä ïîñëåäâàëè íÿêîëêî âúïðîñà îò ñòðàíà íà óïðàâèòåëèòå â þæíîêîðåéñêàòà êîìïàíèÿ, òå íàïúëíî îòõâúðëèëè èäåÿòà çà çàêóïóâàíå íà Android, êàòî äîðè ñå ïðèñìåëè  íà Ðóáèí, ñïîäåëÿ òîé.\r\n\r\nÄâå ñåäìèöè ïî-êúñíî îáà÷å Google ïðîÿâÿâàò èíòåðåñ êúì ïðîåêòà, êàòî â ïîñëåäñòâèå è íàïúëíî çàêóïóâà Android çà ñóìàòà îò 50 ìèëèîíà äîëàðà. Òîãàâàøíèÿò åêèï ïúê çàåìà ðúêîâîäíè ïîçèöèè â íîâîòî ðàçäåëåíèå íà êîìïàíèÿòà. Äàëè Samsung ñåãà ñúæàëÿâàò çà ïðîïóñíàòàòà âúçìîæíîñò?', 1);
INSERT INTO `gameplays` VALUES(39, 1, '2014-02-26 19:31:29', 'Çàáàâíà èãðà ñ Àøèòî - League of Legends', 'http://www.youtube.com/watch?v=an5cejP1gy8', '[center]Team 1 LOL\r\nBOT - Ashe\r\nBOT - Bliz\r\nMID - Ari\r\nTOP - Volybear\r\nJUNG - Jax\r\n\r\nTeam 2 LOL\r\nBOT -\r\nBOT -\r\nMID -\r\nTOP -\r\nJUNG -\r\n\r\nÁëàãîäàðÿ, ÷å ãëåäàõòå òîâà âèäåî[/center]', 1);
INSERT INTO `gameplays` VALUES(38, 1, '2014-02-26 18:56:43', 'BF4: Êàìïàíèÿòà ÷àñò II', 'http://www.youtube.com/watch?v=Nh_DZQZIAEQ', 'Åòî ïðèÿòåëè, âòîðàòà ÷àñò îò êàìïàíèÿòà íà ÁÔ4, íàäÿâàì ñå äà âè õàðåñà :) ', 4);

-- --------------------------------------------------------

--
-- Table structure for table `gamereview`
--

CREATE TABLE `gamereview` (
  `game_id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`game_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `gamereview`
--

INSERT INTO `gamereview` VALUES(1, 'League of Legends', 'http://www.ingato.com/images/lol_icon.png');
INSERT INTO `gamereview` VALUES(2, 'Dota 2', 'http://www.ozlegacy.com/images/dota2_icon.png');
INSERT INTO `gamereview` VALUES(3, 'GTA IV', 'http://www.psu.com/forums/dbtech/vbshop/images/items/GTAIV.jpg');
INSERT INTO `gamereview` VALUES(4, 'Call of Duty', 'http://img.uptodown.com/icons/mini/call-of-duty.png');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sender` int(10) unsigned NOT NULL DEFAULT '0',
  `receiver` int(10) unsigned NOT NULL DEFAULT '0',
  `added` datetime DEFAULT NULL,
  `msg` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `unread` enum('yes','no') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'yes',
  `poster` bigint(20) unsigned NOT NULL DEFAULT '0',
  `location` enum('in','out','both') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'in',
  PRIMARY KEY (`id`),
  KEY `receiver` (`receiver`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` VALUES(1, 2, 1, '2014-03-07 23:02:02', 'Ïðîáíî ñúîáùåíèå.', '', 2, 'in');
INSERT INTO `messages` VALUES(3, 6, 1, '2014-03-08 12:04:29', 'Çäðàñòè :)', '', 6, 'in');
INSERT INTO `messages` VALUES(4, 1, 6, '2014-03-08 12:17:29', '>>> BushonaaBG íàïèñà : --------\r\nÇäðàñòè :)\r\n>>> Êðàé íà ñúîáùåíèåòî îò BushonaaBG\r\n\r\nbtw ot kude vze bbcoda?', '', 1, 'in');
INSERT INTO `messages` VALUES(5, 1, 4, '2014-03-08 20:47:13', 'Äîáðå äîøúë!', '', 1, 'in');
INSERT INTO `messages` VALUES(6, 1, 9, '2014-03-14 17:30:57', 'Ïðèÿòíî ìè å', '', 1, 'in');
INSERT INTO `messages` VALUES(7, 9, 1, '2014-03-14 17:33:24', '>>> admin íàïèñà : --------\r\nÏðèÿòíî ìè å\r\n>>> Êðàé íà ñúîáùåíèåòî îò admin\r\n\r\nÇäðàâåé, \r\n\r\nÏîçäðàâëåíèÿ, ñàéòúò òè å óíèêàëåí è ìíîãî äîáðå èçðàáîòåí!\r\nÁðàâî çà äîáðàòà ðàáîòà è óñïåõ ñúñ ñàéòà! :)\r\n\r\nÑ óâàæåíèå,\r\nÄåñèñëàâ Àíòîíîâ - ExTrEeMeR', '', 9, 'in');
INSERT INTO `messages` VALUES(8, 4, 1, '2014-04-11 10:36:06', 'Zdravei', '', 4, 'in');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `category` int(3) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` VALUES(1, 'Patch 4.3 Notes', 'Íîâèòå úïäåéòè îêîëî League of Legends', 2, 'http://www.leagueoflegends-bg.com/media/k2/items/cache/2d535442c2c0b0669d8f5a051ed00bcc_XL.jpg', 'Íàâÿðíî ñòå íàÿñíî, ÷å è ñ Patch 4.3 ñå ñòèãíà äî îðÿçâàíå íà ÷àñò îò ãåðîèòå. Rio ñà íàÿñíî, ÷å îùå îò ïóñêàíåòî íà èãðàòà â îáðúùåíèå, ñà äîïóñíàëè ãðåøêè â ñïîñîáíîñòèòå íà Vel Koz, Corki, Gragas è Kassadin. Åòî äî êúäå ñå ñòèãíà ñúñ ñòàòñîâåòå èì.\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.3.10/img/champion/Velkoz.png[/img]Vel Koz\r\n\r\nVel Koz, îêîòî íà ïðàçíîòàòà å â òîçè patch, íî ùå áúäå ïóñíàò íà ïî-êúñíà äàòà.\r\n\r\n \r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.2.6/img/champion/Corki.png[/img]Corki\r\n\r\nÈãðà÷èòå íà Corki âå÷å ùå âèæäàò ïðîñòðàíñòâîòî â êîåòî ùå ïàäíå áîìáàòà, ÷èèòî ùåòè âå÷å ùå íàðàñòâàò ñ áîíóñ ôèçè÷åñêà ñèëà.\r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.3.10/img/spell/PhosphorusBomb.png[/img]Q - Phosphorus Bomb - + 0.5 áîíóñ ôèçè÷åñêà ñèëà.\r\n\r\nÂå÷å ïîêàçâà êúäå ùå ïàäíå áîìáàòà.(Ïðåäè ãî ïîêàçâàøå ñàìî íà âðàãîâåòå )\r\n\r\n \r\n\r\n \r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.2.6/img/champion/Gragas.png[/img]Gragas\r\n\r\nÍàìàëèõìå ôèçè÷åñêîòî ñúîòíîøåíèåòî, ñ êîåòî íàðàñòâà íåãîâèÿò Body Slam è ìàãè÷åñêîòî ñúîòíîøåíèåòî íà Explosive Cask\r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.3.10/img/spell/GragasBodySlam.png[/img]E - Body Slam – Áîíóñ ôèçè÷åñêî ñúîòíîøåíèå íàìàëåíî îò 0,66 íà âñè÷êè íèâà &#8658; 0.3/0.4/0.5/0.6/0.7\r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.3.10/img/spell/GragasExplosiveCask.png[/img]R - Explosive Cask – Áîíóñ ìàãè÷åñêî ñúîòíîøåíèå íàìàëåíî îò 1.0 &#8658; 0.9 è ìàíàòà å íàìàëåíà íà 100 íà âñè÷êè íèâà.\r\n\r\n \r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.2.6/img/champion/Kassadin.png[/img]Kassadin\r\n\r\nÍàìàëèõìå ùåòèòå íà Null s Sphere s è ïðîäúëæèòåëíîñòòà íà silence-a è íàìàëèõìå ùåòèòå íà Force Pulse\r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.3.10/img/spell/NullLance.png[/img]Q – Null Sphere\r\n\r\nÙåòè: 80/115/150/185/220 &#8658; 80/110/140/170/200\r\n\r\n[img]http://ddragon.leagueoflegends.com/cdn/4.3.10/img/spell/ForcePulse.png[/img]E - Force Pulse\r\n\r\nÙåòè: 80/130/180/230/280 &#8658; 80/120/160/200/240', 1391861679);
INSERT INTO `news` VALUES(43, 'Ó÷àñòâàìå â ñúñòåçàíèå ïî Èíô. òåõíîëîãèè', 'Â òàçè íàäïðåâàðà ñåãà ñå íóæäàåì îò âàøàòà ïîäêðåïà.', 1, 'http://webloz.net/imgs/webloz-mainlogo.png', 'Çäðàâåéòå ïðèÿòåëè, \r\nÓ÷àñòâàìå â ñúñòåçàíèå ïî Èíô. òåõíîëîãè, òa òåïúðâà çàïî÷âà êëàñèðàíåòî íà ïúðâè êðúã.\r\nÎíëàéí ãëàñóâàíåòî íà ïðîåêòèòå ïî Èíô. òåõíîëîãèè âå÷å çàïî÷íà. Êîíêóðåíöèÿòà å äîñòà ñåðèîçíà, a ñòúëáèöàòà å òðóäíà çà èçêà÷âàíå. Íàøèÿ ñàéò Hard-Gamers Community â ìîìåíòà ñúáèðà ãëàñîâå è ñå íàäÿâàìå äà ïîëó÷èì âàøàòà ïîäêðåïà. Ñúñòåçàíèåòî å îðãàíèçèðàíî îò [url=http://webloz.net/][color=blue][b]WEBLOZ[/b][/color][/url] è ìîæå äà íè ïîäêðåïèòå íà ñëåäíàòà [url=http://webloz.net/onlinevote/vote/63][color=red][u]óåá ñòðàíèöà[/u][/color][/url], êàòî òðÿáâà äà ïîòâúðäèòå ñëåä òîâà âàøèÿ ãëàñ ïî å-ìàéëà, êîéòî ùå ïîëó÷èòå. \r\n\r\nÁëàãîäàðèì Âè çà óêàçàíàòà ïîìîù!', 1395848029);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL DEFAULT '0',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(125) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `youtube` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `game` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `added` (`added`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` VALUES(35, 1, '2014-02-17 17:48:41', 'Cod Ghosts Åïè÷íîñò äî êðàé', 'http://www.youtube.com/watch?v=upgx-EWuy3Y', 'Call of Duty: Ghosts îòâàðÿ íîâà ñòðàíèöà â åïè÷íàòà èñòîðèÿ íà ïîðåäèöàòà!\r\n[url]https://www.facebook.com/AndroVlog[/url]\r\n[url]http://ask.fm/AndroVlog[/url]', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sitelog`
--

CREATE TABLE `sitelog` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `added` datetime DEFAULT NULL,
  `txt` text,
  PRIMARY KEY (`id`),
  KEY `added` (`added`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `sitelog`
--


-- --------------------------------------------------------

--
-- Table structure for table `stylesheets`
--

CREATE TABLE `stylesheets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uri` varchar(255) NOT NULL DEFAULT '',
  `name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `stylesheets`
--

INSERT INTO `stylesheets` VALUES(1, 'default.css', '(default)');

-- --------------------------------------------------------

--
-- Table structure for table `tournaments`
--

CREATE TABLE `tournaments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `game` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `live` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `first` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first1` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first2` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first3` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first4` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first5` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first6` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first7` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first8` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first9` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `first10` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second1` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second2` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second3` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second4` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second5` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second6` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second7` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second8` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second9` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `second10` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=18 ;

--
-- Dumping data for table `tournaments`
--

INSERT INTO `tournaments` VALUES(1, 'styles/images/slider/slider1.png', 'League of Legends', '5 vs 5', '2014-03-04', 'http://www.twitch.tv/cafeid', 'Áèñêâèòè çàêóñêà', 'Äîáðî óòðî', 'Ãîøî1', 'Ãîøî2', 'Ãîøî3', 'Ãîøî4', 'Ãîøî5', 'Ãîøî6', 'Ãîøî7', 'Ãîøî8', 'Ãîøî8', 'Ãîøî10', 'Ïåøî', 'Ïåøî2', 'Ïåøî3', 'Ïåøî4', 'Ïåøî5', 'Ïåøî6', 'Ïåøî7', 'Ïåøî8', 'Ïåøî8', 'Ïåøî10', 'Çà ïîâå÷å èíôîðìàöèÿ òåë. 0884506356 msd fe e k je f kj erfekfje fienrfe igkr eigeri grekrg dfigoegr okjrgmeo grmnfgdk mngrdkl gfnmgkl fgndfkl gflgfdl gnmfi dgnfk flgmnd ngdf ndl gmndlfkgmndnmgdk sgd Óâåäîìÿâàì Âè, ÷å äíåñ íà ñâîå çàñåäàíèå Ðåãèîíàëíîòî îïåðàòèâíî áþðî çà áîðáà ñ ãðèïà è îñòðèòå ðåñïèðàòîðíè çàáîëÿâàíèÿ âçå ðåøåíèå äà áúäàò ïðåêðàòåíè ó÷åáíèòå çàíÿòèÿ âúâ âñè÷êè ó÷èëèùà íà òåðèòîðèÿòà íà îáëàñò Ðóñå çà ïåðèîäà îò 29.01.2014 ã. äî 31.01.2014 ãîä. âêëþ÷èòåëíî. Ñðî÷íàòà âàêàíöèÿ ñïîðåä ãðàôèêà íà ó÷åáíîòî âðåìå å îò 01.02.14 äî 04.02.14. Ó÷åíèöèòå ñëåäâà äà ñà íà ó÷èëèùå íà 05.02.14Óâåäîìÿâàì Âè, ÷å äíåñ íà ñâîå çàñåäàíèå Ðåãèîíàëíîòî îïåðàòèâíî áþðî çà áîðáà ñ ãðèïà è îñòðèòå ðåñïèðàòîðíè çàáîëÿâàíèÿ âçå ðåøåíèå äà áúäàò ïðåêðàòåíè ó÷åáíèòå çàíÿòèÿ âúâ âñè÷êè ó÷èëèùà íà òåðèòîðèÿòà íà îáëàñò Ðóñå çà ïåðèîäà îò 29.01.2014 ã. äî 31.01.2014 ãîä. âêëþ÷èòåëíî. Ñðî÷íàòà âàêàíöèÿ ñïîðåä ãðàôèêà íà ó÷åáíîòî âðåìå å îò 01.02.14 äî 04.02.14. Ó÷åíèöèòå ñëåäâà äà ñà íà ó÷èëèùå íà 05.02.14');
INSERT INTO `tournaments` VALUES(3, 'http://www.supergraphictees.com/wp-content/uploads/cod-ghost-white.jpg', 'GTA', '3 vs 3', '2014-03-24', 'http://www.twitch.tv/cafeid', '', '', 'Ãîøî1', 'Ãîøî2', 'Ãîøî3', '', '', '', '', '', '', '', 'Ïåøî', 'Ïåøî2', 'Ïåøî3', '', '', '', '', '', '', '', 'Çà ïîâå÷å èíôîðìàöèÿ òåë. 0884506356 msd fe e k je f kj erfekfje fienrfe igkr eigeri grekrg dfigoegr okjrgmeo grmnfgdk mngrdkl gfnmgkl fgndfkl gflgfdl gnmfi dgnfk flgmnd ngdf ndl gmndlfkgmndnmgdk sgd Óâåäîìÿâàì Âè, ÷å äíåñ íà ñâîå çàñåäàíèå Ðåãèîíàëíîòî îïåðàòèâíî áþðî çà áîðáà ñ ãðèïà è îñòðèòå ðåñïèðàòîðíè çàáîëÿâàíèÿ âçå ðåøåíèå äà áúäàò ïðåêðàòåíè ó÷åáíèòå çàíÿòèÿ âúâ âñè÷êè ó÷èëèùà íà òåðèòîðèÿòà íà îáëàñò Ðóñå çà ïåðèîäà îò 29.01.2014 ã. äî 31.01.2014 ãîä. âêëþ÷èòåëíî. Ñðî÷íàòà âàêàíöèÿ ñïîðåä ãðàôèêà íà ó÷åáíîòî âðåìå å îò 01.02.14 äî 04.02.14. Ó÷åíèöèòå ñëåäâà äà ñà íà ó÷èëèùå íà 05.02.14Óâåäîìÿâàì Âè, ÷å äíåñ íà ñâîå çàñåäàíèå Ðåãèîíàëíîòî îïåðàòèâíî áþðî çà áîðáà ñ ãðèïà è îñòðèòå ðåñïèðàòîðíè çàáîëÿâàíèÿ âçå ðåøåíèå äà áúäàò ïðåêðàòåíè ó÷åáíèòå çàíÿòèÿ âúâ âñè÷êè ó÷èëèùà íà òåðèòîðèÿòà íà îáëàñò Ðóñå çà ïåðèîäà îò 29.01.2014 ã. äî 31.01.2014 ãîä. âêëþ÷èòåëíî. Ñðî÷íàòà âàêàíöèÿ ñïîðåä ãðàôèêà íà ó÷åáíîòî âðåìå å îò 01.02.14 äî 04.02.14. Ó÷åíèöèòå ñëåäâà äà ñà íà ó÷èëèùå íà 05.02.14');
INSERT INTO `tournaments` VALUES(2, 'http://toplogos.ru/images/logo-dota-2.png', 'Dota 2', '1 vs 1', '2014-03-28', 'http://www.twitch.tv/cafeid', 'BushonaaBG', 'Foggy', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Çà ïîâå÷å èíôîðìàöèÿ òåë. 0884506356 msd fe e k je f kj erfekfje fienrfe igkr eigeri grekrg dfigoegr okjrgmeo grmnfgdk mngrdkl gfnmgkl fgndfkl gflgfdl gnmfi dgnfk flgmnd ngdf ndl gmndlfkgmndnmgdk sgd Óâåäîìÿâàì Âè, ÷å äíåñ íà ñâîå çàñåäàíèå Ðåãèîíàëíîòî îïåðàòèâíî áþðî çà áîðáà ñ ãðèïà è îñòðèòå ðåñïèðàòîðíè çàáîëÿâàíèÿ âçå ðåøåíèå äà áúäàò ïðåêðàòåíè ó÷åáíèòå çàíÿòèÿ âúâ âñè÷êè ó÷èëèùà íà òåðèòîðèÿòà íà îáëàñò Ðóñå çà ïåðèîäà îò 29.01.2014 ã. äî 31.01.2014 ãîä. âêëþ÷èòåëíî. Ñðî÷íàòà âàêàíöèÿ ñïîðåä ãðàôèêà íà ó÷åáíîòî âðåìå å îò 01.02.14 äî 04.02.14. Ó÷åíèöèòå ñëåäâà äà ñà íà ó÷èëèùå íà 05.02.14Óâåäîìÿâàì Âè, ÷å äíåñ íà ñâîå çàñåäàíèå Ðåãèîíàëíîòî îïåðàòèâíî áþðî çà áîðáà ñ ãðèïà è îñòðèòå ðåñïèðàòîðíè çàáîëÿâàíèÿ âçå ðåøåíèå äà áúäàò ïðåêðàòåíè ó÷åáíèòå çàíÿòèÿ âúâ âñè÷êè ó÷èëèùà íà òåðèòîðèÿòà íà îáëàñò Ðóñå çà ïåðèîäà îò 29.01.2014 ã. äî 31.01.2014 ãîä. âêëþ÷èòåëíî. Ñðî÷íàòà âàêàíöèÿ ñïîðåä ãðàôèêà íà ó÷åáíîòî âðåìå å îò 01.02.14 äî 04.02.14. Ó÷åíèöèòå ñëåäâà äà ñà íà ó÷èëèùå íà 05.02.14');
INSERT INTO `tournaments` VALUES(15, 'http://www.supergraphictees.com/wp-content/uploads/cod-ghost-white.jpg', 'COD: Ghost', 'Survival', '2014-03-05', 'http://www.twitch.tv/cafeid', '', '', 'Ïåøî1', 'Ïåøî2', 'Ïåøî3', 'Ïåøî4', 'Ïåøî5', '', '', '', '', '', 'Ãîøî1', 'Ãîøî2', 'Ãîøî3', 'Ãîøî4', 'Ãîøî5', '', '', '', '', '', '[b]Íÿìà[/b]');
INSERT INTO `tournaments` VALUES(17, 'styles/images/slider/slider1.png', 'League of Legends', 'Hexakill', '2014-03-15', 'http://www.twitch.tv/cafeid', 'Áèñêâèòè çàêóñêà', 'Äîáðî óòðî', 'WilLmoo', 'cekobg', 'Dakata619', 'velikovv', 'Warnesbg', 'Trenndo', '', '', '', '', 'daniprobg', 'Epicenter', 'Paskoan', 'NeOsTy3', 'Foggy', 'Ne0sTyL321', '', '', '', '', 'Ñêîðî Áèñêâèòè çàêóñêà è Äîáðî óòðî ùå êðúñòîñàò øïàãè. Êîé ùå ïîáåäè?');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(40) NOT NULL DEFAULT '',
  `old_password` varchar(40) NOT NULL DEFAULT '',
  `passhash` varchar(32) NOT NULL DEFAULT '',
  `secret` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `email` varchar(80) NOT NULL DEFAULT '',
  `status` enum('pending','confirmed') NOT NULL DEFAULT 'confirmed',
  `added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_access` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `editsecret` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `privacy` enum('strong','normal','low') NOT NULL DEFAULT 'normal',
  `stylesheet` int(10) DEFAULT '1',
  `info` text,
  `acceptpms` enum('yes','friends','no') NOT NULL DEFAULT 'yes',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `class` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `avatar` varchar(250) NOT NULL,
  `title` varchar(30) NOT NULL DEFAULT '',
  `modcomment` text NOT NULL,
  `enabled` enum('yes','no') NOT NULL DEFAULT 'yes',
  `avatars` enum('yes','no') NOT NULL DEFAULT 'yes',
  `donor` enum('yes','no') NOT NULL DEFAULT 'no',
  `warned` enum('yes','no') NOT NULL DEFAULT 'no',
  `warneduntil` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deletepms` enum('yes','no') NOT NULL DEFAULT 'no',
  `savepms` enum('yes','no') NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `status_added` (`status`,`added`),
  KEY `ip` (`ip`),
  KEY `last_access` (`last_access`),
  KEY `enabled` (`enabled`),
  KEY `warned` (`warned`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'admin', '', '5a7b211721eca6363ade8056ef5f513d', '‘t†ï!/"1¯ó€ÕòÞ°pU\n\n', 'admin@abv.bg', 'confirmed', '2014-03-07 18:12:34', '2014-04-11 06:56:51', '2014-04-11 10:58:44', 'Ihë&×dŸÊxÁNe<¢ˆm´ä', 'normal', 1, '', 'yes', '77.78.23.58', 4, '', '', '', 'yes', 'no', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(2, 'moderator', '', '029aa6a47d34cc3376289fc7de67a2e3', '@\Z§Ü+v÷·GÀÉf2Ž¸°', 'moderator@abv.bg', 'confirmed', '2014-03-07 13:13:39', '2014-04-11 06:54:25', '2014-04-11 10:56:06', '', 'normal', 1, NULL, 'yes', '77.78.23.58', 3, '', '', '', 'yes', 'yes', '', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(3, 'vipuser', '', '4d59427c15c36b1b8ad8c88ef33305e2', 'î©ãˆÞÿ–ÏžÉ6¡ì9Ï\0sW', 'vipuser@abv.bg', 'confirmed', '2014-03-07 13:14:16', '2014-04-11 06:53:25', '2014-04-11 10:54:07', '', 'normal', 1, NULL, 'yes', '77.78.23.58', 2, '', '', '', 'yes', 'yes', '', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(4, 'potrebitel', '', '5dc56d95b90d93f39618ce718cc68774', 'Õa& j–"K’V.LWÝ#²ókvÿ', 'potrebitel@abv.bg', 'confirmed', '2014-03-07 18:18:53', '2014-04-11 06:51:25', '2014-04-11 10:53:15', '¼€ÁwÁ&¼‚hø$%"=Í€', 'normal', 1, NULL, 'yes', '77.78.23.58', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(6, 'BushonaaBG', '', '0f9a62ea036e7880c6f2eb059932a24b', 'Œ›+|ñ', 'velianstoychev@gmail.com', 'confirmed', '2014-03-07 13:26:39', '2014-03-08 07:04:02', '2014-03-28 17:37:02', '', 'normal', 1, '[center][b][color=blue]Äîáðå äîøëè â ìîÿ ïðîôèë![/color][/b][/center]\r\n[color=green]Çäðàâèéòå, \r\nÀç ñúì Âåëèàí îò ÌÃ "ÁàáàÒîíêà", ãð. Ðóñå è ìîåòî õîáè å ñúçäàâàíåòî íà óåá ñàéòîâå è êîìïþòúðíèòå èãðè. Çàíèìàâàì ñå ñúñ ñúçäàâàíå íà ñàéòîâå îò áëèçî 3 ãîäèíè, çàïî÷âàéêè îò "ïúðâîáèòåí" HTML.[/color]\r\n[table][tr][td]Íîìåð 1[/td][td]League of Legends[/td][/tr][tr][td]Íîìåð 2[/td][td]BF4[/td][/tr][tr][td]Íîìåð 3[/td][td]COD: Ghost[/td][/tr][/table]', 'yes', '78.83.136.25', 4, 'http://fc09.deviantart.net/fs70/f/2012/287/e/6/league_of_legends___corki_avatar_by_iamsointense-d5hr94c.jpg', 'Âåëèàí Ñòîé÷åâ Âåëèêîâ', '', 'yes', 'no', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(7, 'mitaka9999', '', '75bf134418ec8c28700f13efc77f1d9f', '×c/ÐJ™„Ì·ÁèÑÍãzð¡Ê', 'pesho-kurdov@abv.bg', 'confirmed', '2014-03-07 18:40:36', '2014-03-07 13:40:43', '2014-03-07 18:41:58', 'Ú±]Š>wbÕÓÁ`â¦À‡4mª', 'normal', 1, NULL, 'yes', '212.25.57.85', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(8, 'koko', '', 'b734df9e8abc2ca210f37937d056b079', '', 'koko@abv.bg', 'confirmed', '2014-03-10 17:12:09', '2014-03-10 13:12:25', '2014-03-10 19:17:28', 'ô´:zíêÔªy‰v(', 'normal', 1, '', 'yes', '212.25.39.243', 1, '', '', '', 'yes', 'no', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(9, 'extreemer', '', '5bed691919e43b4ab8b751d92d665029', 'i‰4?ðÖµ\nà›¿“êXNü+°n\Z', 'extreemer55@gmail.com', 'confirmed', '2014-03-14 17:28:48', '2014-03-14 13:29:07', '2014-03-15 07:10:52', 'V’o¿Ð÷¡»ÄZyÔþ@T', 'normal', 1, 'WEB Developer âúâ CodeCanyon.NET', 'yes', '87.121.172.98', 2, 'http://prikachi.com/images/919/6065919m.png', 'Äåñèñëàâ Àíòîíîâ', '', 'yes', 'no', '', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(10, 'dadada', '', '31a547ed3b0aa186f83c1b3d9099d31f', '¶îþŸ°R phxàMvfÇÂ¨x¬', 'dadada@dadada.dadada', 'confirmed', '2014-03-18 20:47:09', '2014-03-18 16:47:18', '2014-03-19 19:10:03', ',HŒêÒ£ÐhêÙÞð½ú Žå&Î', 'normal', 1, NULL, 'yes', '109.199.129.150', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(11, 'tsanov', '', 'c1d9293753d4d164aebea905cbc5cbf2', 'íT¶ºmoä\Z*}cy''¡z˜H»W>', 'nikolay_tsanov@outlook.com', 'confirmed', '2014-03-18 20:58:33', '2014-03-19 04:34:09', '2014-04-01 20:50:57', 'WrøìsÓ:›O''J<ÍeƒVõ\\i', 'normal', 1, NULL, 'yes', '93.155.195.103', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(12, 'testme', '', 'e67919e239c612b9a36531f3f650ac6c', '~RŸIge:`)|‘†«ù£oŸSµ€', 'phpbb.991@gmail.com', 'confirmed', '2014-03-22 10:08:37', '2014-03-22 06:09:18', '2014-03-22 10:14:55', '°SŸ•_¾2•H5’.tÆ', 'normal', 1, NULL, 'yes', '2.84.26.65', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(13, 'ds', '', 'da4aa5aa2270bd8ea987a40f00e23ce2', 'œ›¯´Åh&ñ²2P¥–Äï1“‹×', 'ds@ds.ds', 'confirmed', '2014-03-24 12:58:05', '2014-03-24 08:58:15', '2014-03-26 15:03:47', '‚SlãYu1ª±-Çýí¦Ïjf;', 'normal', 1, NULL, 'yes', '212.233.134.198', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(14, 'dqt23947', '', 'ebd7b6382d108bf5446aed382f070048', 'õaóí®dæ>ÿâ)‚*>ç¹]', 'dqt23947@coieo.com', 'confirmed', '2014-03-26 17:53:17', '2014-03-26 13:53:35', '2014-04-03 22:04:14', '}•6	A)ÅÊ)Éc<9½«Àƒì\0', 'normal', 1, NULL, 'yes', '213.91.209.239', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
INSERT INTO `users` VALUES(15, 'martootruse', '', 'c5a7132f72fe8909217edfdcbef18983', 'Õ¼€õ‰ýlËg!Ž@o|Q', 'mdimitrov01@gmail.com', 'confirmed', '2014-03-27 17:54:58', '2014-03-27 13:55:12', '2014-03-27 17:55:57', 'Íæ»Jä¸¹%y‰HéîÒÚd#', 'normal', 1, NULL, 'yes', '2.121.16.180', 1, '', '', '', 'yes', 'yes', 'no', 'no', '0000-00-00 00:00:00', 'no', 'yes');
