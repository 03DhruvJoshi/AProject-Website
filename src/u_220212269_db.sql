-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2023 at 06:04 PM
-- Server version: 8.0.32-0ubuntu0.20.04.2
-- PHP Version: 8.1.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_220212269_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `pid` int UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `phase` enum('design','development','testing','deployment','complete') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `uid` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`pid`, `title`, `start_date`, `end_date`, `phase`, `description`, `uid`) VALUES
(1, 'Basic Calculator', '2023-04-07', '2023-08-23', 'testing', ' A number guessing game where the computer generates \r\n    a random number and the player has to guess i. 5 inputs \r\n    allowed per game and 3 hints allowed per day. The game will \r\n    be created using Ruby. ', 1),
(2, 'Number Guessing Game', '2023-04-06', '2024-07-19', 'testing', ' A number guessing game where the computer generates \r\n    a random number and the player has to guess i. 5 inputs \r\n    allowed per game and 3 hints allowed per day. The game will \r\n    be created using Python', 2),
(3, 'Tic-Tac-Toe Game', '2023-04-14', '2024-01-23', 'deployment', 'Tic-Tac-Toe game with multiple playing options that will allow\r\n    players to compete against the computer, or against each other\r\n    through both online or offline using a single computer. The game will\r\n    be created using Java.', 2),
(4, 'Bucket List', '2023-04-10', '2023-09-06', 'design', 'An Android application using Kotlin and HTML, that will allow \r\n    users to create, edit and delete tasks. The application will contain \r\n    additional features such as timer, reminders, motivational quotes, \r\n    screentime saver, applock, and the option to prioritise tasks.', 3),
(5, 'Text Adventure Game', '2023-04-21', '2023-10-13', 'design', ' A text-based adventure game to be developed using Unity and C# \r\n    that will allow players to navigate through a story by making\r\n    choices listed in multiple choice format via 4 options. \r\n    The game will be hosted on an online platform where users can create their own stories for the \r\n    entire gaming community to enjoy.', 4),
(6, 'Hangman Game', '2023-04-12', '2023-08-18', 'testing', ' A hangman game to be developed using Go language that will allow\r\n    players to compete against each other where the players have to guess a \r\n    word by suggesting letters. The game will have no hints as the first player \r\n    to determine the word will win.', 4),
(7, 'RPS Game', '2023-03-28', '2023-09-20', 'testing', ' A rock-paper-scissor with multiple playing options that will allow\r\n    players to compete against the computer, or against each other\r\n    through both online or offline using a single computer. The game will\r\n    be created using Java and Unreal Engine. ', 5),
(8, 'Password Generator', '2023-03-29', '2023-08-06', 'development', ' A password generator software that will allow users to create extremely strong\r\n    but memorable passwords that will be secure and resilient to any type of password \r\n    attacks including dictionary and brute force attacks. The software will also contain \r\n    a manual on how to create a strong password, and it will also contain a dedicated passowrd tester\r\n    to test the password strength.', 5),
(9, 'EdTech App for GCSE students', '2023-04-13', '2024-06-06', 'development', ' An Android application to be developed using Java, Kotlin and HTML, that will allow\r\n    GCSE students to be prepare for the exams in a fun and interactive way. The application will \r\n    be divided into 2 sections: Theory and Quiz. In the first section, students will come across learning \r\n    the fundamental topics of the different subjects, and their knowledge will be tested through the \r\n    second section.', 5),
(10, 'Mad Libs Game', '2023-04-19', '2023-10-20', 'testing', ' A Mad Libs Game using C++ that will allow players to fill in the blanks in a story with their \r\n    own words. In the game, Without exposing the context of a word, one player invites the other players \r\n    to fill in each blank with a word of the appropriate category. The finished story is then read aloud. \r\n    The outcome is typically a statement that has a funny, bizarre, or slightly nonsensical tone. ', 6),
(11, '2D Fighter Game', '2023-03-28', '2023-08-16', 'development', 'It is a 2D fighter game, an action-packed experience featuring diverse characters, responsive controls, and engaging gameplay. Get ready to fight your way to the top!', 1),
(12, 'Snake Game', '2023-03-15', '2023-08-22', 'testing', 'The snake game is a classic arcade-style game where players control a growing snake, eat food, and avoid obstacles to score points. This game is made using Java and C++. ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int UNSIGNED NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `email`) VALUES
(1, '1232', '$2y$10$V/3oe5iIeQJZYvXJKb4sPeAS0f/xt2v6ZYaKXkP83sbOGLObqt2DO', '1232@email.com'),
(2, 'hwo', '$2y$10$NDjs37k4emlpxgonQcN4hOmVff3zLqourvCm/ShnfW12Qf3rOCIOO', 'hwo@email.com'),
(3, 'hello', '$2y$10$I.B6w4LpUUNfu2PxDMFlr.YKW9ChIqb7obl.YSVDbOqZbgwZt2KYq', 'hello@gmail.com'),
(4, 'hjhj123', '$2y$10$4n.g6fUogzHBB8vk3suag.jijee0BBo7B9XuLveJ.dt5F18fzMZLi', 'hjhj@gmail.com'),
(5, 'mickyjonny112', '$2y$10$MPvWmm2cPoISo0CfEqDqhuN9c80wbproRlICyXvoZkha.7pPGjhEW', 'micky@email.com'),
(6, 'firestone3', '$2y$10$CEtH8t/uXka9LVIJhpGCteZ6aEhk2TDR6eZN7mXUe.Nxcgfr6c4de', 'fire@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `pid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
