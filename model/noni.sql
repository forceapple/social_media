-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Mar 06, 2015 at 06:40 PM
-- Server version: 5.6.17-debug-log
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `noni`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`cid` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `comment`) VALUES
(1, 'omg, that is a noni?!'),
(2, 'sadasdasd'),
(3, 'YEah same');

-- --------------------------------------------------------

--
-- Table structure for table `comments_posts`
--

CREATE TABLE IF NOT EXISTS `comments_posts` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments_posts`
--

INSERT INTO `comments_posts` (`pid`, `uid`, `cid`) VALUES
(1, 1, 1),
(2, 2, 2),
(1, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`pid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `text` varchar(300) NOT NULL,
  `post_image` varchar(200) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `title`, `text`, `post_image`, `type`) VALUES
(1, 'Noni!!!!!!', 'I never had noni beofre', 'http://www.costaricannoni.com/pics/P1050237.JPG', 1),
(2, 'Test2', 'asdasdasd', 'sadasd.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_img` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `profile_img`) VALUES
(1, 'Gordon', '1234', 'http://fc00.deviantart.net/fs22/f/2008/008/f/e/Saber_Wallpaper_by_X_Hide.jpg'),
(2, 'test', '1234', 'http://toucanfruit.com/boutique/wp-content/uploads/2013/11/Noni.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE IF NOT EXISTS `user_post` (
  `uid` int(11) NOT NULL,
  `pid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`uid`, `pid`) VALUES
(1, 1),
(2, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `comments_posts`
--
ALTER TABLE `comments_posts`
 ADD UNIQUE KEY `pid` (`pid`,`uid`), ADD KEY `uid` (`uid`), ADD KEY `cid` (`cid`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
 ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
 ADD UNIQUE KEY `uid` (`uid`,`pid`), ADD KEY `pid` (`pid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments_posts`
--
ALTER TABLE `comments_posts`
ADD CONSTRAINT `comments_posts_ibfk_4` FOREIGN KEY (`cid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comments_posts_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comments_posts_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_post`
--
ALTER TABLE `user_post`
ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_post_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
