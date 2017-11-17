-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2017 at 08:19 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lonely_heroes`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL,
  `content` text NOT NULL,
  `commented_user_id` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `user_id`, `content`, `commented_user_id`) VALUES
(12, 1, 'yo deadpool', 2),
(13, 1, 'Yo doctor strange', 3),
(14, 1, 'You\'re pretty', 5),
(15, 1, 'My favorite girl', 4),
(16, 1, 'DO you have snakes on your head?', 6),
(17, 1, 'Looking good. Answer my messages! Please :(', 4);

-- --------------------------------------------------------

--
-- Table structure for table `gift`
--

CREATE TABLE `gift` (
  `gift_id` int(64) NOT NULL,
  `gift` varchar(20) NOT NULL,
  `user_id` int(64) NOT NULL,
  `gifted_user_id` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gift`
--

INSERT INTO `gift` (`gift_id`, `gift`, `user_id`, `gifted_user_id`) VALUES
(1, 'gifts/gun.png', 1, 2),
(3, 'gifts/sword.jpg', 1, 2),
(4, 'gifts/shield.jpg', 1, 2),
(5, 'gifts/gun.png', 2, 1),
(6, 'gifts/sword.jpg', 2, 1),
(7, 'gifts/shield.jpg', 2, 1),
(8, 'gifts/shield.jpg', 4, 1),
(9, 'gifts/gun.png', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `like_it`
--

CREATE TABLE `like_it` (
  `like_it_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL,
  `liked_user_id` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `like_it`
--

INSERT INTO `like_it` (`like_it_id`, `user_id`, `liked_user_id`) VALUES
(88, 1, 2),
(89, 1, 2),
(90, 1, 2),
(91, 1, 2),
(92, 1, 3),
(93, 1, 3),
(94, 1, 3),
(95, 1, 4),
(96, 1, 4),
(97, 1, 5),
(98, 1, 5),
(102, 1, 6),
(103, 1, 6),
(122, 1, 2),
(123, 1, 2),
(124, 1, 2),
(125, 1, 1),
(126, 1, 1),
(127, 1, 1),
(128, 1, 1),
(129, 1, 1),
(130, 1, 1),
(131, 1, 1),
(132, 1, 1),
(133, 1, 1),
(134, 1, 3),
(135, 1, 3),
(136, 1, 3),
(137, 1, 3),
(138, 1, 6),
(139, 1, 5),
(140, 1, 4),
(141, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(64) NOT NULL,
  `user_id` int(64) NOT NULL,
  `content` text NOT NULL,
  `messaged_user_id` int(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `user_id`, `content`, `messaged_user_id`) VALUES
(12, 1, 'Hi, Deadpool!', 2),
(13, 1, 'Ciao, Marvel. How is it going?', 4),
(14, 1, 'Come on Marvel answer me', 4),
(15, 1, 'Marvellllllllllllllll, answer', 4),
(16, 2, 'Hi Iron man! Did you iron today? ;-)', 1),
(17, 2, 'You\'re a rich guy', 1),
(18, 2, 'I love you too', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `age` int(4) NOT NULL,
  `gender` char(8) NOT NULL,
  `super_power` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `age`, `gender`, `super_power`, `description`, `image`) VALUES
(1, 'Iron man', 54, 'male', 'richness', 'I\'m a wealthy American business magnate, playboy, and ingenious scientist. ', 'image/iron.jpg'),
(2, 'Deadpool', 20, 'male', 'healing', 'I\'m a master of assassination techniques and highly skilled with weapons. ', 'image/deadpool.jpg'),
(3, 'Doctor Strange', 62, 'male', 'energy projection', 'I\'m a skilled athlete and martial artist with substantial magical knowledge.', 'image/strange.jpg'),
(4, 'Captain Marvel', 30, 'female', 'flying', 'I\'m a skilled pilot & hand to hand combatant. ', 'image/marvel.jpg'),
(5, 'Scarlet Witch', 52, 'female', 'hex-spheres', 'I can tap into mystic energy for reality-altering effects. ', 'image/scarlet.jpg'),
(6, 'Medusa', 42, 'female', 'hair stuff', 'I can control the rate of growth and movement of each strand of my hair.', 'image/medusa.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `commented_user_id` (`commented_user_id`);

--
-- Indexes for table `gift`
--
ALTER TABLE `gift`
  ADD PRIMARY KEY (`gift_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_of_gifted_user` (`gifted_user_id`);

--
-- Indexes for table `like_it`
--
ALTER TABLE `like_it`
  ADD PRIMARY KEY (`like_it_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_of_liked_user` (`liked_user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_of_messeged_user` (`messaged_user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `gift`
--
ALTER TABLE `gift`
  MODIFY `gift_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `like_it`
--
ALTER TABLE `like_it`
  MODIFY `like_it_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(64) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`commented_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `gift`
--
ALTER TABLE `gift`
  ADD CONSTRAINT `gift_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gift_ibfk_2` FOREIGN KEY (`gifted_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like_it`
--
ALTER TABLE `like_it`
  ADD CONSTRAINT `like_it_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `like_it_ibfk_2` FOREIGN KEY (`liked_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`messaged_user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
