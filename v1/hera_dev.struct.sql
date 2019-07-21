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

-- --------------------------------------------------------

--
-- Structure de la table `Ateliers`
--

CREATE TABLE `Ateliers` (
  `ID` int(11) NOT NULL,
  `AtelierName` varchar(30) NOT NULL,
  `AtelierVariableName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Evenements`
--

CREATE TABLE `Evenements` (
  `NoEvent` int(5) NOT NULL,
  `Titre` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Lieu` varchar(50) NOT NULL,
  `TypeEvent` varchar(50) NOT NULL,
  `HeureDebut` datetime NOT NULL,
  `HeureFin` datetime NOT NULL,
  `Age` int(11) NOT NULL,
  `PrixMembre` int(11) NOT NULL,
  `PrixNonMembre` int(11) NOT NULL,
  `PlaceDispo` int(11) NOT NULL,
  `PlaceMax` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `InscrEvent`
--

CREATE TABLE `InscrEvent` (
  `NoInscr` int(5) NOT NULL,
  `NoEvent` int(5) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `jqcalendar`
--

CREATE TABLE `jqcalendar` (
  `Id` int(11) NOT NULL,
  `Subject` varchar(1000) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Location` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `Description` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `StartTime` datetime DEFAULT NULL,
  `EndTime` datetime DEFAULT NULL,
  `StartTimeTS` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `EndTimeTS` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `IsAllDayEvent` smallint(6) NOT NULL,
  `Color` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `RecurringRule` varchar(500) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `Liaison`
--

CREATE TABLE `Liaison` (
  `ID` int(11) NOT NULL,
  `IDProjet` int(11) DEFAULT NULL,
  `IDEvent` int(11) DEFAULT NULL,
  `IDMembre` int(11) DEFAULT NULL,
  `Ateliers` varchar(50) DEFAULT NULL,
  `Sujets` varchar(50) DEFAULT NULL,
  `Outils` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Login`
--

CREATE TABLE `Login` (
  `ID` int(11) NOT NULL,
  `Login` varchar(50) COLLATE latin1_general_cs NOT NULL,
  `Pw` varchar(50) COLLATE latin1_general_cs NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_cs;

-- --------------------------------------------------------

--
-- Structure de la table `Membres`
--

CREATE TABLE `Membres` (
  `ID` int(11) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Newsletter` int(11) NOT NULL DEFAULT '0',
  `DateInscription` date NOT NULL,
  `EcheanceCoti` date NOT NULL,
  `NbreHeure` time NOT NULL,
  `AdminMembre` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Outils`
--

CREATE TABLE `Outils` (
  `ID` int(11) NOT NULL,
  `OutilName` varchar(30) NOT NULL,
  `OutilVariableName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pec_calendars`
--

CREATE TABLE `pec_calendars` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` enum('user','group','url') DEFAULT 'user',
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `color` varchar(7) DEFAULT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `status` enum('on','off') DEFAULT 'on',
  `show_in_list` enum('0','1') DEFAULT NULL,
  `public` tinyint(3) UNSIGNED DEFAULT '0',
  `reminder_message_email` text,
  `reminder_message_popup` text,
  `access_key` varchar(32) DEFAULT NULL COMMENT 'ical subscribe access key',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pec_events`
--

CREATE TABLE `pec_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `cal_id` int(10) UNSIGNED DEFAULT NULL,
  `IDMembre` int(11) NOT NULL,
  `type` enum('standard','multi_day') DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `start_time` char(5) DEFAULT NULL,
  `start_timestamp` int(10) UNSIGNED DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `end_time` char(5) DEFAULT NULL,
  `end_timestamp` int(10) UNSIGNED DEFAULT NULL,
  `repeat_type` enum('none','daily','everyWeekDay','everyMWFDay','everyTTDay','weekly','monthly','yearly') DEFAULT 'none',
  `repeat_interval` tinyint(3) UNSIGNED DEFAULT NULL,
  `repeat_count` tinyint(3) UNSIGNED DEFAULT '0',
  `repeat_start_date` date DEFAULT '0000-01-01',
  `repeat_end_on` date DEFAULT '0000-01-01',
  `repeat_end_after` int(11) DEFAULT '0',
  `repeat_never` tinyint(1) DEFAULT '0',
  `repeat_by` enum('repeat_by_day_of_the_month','repeat_by_day_of_the_week') DEFAULT NULL,
  `repeat_on_sun` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_on_mon` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_on_tue` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_on_wed` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_on_thu` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_on_fri` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_on_sat` tinyint(1) NOT NULL DEFAULT '0',
  `repeat_deleted_indexes` varchar(255) DEFAULT NULL,
  `title` text,
  `description` varchar(200) DEFAULT NULL,
  `allDay` varchar(10) DEFAULT NULL,
  `url` varchar(256) DEFAULT NULL,
  `color` varchar(15) DEFAULT NULL,
  `backgroundColor` varchar(20) DEFAULT NULL,
  `textColor` varchar(20) DEFAULT NULL,
  `borderColor` varchar(20) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `available` enum('0','1') DEFAULT '1',
  `privacy` enum('public','private') DEFAULT 'public',
  `image` varchar(100) DEFAULT NULL,
  `invitation` enum('1','0') DEFAULT '0',
  `invitation_event_id` int(10) UNSIGNED DEFAULT '0',
  `invitation_creator_id` int(10) UNSIGNED DEFAULT '0',
  `invitation_response` enum('yes','no','maybe','pending') DEFAULT 'pending',
  `free_busy` enum('free','busy') NOT NULL,
  `created_by` varchar(30) DEFAULT NULL,
  `modified_by` varchar(30) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `updated_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pec_settings`
--

CREATE TABLE `pec_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `shortdate_format` varchar(20) DEFAULT NULL,
  `longdate_format` varchar(20) DEFAULT NULL,
  `timeformat` enum('core','standard') DEFAULT NULL,
  `custom_view` tinyint(3) UNSIGNED DEFAULT NULL,
  `start_day` tinyint(1) DEFAULT '0',
  `default_view` varchar(20) DEFAULT NULL,
  `wysiwyg` enum('1','0') DEFAULT '0',
  `staff_mode` enum('0','1') DEFAULT '0',
  `calendar_mode` enum('vertical','timeline') DEFAULT 'vertical',
  `timeline_day_width` mediumint(8) UNSIGNED DEFAULT '360',
  `timeline_row_height` mediumint(8) UNSIGNED DEFAULT '28',
  `timeline_show_hours` tinyint(3) UNSIGNED DEFAULT '1',
  `timeline_mode` enum('horizontal','vertical') DEFAULT 'horizontal',
  `week_cal_timeslot_min` mediumint(8) UNSIGNED DEFAULT '30',
  `timeslot_height` tinyint(3) UNSIGNED DEFAULT '20',
  `week_cal_start_time` char(5) DEFAULT '00:00',
  `week_cal_end_time` char(5) DEFAULT '23:00',
  `week_cal_show_hours` tinyint(3) UNSIGNED DEFAULT '1',
  `event_tooltip` tinyint(3) UNSIGNED DEFAULT '1',
  `left_side_visible` tinyint(3) UNSIGNED DEFAULT '1',
  `language` varchar(64) DEFAULT 'English',
  `time_zone` varchar(4) DEFAULT '-12',
  `email_server` enum('PHPMailer','SendGrid') DEFAULT 'PHPMailer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `pec_users`
--

CREATE TABLE `pec_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `access_key` varchar(32) DEFAULT NULL,
  `activated` tinyint(3) UNSIGNED DEFAULT '1',
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `role` enum('super','admin','user') DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `active_calendar_id` varchar(512) NOT NULL DEFAULT '0',
  `company` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `timezone` varchar(30) DEFAULT NULL,
  `language` varchar(10) DEFAULT NULL,
  `theme` varchar(20) DEFAULT NULL,
  `kbd_shortcuts` tinyint(3) UNSIGNED DEFAULT '1',
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ProjetsPersonnels`
--

CREATE TABLE `ProjetsPersonnels` (
  `ID` int(11) NOT NULL,
  `NoMembre` int(11) NOT NULL,
  `Titre` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `DateSave` date NOT NULL,
  `ZipFile` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `Sujets`
--

CREATE TABLE `Sujets` (
  `ID` int(11) NOT NULL,
  `SujetName` varchar(30) NOT NULL,
  `SujetVariableName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Ateliers`
--
ALTER TABLE `Ateliers`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Evenements`
--
ALTER TABLE `Evenements`
  ADD KEY `ID` (`NoEvent`);

--
-- Index pour la table `InscrEvent`
--
ALTER TABLE `InscrEvent`
  ADD KEY `NoInscr` (`NoInscr`);

--
-- Index pour la table `jqcalendar`
--
ALTER TABLE `jqcalendar`
  ADD PRIMARY KEY (`Id`);

--
-- Index pour la table `Liaison`
--
ALTER TABLE `Liaison`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Membres`
--
ALTER TABLE `Membres`
  ADD KEY `NoMembre` (`ID`);

--
-- Index pour la table `Outils`
--
ALTER TABLE `Outils`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `pec_calendars`
--
ALTER TABLE `pec_calendars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Index pour la table `pec_events`
--
ALTER TABLE `pec_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cal_id` (`cal_id`,`type`,`start_date`),
  ADD KEY `cal_id_2` (`cal_id`,`type`,`end_date`),
  ADD KEY `cal_id_3` (`cal_id`,`type`,`start_date`,`end_date`),
  ADD KEY `cal_id_4` (`cal_id`,`start_date`),
  ADD KEY `cal_id_5` (`cal_id`,`end_date`),
  ADD KEY `cal_id_6` (`cal_id`,`start_date`,`end_date`);

--
-- Index pour la table `pec_settings`
--
ALTER TABLE `pec_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Index pour la table `pec_users`
--
ALTER TABLE `pec_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `i_username` (`username`),
  ADD KEY `fk_admin_id` (`admin_id`),
  ADD KEY `access_key` (`access_key`);

--
-- Index pour la table `ProjetsPersonnels`
--
ALTER TABLE `ProjetsPersonnels`
  ADD PRIMARY KEY (`ID`);

--
-- Index pour la table `Sujets`
--
ALTER TABLE `Sujets`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Ateliers`
--
ALTER TABLE `Ateliers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Evenements`
--
ALTER TABLE `Evenements`
  MODIFY `NoEvent` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `InscrEvent`
--
ALTER TABLE `InscrEvent`
  MODIFY `NoInscr` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jqcalendar`
--
ALTER TABLE `jqcalendar`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Liaison`
--
ALTER TABLE `Liaison`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Login`
--
ALTER TABLE `Login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Membres`
--
ALTER TABLE `Membres`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Outils`
--
ALTER TABLE `Outils`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pec_calendars`
--
ALTER TABLE `pec_calendars`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pec_events`
--
ALTER TABLE `pec_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pec_settings`
--
ALTER TABLE `pec_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `pec_users`
--
ALTER TABLE `pec_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Sujets`
--
ALTER TABLE `Sujets`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `pec_calendars`
--
ALTER TABLE `pec_calendars`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `pec_users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pec_events`
--
ALTER TABLE `pec_events`
  ADD CONSTRAINT `pec_events_ibfk_1` FOREIGN KEY (`cal_id`) REFERENCES `pec_calendars` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `pec_users`
--
ALTER TABLE `pec_users`
  ADD CONSTRAINT `fk_admin_id` FOREIGN KEY (`admin_id`) REFERENCES `pec_users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
