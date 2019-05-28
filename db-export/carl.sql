-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2019 at 07:56 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carl`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(300) COLLATE utf8mb4_bin DEFAULT NULL,
  `contact_number` varchar(15) COLLATE utf8mb4_bin DEFAULT NULL,
  `subelection_position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `candidate`
--

INSERT INTO `candidate` (`id`, `name`, `date_of_birth`, `address`, `contact_number`, `subelection_position_id`) VALUES
(1, 'dump', '2019-04-16', 'born yesterday', '43254543', 2),
(2, 'dump 2', '2019-04-02', 'slightly more mature st.', '55555555', 2),
(3, 'Millany Anne Cua', '0000-00-00', 'Millanyse Street', '9999999999', 4),
(4, 'Roberto Daniel Aguinaldo', '0000-00-00', 'U621 Jay Apura Bldg Bali Oasis 2', '9999999999', 4),
(5, 'Wesley Christopher Kayanan', '0000-00-00', '', '', 4),
(6, 'Justin Roma', '2000-01-15', '', '', 4),
(7, 'ggg', '2019-01-01', 'gjh', '4', 5),
(9, 'aaaa', '1987-03-05', 'here', '1', 19);

-- --------------------------------------------------------

--
-- Table structure for table `election`
--

CREATE TABLE `election` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `enabled` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `election`
--

