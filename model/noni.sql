-- phpMyAdmin SQL Dump
-- version 4.2.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 22, 2015 at 06:17 AM
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
-- Table structure for table `comment_vote`
--

CREATE TABLE IF NOT EXISTS `comment_vote` (
  `user_id` int(11) NOT NULL,
  `commnet_id` int(11) NOT NULL,
  `votetype` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_vote`
--

INSERT INTO `comment_vote` (`user_id`, `commnet_id`, `votetype`) VALUES
(2, 6, 0),
(4, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`cid` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `comment_time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`cid`, `comment`, `comment_time_stamp`, `votes`) VALUES
(2, 'sadasdasd', '2015-03-20 05:45:49', 0),
(3, 'YEah same', '2015-03-20 05:45:49', 0),
(6, 'dfgdfg', '2015-03-20 05:45:49', 4),
(7, 'dfgdfgdfg', '2015-03-20 05:46:27', 0),
(9, 'pew epwewpewpe pwewe', '2015-03-20 05:50:53', 0);

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
(1, 2, 3),
(2, 2, 2),
(1, 1, 6),
(1, 1, 7),
(1, 2, 9);

-- --------------------------------------------------------

--
-- Table structure for table `fav`
--

CREATE TABLE IF NOT EXISTS `fav` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fav`
--

INSERT INTO `fav` (`pid`, `uid`) VALUES
(2, 1),
(1, 2),
(2, 2),
(14, 2),
(1, 3),
(2, 3),
(2, 4),
(16, 6);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
`pid` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `text` varchar(300) NOT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0' COMMENT 'total number of votes'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`pid`, `title`, `text`, `time_stamp`, `type`, `votes`) VALUES
(1, 'Noni!!!!!iioio', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-03-20 04:52:47', 0, 0),
(2, 'Test2', 'asdasdasd', '2015-03-20 04:52:47', 1, 0),
(3, 'Test1\r\n', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-03-20 04:52:47', 0, 0),
(4, 'test2', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(5, 'test3', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(6, 'test4', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(7, 'test5', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(8, 'test6', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(9, 'test7', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(10, 'test8', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(11, 'test9', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(12, 'test10', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(13, 'test11', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(14, 'test12', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(15, 'test13', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(16, 'test14', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(17, 'test15', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(18, 'test16', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(19, 'test17', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(20, 'test18', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(21, 'test19', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(22, 'test20', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(23, 'test21', 'https://www.superorganicfoods.com/images/Noni2.jpg', '2015-05-21 03:55:13', 0, 0),
(24, 'fsefsfasdasasdasd', 'ads', '2015-05-21 04:31:15', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`uid` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `profile_img` varchar(200) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `email` varchar(300) NOT NULL,
  `location` varchar(300) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `username`, `password`, `profile_img`, `f_name`, `l_name`, `email`, `location`) VALUES
(1, 'Gordon', '1234', 'http://fc00.deviantart.net/fs22/f/2008/008/f/e/Saber_Wallpaper_by_X_Hide.jpg', 'Gordon', 'Lee', 'testset@gmail.com', 'Vacnouver, BC'),
(2, 'test', '1234', 'http://toucanfruit.com/boutique/wp-content/uploads/2013/11/Noni.jpg', 'etstsegg', 'setsetgg', 'setsetfrgr', 'setsetggg'),
(3, 'monetd', 'asd', 'asd.jpg', 'sdffff', 'erh', '', 'vancouver'),
(4, 'Ga', 'asd', 'asd.jpg', 'sdffff', 'erh', 'sadda@gmail.com', 'vancouver'),
(5, 'g1', '123123', 'qweqw.jpg', 'qwe', 'rqw', 'qwe@gmail.com', 'testset'),
(6, 'Gordon', '1234', 'google.ca', 'Gordo', 'Broro', 'g@g.g', 'Vancouver'),
(7, 'test2', '1234', 'google.ca', 'Gordo', 'Broro', 'g@g.g', 'Vancouver');

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
(2, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `votetype` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`user_id`, `post_id`, `votetype`) VALUES
(1, 1, 0),
(2, 1, 1),
(3, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment_vote`
--
ALTER TABLE `comment_vote`
 ADD PRIMARY KEY (`user_id`,`commnet_id`), ADD KEY `comment_vote_ibfk_2` (`commnet_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `comments_posts`
--
ALTER TABLE `comments_posts`
 ADD KEY `uid` (`uid`), ADD KEY `cid` (`cid`), ADD KEY `pid` (`pid`,`uid`);

--
-- Indexes for table `fav`
--
ALTER TABLE `fav`
 ADD UNIQUE KEY `pid` (`pid`,`uid`), ADD KEY `uid` (`uid`);

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
-- Indexes for table `votes`
--
ALTER TABLE `votes`
 ADD PRIMARY KEY (`user_id`,`post_id`), ADD KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment_vote`
--
ALTER TABLE `comment_vote`
ADD CONSTRAINT `comment_vote_ibfk_2` FOREIGN KEY (`commnet_id`) REFERENCES `comments` (`cid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `comment_vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comments_posts`
--
ALTER TABLE `comments_posts`
ADD CONSTRAINT `comments_posts_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comments_posts_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `comments_posts_ibfk_4` FOREIGN KEY (`cid`) REFERENCES `comments` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fav`
--
ALTER TABLE `fav`
ADD CONSTRAINT `fav_ibfk_2` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `fav_ibfk_1` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_post`
--
ALTER TABLE `user_post`
ADD CONSTRAINT `user_post_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `user_post_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `post` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`uid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`pid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
