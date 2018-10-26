-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 15 dec 2014 om 11:57
-- Serverversie: 5.6.15-log
-- PHP-versie: 5.5.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `mapapp_nl_1`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `markers`
--

CREATE TABLE IF NOT EXISTS `markers` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `x` int(8) NOT NULL,
  `y` int(8) NOT NULL,
  `title` varchar(128) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Gegevens worden uitgevoerd voor tabel `markers`
--

INSERT INTO `markers` (`id`, `x`, `y`, `title`, `content`) VALUES
(1, 547, 748, 'Amsterdam', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin viverra risus id dolor rhoncus maximus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam accumsan eget felis pharetra sodales. Donec ac ex quis ipsum iaculis elementum. Suspendisse in augue quam. Aliquam tellus mauris, iaculis nec posuere sed, rutrum accumsan ligula. Curabitur interdum eleifend libero, ac sagittis felis pulvinar quis. Praesent molestie nec turpis eget dignissim. Nulla elementum, ipsum a iaculis consectetur, sem elit dapibus quam, sit amet imperdiet diam ipsum vel dolor. Maecenas luctus aliquet orci vitae dignissim. Donec hendrerit eu arcu non blandit. Phasellus et dui a nunc luctus varius sit amet nec sem. '),
(2, 522, 804, 'Brussel', 'Ut ornare ipsum vitae orci facilisis euismod. In vitae elit eu ante finibus consequat. Nam nec ex ac mi lobortis laoreet. Aenean consequat neque quis convallis faucibus. Nunc consectetur orci vitae ligula ullamcorper convallis. Praesent vel sem in nunc euismod feugiat. Aliquam ut facilisis sapien. Duis gravida tincidunt tellus, et faucibus turpis volutpat id. Aenean ornare purus et mauris imperdiet, a placerat mi ultrices. Proin finibus neque a lobortis efficitur. Donec viverra maximus hendrerit. Pellentesque fermentum augue vitae ligula congue condimentum. Ut gravida finibus ipsum, varius vulputate nibh convallis id. Fusce sollicitudin nibh sed fringilla viverra. '),
(3, 711, 1192, 'Rome', ' Donec erat ante, accumsan sed urna nec, tincidunt porttitor lectus. Integer ante ex, fringilla ac accumsan eu, venenatis sed lorem. Aliquam consequat arcu in luctus porta. Vestibulum pretium nisi vel tortor tincidunt ultricies. Sed in suscipit nisi, nec commodo dui. Duis nec ornare ipsum, in dapibus purus. Aenean sed lobortis risus. Mauris lacinia rutrum tellus, vitae molestie metus viverra posuere. In et imperdiet diam.<br /><br />\n\nCras egestas vitae ex vel gravida. Nulla in consectetur libero. Vestibulum auctor justo vitae metus blandit congue. Mauris posuere vel enim sed ultricies. Mauris egestas, massa et commodo porta, erat libero mattis turpis, et mattis orci nisi nec lacus. Integer eget est bibendum, interdum quam et, dapibus tortor. Maecenas in arcu non quam mattis egestas eu eu lectus. Vivamus rhoncus vitae nisl sed luctus. Maecenas sagittis eleifend lobortis. Nullam hendrerit enim urna, in iaculis felis sagittis et. '),
(4, 422, 745, 'Londen', 'Etiam pretium sapien eu augue pellentesque bibendum. Phasellus fermentum, odio id efficitur imperdiet, urna leo viverra massa, ut posuere ipsum neque in nibh. Mauris in justo quam. Donec justo lacus, malesuada id tellus ac, porttitor luctus justo. Quisque nec finibus magna, vitae interdum sapien. Proin vitae risus feugiat, blandit augue at, vestibulum nulla. Vestibulum dignissim metus vitae lorem facilisis, in lacinia urna ullamcorper. Sed commodo erat et sem semper sodales. Proin ac lacinia orci, sed rhoncus elit. Etiam interdum ultricies velit id pellentesque. '),
(5, 448, 881, 'Parijs', 'Cras egestas vitae ex vel gravida. Nulla in consectetur libero. Vestibulum auctor justo vitae metus blandit congue. Mauris posuere vel enim sed ultricies. Mauris egestas, massa et commodo porta, erat libero mattis turpis, et mattis orci nisi nec lacus. Integer eget est bibendum, interdum quam et, dapibus tortor. Maecenas in arcu non quam mattis egestas eu eu lectus. Vivamus rhoncus vitae nisl sed luctus. Maecenas sagittis eleifend lobortis. Nullam hendrerit enim urna, in iaculis felis sagittis et. '),
(6, 718, 781, 'Berlijn', 'Donec erat ante, accumsan sed urna nec, tincidunt porttitor lectus. Integer ante ex, fringilla ac accumsan eu, venenatis sed lorem. Aliquam consequat arcu in luctus porta. Vestibulum pretium nisi vel tortor tincidunt ultricies. Sed in suscipit nisi, nec commodo dui. Duis nec ornare ipsum, in dapibus purus. Aenean sed lobortis risus. Mauris lacinia rutrum tellus, vitae molestie metus viverra posuere. In et imperdiet diam. ');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
