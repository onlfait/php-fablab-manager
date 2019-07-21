-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : hera.myd.infomaniak.com
-- Généré le :  Dim 21 juil. 2019 à 08:17
-- Version du serveur :  5.6.33-log
-- Version de PHP :  7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hera_dev`
--

--
-- Déchargement des données de la table `Ateliers`
--

INSERT INTO `Ateliers` (`ID`, `AtelierName`, `AtelierVariableName`) VALUES
(1, 'Atelier Communautaire', 'AtelierCommunautaire'),
(2, 'Cours', 'Cours'),
(3, 'Event', 'Event');

--
-- Déchargement des données de la table `Evenements`
--

INSERT INTO `Evenements` (`NoEvent`, `Titre`, `Description`, `Lieu`, `TypeEvent`, `HeureDebut`, `HeureFin`, `Age`, `PrixMembre`, `PrixNonMembre`, `PlaceDispo`, `PlaceMax`) VALUES
(2, 'Evénement 2', 'Bla Bla', 'FabLab OnlFait', '', '2019-03-09 14:00:00', '2019-03-09 16:00:00', 6, 50, 60, 2, 6),
(3, 'Event', 'fsdfsdf', 'FabLab OnlFait', '', '2019-05-17 10:00:00', '2019-05-17 13:00:00', 12, 101, 140, 5, 6),
(5, 'Evénement test', 'C\'est un test suite à la remarque de Cristina', 'FabLab OnlFait', '', '2019-06-19 10:00:00', '2019-06-19 12:00:00', 12, 200, 300, 6, 6),
(6, 'Event test', 'sldfjdlsfjdklfjdslfjl', 'FabLab OnlFait', '', '2019-07-25 12:00:00', '2019-07-25 16:00:00', 12, 200, 250, 6, 6);

--
-- Déchargement des données de la table `InscrEvent`
--

INSERT INTO `InscrEvent` (`NoInscr`, `NoEvent`, `Nom`, `Prenom`, `Email`) VALUES
(1, 1, 'Thomas', 'Sébastien', 'sebastienthomas001@gmail.com'),
(2, 2, 'Thom', 'Séb', 'séb@gmail.com'),
(3, 1, 'Nom2', 'Prénom2', 'Email2@gmail.com'),
(4, 1, 'Sébastien', 'Test', 'sdsdsdsd@dsfsd'),
(5, 3, 'Thomas', 'Séb', 'sebastienthomas001@gmail.com'),
(6, 4, 'Thomas', 'Sébastien', 'sebastienthomas001@gmail.com'),
(7, 2, 'Olivotto', 'Cristina', 'cristina.olivotto@gmail.com'),
(8, 2, 'Olivotto', 'Cristina', 'cristina.olivotto@gmail.com'),
(9, 2, 'Thomas', 'Séb', 'sebastienthomas001@gmail.com');

--
-- Déchargement des données de la table `Liaison`
--

INSERT INTO `Liaison` (`ID`, `IDProjet`, `IDEvent`, `IDMembre`, `Ateliers`, `Sujets`, `Outils`) VALUES
(20, 2, NULL, NULL, NULL, NULL, 'Dessin2D'),
(21, 2, NULL, NULL, NULL, NULL, 'Dessin3D'),
(22, 2, NULL, NULL, NULL, 'DIY', NULL),
(23, 2, NULL, NULL, NULL, 'Electronique', NULL),
(34, 3, NULL, NULL, NULL, NULL, 'Dessin2D'),
(35, 3, NULL, NULL, NULL, NULL, 'Soudure'),
(36, 3, NULL, NULL, NULL, 'Electronique', NULL),
(37, 3, NULL, NULL, NULL, 'Robotique', NULL),
(111, 0, NULL, NULL, NULL, NULL, 'Dessin2D'),
(112, 0, NULL, NULL, NULL, NULL, 'Dessin3D'),
(113, 0, NULL, NULL, NULL, NULL, 'Impression3D'),
(114, 0, NULL, NULL, NULL, 'DIY', NULL),
(115, 0, NULL, NULL, NULL, 'Programmation', NULL),
(213, 1, NULL, NULL, NULL, NULL, 'DecoupeVinyle'),
(214, 1, NULL, NULL, NULL, NULL, 'Dessin3D'),
(215, 1, NULL, NULL, NULL, 'DIY', NULL),
(216, 1, NULL, NULL, NULL, 'ETextile', NULL),
(217, 1, NULL, NULL, NULL, 'Recyclage', NULL),
(345, 4, NULL, NULL, NULL, NULL, 'Dessin2D'),
(346, 4, NULL, NULL, NULL, 'Electronique', NULL),
(347, 4, NULL, NULL, NULL, 'InternetOfThings', NULL),
(348, 4, NULL, NULL, NULL, 'Robotique', NULL),
(354, NULL, 3, NULL, 'AtelierCommunautaire', NULL, NULL),
(355, NULL, 3, NULL, NULL, NULL, 'DecoupeVinyle'),
(356, NULL, 3, NULL, NULL, NULL, 'Dessin3D'),
(357, NULL, 3, NULL, NULL, 'DIY', NULL),
(358, NULL, 3, NULL, NULL, 'ETextile', NULL),
(517, NULL, NULL, 6, NULL, NULL, 'DecoupeVinyle'),
(518, NULL, NULL, 6, NULL, NULL, 'Dessin2D'),
(519, NULL, NULL, 6, NULL, 'InternetOfThings', NULL),
(531, NULL, 2, NULL, 'AtelierCommunautaire', NULL, NULL),
(532, NULL, 2, NULL, NULL, NULL, 'DecoupeLaser'),
(533, NULL, 2, NULL, NULL, NULL, 'DecoupeVinyle'),
(534, NULL, 2, NULL, NULL, 'Electronique', NULL),
(535, NULL, 2, NULL, NULL, 'Programmation', NULL),
(548, NULL, NULL, 9, NULL, NULL, 'Dessin2D'),
(549, NULL, NULL, 9, NULL, NULL, 'Dessin3D'),
(550, NULL, NULL, 9, NULL, NULL, 'Impression3D'),
(551, NULL, NULL, 9, NULL, 'DIY', NULL),
(552, NULL, NULL, 9, NULL, 'ETextile', NULL),
(553, NULL, NULL, 9, NULL, 'Recyclage', NULL),
(573, NULL, NULL, 11, NULL, NULL, 'DecoupeLaser'),
(574, NULL, NULL, 11, NULL, NULL, 'DecoupeVinyle'),
(575, NULL, NULL, 11, NULL, NULL, 'Dessin2D'),
(576, NULL, NULL, 11, NULL, NULL, 'Dessin3D'),
(577, NULL, NULL, 11, NULL, NULL, 'Impression3D'),
(578, NULL, NULL, 11, NULL, NULL, 'Soudure'),
(579, NULL, NULL, 11, NULL, 'DIY', NULL),
(580, NULL, NULL, 11, NULL, 'Electronique', NULL),
(581, NULL, NULL, 11, NULL, 'ETextile', NULL),
(582, NULL, NULL, 11, NULL, 'InternetOfThings', NULL),
(583, NULL, NULL, 11, NULL, 'Programmation', NULL),
(584, NULL, NULL, 11, NULL, 'Recyclage', NULL),
(585, NULL, NULL, 11, NULL, 'Robotique', NULL),
(586, NULL, NULL, 11, NULL, 'Science', NULL),
(587, NULL, 4, NULL, 'Cours', NULL, NULL),
(588, NULL, 4, NULL, NULL, NULL, 'DecoupeVinyle'),
(589, NULL, 4, NULL, NULL, NULL, 'Dessin2D'),
(590, NULL, 4, NULL, NULL, 'DIY', NULL),
(591, NULL, 4, NULL, NULL, 'InternetOfThings', NULL),
(1085, NULL, NULL, 1, NULL, NULL, 'Dessin2D'),
(1086, NULL, NULL, 1, NULL, NULL, 'Dessin3D'),
(1087, NULL, NULL, 1, NULL, NULL, 'Soudure'),
(1088, NULL, NULL, 1, NULL, 'DIY', NULL),
(1089, NULL, NULL, 1, NULL, 'InternetOfThings', NULL),
(1090, NULL, NULL, 1, NULL, 'Programmation', NULL),
(1092, NULL, 5, NULL, 'AtelierCommunautaire', NULL, NULL),
(1093, NULL, 5, NULL, NULL, NULL, 'Dessin2D'),
(1094, NULL, 5, NULL, NULL, NULL, 'Dessin3D'),
(1095, NULL, 5, NULL, NULL, 'ETextile', NULL),
(1096, NULL, 5, NULL, NULL, 'Programmation', NULL),
(1107, NULL, 6, NULL, 'Event', NULL, NULL),
(1108, NULL, 6, NULL, NULL, NULL, 'Dessin2D'),
(1109, NULL, 6, NULL, NULL, NULL, 'Dessin3D'),
(1110, NULL, 6, NULL, NULL, 'ETextile', NULL),
(1111, NULL, 6, NULL, NULL, 'Programmation', NULL);

--
-- Déchargement des données de la table `Login`
--

INSERT INTO `Login` (`ID`, `Login`, `Pw`) VALUES
(1, 'User1', 'Pass1'),
(6, 'User4', 'Pass4'),
(9, 'Seb', 'Thom'),
(11, 'Cristina', 'cherubini'),
(12, 'User12', 'Pass12'),
(13, 'User13', 'Pass13'),
(14, 'User14', 'Pass14'),
(15, 'User15', 'Pass15'),
(16, 'Login16', 'Pass16');

--
-- Déchargement des données de la table `Membres`
--

INSERT INTO `Membres` (`ID`, `Nom`, `Prenom`, `Email`, `Newsletter`, `DateInscription`, `EcheanceCoti`, `NbreHeure`, `AdminMembre`) VALUES
(1, 'Name1', 'Prénom1', 'ones@sfg', 1, '2019-03-04', '2020-03-08', '06:30:00', 1),
(6, 'Name4', 'Prénom4', 'Email4@gmail.com', 0, '2019-05-08', '2019-05-08', '04:00:00', 0),
(9, 'Thomas', 'Sébastien', 'sebastienthomas001@gmail.com', 0, '2019-05-08', '2020-05-07', '09:00:00', 0),
(11, 'Olivotto', 'Cristina', 'cristina@onlfait.ch', 0, '2019-05-27', '2021-05-27', '06:00:00', 0),
(12, 'Name12', 'Prénom12', 'Email12@gmail', 1, '2019-07-19', '2019-07-19', '00:00:00', 1),
(13, 'Name13', 'Prénom13', 'Email13@asdasd', 0, '2019-07-19', '2019-07-19', '00:00:00', 0),
(14, 'Nom14', 'Prénom14', 'Email14@sfdsf', 1, '2019-07-19', '2019-07-19', '00:00:00', 0),
(15, 'Name15', 'Prénom15', 'Email15@sddsfs', 0, '2019-07-19', '2019-07-19', '00:00:00', 0),
(16, 'Name16', 'Prénom16', 'Email16@asdsd', 1, '2019-07-19', '2019-07-19', '00:00:00', 0);

--
-- Déchargement des données de la table `Outils`
--

INSERT INTO `Outils` (`ID`, `OutilName`, `OutilVariableName`) VALUES
(1, 'Découpe Laser', 'DecoupeLaser'),
(2, 'Découpe Vinyle', 'DecoupeVinyle'),
(3, 'Dessin 2D', 'Dessin2D'),
(4, 'Dessin 3D', 'Dessin3D'),
(5, 'Impression 3D', 'Impression3D'),
(6, 'Soudure', 'Soudure');

--
-- Déchargement des données de la table `pec_calendars`
--

INSERT INTO `pec_calendars` (`id`, `type`, `user_id`, `name`, `description`, `color`, `admin_id`, `status`, `show_in_list`, `public`, `reminder_message_email`, `reminder_message_popup`, `access_key`, `created_on`, `updated_on`) VALUES
(1, 'user', 1, 'Default Calendar', 'This is a default calendar', '#3a87ad', NULL, 'on', '1', 1, '', '', '', '2014-03-20 00:00:00', NULL);

--
-- Déchargement des données de la table `pec_events`
--

INSERT INTO `pec_events` (`id`, `cal_id`, `IDMembre`, `type`, `start_date`, `start_time`, `start_timestamp`, `end_date`, `end_time`, `end_timestamp`, `repeat_type`, `repeat_interval`, `repeat_count`, `repeat_start_date`, `repeat_end_on`, `repeat_end_after`, `repeat_never`, `repeat_by`, `repeat_on_sun`, `repeat_on_mon`, `repeat_on_tue`, `repeat_on_wed`, `repeat_on_thu`, `repeat_on_fri`, `repeat_on_sat`, `repeat_deleted_indexes`, `title`, `description`, `allDay`, `url`, `color`, `backgroundColor`, `textColor`, `borderColor`, `location`, `available`, `privacy`, `image`, `invitation`, `invitation_event_id`, `invitation_creator_id`, `invitation_response`, `free_busy`, `created_by`, `modified_by`, `created_on`, `updated_on`) VALUES
(58, 1, 1, NULL, '2019-07-20', '12:00', 1563616800, '2019-07-20', '14:00', 1563624000, 'none', NULL, 0, '0000-01-01', '0000-01-01', 0, 0, NULL, 0, 0, 0, 0, 0, 0, 0, NULL, 'Imprimante 3D n1 (Prénom1 Name1)', NULL, NULL, NULL, NULL, '#ff9999', NULL, '#ff9999', NULL, '1', 'public', NULL, '0', 0, 0, 'pending', 'free', NULL, NULL, NULL, NULL);

--
-- Déchargement des données de la table `pec_settings`
--

INSERT INTO `pec_settings` (`id`, `user_id`, `admin_id`, `shortdate_format`, `longdate_format`, `timeformat`, `custom_view`, `start_day`, `default_view`, `wysiwyg`, `staff_mode`, `calendar_mode`, `timeline_day_width`, `timeline_row_height`, `timeline_show_hours`, `timeline_mode`, `week_cal_timeslot_min`, `timeslot_height`, `week_cal_start_time`, `week_cal_end_time`, `week_cal_show_hours`, `event_tooltip`, `left_side_visible`, `language`, `time_zone`, `email_server`) VALUES
(1, 1, NULL, 'mm/dd/yyyy', 'DD, dd MM yyyy', 'core', NULL, 0, 'month', '0', '0', 'vertical', 360, 28, 1, 'horizontal', 30, 20, '00:00', '23:00', 1, 1, 1, 'English', '-12', 'PHPMailer');

--
-- Déchargement des données de la table `ProjetsPersonnels`
--

INSERT INTO `ProjetsPersonnels` (`ID`, `NoMembre`, `Titre`, `Description`, `DateSave`, `ZipFile`) VALUES
(3, 2, 'Projet du membre 2', 'asdsdsadsdda', '2019-04-29', 1),
(4, 10, 'Projet de Séb', 'asdasdjkdhakh ajkdsjaskdhka', '2019-05-11', 1);

--
-- Déchargement des données de la table `Sujets`
--

INSERT INTO `Sujets` (`ID`, `SujetName`, `SujetVariableName`) VALUES
(1, 'DIY', 'DIY'),
(2, 'Electronique', 'Electronique'),
(3, 'E-tectile', 'ETextile'),
(4, 'Internet Of Things', 'InternetOfThings'),
(5, 'Programmation', 'Programmation'),
(6, 'Recyclage', 'Recyclage'),
(7, 'Robotique', 'Robotique'),
(8, 'Science', 'Science');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
