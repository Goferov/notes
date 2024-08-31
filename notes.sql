-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2024 at 04:36 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notes`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notes`
--

CREATE TABLE `notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `description`, `created`) VALUES
(1, 'Buy groceries', 'Remember to buy milk, bread, and eggs.', '2024-08-31 10:00:00'),
(2, 'Meeting with team', 'Discuss project updates and next steps.', '2024-08-31 11:00:00'),
(3, 'Doctor appointment', 'Check-up at the clinic at 3 PM.', '2024-08-31 09:30:00'),
(4, 'Finish report', 'Complete the quarterly financial report.', '2024-08-30 14:00:00'),
(5, 'Call John', 'Follow up on the partnership proposal.', '2024-08-30 16:30:00'),
(6, 'Plan weekend trip', 'Research and book activities for the weekend.', '2024-08-29 18:00:00'),
(7, 'Send invoices', 'Send out invoices to clients for August.', '2024-08-29 09:00:00'),
(8, 'Read book', 'Finish reading \"Atomic Habits\".', '2024-08-28 20:00:00'),
(9, 'Gym session', 'Workout at the gym for an hour.', '2024-08-28 07:00:00'),
(10, 'Update website', 'Revise the homepage content and upload new photos.', '2024-08-27 13:00:00'),
(11, 'Client presentation', 'Prepare slides for Monday\'s presentation.', '2024-08-26 15:00:00'),
(12, 'Grocery shopping', 'Need to buy vegetables and fruits.', '2024-08-25 12:00:00'),
(13, 'Car maintenance', 'Get the oil changed and tires checked.', '2024-08-24 10:00:00'),
(14, 'Organize files', 'Sort and organize all work documents.', '2024-08-23 17:00:00'),
(15, 'Attend workshop', 'Join the online productivity workshop.', '2024-08-22 19:00:00'),
(16, 'Pay bills', 'Pay electricity and internet bills.', '2024-08-21 09:30:00'),
(17, 'Buy birthday gift', 'Purchase a gift for Sarah\'s birthday.', '2024-08-20 14:30:00'),
(18, 'Call mom', 'Check in and have a chat with mom.', '2024-08-19 18:00:00'),
(19, 'Renew subscription', 'Renew the magazine subscription.', '2024-08-18 11:00:00'),
(20, 'Dinner reservation', 'Book a table for Friday night.', '2024-08-17 20:00:00'),
(21, 'Complete survey', 'Fill out the customer satisfaction survey.', '2024-08-16 08:00:00'),
(22, 'Clean house', 'Do a deep clean of the living room and kitchen.', '2024-08-15 13:00:00'),
(23, 'Backup data', 'Backup all important files to the cloud.', '2024-08-14 16:00:00'),
(24, 'Meditation', 'Practice meditation for 20 minutes.', '2024-08-13 07:30:00'),
(25, 'Review budget', 'Analyze this month\'s expenses.', '2024-08-12 18:30:00'),
(26, 'Water plants', 'Water all the indoor plants.', '2024-08-11 09:00:00'),
(27, 'Bake cookies', 'Bake a batch of chocolate chip cookies.', '2024-08-10 15:00:00'),
(28, 'Research project', 'Gather information for the new project proposal.', '2024-08-09 11:00:00'),
(29, 'Plan budget', 'Set up the budget for September.', '2024-08-08 10:00:00'),
(30, 'Check emails', 'Sort and respond to all pending emails.', '2024-08-07 09:00:00');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