INSERT INTO `election` (`id`, `name`, `description`, `enabled`) VALUES
(1, 'test', 'desc11', 0),
(2, 'dog election', 'test lol', 0),
(3, 'safsadsa', 'dsadsadsa', 0),
(4, 'hunger election', 'Libre ni Roniel', 0),
(8, 'wesley', 'kayanan', 0),
(11, 'john', 'john', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subelection`
--

CREATE TABLE `subelection` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `election_id` int(11) NOT NULL,
  `allow_all_voter_blocks` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `subelection`
--

INSERT INTO `subelection` (`id`, `name`, `description`, `election_id`, `allow_all_voter_blocks`) VALUES
(1, 'puppet 1', 'test subelection 1', 1, 0),
(3, 'puppet 2', 'test subelection 2 communist ed', 1, 1),
(4, 'District Wesley', 'blah blah blah', 3, 1),
(5, 'y', 'yyyy', 4, 0),
(6, 'christopher', 'reyes', 8, 0),
(8, 'sub', 'sub', 11, 0);

-- --------------------------------------------------------

--
-- Table structure for table `subelection_authorized_vblocks`
--

CREATE TABLE `subelection_authorized_vblocks` (
  `id` int(11) NOT NULL,
  `subelection_id` int(11) NOT NULL,
  `authorized_voter_block_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `subelection_authorized_vblocks`
--

INSERT INTO `subelection_authorized_vblocks` (`id`, `subelection_id`, `authorized_voter_block_id`) VALUES
(1, 1, 3),
(4, 1, 4),
(6, 4, 5),
(7, 6, 6),
(8, 8, 32);

-- --------------------------------------------------------

--
-- Table structure for table `subelection_position`
--

CREATE TABLE `subelection_position` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `subelection_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `subelection_position`
--

INSERT INTO `subelection_position` (`id`, `name`, `description`, `subelection_id`) VALUES
(1, 'president', 'sadsasassa', 1),
(2, 'vice president', 'å‰¯ä¼šé•·', 1),
(4, 'Dictator', '', 4),
(5, 'h', 'nhh', 6),
(19, 'position', 'position', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `surname` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(300) COLLATE utf8mb4_bin DEFAULT NULL,
  `contact_number` varchar(15) COLLATE utf8mb4_bin DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `password` varchar(5) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `date_of_birth`, `address`, `contact_number`, `username`, `password`) VALUES
(9, 'test vblock user barch', 'american', '2019-04-22', 'sadsad', '3213213', 'tamerican', 'Y6sr3'),
(10, 'test vblock user barch', 'test', '2019-04-22', 'sadsad', '3213213', 'ttest', 'she6a'),
(11, 'test vblock user barch', 'um', '2019-04-22', 'sadsad', '3213213', 'tum', 'Mau6S'),
(12, 'test vblock user barch', 'yoyoyo', '2019-04-22', 'sadsad', '3213213', 'tyoyoyo', 'ajs6z'),
(13, 'test vblock user barch', 'heyy', '2019-04-22', 'sadsad', '3213213', 'theyy', 'syqmx'),
(14, 'test vblock user barch', 'heyy', '2019-04-22', 'sadsad', '3213213', 'theyy1', 'JsgSn'),
(15, 'alice', 'alice', '2000-01-01', 'abc', '999999999', 'aalice', 'HstS5'),
(16, 'bob', 'bob', '2000-01-01', 'abc', '999999999', 'bbob', 'y5ELf'),
(17, 'charlie', 'chan', '2000-01-01', 'abc', '999999999', 'cchan', 'POs9a'),
(18, 'dave', 'cruz', '2000-01-01', 'abc', '999999999', 'dcruz', 'Nsiqm'),
(19, 'j', 'surname', '2019-01-01', 'gghj', '17', 'jsurname', 'JArx5'),
(20, 'j', 'man', '2019-01-01', 'gghj', '18', 'jman', 'yRz5v'),
(21, 'ggg', 'hhh', '2019-01-01', 'gghj', '19', 'ghhh', 'sh3o0'),
(22, 'GGGGG', 'GGGGG', '2004-03-03', 'rtyuio', '123456789', 'GGGGGG', 'HzrwF'),
(23, 'hello', 'world', '1998-05-04', 'earth', '23', 'hworld', '17b4e'),
(24, 'wsfe', 'fesf', '2020-11-02', 'wsf', '204934983', 'wfesf', '5d79f');

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE `vote` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `subelection_position_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `voter_block`
--

CREATE TABLE `voter_block` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_bin DEFAULT NULL,
  `description` varchar(200) COLLATE utf8mb4_bin DEFAULT NULL,
  `parent_election_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `voter_block`
--

INSERT INTO `voter_block` (`id`, `name`, `description`, `parent_election_id`) VALUES
(3, 'test voter block', 'lalaalalala', 1),
(4, 'sdad', 'asdadsada', 1),
(5, 'District Wesley', 'Binayaran ni Wesley', 3),
(6, 'roberto', 'daniel', 8),
(8, 'hello', 'hello', 1),
(30, 'v', 'v', 8),
(32, 'loss', 'loss', 11);

-- --------------------------------------------------------

--
-- Table structure for table `voter_block_members`
--

CREATE TABLE `voter_block_members` (
  `id` int(11) NOT NULL,
  `block_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `voter_block_members`
--

INSERT INTO `voter_block_members` (`id`, `block_id`, `user_id`) VALUES
(4, 3, 12),
(5, 3, 13),
(6, 3, 14),
(7, 4, 13),
(8, 5, 15),
(9, 5, 16),
(10, 5, 17),
(11, 5, 18),
(12, 3, 15),
(13, 6, 19),
(14, 6, 20),
(15, 6, 21),
(16, 5, 19),
(17, 3, 22),
(18, 3, 23),
(25, 3, 24);

-- --------------------------------------------------------

--
-- Table structure for table `vote_results`
--

CREATE TABLE `vote_results` (
  `id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `vote_count` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subelection_position_id` (`subelection_position_id`);

--
-- Indexes for table `election`
--
ALTER TABLE `election`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subelection`
--
ALTER TABLE `subelection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `election_id` (`election_id`);

--
-- Indexes for table `subelection_authorized_vblocks`
--
ALTER TABLE `subelection_authorized_vblocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subelection_id` (`subelection_id`),
  ADD KEY `authorized_voter_block_id` (`authorized_voter_block_id`);

--
-- Indexes for table `subelection_position`
--
ALTER TABLE `subelection_position`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subelection_id` (`subelection_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `subelection_position_id` (`subelection_position_id`);

--
-- Indexes for table `voter_block`
--
ALTER TABLE `voter_block`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parent_election` (`parent_election_id`);

--
-- Indexes for table `voter_block_members`
--
ALTER TABLE `voter_block_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `block_id` (`block_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `election`
--
ALTER TABLE `election`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `subelection`
--
ALTER TABLE `subelection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subelection_authorized_vblocks`
--
ALTER TABLE `subelection_authorized_vblocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subelection_position`
--
ALTER TABLE `subelection_position`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `vote`
--
ALTER TABLE `vote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `voter_block`
--
ALTER TABLE `voter_block`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `voter_block_members`
--
ALTER TABLE `voter_block_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidate`
--
ALTER TABLE `candidate`
  ADD CONSTRAINT `candidate_ibfk_1` FOREIGN KEY (`subelection_position_id`) REFERENCES `subelection_position` (`id`);

--
-- Constraints for table `subelection`
--
ALTER TABLE `subelection`
  ADD CONSTRAINT `subelection_ibfk_1` FOREIGN KEY (`election_id`) REFERENCES `election` (`id`);

--
-- Constraints for table `subelection_authorized_vblocks`
--
ALTER TABLE `subelection_authorized_vblocks`
  ADD CONSTRAINT `subelection_authorized_vblocks_ibfk_1` FOREIGN KEY (`subelection_id`) REFERENCES `subelection` (`id`),
  ADD CONSTRAINT `subelection_authorized_vblocks_ibfk_2` FOREIGN KEY (`authorized_voter_block_id`) REFERENCES `voter_block` (`id`);

--
-- Constraints for table `subelection_position`
--
ALTER TABLE `subelection_position`
  ADD CONSTRAINT `subelection_position_ibfk_1` FOREIGN KEY (`subelection_id`) REFERENCES `subelection` (`id`);

--
-- Constraints for table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidate` (`id`),
  ADD CONSTRAINT `vote_ibfk_3` FOREIGN KEY (`subelection_position_id`) REFERENCES `subelection_position` (`id`);

--
-- Constraints for table `voter_block`
--
ALTER TABLE `voter_block`
  ADD CONSTRAINT `fk_parent_election` FOREIGN KEY (`parent_election_id`) REFERENCES `election` (`id`);

--
-- Constraints for table `voter_block_members`
--
ALTER TABLE `voter_block_members`
  ADD CONSTRAINT `voter_block_members_ibfk_1` FOREIGN KEY (`block_id`) REFERENCES `voter_block` (`id`),
  ADD CONSTRAINT `voter_block_members_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
