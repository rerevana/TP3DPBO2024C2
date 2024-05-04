-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2024 at 04:21 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_film`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `id_film` int(11) NOT NULL,
  `foto_film` varchar(255) NOT NULL,
  `judul_film` varchar(11) NOT NULL,
  `id_genre` int(11) NOT NULL,
  `durasi_film` int(11) NOT NULL,
  `id_sutradara` int(11) NOT NULL,
  `id_negara` int(11) NOT NULL,
  `rating_usia_film` enum('SU','P 2+','A 7+','R 13+','D 17+') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`id_film`, `foto_film`, `judul_film`, `id_genre`, `durasi_film`, `id_sutradara`, `id_negara`, `rating_usia_film`) VALUES
(14, '509-titanic.jpg', 'Titanic', 5, 161, 5, 2, 'R 13+'),
(21, '759-archer.jpg', 'Archer', 2, 123, 1, 1, 'SU'),
(23, '830-homealone.jpg', 'Home Alone', 4, 145, 3, 4, 'A 7+');

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `id_genre` int(11) NOT NULL,
  `nama_genre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`id_genre`, `nama_genre`) VALUES
(2, 'Thriller'),
(3, 'Drama'),
(4, 'Komedi'),
(5, 'Romance'),
(6, 'Action');

-- --------------------------------------------------------

--
-- Table structure for table `negara`
--

CREATE TABLE `negara` (
  `id_negara` int(11) NOT NULL,
  `nama_negara` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `negara`
--

INSERT INTO `negara` (`id_negara`, `nama_negara`) VALUES
(1, 'Indonesia'),
(2, 'Korea Selatan'),
(4, 'China'),
(5, 'Thailand'),
(6, 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `sutradara`
--

CREATE TABLE `sutradara` (
  `id_sutradara` int(11) NOT NULL,
  `nama_sutradara` varchar(100) NOT NULL,
  `jenis_kelamin_sutradara` enum('Laki-Laki','Perempuan','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sutradara`
--

INSERT INTO `sutradara` (`id_sutradara`, `nama_sutradara`, `jenis_kelamin_sutradara`) VALUES
(1, 'Joko Anwar', 'Laki-Laki'),
(3, 'Revana Faliha Salma', 'Perempuan'),
(4, 'Rere', 'Laki-Laki'),
(5, 'James Cameron', 'Laki-Laki'),
(6, 'John Musker', 'Laki-Laki');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id_film`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`id_genre`);

--
-- Indexes for table `negara`
--
ALTER TABLE `negara`
  ADD PRIMARY KEY (`id_negara`);

--
-- Indexes for table `sutradara`
--
ALTER TABLE `sutradara`
  ADD PRIMARY KEY (`id_sutradara`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `film`
--
ALTER TABLE `film`
  MODIFY `id_film` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `id_genre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `negara`
--
ALTER TABLE `negara`
  MODIFY `id_negara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sutradara`
--
ALTER TABLE `sutradara`
  MODIFY `id_sutradara` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
