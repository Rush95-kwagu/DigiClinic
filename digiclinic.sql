-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 08, 2025 at 05:14 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digiclinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

DROP TABLE IF EXISTS `departement`;
CREATE TABLE IF NOT EXISTS `departement` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `departement_generale_id` bigint UNSIGNED DEFAULT NULL,
  `departement_speciale_id` bigint UNSIGNED DEFAULT NULL,
  `id_chef` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departement_departement_generale_id_foreign` (`departement_generale_id`),
  KEY `departement_departement_speciale_id_foreign` (`departement_speciale_id`),
  KEY `departement_id_chef_foreign` (`id_chef`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departement_generales`
--

DROP TABLE IF EXISTS `departement_generales`;
CREATE TABLE IF NOT EXISTS `departement_generales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_depart` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `libelle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `medecin_id` bigint UNSIGNED DEFAULT NULL,
  `chef_departement_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departement_generales_medecin_id_foreign` (`medecin_id`),
  KEY `departement_generales_chef_departement_id_foreign` (`chef_departement_id`),
  KEY `departement_generales_service_id_foreign` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departement_speciales`
--

DROP TABLE IF EXISTS `departement_speciales`;
CREATE TABLE IF NOT EXISTS `departement_speciales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_depart` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `libelle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `doctors_id` bigint UNSIGNED DEFAULT NULL,
  `chef_departement_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departement_speciales_doctors_id_foreign` (`doctors_id`),
  KEY `departement_speciales_chef_departement_id_foreign` (`chef_departement_id`),
  KEY `departement_speciales_service_id_foreign` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `medecins`
--

DROP TABLE IF EXISTS `medecins`;
CREATE TABLE IF NOT EXISTS `medecins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `specialite` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `diplome` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `annee_experience` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `personnel_id` bigint UNSIGNED DEFAULT NULL,
  `departement_id` bigint UNSIGNED DEFAULT NULL,
  `patient_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medecins_personnel_id_foreign` (`personnel_id`),
  KEY `medecins_departement_id_foreign` (`departement_id`),
  KEY `medecins_patient_id_foreign` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_08_22_123440_create_admins_table', 1),
(6, '2024_08_22_192650_create_departement_speciales_table', 1),
(7, '2024_08_22_195549_create_departement_generales', 1),
(8, '2024_08_23_083757_create_medecins_table', 1),
(9, '2024_08_23_104034_add_status_to_departement_speciales_table', 1),
(10, '2024_08_23_104259_add_status_to_departement_generales_table', 1),
(11, '2024_08_25_213205_create_departement_table', 1),
(12, '2024_08_26_112449_add_id_chef_to_departement_table', 1),
(13, '2024_08_28_185350_create_services_table', 1),
(14, '2024_08_28_214928_add_specialite_to_services_table', 1),
(15, '2024_08_29_000718_create_personnels_table', 1),
(16, '2024_08_29_011628_add_sexe_to_personnels_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `personnel_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sexe` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qualification` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `specialite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `departement` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ville` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `adresse` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `departement_id` bigint UNSIGNED DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`personnel_id`),
  UNIQUE KEY `personnels_email_unique` (`email`),
  KEY `personnels_service_id_foreign` (`service_id`),
  KEY `personnels_departement_id_foreign` (`departement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `personnel`
--

INSERT INTO `personnel` (`personnel_id`, `nom`, `prenom`, `sexe`, `qualification`, `specialite`, `birthdate`, `departement`, `ville`, `telephone`, `adresse`, `email`, `service_id`, `departement_id`, `photo`, `created_at`, `updated_at`, `id_centre`) VALUES
(1, 'Jones', 'John', 'M', 'Acceuil', 'Acceuil', '2024-08-31', 'Dentiste', 'Cotonou', '96868950', 'Zokpa', 'acceuil@gmail.com', 1, 1, '', NULL, NULL, 1),
(2, 'TIANDO', 'Herman', 'M', 'Caisse', 'Caisse/Phcie', '2024-08-31', 'Dentiste', 'Cotonou', '96868950', 'Zokpa', 'caisse@gmail.com', 1, 1, '', NULL, NULL, 1),
(3, 'FOX', 'Jenner', 'F', 'Dr', 'Chirugien', '2024-08-31', 'Dentiste', 'Cotonou', '96868950', 'Zokpa', 'chirurgie@gmail.com', 1, 1, '', NULL, NULL, 1),
(4, 'COLE', 'Jenner', 'F', 'Phcie', 'Pharmacie', '2024-08-31', 'Pharmacie', 'Cotonou', '96868950', 'Zokpa', 'pharmacie@gmail.com', 1, 1, '', NULL, NULL, 1),
(5, 'KILMER', 'Thuram', 'M', 'Labo', 'Laborantin', '2024-08-31', 'Labo', 'Cotonou', '96868950', 'Zokpa', 'labo@gmail.com', 1, 1, '', NULL, NULL, 1),
(6, 'Admin', 'Admin', 'M', 'Admin', 'Administration', '2024-08-31', 'Admin', 'Cotonou', '96868950', 'Zokpa', 'admin@admin', 1, 1, '', NULL, NULL, 1),
(8, 'ADEBOLOU', 'Olaréwadou', 'M', 'Dr', 'Médécin Généraliste', '1992-01-01', 'Ouémé', 'Adjarra', '0196291680', '23 avenue colette besson', 'gene@gmail.com', 2, NULL, '', '2024-12-05 14:03:57', '2024-12-05 14:03:57', 1),
(9, 'DUPONT', 'Anita', 'F', 'Sge-Fm', 'Sage-Femme', '1996-01-02', 'Collines', 'Dassa-Zoumè', '0196969685', 'Route des pêches', 'sage@gmail.com', 3, NULL, '', '2024-12-05 14:05:05', '2024-12-05 14:05:05', 1),
(10, 'NEPAL', 'Anderson', 'M', 'Dr', NULL, '2012-01-02', 'Littoral', 'Cotonou', '66666666', 'CSB ZOPAH', 'medecinchef@gmail.com', 11, NULL, '', '2024-12-18 14:14:09', '2024-12-18 14:14:09', 0),
(11, 'AHOMONTIN', 'Doriane', 'F', 'Sge-Fm', NULL, '2025-01-01', 'Alibori', 'Kandi', '67156137', 'C/sb Godomey-Tougoudo M.ADEBOLOU', 'russelhanss@gmail.com', 3, NULL, '', '2025-01-24 13:29:13', '2025-01-24 13:29:13', 0),
(12, 'STRONG', 'André', 'M', 'Inf', NULL, '1985-05-13', 'Littoral', 'Cotonou', '0167854856', 'Route de Tankpe', 'inf@gmail.com', 35, NULL, '', '2025-03-30 02:29:44', '2025-03-30 02:29:44', 1),
(13, 'KOUAGOU', 'Boukora Bibiane', 'F', 'Inf', NULL, '2004-06-08', 'Plateau', 'Pobè', '67156137', 'CSB ZOPAH', 'russelhansdddds@gmail.com', 2, NULL, '', '2025-03-30 02:34:16', '2025-03-30 02:34:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `services_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `service` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `specialite` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `centre_id` bigint NOT NULL,
  `chef_service` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`services_id`),
  KEY `chief_service_id` (`chef_service`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`services_id`, `service`, `specialite`, `email`, `telephone`, `status`, `centre_id`, `chef_service`, `created_at`, `updated_at`) VALUES
(2, 'Psychiatrie', 'Spécialité Médicale', 'infirmerie@gmail.com', '60606062', '1', 1, 2, '2024-11-11 16:41:46', '2024-11-11 16:41:46'),
(3, 'Maternité', '', 'maternite@gmail.com', '96000000', '1', 1, 3, '2024-11-13 11:54:38', '2024-11-13 11:54:38'),
(4, 'Chirurgie', 'Spécialité Médicale', 'maternite@gmail.com', '96000000', '1', 1, 5, '2024-11-13 13:14:08', '2024-11-13 13:14:08'),
(9, 'Laboratoire', 'Specialité Para Médicale', 'labo@gmail.com', '010101010', '1', 1, 4, '2025-03-14 04:58:45', '2025-03-14 04:58:45'),
(13, 'Médecine Générale', 'Médicale', 'gene+2@gmail.com', '0125254555', '1', 1, 12, '2025-04-04 07:28:51', '2025-04-04 07:28:51'),
(14, 'Echographie', 'Imagerie', 'echo@gmail.com', '0125458548', '1', 1, 10, '2025-04-04 07:59:39', '2025-04-04 07:59:39');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_agendas`
--

DROP TABLE IF EXISTS `tbl_agendas`;
CREATE TABLE IF NOT EXISTS `tbl_agendas` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `patient_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agendas_patient_id_foreign` (`patient_id`),
  KEY `agendas_user_id_foreign` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_analyse`
--

DROP TABLE IF EXISTS `tbl_analyse`;
CREATE TABLE IF NOT EXISTS `tbl_analyse` (
  `id_analyse` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `id_type_analyse` int DEFAULT NULL,
  `payed_analyse_id` bigint NOT NULL,
  `analyse` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `prix` int DEFAULT NULL,
  `prix_manuel` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `analyse_fichier` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `analyse_resultat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `statut_analyse` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`id_analyse`),
  KEY `tbl_analyse_payed` (`payed_analyse_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_analyse`
--

INSERT INTO `tbl_analyse` (`id_analyse`, `patient_id`, `id_type_analyse`, `payed_analyse_id`, `analyse`, `prix`, `prix_manuel`, `user_id`, `analyse_fichier`, `analyse_resultat`, `statut_analyse`, `created_at`, `id_centre`) VALUES
(1, 1, 13, 0, NULL, 7000, NULL, 5, NULL, NULL, 0, '2024-10-02 14:10:59', 0),
(2, 2, 4, 0, NULL, 20000, NULL, 5, NULL, 'nonn', 1, '2024-10-08 14:02:22', 1),
(3, 6, 13, 0, NULL, 7000, NULL, 5, 'Uploads/Analyses/Document_exposé.pdf', 'Test', 1, '2024-12-02 09:26:33', 1),
(4, 2, 3, 0, NULL, 30, NULL, 5, NULL, NULL, 0, '2025-02-05 06:16:41', 1),
(5, 4, 4, 0, NULL, 50, NULL, 5, 'Uploads/Analyses/spécialités.pdf', 'yguyg', 1, '2025-02-05 06:17:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_analyse_parametres`
--

DROP TABLE IF EXISTS `tbl_analyse_parametres`;
CREATE TABLE IF NOT EXISTS `tbl_analyse_parametres` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `element` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `genre` enum('HOMME','FEMME','ADOLESCENT','FEMME ENCEINTE','ENFANT') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `libelle_norme` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `valeur_norme` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tranche_adolescent` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tbl_prestation_id` bigint UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tbl_prestation` (`tbl_prestation_id`),
  KEY `tbl_prestation_id` (`tbl_prestation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_analyse_parametres`
--

INSERT INTO `tbl_analyse_parametres` (`id`, `element`, `genre`, `category`, `libelle_norme`, `valeur_norme`, `tranche_adolescent`, `tbl_prestation_id`) VALUES
(1, 'Elément', 'HOMME', NULL, 'test1', 'testtest2', NULL, 236),
(2, 'Elément', 'FEMME', NULL, 'test3', 'testtest3', NULL, 236),
(3, 'test', 'HOMME', NULL, 'test libellé norme', '0.2', NULL, NULL),
(4, 'ELement norme', 'FEMME', NULL, 'Libelle norme', '32633', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_analyse_payed`
--

DROP TABLE IF EXISTS `tbl_analyse_payed`;
CREATE TABLE IF NOT EXISTS `tbl_analyse_payed` (
  `payed_analyse_id` int NOT NULL AUTO_INCREMENT,
  `prestation_id` bigint NOT NULL,
  `montant_total` int NOT NULL,
  `id_demande` int NOT NULL,
  `patient_id` int NOT NULL,
  `services_id` int NOT NULL,
  `centre_id` int NOT NULL,
  `treated` tinyint NOT NULL DEFAULT '0',
  `date_paiement` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`payed_analyse_id`),
  KEY `tbl_patient` (`patient_id`),
  KEY `tbl_centre` (`centre_id`),
  KEY `services` (`services_id`),
  KEY `tbl_demande_ext` (`id_demande`),
  KEY `tbl_prestation` (`prestation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_analyse_payed`
--

INSERT INTO `tbl_analyse_payed` (`payed_analyse_id`, `prestation_id`, `montant_total`, `id_demande`, `patient_id`, `services_id`, `centre_id`, `treated`, `date_paiement`, `updated_at`) VALUES
(1, 10, 0, 1, 54, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-21 09:42:13'),
(2, 232, 0, 2, 62, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-21 09:42:30'),
(3, 229, 0, 3, 61, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-21 09:42:48'),
(4, 10, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(5, 6, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(6, 232, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(7, 231, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(8, 229, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(9, 228, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(10, 227, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(11, 226, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(12, 225, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(13, 222, 543, 1, 54, 0, 1, 0, '2025-03-21 08:44:28', '2025-03-21 08:44:28'),
(14, 24, 500, 3, 61, 0, 1, 0, '2025-03-21 08:44:58', '2025-03-21 08:44:58'),
(15, 0, 0, 4, 5, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-23 13:20:06'),
(16, 6, 507, 4, 5, 0, 1, 0, '2025-03-23 12:23:16', '2025-03-23 12:23:16'),
(17, 10, 507, 4, 5, 0, 1, 0, '2025-03-23 12:23:16', '2025-03-23 12:23:16'),
(18, 106, 507, 4, 5, 0, 1, 0, '2025-03-23 12:23:16', '2025-03-23 12:23:16'),
(19, 138, 507, 4, 5, 0, 1, 0, '2025-03-23 12:23:16', '2025-03-23 12:23:16'),
(20, 0, 0, 5, 64, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-23 13:29:23'),
(21, 6, 7, 5, 64, 0, 1, 0, '2025-03-23 12:33:38', '2025-03-23 12:33:38'),
(22, 16, 7, 5, 64, 0, 1, 0, '2025-03-23 12:33:38', '2025-03-23 12:33:38'),
(23, 0, 0, 6, 65, 0, 1, 0, '0000-00-00 00:00:00', '2025-03-23 15:40:35'),
(24, 0, 0, 7, 61, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-23 15:42:02'),
(25, 10, 1003, 7, 61, 0, 1, 0, '2025-03-23 14:45:09', '2025-03-23 14:45:09'),
(26, 6, 1003, 7, 61, 0, 1, 0, '2025-03-23 14:45:09', '2025-03-23 14:45:09'),
(27, 24, 1003, 7, 61, 0, 1, 0, '2025-03-23 14:45:09', '2025-03-23 14:45:09'),
(28, 0, 0, 8, 2, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-27 22:08:19'),
(29, 236, 1200, 8, 2, 0, 1, 0, '2025-03-28 14:06:48', '2025-03-28 14:06:48'),
(30, 236, 1200, 8, 2, 0, 1, 0, '2025-03-28 14:06:59', '2025-03-28 14:06:59'),
(31, 236, 1200, 8, 2, 0, 1, 0, '2025-03-28 14:07:13', '2025-03-28 14:07:13'),
(32, 0, 0, 9, 68, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-31 20:28:16'),
(33, 0, 0, 10, 68, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-31 20:28:52'),
(34, 236, 1200, 9, 68, 0, 1, 0, '2025-03-31 19:31:31', '2025-03-31 19:31:31'),
(35, 236, 1200, 9, 68, 0, 1, 0, '2025-03-31 19:32:32', '2025-03-31 19:32:32'),
(36, 236, 1200, 9, 68, 0, 1, 0, '2025-03-31 19:33:40', '2025-03-31 19:33:40'),
(37, 236, 1200, 10, 68, 0, 1, 0, '2025-03-31 19:39:26', '2025-03-31 19:39:26'),
(38, 0, 0, 11, 68, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-31 21:27:19'),
(39, 138, 1208, 11, 68, 0, 1, 0, '2025-03-31 20:29:41', '2025-03-31 20:29:41'),
(40, 139, 1208, 11, 68, 0, 1, 0, '2025-03-31 20:29:41', '2025-03-31 20:29:41'),
(41, 236, 1208, 11, 68, 0, 1, 0, '2025-03-31 20:29:41', '2025-03-31 20:29:41'),
(42, 0, 0, 12, 68, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-31 23:31:02'),
(43, 243, 0, 13, 68, 9, 1, 0, '0000-00-00 00:00:00', '2025-03-31 23:31:22'),
(44, 236, 1200, 13, 68, 0, 1, 0, '2025-03-31 22:34:03', '2025-03-31 22:34:03'),
(48, 6, 1203, 15, 69, 0, 1, 0, '2025-04-02 16:03:34', '2025-04-02 16:03:34'),
(49, 236, 1203, 15, 69, 0, 1, 0, '2025-04-02 16:03:34', '2025-04-02 16:03:34'),
(50, 0, 0, 17, 70, 9, 1, 0, '0000-00-00 00:00:00', '2025-04-04 05:03:15'),
(51, 107, 501, 17, 70, 0, 1, 0, '2025-04-04 03:09:05', '2025-04-04 03:09:05'),
(52, 106, 501, 17, 70, 0, 1, 0, '2025-04-04 03:09:05', '2025-04-04 03:09:05'),
(53, 6, 503, 12, 68, 0, 1, 0, '2025-04-04 03:27:38', '2025-04-04 03:27:38'),
(54, 10, 503, 12, 68, 0, 1, 0, '2025-04-04 03:27:38', '2025-04-04 03:27:38'),
(55, 236, 1200, 16, 69, 0, 1, 0, '2025-04-04 13:15:15', '2025-04-04 13:15:15'),
(56, 0, 0, 18, 80, 9, 1, 0, '0000-00-00 00:00:00', '2025-04-08 17:02:51'),
(57, 0, 0, 19, 81, 9, 1, 0, '0000-00-00 00:00:00', '2025-04-08 17:03:35'),
(58, 233, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43'),
(59, 234, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43'),
(60, 235, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43'),
(61, 220, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43'),
(62, 221, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43'),
(63, 216, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43'),
(64, 165, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43'),
(65, 159, 204500, 19, 81, 0, 1, 1, '2025-04-08 15:06:43', '2025-04-08 15:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_approvisionnement`
--

DROP TABLE IF EXISTS `tbl_approvisionnement`;
CREATE TABLE IF NOT EXISTS `tbl_approvisionnement` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `stock` int NOT NULL,
  `stock_defective` int NOT NULL,
  `comments` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `received_products_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_approvisionnement`
--

INSERT INTO `tbl_approvisionnement` (`id`, `admin_id`, `product_id`, `stock`, `stock_defective`, `comments`, `created_at`, `updated_at`, `id_centre`) VALUES
(1, 0, 1, 3, 1, NULL, NULL, NULL, 0),
(2, 0, 2, 10, 1, NULL, NULL, NULL, 0),
(3, 0, 3, 12, 0, NULL, NULL, NULL, 0),
(4, 0, 4, 8, 1, NULL, NULL, NULL, 0),
(5, 0, 5, 9, 4, NULL, NULL, NULL, 0),
(6, 0, 6, 16, 5, NULL, NULL, NULL, 0),
(7, 0, 7, 12, 1, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appro_reactif`
--

DROP TABLE IF EXISTS `tbl_appro_reactif`;
CREATE TABLE IF NOT EXISTS `tbl_appro_reactif` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint UNSIGNED NOT NULL,
  `reactif_id` bigint UNSIGNED NOT NULL,
  `stock` int NOT NULL,
  `stock_defective` int NOT NULL,
  `comments` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `received_products_product_id_foreign` (`reactif_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_appro_reactif`
--

INSERT INTO `tbl_appro_reactif` (`id`, `admin_id`, `reactif_id`, `stock`, `stock_defective`, `comments`, `created_at`, `updated_at`, `id_centre`) VALUES
(1, 0, 1, 3, 1, NULL, NULL, NULL, 0),
(2, 0, 2, 10, 1, NULL, NULL, NULL, 0),
(3, 0, 3, 12, 0, NULL, NULL, NULL, 0),
(4, 0, 4, 8, 1, NULL, NULL, NULL, 0),
(5, 0, 5, 9, 4, NULL, NULL, NULL, 0),
(6, 0, 6, 16, 5, NULL, NULL, NULL, 0),
(7, 0, 7, 12, 1, NULL, NULL, NULL, 0),
(8, 0, 11, 20, 2, 'RAS', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_caisse_prise_en_charge`
--

DROP TABLE IF EXISTS `tbl_caisse_prise_en_charge`;
CREATE TABLE IF NOT EXISTS `tbl_caisse_prise_en_charge` (
  `id_caisse_prise_en_charge` int NOT NULL AUTO_INCREMENT,
  `id_prise_en_charge` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `user_role_id` int DEFAULT NULL,
  `frais_consultation` int DEFAULT NULL,
  `frais_hospitalisation` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`id_caisse_prise_en_charge`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_caisse_prise_en_charge`
--

INSERT INTO `tbl_caisse_prise_en_charge` (`id_caisse_prise_en_charge`, `id_prise_en_charge`, `user_id`, `user_role_id`, `frais_consultation`, `frais_hospitalisation`, `created_at`, `updated_at`, `id_centre`) VALUES
(1, 1, 2, 1, 2500, NULL, '2024-09-01 16:31:43', '2024-09-01 16:31:43', 0),
(2, 2, NULL, NULL, NULL, NULL, '2024-09-01 16:36:21', '2024-09-01 16:36:21', 0),
(3, 3, NULL, NULL, NULL, NULL, '2024-09-01 16:48:24', '2024-09-01 16:48:24', 0),
(4, 4, NULL, NULL, NULL, NULL, '2024-09-01 17:13:33', '2024-09-01 17:13:33', 0),
(5, 5, 2, 1, 2500, NULL, '2024-09-01 17:28:54', '2024-09-01 17:28:54', 0),
(6, 6, 2, 1, 10000, NULL, '2024-09-01 18:53:39', '2024-09-01 18:53:39', 0),
(7, 7, 2, 1, 10000, NULL, '2024-09-01 18:55:11', '2024-09-01 18:55:11', 0),
(8, 8, NULL, NULL, NULL, NULL, '2024-09-22 12:32:54', '2024-09-22 12:32:54', 0),
(9, 9, NULL, NULL, NULL, NULL, '2024-10-08 14:14:31', '2024-10-08 14:14:31', 0),
(10, 10, NULL, NULL, NULL, NULL, '2024-10-08 14:18:28', '2024-10-08 14:18:28', 1),
(11, 11, 2, 1, 500, NULL, '2024-11-15 10:47:44', '2024-11-15 10:47:44', 1),
(12, 12, 2, 1, 10, NULL, '2024-12-02 14:04:50', '2024-12-02 14:04:50', 1),
(13, 13, NULL, NULL, NULL, NULL, '2024-12-05 15:54:31', '2024-12-05 15:54:31', 1),
(14, 14, NULL, NULL, NULL, NULL, '2024-12-05 23:21:55', '2024-12-05 23:21:55', 1),
(15, 15, NULL, NULL, NULL, NULL, '2024-12-06 07:53:18', '2024-12-06 07:53:18', 1),
(16, 18, NULL, NULL, NULL, NULL, '2024-12-06 09:33:31', '2024-12-06 09:33:31', 1),
(17, 41, NULL, NULL, NULL, NULL, '2024-12-27 09:40:28', '2024-12-27 09:40:28', 1),
(18, 44, NULL, NULL, NULL, NULL, '2025-01-04 20:48:12', '2025-01-04 20:48:12', 1),
(19, 46, NULL, NULL, NULL, NULL, '2025-01-04 22:24:01', '2025-01-04 22:24:01', 1),
(20, 51, NULL, NULL, NULL, NULL, '2025-02-05 08:11:17', '2025-02-05 08:11:17', 1),
(21, 58, NULL, NULL, NULL, NULL, '2025-04-06 08:56:14', '2025-04-06 08:56:14', 1),
(22, 62, NULL, NULL, NULL, NULL, '2025-04-07 09:12:57', '2025-04-07 09:12:57', 1),
(23, 63, NULL, NULL, NULL, NULL, '2025-04-07 09:19:17', '2025-04-07 09:19:17', 1),
(24, 65, NULL, NULL, NULL, NULL, '2025-04-07 09:59:45', '2025-04-07 09:59:45', 1),
(25, 66, NULL, NULL, NULL, NULL, '2025-04-07 10:41:58', '2025-04-07 10:41:58', 1),
(26, 68, NULL, NULL, NULL, NULL, '2025-04-07 15:16:11', '2025-04-07 15:16:11', 1),
(27, 69, NULL, NULL, NULL, NULL, '2025-04-07 15:17:22', '2025-04-07 15:17:22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart_reactif`
--

DROP TABLE IF EXISTS `tbl_cart_reactif`;
CREATE TABLE IF NOT EXISTS `tbl_cart_reactif` (
  `id_cart_reactif` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `reactif_id` int NOT NULL,
  `id_analyse` int NOT NULL,
  `qty` int NOT NULL,
  `id_centre` int NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_cart_reactif`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publication_status` int DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_description`, `publication_status`, `updated_at`, `id_centre`) VALUES
(1, 'Médicaments', 'Médicaments', 1, NULL, 0),
(2, 'Compléments Alimentaires', 'Compléments Alimentaires', 1, NULL, 0),
(3, 'Beauté et Soins', 'Beauté et Soins', 1, NULL, 0),
(4, 'Hygiène et Bien-être', 'Hygiène et Bien-être', 1, NULL, 0),
(5, 'Médecine douce et Santé', 'Médecine douce et Santé', 1, NULL, 0),
(6, 'Grossesse et Bébé', 'Grossesse et Bébé', NULL, NULL, 0),
(7, 'Vétérinaire', 'Vétérinaire', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_centre`
--

DROP TABLE IF EXISTS `tbl_centre`;
CREATE TABLE IF NOT EXISTS `tbl_centre` (
  `id_centre` int NOT NULL AUTO_INCREMENT,
  `id_entite` int NOT NULL,
  `nom_centre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Autorisation_decret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `adresse_centre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tel_centre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_directeur` bigint NOT NULL,
  `date_centre` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_centre`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_centre`
--

INSERT INTO `tbl_centre` (`id_centre`, `id_entite`, `nom_centre`, `Autorisation_decret`, `adresse_centre`, `tel_centre`, `id_directeur`, `date_centre`, `updated_at`) VALUES
(1, 1, 'CENTRE MEDICAL ASSAFWA \"LES ELITES\"', 'Aut.n°012/MS/DC/SGM/CCJ/DNSP/SRS/SA/016SGG21 du 12 Jan. 2021', 'Cotonou Fidjrossè von HOUDOU ALI 01 BP 2334', '+229 69 39 69 91', 2, '2024-10-08 16:11:52', '2024-11-13 21:19:34'),
(2, 1, 'Centre Bohicon', NULL, NULL, '0', 4, '2024-10-08 16:11:52', '2024-11-13 21:19:34'),
(3, 2, 'Centre Djougou', NULL, NULL, '0', 5, '2024-11-13 20:31:08', '2024-11-13 20:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_chambre`
--

DROP TABLE IF EXISTS `tbl_chambre`;
CREATE TABLE IF NOT EXISTS `tbl_chambre` (
  `id_chambre` int NOT NULL AUTO_INCREMENT,
  `libelle_chambre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `etat_chambre` int NOT NULL DEFAULT '1',
  `type_chambre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_vip` int NOT NULL DEFAULT '0',
  `patient_id` int DEFAULT NULL,
  `centre_id` int NOT NULL,
  `services_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_chambre`),
  KEY `tbl_centre` (`centre_id`),
  KEY `services` (`services_id`) USING BTREE,
  KEY `tbl_patient` (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_chambre`
--

INSERT INTO `tbl_chambre` (`id_chambre`, `libelle_chambre`, `etat_chambre`, `type_chambre`, `is_vip`, `patient_id`, `centre_id`, `services_id`, `created_at`, `updated_at`) VALUES
(1, '1', 1, '', 0, 0, 1, 0, '2025-04-04 10:04:53', '2025-04-04 10:04:53'),
(2, '2', 1, '', 0, 0, 1, 0, '2025-04-04 10:04:53', '2025-04-04 10:04:53'),
(3, '3', 1, '', 0, 0, 1, 0, '2025-04-04 10:04:53', '2025-04-04 10:04:53'),
(4, '4', 1, '', 1, 0, 1, 0, '2025-04-04 10:04:53', '2025-04-04 10:04:53'),
(5, '8', 1, 'F', 0, 0, 1, 4, '2025-04-04 10:04:53', '2025-04-04 10:04:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_constantes`
--

DROP TABLE IF EXISTS `tbl_constantes`;
CREATE TABLE IF NOT EXISTS `tbl_constantes` (
  `constante_id` bigint NOT NULL AUTO_INCREMENT,
  `patient_id` bigint NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `valeur` int NOT NULL,
  `constante_count` int NOT NULL,
  `unite` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `id_prise_en_charge` bigint DEFAULT NULL,
  `id_consultation` bigint NOT NULL,
  `centre_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`constante_id`)
) ENGINE=MyISAM AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_constantes`
--

INSERT INTO `tbl_constantes` (`constante_id`, `patient_id`, `type`, `valeur`, `constante_count`, `unite`, `id_prise_en_charge`, `id_consultation`, `centre_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 64, '', 0, 0, '', 62, 0, 1, 0, '2025-03-29 18:18:36', '2025-03-29 19:24:46'),
(2, 65, '', 0, 0, '', 63, 0, 1, 0, '2025-03-29 18:23:52', '2025-03-29 19:24:46'),
(3, 0, 'FC', 44, 0, 'bpm', 67, 0, 0, 0, '2025-03-29 18:31:18', '2025-03-29 18:31:18'),
(4, 0, 'TEMP', 555, 0, '°C', 68, 0, 1, 1, '2025-03-29 18:40:47', '2025-03-29 18:40:47'),
(5, 0, 'FC', 556, 0, 'bpm', 68, 0, 1, 1, '2025-03-29 18:40:47', '2025-03-29 18:40:47'),
(6, 65, 'FC', 66, 2, 'bpm', 69, 0, 1, 1, '2025-03-29 18:46:46', '2025-03-29 18:46:46'),
(7, 65, 'POIDS', 787, 2, 'kg', 69, 0, 1, 1, '2025-03-29 18:46:46', '2025-03-29 18:46:46'),
(8, 69, 'TENSION ARTERIELLE', 55, 0, 'mmHg', 72, 0, 0, 0, '2025-03-30 02:07:02', '2025-03-30 02:07:02'),
(9, 69, 'FREQUENCE RESPIRATOIRE', 555, 0, 'rpm', 72, 0, 0, 0, '2025-03-30 02:07:02', '2025-03-30 02:07:02'),
(10, 69, 'TENSION ARTERIELLE', 22, 0, 'mmHg', 72, 0, 0, 0, '2025-03-30 02:33:11', '2025-03-30 02:33:11'),
(11, 72, 'TENSION ARTERIELLE', 455, 0, 'mmHg', 75, 0, 0, 0, '2025-03-30 03:28:11', '2025-03-30 03:28:11'),
(12, 73, 'TENSION ARTERIELLE', 55, 0, 'mmHg', 76, 0, 1, 0, '2025-03-30 03:38:04', '2025-03-30 03:38:04'),
(13, 73, 'FREQUENCE RESPIRATOIRE', 78, 0, 'rpm', 76, 0, 1, 0, '2025-03-30 03:38:04', '2025-03-30 03:38:04'),
(14, 73, 'TENSION ARTERIELLE', 878, 0, 'mmHg', 76, 0, 1, 0, '2025-03-30 03:38:04', '2025-03-30 03:38:04'),
(15, 65, 'FREQUENCE CARDIAQUE', 4, 1, 'bpm', NULL, 47, 1, 11, '2025-04-01 14:09:11', '2025-04-01 14:09:11'),
(16, 65, 'TEMPERATURE', 90, 1, '°C', NULL, 47, 1, 11, '2025-04-01 14:10:56', '2025-04-01 14:10:56'),
(17, 65, 'TENSION ARTERIELLE', 55, 4, 'mmHg', NULL, 47, 1, 11, '2025-04-01 14:49:08', '2025-04-01 14:49:08'),
(18, 65, 'FREQUENCE RESPIRATOIRE', 6, 4, 'rpm', NULL, 47, 1, 11, '2025-04-01 14:49:08', '2025-04-01 14:49:08'),
(19, 65, 'SATURATION O2', 66, 4, '%', NULL, 47, 1, 11, '2025-04-01 14:49:08', '2025-04-01 14:49:08'),
(20, 65, 'TAILLE', 55, 4, 'cm', NULL, 47, 1, 11, '2025-04-01 14:49:08', '2025-04-01 14:49:08'),
(21, 36, 'FREQUENCE CARDIAQUE', 5, 1, 'bpm', NULL, 32, 1, 11, '2025-04-01 14:55:51', '2025-04-01 14:55:51'),
(22, 36, 'FREQUENCE CARDIAQUE', 4, 1, 'bpm', NULL, 32, 1, 11, '2025-04-01 14:57:49', '2025-04-01 14:57:49'),
(23, 36, 'POIDS', 65, 1, 'kg', NULL, 32, 1, 11, '2025-04-01 14:58:04', '2025-04-01 14:58:04'),
(24, 36, 'GLYCEMIE CAPILLAIRE', 6, 1, 'g/L', NULL, 32, 1, 11, '2025-04-01 15:04:58', '2025-04-01 15:04:58'),
(25, 36, 'FREQUENCE RESPIRATOIRE', 5, 2, 'rpm', NULL, 32, 1, 11, '2025-04-01 15:20:42', '2025-04-01 15:20:42'),
(26, 36, 'GLYCEMIE POST PRANDIALE', 10, 2, 'g/L', NULL, 32, 1, 11, '2025-04-01 15:20:42', '2025-04-01 15:20:42'),
(27, 65, 'FREQUENCE CARDIAQUE', 10, 1, 'bpm', 79, 0, 1, 1, '2025-04-01 15:21:31', '2025-04-01 15:21:31'),
(28, 65, 'FREQUENCE CARDIAQUE', 10, 1, 'bpm', 80, 0, 1, 1, '2025-04-01 15:21:31', '2025-04-01 15:21:31'),
(29, 32, 'FREQUENCE RESPIRATOIRE', 6, 2, 'rpm', NULL, 25, 1, 11, '2025-04-01 16:06:11', '2025-04-01 16:06:11'),
(30, 32, 'GLYCEMIE CAPILLAIRE', 6, 2, 'g/L', NULL, 25, 1, 11, '2025-04-01 16:06:11', '2025-04-01 16:06:11'),
(31, 32, 'FREQUENCE CARDIAQUE', 455, 2, 'bpm', NULL, 25, 1, 11, '2025-04-01 16:06:52', '2025-04-01 16:06:52'),
(32, 32, 'POIDS', 455, 2, 'kg', NULL, 25, 1, 11, '2025-04-01 16:06:52', '2025-04-01 16:06:52'),
(33, 64, 'FREQUENCE CARDIAQUE', 5, 1, 'bpm', 82, 0, 1, 1, '2025-04-02 00:33:20', '2025-04-02 00:33:20'),
(34, 76, 'FREQUENCE CARDIAQUE', 5, 0, 'bpm', 83, 0, 1, 0, '2025-04-02 00:34:27', '2025-04-02 00:34:27'),
(35, 76, 'FREQUENCE RESPIRATOIRE', 5, 0, 'rpm', 83, 0, 1, 0, '2025-04-02 00:34:27', '2025-04-02 00:34:27'),
(36, 77, 'TEMPERATURE', 37, 0, '°C', 84, 0, 1, 0, '2025-04-02 00:58:16', '2025-04-02 00:58:16'),
(37, 77, 'FREQUENCE CARDIAQUE', 12, 0, 'bpm', 84, 0, 1, 0, '2025-04-02 00:58:16', '2025-04-02 00:58:16'),
(38, 78, 'TEMPERATURE', 36, 0, '°C', 85, 0, 1, 0, '2025-04-03 06:19:25', '2025-04-03 06:19:25'),
(39, 78, 'GLYCEMIE CAPILLAIRE', 1, 0, 'g/L', 85, 0, 1, 0, '2025-04-03 06:19:25', '2025-04-03 06:19:25'),
(40, 78, 'POIDS', 85, 0, 'kg', 85, 0, 1, 0, '2025-04-03 06:19:25', '2025-04-03 06:19:25'),
(41, 78, 'TAILLE', 2, 0, 'cm', 85, 0, 1, 0, '2025-04-03 06:19:25', '2025-04-03 06:19:25'),
(42, 36, 'TENSION ARTERIELLE', 6, 1, 'mmHg', NULL, 32, 1, 11, '2025-04-04 13:04:53', '2025-04-04 13:04:53'),
(43, 32, 'TENSION ARTERIELLE', 55, 1, 'mmHg', NULL, 25, 1, 11, '2025-04-05 22:14:07', '2025-04-05 22:14:07'),
(44, 74, 'TENSION ARTERIELLE', 10, 0, 'mmHg', 57, 50, 1, 0, '2025-04-05 22:31:45', '2025-04-05 22:31:45'),
(45, 74, 'POIDS', 65, 0, 'kg', 57, 50, 1, 0, '2025-04-05 22:31:45', '2025-04-05 22:31:45'),
(46, 74, 'TAILLE', 165, 0, 'cm', 57, 50, 1, 0, '2025-04-05 22:31:45', '2025-04-05 22:31:45'),
(47, 74, 'FREQUENCE CARDIAQUE', 14, 3, 'bpm', 58, 0, 1, 1, '2025-04-06 10:56:14', '2025-04-06 10:56:14'),
(48, 74, 'TEMPERATURE', 52, 3, '°C', 58, 0, 1, 1, '2025-04-06 10:56:14', '2025-04-06 10:56:14'),
(49, 74, 'POIDS', 54, 3, 'kg', 58, 0, 1, 1, '2025-04-06 10:56:14', '2025-04-06 10:56:14'),
(50, 76, 'FREQUENCE CARDIAQUE', 555, 0, 'bpm', 60, 0, 1, 0, '2025-04-07 07:38:26', '2025-04-07 07:38:26'),
(51, 76, 'TEMPERATURE', 25, 0, '°C', 60, 0, 1, 0, '2025-04-07 07:38:26', '2025-04-07 07:38:26'),
(52, 76, 'SATURATION O2', 6, 0, '%', 60, 0, 1, 0, '2025-04-07 07:38:26', '2025-04-07 07:38:26'),
(53, 77, 'TEMPERATURE', 36, 0, '°C', 61, 0, 1, 0, '2025-04-07 07:47:45', '2025-04-07 07:47:45'),
(54, 77, 'POIDS', 65, 0, 'kg', 61, 0, 1, 0, '2025-04-07 07:47:45', '2025-04-07 07:47:45'),
(55, 77, 'TAILLE', 168, 0, 'cm', 61, 0, 1, 0, '2025-04-07 07:47:45', '2025-04-07 07:47:45'),
(56, 74, 'GLYCEMIE POST PRANDIALE', 55, 2, 'g/L', 23, 0, 1, 1, '2025-04-07 09:19:17', '2025-04-07 09:19:17'),
(57, 74, 'POIDS', 45, 2, 'kg', 23, 0, 1, 1, '2025-04-07 09:19:17', '2025-04-07 09:19:17'),
(58, 78, 'TENSION ARTERIELLE', 55, 0, 'mmHg', 64, 0, 1, 0, '2025-04-07 09:38:20', '2025-04-07 09:38:20'),
(59, 78, 'FREQUENCE CARDIAQUE', 6, 0, 'bpm', 64, 58, 1, 0, '2025-04-07 09:38:20', '2025-04-07 09:38:20'),
(60, 78, 'SATURATION O2', 88, 0, '%', 64, 58, 1, 0, '2025-04-07 09:38:20', '2025-04-07 09:38:20'),
(61, 5, 'POIDS', 52, 3, 'kg', 24, 0, 1, 1, '2025-04-07 09:59:45', '2025-04-07 09:59:45'),
(62, 5, 'TAILLE', 165, 3, 'cm', 24, 0, 1, 1, '2025-04-07 09:59:45', '2025-04-07 09:59:45'),
(63, 5, 'GLYCEMIE A JEUN', 54, 3, 'g/L', 24, 0, 1, 1, '2025-04-07 09:59:45', '2025-04-07 09:59:45'),
(64, 78, 'POIDS', 85, 3, 'kg', 25, 0, 1, 1, '2025-04-07 10:41:58', '2025-04-07 10:41:58'),
(65, 78, 'TAILLE', 165, 3, 'cm', 25, 0, 1, 1, '2025-04-07 10:41:58', '2025-04-07 10:41:58'),
(66, 78, 'SATURATION O2', 5, 3, '%', 25, 0, 1, 1, '2025-04-07 10:41:58', '2025-04-07 10:41:58'),
(67, 79, 'TENSION ARTERIELLE', 4, 0, 'mmHg', 67, 61, 1, 0, '2025-04-07 10:43:38', '2025-04-07 10:43:38'),
(68, 79, 'TEMPERATURE', 88, 0, '°C', 67, 61, 1, 0, '2025-04-07 10:43:38', '2025-04-07 10:43:38'),
(69, 79, 'FREQUENCE CARDIAQUE', 88, 0, 'bpm', 67, 61, 1, 0, '2025-04-07 10:43:38', '2025-04-07 10:43:38'),
(70, 79, 'TENSION ARTERIELLE', 55, 0, 'mmHg', 67, 61, 1, 0, '2025-04-07 10:45:58', '2025-04-07 10:45:58'),
(71, 68, 'TENSION ARTERIELLE', 8, 1, 'mmHg', 26, 0, 1, 1, '2025-04-07 15:16:11', '2025-04-07 15:16:11'),
(72, 68, 'TENSION ARTERIELLE', 8, 1, 'mmHg', 27, 0, 1, 1, '2025-04-07 15:17:22', '2025-04-07 15:17:22'),
(73, 78, 'FREQUENCE CARDIAQUE', 5, 1, 'bpm', NULL, 65, 1, 11, '2025-04-07 15:28:49', '2025-04-07 15:28:49'),
(74, 80, 'TEMPERATURE', 36, 0, '°C', 70, 66, 1, 0, '2025-04-07 16:57:44', '2025-04-07 16:57:44'),
(75, 80, 'POIDS', 65, 0, 'kg', 70, 66, 1, 0, '2025-04-07 16:57:44', '2025-04-07 16:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_consultation`
--

DROP TABLE IF EXISTS `tbl_consultation`;
CREATE TABLE IF NOT EXISTS `tbl_consultation` (
  `id_consultation` int NOT NULL AUTO_INCREMENT,
  `id_prise_en_charge` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `user_role_id` int DEFAULT NULL,
  `diagnostic` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `new_temp` int DEFAULT NULL,
  `observation` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_hospitalisation` int NOT NULL DEFAULT '0',
  `id_lit` int DEFAULT NULL,
  `fichier_joint` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `etat_traitement` int NOT NULL DEFAULT '0',
  `conslt_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conslt_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `centre_id` int NOT NULL,
  PRIMARY KEY (`id_consultation`),
  KEY `tbl_centre` (`centre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_consultation`
--

INSERT INTO `tbl_consultation` (`id_consultation`, `id_prise_en_charge`, `user_id`, `user_role_id`, `diagnostic`, `new_temp`, `observation`, `is_hospitalisation`, `id_lit`, `fichier_joint`, `etat_traitement`, `conslt_created_at`, `conslt_updated_at`, `centre_id`) VALUES
(1, 1, 3, 7, '<p>Il s\'agit potentiellement d\'un début de palu</p>', NULL, 'Analyses médicales requises', 0, NULL, 'Uploads/consultations/EXPOSE HIST-GEO.pdf', 1, '2024-09-05 14:43:46', '2024-09-05 14:43:46', 1),
(2, 7, 3, 7, 'Il s\'agit potentiellement d\'un apindice', NULL, 'Faire une écho', 0, NULL, NULL, 1, '2024-09-13 14:12:37', '2024-09-13 14:12:37', 1),
(3, 1, 5, 4, '<p>Analyses effectuées indiquant un fort taux de bactéries paludéens</p>', NULL, 'Prescrire une ordonnance en conséquence', 0, NULL, 'Uploads/consultations/LM BOURSE D\'etude.pdf', 1, '2024-09-13 15:29:32', '2024-09-13 15:29:32', 1),
(4, 1, 3, 7, 'Le patient souffrait en effet du palu.\r\nUne ordonnance lui sera délivré en conséquence.\r\nOrdonnance Médicale', NULL, NULL, 0, NULL, NULL, 1, '2024-09-13 15:56:52', '2024-09-13 15:56:52', 1),
(5, 5, 3, 7, NULL, NULL, NULL, 1, 2, 'Uploads/consultations/Facture Vente TPS.pdf', 1, '2024-09-14 19:52:48', '2024-09-14 19:52:48', 1),
(41, 5, 5, 4, 'Test', NULL, NULL, 0, NULL, NULL, 1, '2025-02-06 10:08:14', '2025-04-07 03:06:32', 1),
(6, 7, 5, 4, 'Echo réalisé confirmant l\'apindice', NULL, 'Opération d\'urgence requise', 0, NULL, 'Uploads/consultations/1ere Session AOUT 2024 Liste des candidats admis31_08_2024 13_15_22_62.pdf', 1, '2024-09-14 20:02:41', '2024-09-14 20:02:41', 1),
(7, 7, 3, 7, 'Opération réalisé avec succès. Une ordonnance sera de mise pour la convalescence', NULL, NULL, 0, NULL, NULL, 1, '2024-09-14 20:04:27', '2024-09-14 20:04:27', 1),
(8, 11, 3, 7, NULL, NULL, NULL, 1, 2, NULL, 1, '2024-11-15 10:49:20', '2024-11-15 10:49:20', 1),
(9, 10, 8, 2, 'Risque possible d\'intoxication alimentaire', NULL, 'Analyse requise', 1, 5, 'Uploads/consultations/SBEE Octobre 20224.pdf', 1, '2024-12-05 15:41:10', '2024-12-05 15:41:10', 1),
(10, 12, 8, 2, 'nlnflefefefe', NULL, 'Joue gauche enflée', 1, 2, NULL, 1, '2024-12-05 15:41:42', '2024-12-05 15:41:42', 1),
(11, 13, 9, 3, NULL, NULL, NULL, 0, NULL, NULL, 0, '2024-12-05 23:08:06', '2024-12-05 23:08:06', 1),
(12, 23, 3, 7, 'rezzzzzzzzzz', 40, NULL, 0, NULL, NULL, 1, '2024-12-06 18:00:35', '2024-12-06 18:00:35', 1),
(13, 26, 8, 2, NULL, NULL, NULL, 1, 2, NULL, 1, '2024-12-18 17:40:53', '2024-12-18 17:40:53', 1),
(14, 27, 8, 2, 'Hospitatlisation', NULL, NULL, 1, NULL, NULL, 0, '2024-12-18 18:02:44', '2025-04-07 02:42:38', 1),
(15, 28, 8, 2, 'Forte fièvre, douleur abdominale et grippe', NULL, 'Demande d\'analyse CRP', 1, 5, NULL, 1, '2024-12-19 06:55:45', '2024-12-19 06:55:45', 1),
(16, 29, 3, 7, 'fdsfdsg', NULL, NULL, 0, NULL, NULL, 1, '2024-12-19 07:53:35', '2024-12-19 07:53:35', 1),
(17, 30, 8, 2, 'Ulcère gastrique', NULL, 'Fibroscopie', 1, 3, NULL, 1, '2024-12-19 09:30:05', '2024-12-19 09:30:05', 1),
(18, 31, 8, 2, 'Migraine', NULL, NULL, 1, 3, NULL, 1, '2024-12-19 09:50:31', '2024-12-19 09:50:31', 1),
(19, 35, 8, 2, 'Fin de traitement', 36, NULL, 1, 2, NULL, 1, '2024-12-19 10:32:14', '2024-12-19 10:32:14', 1),
(20, 36, 8, 2, 'Vomissement et nausée répétée', NULL, 'Fibroscopie et scanner', 1, 2, NULL, 1, '2024-12-20 11:55:00', '2024-12-20 11:55:00', 1),
(21, 33, 8, 2, NULL, NULL, NULL, 1, 3, NULL, 1, '2024-12-21 07:00:43', '2024-12-21 07:00:43', 1),
(22, 32, 8, 2, 'fini', NULL, NULL, 0, NULL, NULL, 1, '2024-12-21 07:01:00', '2024-12-21 07:01:00', 1),
(23, 34, 8, 2, 'je', NULL, NULL, 0, NULL, NULL, 1, '2024-12-21 23:58:55', '2024-12-21 23:58:55', 1),
(24, 25, 8, 2, 'test', NULL, 'analyse', 1, 2, NULL, 1, '2024-12-22 07:30:19', '2024-12-22 07:30:19', 1),
(25, 37, 8, 2, 'Traitement terminé', NULL, NULL, 0, 2, NULL, 1, '2024-12-22 07:50:53', '2025-04-07 02:37:34', 1),
(26, 22, 8, 2, 'bon', NULL, NULL, 0, NULL, NULL, 1, '2024-12-22 09:19:11', '2024-12-22 09:19:11', 1),
(27, 38, 8, 2, 'bon', NULL, NULL, 0, NULL, NULL, 1, '2024-12-22 11:01:15', '2024-12-22 11:01:15', 1),
(28, 24, 8, 2, 'bon', NULL, NULL, 0, NULL, NULL, 1, '2024-12-22 18:28:19', '2024-12-22 18:28:19', 1),
(29, 39, 8, 2, NULL, NULL, NULL, 1, 2, NULL, 1, '2024-12-22 19:12:03', '2024-12-22 19:12:03', 1),
(30, 40, 8, 2, 'analyse CRP', NULL, NULL, 1, NULL, NULL, 1, '2024-12-27 09:42:08', '2024-12-27 09:42:08', 1),
(31, 41, 8, 2, 'bon', NULL, NULL, 0, NULL, NULL, 1, '2024-12-27 09:46:54', '2024-12-27 09:46:54', 1),
(32, 42, 8, 2, 'rteedffd', NULL, NULL, 1, 2, NULL, 1, '2025-01-04 08:20:16', '2025-01-04 08:20:16', 1),
(39, 46, 8, 2, 'hujhjh', NULL, NULL, 1, 2, NULL, 1, '2025-01-04 22:24:13', '2025-01-04 22:24:13', 1),
(33, 14, 3, 7, 'iopl', NULL, NULL, 0, NULL, NULL, 1, '2025-01-04 20:41:12', '2025-01-04 20:41:12', 1),
(34, 43, 3, 7, 'Mise en observation du patient', NULL, NULL, 1, 5, NULL, 0, '2025-01-04 20:41:23', '2025-04-07 02:41:54', 1),
(35, 18, 3, 7, 'yhh', NULL, NULL, 0, NULL, NULL, 1, '2025-01-04 20:41:35', '2025-01-04 20:41:35', 1),
(36, 15, 3, 7, 'ras', NULL, NULL, 0, NULL, NULL, 1, '2025-01-04 20:41:47', '2025-01-04 20:41:47', 1),
(37, 44, 3, 7, 'traitement accéléré', NULL, NULL, 0, NULL, NULL, 1, '2025-01-04 20:48:54', '2025-01-04 20:48:54', 1),
(38, 45, 8, 2, 'bon', NULL, NULL, 0, NULL, NULL, 1, '2025-01-04 21:53:35', '2025-01-04 21:53:35', 1),
(40, 47, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-02-05 02:23:09', '2025-02-05 02:23:09', 1),
(42, 39, 2, 1, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-03-06 10:41:11', '2025-03-06 10:41:11', 1),
(43, 50, 2, 1, 'Je ne saurais le dire avec précision', NULL, NULL, 0, NULL, NULL, 1, '2025-03-13 10:42:31', '2025-04-07 02:39:07', 1),
(44, 49, 2, 1, 'Oren, que se passe-t-il ?', NULL, NULL, 0, NULL, NULL, 1, '2025-03-13 10:42:45', '2025-04-07 02:39:52', 1),
(45, 48, 2, 1, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-03-16 00:38:10', '2025-03-16 00:38:10', 1),
(46, 53, 2, 1, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-03-27 21:29:04', '2025-03-27 21:29:04', 1),
(47, 54, 2, 1, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-03-27 21:29:18', '2025-03-27 21:29:18', 1),
(48, 56, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-05 06:39:02', '2025-04-05 06:39:02', 1),
(49, 55, 3, 7, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-05 06:39:32', '2025-04-05 06:39:32', 1),
(50, 57, 8, 2, 'Tester la clôture du traitement', NULL, NULL, 0, NULL, NULL, 1, '2025-04-05 22:32:17', '2025-04-07 02:36:43', 0),
(51, 58, 8, 2, 'Termination', NULL, NULL, 0, NULL, NULL, 1, '2025-04-06 10:56:44', '2025-04-07 03:03:11', 0),
(52, 51, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 08:15:34', '2025-04-07 08:15:34', 0),
(53, 61, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 08:15:52', '2025-04-07 08:15:52', 0),
(54, 60, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 08:16:06', '2025-04-07 08:16:06', 0),
(55, 52, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 08:41:28', '2025-04-07 08:41:28', 0),
(56, 62, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 09:13:18', '2025-04-07 09:13:18', 0),
(57, 63, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 09:19:30', '2025-04-07 09:19:30', 0),
(58, 64, 8, 2, 'ddd', NULL, NULL, 0, NULL, NULL, 1, '2025-04-07 09:41:40', '2025-04-07 13:21:55', 0),
(59, 65, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 10:00:11', '2025-04-07 10:00:11', 0),
(60, 66, 8, 2, 'sssss', NULL, 'ssss', 0, NULL, NULL, 1, '2025-04-07 10:46:17', '2025-04-07 13:23:33', 0),
(61, 67, 8, 2, 'Céphalé', NULL, 'Recommande un scanner', 0, NULL, NULL, 1, '2025-04-07 10:46:27', '2025-04-07 08:48:22', 0),
(62, 67, 3, 7, 'tggehr', NULL, 'Enflement du genoux droit', 1, 5, NULL, 0, '2025-04-07 08:48:22', '2025-04-07 13:25:48', 0),
(63, 68, 8, 2, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 15:17:52', '2025-04-07 15:17:52', 0),
(64, 66, 9, 3, NULL, NULL, NULL, 0, NULL, NULL, 0, '2025-04-07 13:21:55', '2025-04-07 13:21:55', 0),
(65, 66, 3, 7, 'ddgg\"g', NULL, 'zrezrrz', 1, 5, NULL, 0, '2025-04-07 13:23:33', '2025-04-07 13:25:00', 0),
(66, 70, 8, 2, 'Néanmoins', NULL, 'Nean', 0, NULL, NULL, 0, '2025-04-07 16:58:45', '2025-04-07 15:00:49', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_demande_ext`
--

DROP TABLE IF EXISTS `tbl_demande_ext`;
CREATE TABLE IF NOT EXISTS `tbl_demande_ext` (
  `id_demande` bigint NOT NULL AUTO_INCREMENT,
  `last_demande_user_id` int NOT NULL,
  `services_id` int NOT NULL,
  `prestation_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_type_analyse` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `centre_id` int NOT NULL,
  `patient_id` bigint NOT NULL,
  `user_role_id` int NOT NULL,
  `is_payed` tinyint(1) NOT NULL DEFAULT '0',
  `statut` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_demande`),
  KEY `services` (`services_id`),
  KEY `users` (`user_id`),
  KEY `tbl_centre` (`centre_id`),
  KEY `tbl_patient` (`patient_id`),
  KEY `user_roles` (`user_role_id`),
  KEY `user_id` (`last_demande_user_id`),
  KEY `tbl_type_analyse` (`id_type_analyse`),
  KEY `tbl_prestation` (`prestation_id`(250))
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_demande_ext`
--

INSERT INTO `tbl_demande_ext` (`id_demande`, `last_demande_user_id`, `services_id`, `prestation_id`, `id_type_analyse`, `user_id`, `centre_id`, `patient_id`, `user_role_id`, `is_payed`, `statut`, `created_at`, `updated_at`) VALUES
(1, 2, 9, '[\"10\",\"6\",\"232\",\"231\",\"229\",\"228\",\"227\",\"226\",\"225\",\"222\"]', NULL, 1, 1, 54, 0, 1, 0, '2025-03-21 09:42:13', '2025-03-21 08:44:28'),
(2, 2, 9, NULL, NULL, 1, 1, 62, 0, 0, 0, '2025-03-21 09:42:30', '2025-03-21 09:42:30'),
(3, 2, 9, '[\"24\"]', NULL, 1, 1, 61, 0, 1, 0, '2025-03-21 09:42:48', '2025-03-21 08:44:58'),
(4, 2, 9, '[\"6\",\"10\",\"106\",\"138\"]', NULL, 1, 1, 5, 0, 1, 0, '2025-03-23 13:20:06', '2025-03-23 12:23:16'),
(5, 2, 9, '[\"6\",\"16\"]', NULL, 1, 1, 64, 0, 1, 0, '2025-03-23 13:29:23', '2025-03-23 12:33:38'),
(6, 0, 0, NULL, NULL, 1, 1, 65, 0, 0, 0, '2025-03-23 15:40:35', '2025-03-23 15:40:35'),
(7, 2, 9, '[\"10\",\"6\",\"24\"]', NULL, 1, 1, 61, 0, 1, 0, '2025-03-23 15:42:02', '2025-03-23 14:45:09'),
(8, 2, 9, '[\"236\"]', NULL, 1, 1, 2, 0, 1, 0, '2025-03-27 22:08:19', '2025-03-28 14:07:13'),
(9, 2, 9, '[\"236\"]', NULL, 1, 1, 68, 0, 1, 0, '2025-03-31 20:28:16', '2025-03-31 19:33:40'),
(10, 2, 9, '[\"236\"]', NULL, 1, 1, 68, 0, 1, 0, '2025-03-31 20:28:52', '2025-03-31 19:39:26'),
(11, 2, 9, '[\"138\",\"139\",\"236\"]', NULL, 1, 1, 68, 0, 1, 0, '2025-03-31 21:27:19', '2025-03-31 20:29:41'),
(12, 2, 9, '[\"6\",\"10\"]', NULL, 1, 1, 68, 0, 1, 0, '2025-03-31 23:31:02', '2025-04-04 03:27:38'),
(13, 2, 9, '[\"236\"]', NULL, 1, 1, 68, 0, 1, 0, '2025-03-31 23:31:22', '2025-03-31 22:34:03'),
(14, 0, 0, NULL, NULL, 1, 1, 69, 0, 0, 0, '2025-04-02 16:57:39', '2025-04-02 16:57:39'),
(15, 2, 9, '[\"6\",\"236\"]', NULL, 1, 1, 69, 0, 1, 0, '2025-04-02 16:57:57', '2025-04-02 16:03:34'),
(16, 2, 9, '[\"236\"]', NULL, 1, 1, 69, 0, 1, 0, '2025-04-02 17:01:45', '2025-04-04 13:15:15'),
(17, 2, 9, '[\"107\",\"106\"]', NULL, 1, 1, 70, 0, 1, 0, '2025-04-04 05:03:15', '2025-04-04 03:09:05'),
(18, 2, 9, NULL, NULL, 1, 1, 80, 0, 0, 0, '2025-04-08 17:02:51', '2025-04-08 17:02:51'),
(19, 2, 9, '[\"233\",\"234\",\"235\",\"220\",\"221\",\"216\",\"165\",\"159\"]', NULL, 1, 1, 81, 0, 1, 0, '2025-04-08 17:03:35', '2025-04-08 15:06:43');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_entite`
--

DROP TABLE IF EXISTS `tbl_entite`;
CREATE TABLE IF NOT EXISTS `tbl_entite` (
  `id_entite` int NOT NULL AUTO_INCREMENT,
  `nom_entite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rccm` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `directeur` bigint NOT NULL,
  `date_entite` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_entite`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_entite`
--

INSERT INTO `tbl_entite` (`id_entite`, `nom_entite`, `rccm`, `directeur`, `date_entite`, `updated_at`) VALUES
(1, 'CLINIQUE DIRECT AID', '', 5, '2024-10-08 16:10:08', '0000-00-00 00:00:00'),
(2, 'CLINIC ALAFIA', '', 3, '2024-10-08 16:10:08', '0000-00-00 00:00:00'),
(5, 'CLINIC LES GRACES', '', 1, '2024-11-13 17:53:47', '2024-11-13 17:53:47');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_frais_consutation`
--

DROP TABLE IF EXISTS `tbl_frais_consutation`;
CREATE TABLE IF NOT EXISTS `tbl_frais_consutation` (
  `id_frais_consultation` int NOT NULL,
  `nom_consultation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `montant_consultation` int NOT NULL,
  `etat` int NOT NULL DEFAULT '1',
  `id_centre` int NOT NULL,
  PRIMARY KEY (`id_frais_consultation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_frais_consutation`
--

INSERT INTO `tbl_frais_consutation` (`id_frais_consultation`, `nom_consultation`, `montant_consultation`, `etat`, `id_centre`) VALUES
(1, 'Consultation générale', 2500, 1, 0),
(2, 'Consultation dentaire', 10000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_frais_hospitalisation`
--

DROP TABLE IF EXISTS `tbl_frais_hospitalisation`;
CREATE TABLE IF NOT EXISTS `tbl_frais_hospitalisation` (
  `id_frais_hospital` int NOT NULL,
  `nom_hospital` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `montant_hospital` int NOT NULL,
  `etat` int NOT NULL DEFAULT '1',
  `id_centre` int NOT NULL,
  PRIMARY KEY (`id_frais_hospital`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_frais_hospitalisation`
--

INSERT INTO `tbl_frais_hospitalisation` (`id_frais_hospital`, `nom_hospital`, `montant_hospital`, `etat`, `id_centre`) VALUES
(1, 'H-7 jours', 15000, 1, 0),
(2, 'H [7-15] jours', 20000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_guest`
--

DROP TABLE IF EXISTS `tbl_guest`;
CREATE TABLE IF NOT EXISTS `tbl_guest` (
  `guest_id` int NOT NULL AUTO_INCREMENT,
  `guest_first_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guest_last_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guest_ifu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guest_country` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guest_address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guest_mobile_number` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guest_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`guest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_guest`
--

INSERT INTO `tbl_guest` (`guest_id`, `guest_first_name`, `guest_last_name`, `guest_ifu`, `guest_country`, `guest_address`, `guest_mobile_number`, `guest_email`, `id_centre`) VALUES
(2, 'John', 'SMITH', '0202324568794', 'Bénin', 'Abomey-calavi , Bidossessi', '+22967361565', 'tiandorman@gmail.com', 1),
(3, 'Max', 'PAYNE', '0202324568794', 'Bénin', 'Abomey-calavi , Bidossessi', '+22966756558', 'tiandorman@gmail.com', 2),
(1, 'Achat', 'Client(Anonyme)', '0000000000000', 'Bénin', 'Cotonou', '+22900000000', NULL, 0),
(20, 'Herman', 'TIANDO', '0202324568794', 'Bénin', 'Cotonou Abomey calavi', '+22967361565', 'tiandorman@gmail.com', 1),
(21, 'Peter', 'WAYNE', '0202324568794', 'Bénin', 'Cotonou Abomey calavi', '+22967361565', 'tiandorman@gmail.com', 2),
(22, 'Paul', 'LOGAN', '0202324568794', 'Benin', 'CSB TANKPE RUE NEWLAND', '+22960001202', 'tiandorman@gmail.com', 1),
(24, 'Carter', 'FOX', NULL, '', '', '+19699879635', NULL, 2),
(25, 'Kalvin', 'QUEEN', NULL, '', '', '+22960403050', NULL, 1),
(26, 'Prudence', 'DOLCE', NULL, '', '', '+2296897854', NULL, 2),
(27, 'Walker', 'Paul', NULL, '', '', '+2290166666666', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lits`
--

DROP TABLE IF EXISTS `tbl_lits`;
CREATE TABLE IF NOT EXISTS `tbl_lits` (
  `id_lit` int NOT NULL AUTO_INCREMENT,
  `id_chambre` int NOT NULL,
  `services_id` bigint NOT NULL,
  `lit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `statut` int NOT NULL DEFAULT '0',
  `centre_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_lit`),
  KEY `services` (`services_id`) USING BTREE,
  KEY `tbl_centre` (`centre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_lits`
--

INSERT INTO `tbl_lits` (`id_lit`, `id_chambre`, `services_id`, `lit`, `statut`, `centre_id`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 'lit1', 1, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(2, 1, 0, 'lit2', 1, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(3, 1, 0, 'lit3', 1, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(4, 1, 0, 'lit4', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(5, 2, 0, 'lit1', 1, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(6, 2, 0, 'lit2', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(7, 2, 0, 'lit3', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(8, 3, 0, 'lit1', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(9, 3, 0, 'lit2', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(10, 4, 0, 'lit1', 1, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(11, 1, 0, 'lit5', 1, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(12, 5, 0, 'lit1', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(13, 5, 0, 'lit2', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(14, 5, 0, 'lit3', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(15, 5, 0, 'lit4', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(16, 5, 0, 'lit5', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45'),
(17, 5, 0, 'lit6', 0, 1, '2025-04-04 07:39:45', '2025-04-04 07:39:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacture`
--

DROP TABLE IF EXISTS `tbl_manufacture`;
CREATE TABLE IF NOT EXISTS `tbl_manufacture` (
  `manufacture_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `manufacture_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `manufacture_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publication_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`manufacture_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_manufacture`
--

INSERT INTO `tbl_manufacture` (`manufacture_id`, `manufacture_name`, `manufacture_description`, `publication_status`, `created_at`, `updated_at`, `id_centre`) VALUES
(1, 'Sans marque', 'Sans marque', 1, NULL, NULL, 0),
(2, 'Nivea', 'Nivea produt', 1, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `guest_id` int DEFAULT NULL,
  `shipping_id` int NOT NULL,
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `order_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_statut` int NOT NULL DEFAULT '0',
  `id_centre` int NOT NULL,
  PRIMARY KEY (`order_id`),
  KEY `guest_id` (`guest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `transaction_id`, `customer_id`, `guest_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `created_date`, `updated_at`, `order_statut`, `id_centre`) VALUES
(1, 'CAISSE04-14-09-2024 20:26:05', NULL, 1, 0, '1', '21500', 'Cloturé', '2024-09-14 20:26:05', NULL, 0, 0),
(2, 'CAISSE04-02-10-2024 11:38:28', NULL, 1, 0, '2', '15000', 'Cloturé', '2024-10-02 11:38:28', NULL, 0, 0),
(4, 'CAISSE04-08-10-2024 16:20:52', NULL, 1, 0, '6', '25000', 'Cloturé', '2024-10-08 16:20:52', NULL, 0, 2),
(5, 'CAISSE04-08-10-2024 16:22:14', NULL, 21, 0, '7', '88500', 'Cloturé', '2024-10-08 16:22:15', NULL, 0, 2),
(6, 'CAISSE02-02-12-2024 08:40:51', NULL, 27, 0, '8', '4000', 'Cloturé', '2024-12-02 08:40:51', NULL, 0, 1),
(7, 'CAISSE02-03-01-2025 10:56:31', NULL, 2, 0, '9', '5000', 'Cloturé', '2025-01-03 10:56:31', NULL, 0, 1),
(8, 'CAISSE02-03-01-2025 10:56:43', NULL, 2, 0, '10', '0', 'Cloturé', '2025-01-03 10:56:43', NULL, 0, 1),
(9, 'CAISSE02-19-03-2025 16:18:30', NULL, 1, 0, '11', '5000', 'Cloturé', '2025-03-19 16:18:30', NULL, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_details`
--

DROP TABLE IF EXISTS `tbl_order_details`;
CREATE TABLE IF NOT EXISTS `tbl_order_details` (
  `order_details_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `taxe_id` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `product_sales_quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `command_statut` int NOT NULL DEFAULT '0',
  `date_cloture` date DEFAULT NULL,
  PRIMARY KEY (`order_details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `user_id`, `order_id`, `product_id`, `category_id`, `taxe_id`, `product_name`, `product_price`, `product_size`, `product_sales_quantity`, `created_at`, `updated_at`, `command_statut`, `date_cloture`) VALUES
(1, 4, 1, 3, 3, 'AU', 'Granions Chondrostéo Articulations 3X90 comprimés', '5000', NULL, '2', '2024-09-14 20:26:05', NULL, 0, NULL),
(2, 4, 1, 2, 1, 'AU', 'CarboSylane 48 doses', '2000', NULL, '2', '2024-09-14 20:26:05', NULL, 0, NULL),
(3, 4, 1, 5, 6, 'AU', 'ProRhinel Mouche Bébé + 2 embouts souples jetables', '7500', NULL, '1', '2024-09-14 20:26:05', NULL, 0, NULL),
(4, 4, 2, 3, 3, 'AU', 'Granions Chondrostéo Articulations 3X90 comprimés', '5000', NULL, '3', '2024-10-02 11:38:28', NULL, 0, NULL),
(7, 4, 4, 6, 6, 'AU', 'Weleda Baume de Massage Vergetures 150ml', '10960', NULL, '2', '2024-10-08 16:20:52', NULL, 0, NULL),
(8, 4, 4, 3, 3, 'AU', 'Granions Chondrostéo Articulations 3X90 comprimés', '5000', NULL, '3', '2024-10-08 16:20:52', NULL, 0, NULL),
(9, 4, 5, 4, 4, 'AU', 'Bioderma Atoderm Gel Douche 1L', '4500', NULL, '1', '2024-10-08 16:22:15', NULL, 0, NULL),
(10, 4, 5, 2, 1, 'AU', 'CarboSylane 48 doses', '2000', NULL, '2', '2024-10-08 16:22:15', NULL, 0, NULL),
(11, 4, 5, 1, 1, 'AU', 'Météoxane 60 gélules', '20000', NULL, '4', '2024-10-08 16:22:15', NULL, 0, NULL),
(12, 2, 6, 2, 1, 'A', 'CarboSylane 48 doses', '2000', NULL, '2', '2024-12-02 08:40:51', NULL, 0, NULL),
(13, 2, 7, 3, 3, 'AU', 'Granions Chondrostéo Articulations 3X90 comprimés', '5000', NULL, '1', '2025-01-03 10:56:31', NULL, 0, NULL),
(14, 2, 9, 3, 3, 'D', 'Granions Chondrostéo Articulations 3X90 comprimés', '5000', NULL, '1', '2025-03-19 16:18:30', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ordo_consultation`
--

DROP TABLE IF EXISTS `tbl_ordo_consultation`;
CREATE TABLE IF NOT EXISTS `tbl_ordo_consultation` (
  `id_ordo_traitement` int NOT NULL AUTO_INCREMENT,
  `id_consultation` int NOT NULL,
  `num_ordo` int NOT NULL,
  `ordonnance_consultation` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_ordo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_ordo_traitement`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ordo_consultation`
--

INSERT INTO `tbl_ordo_consultation` (`id_ordo_traitement`, `id_consultation`, `num_ordo`, `ordonnance_consultation`, `date_ordo`, `updated_at`) VALUES
(1, 12, 23, '- 2 aspirines\r\n- 1 doliprane\r\n- 1 Panadol / Matin - soir', '2024-12-17 02:54:59', '2025-04-07 04:34:13'),
(2, 5, 5, '<ol><li>Panadol</li><li>Antibiotiques</li><li>Rééducation</li><li>Béquilles</li></ol>', '2024-12-18 01:11:50', '2025-04-07 04:34:13'),
(3, 5, 5, 'Juste un test, merci de ne pas le prendre en considération', '2024-12-18 11:17:02', '2025-04-07 04:34:13'),
(4, 5, 5, '- paracetamol\r\n- vibrocil', '2024-12-18 16:34:21', '2025-04-07 04:34:13'),
(5, 13, 26, 'ECHOGRAPHIE', '2024-12-18 17:42:50', '2025-04-07 04:34:13'),
(6, 13, 26, 'Vitamine C', '2024-12-18 17:45:03', '2025-04-07 04:34:13'),
(7, 14, 27, 'Analyse des reins', '2024-12-18 18:05:27', '2025-04-07 04:34:13'),
(8, 15, 28, 'Analyse CRP, Injection Arthémisia', '2024-12-19 07:01:10', '2025-04-07 04:34:13'),
(9, 18, 31, '<p>non</p>', '2024-12-19 10:02:06', '2025-04-07 04:34:13'),
(10, 18, 31, '<ol><li>Paracetamo</li><li>Nivaquine</li><li>CAC100 sandoz</li></ol>', '2024-12-19 10:03:35', '2025-04-07 04:34:13'),
(11, 10, 1, 'Une ordonnance de test', '2024-12-19 10:11:42', '2025-04-07 04:34:13'),
(12, 5, 5, 'Doliprane', '2024-12-19 10:35:43', '2025-04-07 04:34:13'),
(13, 5, 5, 'Vitamine C', '2024-12-19 10:37:34', '2025-04-07 04:34:13'),
(14, 19, 35, 'Fibroscopie urgente', '2024-12-19 10:44:06', '2025-04-07 04:34:13'),
(15, 19, 35, '<p>Vitamine C, Nivaquine</p>', '2024-12-19 10:45:40', '2025-04-07 04:34:13'),
(16, 20, 36, 'Fibroscopie et scanner', '2024-12-20 11:58:20', '2025-04-07 04:34:13'),
(17, 20, 36, 'Perfusion antibiotique', '2024-12-20 12:03:02', '2025-04-07 04:34:13'),
(18, 24, 25, 'Analyse', '2024-12-22 07:33:20', '2025-04-07 04:34:13'),
(19, 29, 39, 'Radiographie', '2024-12-22 19:13:25', '2025-04-07 04:34:13'),
(20, 32, 42, 'Analyse', '2025-01-04 08:22:55', '2025-04-07 04:34:13'),
(21, 37, 43, '<p>Doliprane</p>', '2025-01-04 20:49:37', '2025-04-07 04:34:13'),
(22, 31, -31, 'sdfsqfsdqf', '2025-01-04 21:51:33', '2025-04-07 04:34:13'),
(23, 38, 45, 'dfgdf', '2025-01-04 21:54:04', '2025-04-07 04:34:13'),
(24, 31, -31, 'ertyhujkl', '2025-01-04 21:55:43', '2025-04-07 04:34:13'),
(25, 10, 1, 'test', '2025-01-23 08:53:22', '2025-04-07 04:34:13'),
(26, 5, 5, 'sss', '2025-01-23 08:55:45', '2025-04-07 04:34:13'),
(27, 40, 47, 'vbrr', '2025-02-05 09:36:42', '2025-04-07 04:34:13'),
(28, 40, 47, '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>rvrvr</li></ol>', '2025-02-05 10:04:22', '2025-04-07 04:34:13'),
(29, 40, 47, '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>God Time is the best</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>In God we trust</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>No time to loose</li></ol>', '2025-02-05 10:05:13', '2025-04-07 04:34:13'),
(30, 40, 47, '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Gr</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>Id</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>dk</li></ol>', '2025-02-05 10:13:58', '2025-04-07 04:34:13'),
(31, 32, 42, '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>ggg</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>hcc</li><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>jchg</li></ol>', '2025-02-05 10:15:21', '2025-04-07 04:34:13'),
(32, 32, 46, '<ol><li data-list=\"ordered\"><span class=\"ql-ui\" contenteditable=\"false\"></span>OK</li></ol>', '2025-04-04 13:05:11', '2025-04-07 04:34:13'),
(33, 44, 0, '<p>Test</p>', '2025-04-07 02:35:13', '2025-04-07 02:35:13'),
(34, 44, 0, '<p>Test</p>', '2025-04-07 02:35:35', '2025-04-07 02:35:35'),
(35, 50, 0, '<p>Test de clôture</p>', '2025-04-07 02:36:43', '2025-04-07 02:36:43'),
(36, 25, 0, '<p>Accidenté terminé</p>', '2025-04-07 02:37:34', '2025-04-07 02:37:34'),
(37, 43, 0, '<p>Ok</p>', '2025-04-07 02:38:25', '2025-04-07 02:38:25'),
(38, 43, 0, '<p>Pourquoi ça n\'a pas fonctionné ?</p>', '2025-04-07 02:39:07', '2025-04-07 02:39:07'),
(39, 44, 0, '<p>Action de clôture choisie</p>', '2025-04-07 02:39:52', '2025-04-07 02:39:52'),
(40, 51, 0, '<p>Terminé</p>', '2025-04-07 03:03:11', '2025-04-07 03:03:11'),
(41, 41, 0, '<p>Terminé</p>', '2025-04-07 03:06:32', '2025-04-07 03:06:32'),
(42, 62, 67, '<p>Ordonnance N°1242</p>', '2025-04-07 15:26:52', '2025-04-07 15:26:52');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_panier`
--

DROP TABLE IF EXISTS `tbl_panier`;
CREATE TABLE IF NOT EXISTS `tbl_panier` (
  `panier_id` int NOT NULL AUTO_INCREMENT,
  `taxe_id` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `guest_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `prix` int NOT NULL,
  `qty` int NOT NULL,
  `total` int NOT NULL,
  `panier_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`panier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patient`
--

DROP TABLE IF EXISTS `tbl_patient`;
CREATE TABLE IF NOT EXISTS `tbl_patient` (
  `patient_id` int NOT NULL AUTO_INCREMENT,
  `dossier_numero` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom_patient` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom_patient` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nip` int DEFAULT NULL,
  `telephone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_urgence` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email_patient` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nationalite` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sexe_patient` varchar(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `smatrimonial` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `datenais` date NOT NULL,
  `pcreated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pupdated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gsang` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `id_centre` int NOT NULL,
  `statut` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_patient`
--

INSERT INTO `tbl_patient` (`patient_id`, `dossier_numero`, `nom_patient`, `prenom_patient`, `nip`, `telephone`, `contact_urgence`, `email_patient`, `nationalite`, `sexe_patient`, `smatrimonial`, `datenais`, `pcreated_at`, `pupdated_at`, `adresse`, `gsang`, `id_centre`, `statut`, `created_at`, `updated_at`) VALUES
(1, '', 'LOGAN', 'Patricia', 789258740, '+22967361565', '+99967361565', 'loganpaul@gmail.com', 'Béninois', 'F', 'Marié ', '1994-09-01', '2024-09-01 12:03:30', '2024-09-01 12:03:30', 'Haie vive, cotonou', 'B-', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(2, '', 'ATAOU', 'Brenda', 788984563, '+22869589878', '+22669589878', 'ataoupatrice@gmail.com', 'Togolais', 'F', 'Célibataire', '1999-03-01', '2024-09-01 12:03:30', '2024-09-01 12:03:30', '', 'A+', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(3, '', 'Mark', 'Otto', 600000, '+22967361565', '+33987456115', 'markotto@gmail.com', 'Béninoise', 'M', 'Marié', '2010-01-01', '2024-09-01 17:13:33', '2024-09-01 17:13:33', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(4, '', 'Wayne', 'Carter', 2, '+22960002034', '+22987954441', 'waynecarter@gmail.com', 'Américain', 'M', 'Célibataire', '1970-03-01', '2024-09-01 17:28:54', '2024-09-01 17:28:54', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(5, '', 'Martin', 'Khalid', 600000, '+24169696969', '+26069020249', 'waynecarter@gmail.com', 'Béninoise', 'M', 'Marié', '2000-01-01', '2024-09-01 18:55:11', '2024-09-01 18:55:11', 'Zogbadjè clinique Merveille', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(6, 'DIR-CEN-0001', 'KOUWAGOU', 'Nadine N\'ko', 1234567897, '+22996276552', '+22996276552', 'nkouwagou@gmail.com', 'Béninoise', '', 'Marié', '2024-11-01', '2024-11-14 14:35:20', '2024-11-14 14:35:20', 'Abomey-Calavi/Aitchedji', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(7, 'DIR-CEN-0001', 'ADEBOLOU', 'Fabrice', 1234567897, '+22954525456', '+22955226655', 'kouagour02@gmail.com', 'Togolaise', '', 'Célibataire', '2024-02-08', '2024-11-15 07:41:46', '2024-11-15 07:41:46', '23 avenue colette besson', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(8, 'DIR-CEN-0001', 'KOUWAGOU', 'Nadine N\'ko', 1234567897, '+229112233555', '+22955555555', 'nkouwagou@gmail.com', 'Béninoise', '', 'Marié', '2024-10-31', '2024-11-15 10:47:44', '2024-11-15 10:47:44', 'Abomey-Calavi/Aitchedji', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(9, '', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 08:06:50', '2024-12-06 08:06:50', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(10, '', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 08:08:52', '2024-12-06 08:08:52', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(11, '', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 08:33:59', '2024-12-06 08:33:59', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(12, '', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 08:35:44', '2024-12-06 08:35:44', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(13, 'CEN202412061057', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 09:57:38', '2024-12-06 09:57:38', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(14, 'CEN202412061723', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2024-12-06 16:23:38', '2024-12-06 16:23:38', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(15, 'CEN202412061724', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 16:24:48', '2024-12-06 16:24:48', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(16, 'CEN202412061737', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 16:37:34', '2024-12-06 16:37:34', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(17, 'CEN202412061737', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 16:37:48', '2024-12-06 16:37:48', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(18, 'COT/2024/12/06/17/55', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2024-12-06 16:55:18', '2024-12-06 16:55:18', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(19, 'COT/2024/12/06/17/59', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-06 16:59:53', '2024-12-06 16:59:53', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(20, 'COT/2024/12/06/1801', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2024-12-06 17:01:57', '2024-12-06 17:01:57', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(21, 'COT/2024/12/06/1905', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2024-12-06 17:05:20', '2024-12-06 17:05:20', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(22, 'MED/2024/12/18/1902', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-18 18:02:14', '2024-12-18 18:02:14', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(23, 'MED/2024/12/19/0753', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-19 06:53:50', '2024-12-19 06:53:50', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(24, 'MED/2024/12/19/0852', 'YEYey', 'IGFIEGFI', 2147483647, '96276552', '7474747', 'nkouwagou@gmail.com', 'Togolaise', 'M', 'IGIG', '2024-12-19', '2024-12-19 07:52:57', '2024-12-19 07:55:32', 'Abomey-Calavi/Aitchedji', 'O+', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(25, 'MED/2024/12/19/1028', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2024-12-19 09:28:39', '2024-12-19 09:28:39', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(26, 'MED/2024/12/19/1045', 'François', 'OBAMA', 25467890, '+2295555555555', '+2295555555555', 'obama@gmail.com', 'Sénégalaise', 'M', 'Célibataire', '2024-12-19', '2024-12-19 09:45:08', '2024-12-19 09:45:08', 'Tanguiéta', 'O+', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(27, 'MED/2024/12/19/1123', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-19 10:23:35', '2024-12-19 10:23:35', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(28, 'MED/2024/12/19/1126', 'JOe', 'Micheal', 2147483647, '+2296666666', '+2296666666', 'micheal@gmail.com', 'Suédoise', 'M', 'MArié', '2024-12-19', '2024-12-19 10:26:19', '2024-12-19 10:26:19', 'TOGO', 'O+', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(29, 'MED/2024/12/19/1128', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-19 10:28:20', '2024-12-19 10:28:20', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(30, 'MED/2024/12/19/1129', 'MOUTON', 'Julien', 2147483647, '+22925862525', '+22925862525', 'juh@kop.com', 'niger', 'M', 'néant', '2024-12-28', '2024-12-19 10:29:58', '2024-12-19 10:29:58', 'Cot', 'O+', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(31, 'MED/2024/12/20/1252', 'DUPONT', 'Jeanne', 54662, '+2295125848', '+2295125848', 'ddhu@yhvg.sfrfz', 'dddc', 'F', 'zcz', '2024-12-08', '2024-12-20 11:52:56', '2024-12-20 11:52:56', 'ded', 'ab', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(32, 'MED/2024/12/22/0850', 'YOKA', 'Bill', 2147483647, '656868989', '656565959', 'kouagour02@gmail.com', 'Béninoise', 'F', 'Marié', '2024-12-22', '2024-12-22 07:50:00', '2024-12-22 09:15:37', '23 avenue colette besson', 'O-', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(33, 'MED/2024/12/22/1200', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-22 11:00:42', '2024-12-22 11:00:42', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(34, 'MED/2024/12/22/2011', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-22 19:11:03', '2024-12-22 19:11:03', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(35, 'MED/2024/12/27/1035', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2024-12-27 09:35:32', '2024-12-27 09:35:32', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(36, 'MED/2025/01/04/0917', 'Martin', 'Pisso', 63233, '+22921854784', '+22921854784', 'ljj@kk.d', 'dcse', 'F', 'sqs', '2025-01-30', '2025-01-04 08:17:54', '2025-01-04 08:17:54', 'Cot', 'O+', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(37, 'MED/2025/01/04/1941', 'Bruno', 'Lemairez', 2147483647, '+22965566', '+22965566', 'xr@ffjk.b', 'dddc', 'M', 'sqs', '2025-01-23', '2025-01-04 18:41:08', '2025-01-04 18:41:08', 'ded', 'O+', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(38, 'MED/2025/01/04/2252', '', '', 0, '', '', '', '', 'F', '', '0000-00-00', '2025-01-04 21:52:25', '2025-01-04 21:52:25', '', '', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(39, 'MED/2025/02/05/0322', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2025-02-05 01:22:53', '2025-02-05 01:22:53', '', '', 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(40, 'MED/2025/02/05/0849', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2025-02-05 06:49:07', '2025-02-05 06:49:07', '', '', 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(41, 'MED/2025/02/05/0856', 'GNAMOU', 'Oren', 1452154785, '67156137', '897544655', 'gnamou@gmail.com', 'JUFvii', 'M', 'UFUF', '2025-02-03', '2025-02-05 06:56:15', '2025-02-05 06:57:50', 'C/sb Aïtchédji Maison ADEOSSI François', 'AB', 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(42, 'MED/2025/02/05/0858', 'ADEBOLOU', 'Fabrice Olaréwadou', 2147483647, '+229644446444', '+229644446444', 'fadebolou@gmail.com', 'HHH', 'M', 'Marié sans enfants', '1995-02-05', '2025-02-05 06:58:40', '2025-02-05 06:58:40', '23 avenue colette besson', 'O', 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(43, 'MED/2025/02/05/0911', '', '', 0, '', '', '', '', 'M', '', '0000-00-00', '2025-02-05 07:11:55', '2025-02-05 07:11:55', '', '', 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(44, 'MED/2025/03/14/1641', 'KOUAGOU', 'Russel Hanss', 2147483647, '6715613765', NULL, NULL, 'allemande', 'F', NULL, '2025-03-14', '2025-03-14 15:41:45', '2025-03-14 15:41:45', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(45, 'MED/2025/03/14/1649', 'KOUAGOU', 'Russel Hanss', 2147483647, '6715613755', NULL, NULL, 'beninoise', 'F', NULL, '2025-03-14', '2025-03-14 15:49:17', '2025-03-14 15:49:17', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(46, 'MED/2025/03/14/1650', 'Jpnh', 'CENA', 5, '85794949', NULL, NULL, 'azerbaïdjanaise', 'F', NULL, '2025-03-14', '2025-03-14 15:50:00', '2025-03-14 15:50:00', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(47, 'MED/2025/03/14/1709', 'LIL', 'Wayne', 2147483647, '012154828', NULL, NULL, 'argentine', 'F', NULL, '2025-03-14', '2025-03-14 16:09:11', '2025-03-14 16:09:11', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(48, 'MED/2025/03/14/1712', 'ZOUMAROU', 'Faouziath', 2147483647, '87548454', NULL, NULL, 'australienne', 'M', NULL, '2025-03-14', '2025-03-14 16:12:36', '2025-03-14 16:12:36', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(49, 'MED/2025/03/14/1714', 'ADEBOLOU', 'Fabrice Olaréwadou', 2147483647, '0783291680', NULL, NULL, 'armenienne', 'F', NULL, '1995-03-14', '2025-03-14 16:14:38', '2025-03-14 16:14:38', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(50, 'MED/2025/03/14/1718', 'AEFEA', 'EDEADA', 2147483647, '85485855', NULL, NULL, 'sud-africaine', 'M', NULL, '2025-03-14', '2025-03-14 16:18:28', '2025-03-14 16:18:28', NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(51, 'MED/2025/03/14/1721', 'FFEFAEFAE', 'FRFFEFF', 2147483647, '43434343434', NULL, NULL, 'antiguaise-et-barbudienne', 'F', NULL, '2025-03-14', '2025-03-14 16:21:14', '2025-03-14 16:21:14', NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(52, 'MED/2025/03/16/1853', 'YANTIKOUA', 'Douba', 2147483647, '989654856', NULL, NULL, 'allemande', 'M', NULL, '1995-05-16', '2025-03-16 17:53:36', '2025-03-16 17:53:36', NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(53, 'MED/2025/03/16/1856', 'Douba', 'Emanuel', 548785485, '545852646', NULL, NULL, 'albanaise', 'M', NULL, '1995-05-09', '2025-03-16 17:56:15', '2025-03-16 17:56:15', NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(54, 'MED/2025/03/18/1023', 'REDDINGTON', 'Raymond', 2147483647, '111111111111', NULL, NULL, 'beninoise', 'F', NULL, '1995-02-10', '2025-03-18 09:23:14', '2025-03-18 09:23:14', NULL, NULL, 1, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(55, 'MED/2025/03/20/0357', 'LISSASSI', 'Pierre', 2147483647, '015485878', NULL, NULL, 'beninoise', 'M', NULL, '1988-06-08', '2025-03-20 02:57:37', '2025-03-20 02:57:37', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(56, 'MED/2025/03/20/0403', 'AGOSSOU', 'Rosine', 887965842, '6655849', NULL, NULL, 'beninoise', 'F', NULL, '1992-11-22', '2025-03-20 03:03:56', '2025-03-20 03:03:56', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(57, 'MED/2025/03/20/0410', 'KOUAGOU', 'Jamal', 2147483647, '55555555', NULL, NULL, 'algerienne', 'M', NULL, '2009-01-28', '2025-03-20 03:10:05', '2025-03-20 03:10:05', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(58, 'MED/2025/03/20/0413', 'JJJJJJJJJJJJ', 'GGGGGGGGG', 555555555, '5555555555', NULL, NULL, 'albanaise', 'F', NULL, '2025-03-20', '2025-03-20 03:13:10', '2025-03-20 03:13:10', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(59, 'MED/2025/03/20/0418', 'uuuuuuuu', 'kkkkk', 2147483647, '555555', NULL, NULL, 'albanaise', 'M', NULL, '2025-03-20', '2025-03-20 03:18:22', '2025-03-20 03:18:22', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(60, 'MED/2025/03/20/0423', 'AGOSSOU', 'Emanuel', 58459522, '54854854', NULL, NULL, 'beninoise', 'M', NULL, '2007-06-05', '2025-03-20 03:23:40', '2025-03-20 03:23:40', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(61, 'MED/2025/03/20/1101', 'N\'KOUE', 'Donatien', 65859654, '0166047068', NULL, NULL, 'albanaise', 'F', NULL, '1936-01-07', '2025-03-20 10:01:05', '2025-03-20 10:01:05', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(62, 'MED/2025/03/20/1101', 'FOLLY', 'Fiacre', 8974562, '648595652', NULL, NULL, 'argentine', 'F', NULL, '1983-02-01', '2025-03-20 10:01:56', '2025-03-20 10:01:56', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(63, 'MED/2025/03/20/1111', 'KADA', 'Miryam', 2147483647, '0197856425', NULL, NULL, 'beninoise', 'M', NULL, '1947-10-14', '2025-03-20 10:11:12', '2025-03-20 10:11:12', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(64, 'MED/2025/03/23/1429', 'ADO', 'Georges', 9854, '78544', NULL, NULL, 'beninoise', 'M', NULL, '2025-03-01', '2025-03-23 13:29:23', '2025-03-23 13:29:23', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(65, 'MED/2025/03/23/1640', 'Jonh', 'Georgesj', 2147483647, '55555555555', NULL, NULL, 'beninoise', 'F', NULL, '2024-12-24', '2025-03-23 15:40:35', '2025-03-23 15:40:35', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(66, 'MED/2025/03/27/2219', '', '', NULL, '', NULL, NULL, '', 'M', NULL, '0000-00-00', '2025-03-27 20:19:57', '2025-03-27 20:19:57', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(67, 'MED/2025/03/27/2221', '', '', NULL, '', NULL, NULL, '', 'M', NULL, '0000-00-00', '2025-03-27 20:21:22', '2025-03-27 20:21:22', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(68, 'MED/2025/03/31/2128', 'DOE', 'John', 234567890, '67667062', NULL, NULL, 'beninoise', 'M', NULL, '1999-12-12', '2025-03-31 20:28:16', '2025-03-31 20:28:16', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(69, 'MED/2025/04/02/1757', 'HODE', 'Ariane', 4567890, '24350937', NULL, NULL, 'beninoise', 'M', NULL, '2025-04-02', '2025-04-02 16:57:39', '2025-04-02 16:57:39', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(70, 'MED/2025/04/04/0603', 'TABITHA', 'Précieux', 789456123, '0197979797', NULL, NULL, 'beninoise', 'M', NULL, '1983-06-06', '2025-04-04 05:03:15', '2025-04-04 05:03:15', NULL, NULL, 0, NULL, '0000-00-00 00:00:00', '2025-04-04 19:31:05'),
(71, 'MED/2025/04/04/1831', '', '', NULL, '', NULL, NULL, '', 'M', NULL, '0000-00-00', '2025-04-04 17:31:09', '2025-04-04 17:31:09', NULL, NULL, 1, 'incomplet', '2025-04-04 17:31:09', '2025-04-04 17:31:09'),
(72, 'MED/2025/04/04/1833', '', '', NULL, '', NULL, NULL, '', 'M', NULL, '0000-00-00', '2025-04-04 17:33:03', '2025-04-04 17:33:03', NULL, NULL, 1, 'incomplet', '2025-04-04 17:33:03', '2025-04-04 17:33:03'),
(73, 'MED/2025/04/04/1959', '', '', NULL, '', NULL, NULL, '', 'M', NULL, '0000-00-00', '2025-04-04 18:59:14', '2025-04-04 18:59:14', NULL, NULL, 1, 'incomplet', '2025-04-04 18:59:14', '2025-04-04 18:59:14'),
(74, 'MED/2025/04/05/2329', 'AZANKPOSSO', 'Aurore', 987654321, '+2290125485878', '+2290125485878', 'az@gmail.com', 'Suédoise', 'F', 'Célibataire', '1969-06-04', '2025-04-05 22:29:30', '2025-04-05 22:29:30', 'test', 'O+', 1, 'complet', '2025-04-05 22:29:30', '2025-04-05 22:31:45'),
(75, 'MED/2025/04/07/0608', '', '', NULL, '', NULL, NULL, '', 'M', NULL, '0000-00-00', '2025-04-07 05:08:31', '2025-04-07 05:08:31', NULL, NULL, 1, 'incomplet', '2025-04-07 05:08:31', '2025-04-07 05:08:31'),
(76, 'MED/2025/04/07/0836', 'Big', 'Joe', 2147483647, '+22998877979', '+22998877979', 'test5@gmail.com', 'Buen', 'F', 'Ceb', '2025-04-07', '2025-04-07 07:36:34', '2025-04-07 07:36:34', 'fheefhefe', 'B', 1, 'complet', '2025-04-07 07:36:34', '2025-04-07 07:38:26'),
(77, 'MED/2025/04/07/0845', 'DANGER', 'Eifel', 85747485, '+229475854796', '+229475854796', 'Niger@gmail.com', 'Nigerienne', 'M', 'Célib', '1994-12-26', '2025-04-07 07:45:14', '2025-04-07 07:45:14', 'Niger', 'O', 1, 'complet', '2025-04-07 07:45:14', '2025-04-07 07:47:45'),
(78, 'MED/2025/04/07/1035', 'ABOKI', 'Nadège', 8575474, '+22911111111', '+22911111111', 'ab@gmail.com', 'Bielorusse', 'M', 'Céb', '1996-05-07', '2025-04-07 09:35:35', '2025-04-07 09:35:35', 'etetet', 'B', 1, 'complet', '2025-04-07 09:35:35', '2025-04-07 09:38:20'),
(79, 'MED/2025/04/07/1142', 'ETET', 'CDGCJD', 748788, '+2291121', '+2291121', 'hdhdhd@gmail.com', 'ETDE', 'M', 'DTD', '2024-11-20', '2025-04-07 10:42:17', '2025-04-07 10:42:17', 'hcdjcdcd', 'B', 1, 'complet', '2025-04-07 10:42:17', '2025-04-07 10:45:58'),
(80, 'MED/2025/04/07/1756', 'Marley', 'Bob', 2147483647, '+2296864948464', '+2296864948464', 'ni@gmail.com', 'Jamaïcaine', 'F', 'Calé', '1973-04-06', '2025-04-07 16:56:09', '2025-04-07 16:56:09', 'Hdjxy jdh', 'O-', 1, 'complet', '2025-04-07 16:56:09', '2025-04-07 16:57:44'),
(81, 'MED/2025/04/08/1803', 'Bieber', 'Justin', 788587485, '01254585', NULL, NULL, 'beninoise', 'F', NULL, '1993-05-03', '2025-04-08 17:03:35', '2025-04-08 17:03:35', NULL, NULL, 0, NULL, '2025-04-08 19:03:35', '2025-04-08 19:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment`
--

DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `payment_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`, `id_centre`) VALUES
(1, 'caisse', 'Payé', '2024-09-14 20:26:05', NULL, 0),
(2, 'caisse', 'Payé', '2024-10-02 11:38:28', NULL, 0),
(7, 'caisse', 'Payé', '2024-10-08 16:22:15', NULL, 0),
(6, 'caisse', 'Payé', '2024-10-08 16:20:52', NULL, 0),
(8, 'caisse', 'Payé', '2024-12-02 08:40:51', NULL, 0),
(9, 'caisse', 'Payé', '2025-01-03 10:56:31', NULL, 0),
(10, 'caisse', 'Payé', '2025-01-03 10:56:43', NULL, 0),
(11, 'caisse', 'Payé', '2025-03-19 16:18:30', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prestation`
--

DROP TABLE IF EXISTS `tbl_prestation`;
CREATE TABLE IF NOT EXISTS `tbl_prestation` (
  `prestation_id` int NOT NULL AUTO_INCREMENT,
  `nom_prestation` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `tarif` int NOT NULL,
  `prix_analyse_assure` int NOT NULL,
  `service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'LABORATOIRE',
  `category` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `centre_id` int NOT NULL,
  `user_id` bigint NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`prestation_id`),
  KEY `tbl_centre` (`centre_id`),
  KEY `users` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=236 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_prestation`
--

INSERT INTO `tbl_prestation` (`prestation_id`, `nom_prestation`, `tarif`, `prix_analyse_assure`, `service`, `category`, `centre_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Ablation sonde urinaire', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(2, 'Accouchement dirigé par sage fem', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(3, 'Accouchement-Encadré par Gynéco', 30000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(4, 'Accouchement-Gynécologue', 50000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(5, 'ACCOUChement sage femme', 16000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(6, 'ACIDE URIQUE', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(7, 'Acte cerclage', 80000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(8, 'Acte Médecine générale', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(9, 'Activités thérapeutiques', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(10, 'AKOP (Amibe Kyste Oeuf Parasite)', 500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(11, 'AMIU Gynécologue', 35000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(12, 'AMIU sage femme', 30000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(13, 'Anesthésie locale', 100, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(14, 'Anesthésie Médecin', 30000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(15, 'ANESTHESIE MEDECIN REANIMATEUR', 50000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(16, 'AntigèneHbs(AgHBs)', 4000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(17, 'Appendicectomie', 180000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(18, 'ASLO', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(19, 'Aspiration auriculaire par oreil', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(20, 'Aspiration nouveau-né', 1000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(21, 'Atelle', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(22, 'Avis gynécologique/48h', 4000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(23, 'Bandage Elastique', 15000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(24, 'Bandelette urinaire', 500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(25, 'Biopsie du col', 25000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(26, 'BLOC OPERATOIRE CAMP CHIRUGICAL', 70000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(27, 'Calcémie', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(28, 'Carnet CPN', 300, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(29, 'CARNET DE SOIN', 100, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(30, 'Carte infantile fille', 500, 0, 'VACCINATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(31, 'Certificat de coups et blessure', 15000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(32, 'Certificat de décès', 5000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(33, 'Certificat de dispense de sport', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(34, 'Certificat de visite contre visi', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(35, 'Certificat de voyage sur grosses', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(36, 'Certificat Médical de repos', 1000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(37, 'Certificat pour permis de condui', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(38, 'Certificat Prénuptial', 10000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(39, 'Césarienne (A.I.A)', 180000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(40, 'Cholestérol HDL', 3000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(41, 'Cholestérol total', 3000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(42, 'Circoncision', 35000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(43, 'CIRCONCISION ff', 60000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(44, 'Confection d\'un anneau de FANTON', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(45, 'Confection plâtre', 15000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(46, 'Consultation anesthésique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(47, 'Consultation Cardio+ECG', 15000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(48, 'Consultation cardiologique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(49, 'Consultation chirurgicale', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(50, 'Consultation Chirurgie Pédiatriq', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(51, 'Consultation dermatologique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(52, 'Consultation gynécologique', 8000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(53, 'Consultation gynécologique perso', 15000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(54, 'Consultation Médecine Générale', 1000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(55, 'Consultation Médicale Dr ODJO', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(56, 'Consultation Neurologique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(57, 'Consultation ORL', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(58, 'Consultation Pédiatrique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(59, 'Consultation Rhumatologique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(60, 'Consultation Traumatologique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(61, 'Consultation Urologique', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(62, 'CONSULTATION VOYAGE', 1500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(63, 'Contrôle tension artérielle', 300, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(64, 'Coup de sonde', 3000, 0, 'ECHOGHRAPHIE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(65, 'CPN (1ere consultation)', 2000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(66, 'CPN (suivi)', 1100, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(67, 'CPON', 1000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(68, 'Créatininémie', 2000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(69, 'CRP (C-Réactive Protéine)', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(70, 'Cystotomie', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(71, 'Decerclage', 25000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(72, 'Déclenchement (travail d\'accouch', 5000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(73, 'Dossier Médical', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(74, 'DOUBLE MISE EN OBSERVATION VIP', 10000, 0, 'HOSPITALISATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(75, 'DUPLICATA FICHE DE NAISSANCE', 5000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(76, 'ECBU', 10000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(77, 'ECG', 8000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(78, 'Echo doppler Veineuse', 30000, 0, 'ECHOGHRAPHIE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(79, 'Echographie abdominale', 15000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(80, 'Echographie abdominopelvienne', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(81, 'ECHOGRAPHIE ENDOVAGINALE/ T', 7500, 0, 'ECHOGHRAPHIE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(82, 'Echographie mammaire', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(83, 'Echographie Partie molle', 20000, 0, 'ECHOGHRAPHIE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(84, 'Echographie pelvienne endovagina', 10000, 0, 'ECHOGHRAPHIE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(85, 'Echographie pelvienne gynécologu', 7000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(86, 'Echographie rénale', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(87, 'Echographie testiculaire', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(88, 'Echographie thyroïdienne', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(89, 'Echographie vésico-prostatique', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(90, 'Écho. obstétricale/pelvienne Tec', 6500, 0, 'ECHOGHRAPHIE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(91, 'Electrophorèse de l\'hémoglobine', 5000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(92, 'Enregistrement RCF', 2000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(93, 'Episiotomie + suture', 5000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(94, 'Expulsion de produit de concepti', 12000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(95, 'Extraction corps étranger ORL', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(96, 'Forfait bloc', 70000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(97, 'Forfait bloc DIRECT-AID', 50000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(98, 'FORFAIT CIRCONCISION', 90000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(99, 'FORFAIT GANTS', 2000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(100, 'Forfait isoflurane (pour 2 heure', 10000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(101, 'FORFAIT NODULECTOMIE', 20000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(102, 'Forfait PLATRE', 45000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(103, 'Forfait plâtre Dr AHONONGA', 90400, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(104, 'Frénectomie', 10000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(105, 'GEDP (Goutte épaisse)', 1500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(106, 'Glycémie à jeun', 1500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(107, 'Glycémie capillaire', 500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(108, 'GsRh (Groupage sanguin rhésus)', 2000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(109, 'Hémoglobine Glyqué', 12000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(110, 'Hospi. journalière urgences', 5000, 0, 'HOSPITALISATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(111, 'Hospitalisation journalière simp', 3000, 0, 'HOSPITALISATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(112, 'Hospitalisation journalière VIP', 15000, 0, 'HOSPITALISATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(113, 'Hospitalisation salle de réveil', 10000, 0, 'HOSPITALISATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(114, 'HSG (Hystérosalpingographie) + p', 27000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(115, 'Imagerie', 18500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(116, 'Infiltration du génou', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(117, 'Injection intramusculaire', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(118, 'Injection intraveineuse', 300, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(119, 'Injection sous-cutanée', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(120, 'Injection VAT', 200, 0, 'VACCINATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(121, 'Ionogramme sanguin', 5000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(122, 'K acte spécialisé', 1000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(123, 'Laboratoire', 125300, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(124, 'Lavage auriculaire par oreille', 2000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(125, 'Lavage oculaire', 300, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(126, 'Lavage rhinopharyngé (nasal) par', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(127, 'Lavement baryté', 25000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(128, 'Magnesémie', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(129, 'Mise en observation horaire aux', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(130, 'Mise en observation VIP', 5000, 0, 'HOSPITALISATION', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(131, 'Monitoring horaire', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(132, 'Monitoring RCF horaire', 500, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(133, 'Mté Déclenchement travail d\'acco', 10000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(134, 'Myomectomie', 200000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(135, 'NB (Numération des blancs)', 1000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(136, 'Nébulisation par séance', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(137, 'Nécrosectomie', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(138, 'NFS', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(139, 'NFS + Plaquettes', 5000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(140, 'Nodulectomie', 60000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(141, 'Oxygénothérapie horaire', 1000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(142, 'Pansement par séance', 800, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(143, 'Pansement Quotidien (forfait)', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(144, 'Pansement quotidien (forfait+ GA', 700, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(145, 'PERITONITE AIGUE', 250000, 0, 'BLOC OPERATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(146, 'PF LAFIA INJECTABLE', 1000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(147, 'PGS', 200, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(148, 'Ponction articulaire', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(149, 'Pose cathéter pour patient exter', 1000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(150, 'Pose de platre', 20000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(151, 'Pose de sonde urinaire', 1000, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(152, 'Pose DIU', 1000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(153, 'Pose DIU Gynécologue', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(154, 'Pose et surveillance de perfusio', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(155, 'Pose jadelle', 1000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(156, 'Pose jadelle gynécologue', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(157, 'Prise de poids', 200, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(158, 'Produits pharmaceutiques', 80200, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(159, 'PSA', 15000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(160, 'Rapport médical', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(161, 'Retrait DIU Gynécologue', 8000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(162, 'Retrait jadelle', 2500, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(163, 'Retrait jadelle Gynécologue', 8000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(164, 'Révision utérine', 2000, 0, 'MATERNITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(165, 'RUBEOLE', 15000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(166, 'Rx ASP (Abdomen Sans Préparation', 8000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(167, 'Rx Avant-bras face/profil', 9000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(168, 'Rx Bassin de face', 9000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(169, 'Rx Bassin face + 2 obliques', 18000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(170, 'Rx Bassin face + hanche profil', 10500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(171, 'Rx Bras face/profil', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(172, 'Rx Calcanéus face/profil', 9000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(173, 'Rx Cheville face/profil', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(174, 'Rx Clavicule face', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(175, 'Rx Coccyx face/profil', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(176, 'Rx Coude face/profil', 15000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(177, 'Rx Crâne face/profil', 13000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(178, 'Rx Doigt face/profil', 8500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(179, 'Rx Epaule face/profil', 13000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(180, 'Rx Epaule f/p+rotation intern et', 15000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(181, 'Rx Fémur face/profil', 12500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(182, 'Rx Genou face/profil', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(183, 'Rx Genou f/p + ¾', 12000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(184, 'Rx Grill costal face + oblique', 15000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(185, 'Rx Grill costal (thorax osseux)', 13000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(186, 'Rx Hanche face/profil', 8000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(187, 'Rx Hirtz (crâne)', 8000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(188, 'Rx Jambe face/profil', 10500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(189, 'Rx Main face/profil', 8000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(190, 'Rx Main f/p + oblique', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(191, 'Rx Mastoïde', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(192, 'Rx Maxillaire défilé deux côtés', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(193, 'Rx Maxillaire défilé un côté', 9000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(194, 'Rx Membre inferieur avec mesure', 22000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(195, 'Rx Orteil face/profil', 8500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(196, 'Rx Os propres du nez', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(197, 'Rx Patella face/profil', 8000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(198, 'Rx Pied face/profil', 8000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(199, 'Rx Pied f/p + ¾', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(200, 'Rx Poignet face/profil', 9000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(201, 'Rx Pulmonaire face', 10500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(202, 'Rx Pulmonaire face/profil', 14500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(203, 'Rx pulmonaire voyageur (forfait)', 6500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(204, 'Rx Rachis cervical face/profil', 13000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(205, 'Rx Rachis cervical f/p + ¾', 18000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(206, 'Rx Rachis dorsal face/profil', 15000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(207, 'Rx Rachis lombaire face/profil', 15000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(208, 'Rx Rachis lombaire f/p + ¾', 25000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(209, 'Rx Rachis lombosacré face/profil', 15000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(210, 'Rx Scapula face/profil', 9000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(211, 'Rx Sinus Blondeau', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(212, 'Rx Sternum face/profil', 13500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(213, 'SDW (Séro Diagnostic de Widal)', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(214, 'Séance de kinésithérapie', 5000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(215, 'SEROLOGIE HCV EXT', 14000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(216, 'Sérologie HIV', 2000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(217, 'Sérologie HVC', 14000, 0, 'SPECIALITE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(218, 'Suture par unité de point', 500, 0, 'MEDECINE GENERALE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(219, 'Taux d\'hémoglobine (Tx d\'Hb)', 1000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(220, 'TBG Sérique', 3000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(221, 'TBG Urinaire', 1500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(222, 'TCK', 5500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(223, 'Télécœur', 10000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(224, 'TOGD (Transit oesogastroduodénal', 25500, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(225, 'TOXOPLASMOSE', 15000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(226, 'TPHA', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(227, 'TP (Temps de prothrombine)', 5500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(228, 'Transaminases ALAT (TGP)+ASAT(TG', 5000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(229, 'Triglycérides', 3500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(230, 'UCR (Urétrocystographieretrograd', 25000, 0, 'RADIO', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(231, 'Urée', 1500, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(232, 'VDRL', 3000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(233, 'VITAMINE D', 15000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(234, 'VS (Vitesse de sédimentation)', 3000, 0, 'LABORATOIRE', '', 1, 0, '2025-04-04 18:27:30', '2025-04-04 18:27:30'),
(235, 'Nom Analyse', 150000, 22155, 'LABORATOIRE', 'SEROLOGIE', 1, 2, '2025-04-04 17:15:03', '2025-04-04 17:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_prise_en_charge`
--

DROP TABLE IF EXISTS `tbl_prise_en_charge`;
CREATE TABLE IF NOT EXISTS `tbl_prise_en_charge` (
  `id_prise_en_charge` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `user_role_id` int NOT NULL,
  `last_consult_user_id` int DEFAULT NULL,
  `last_consult_user_role_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `maux` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `temp` int DEFAULT NULL,
  `etat_consultation` int NOT NULL DEFAULT '0',
  `etat_observation` int NOT NULL DEFAULT '0',
  `etat_hospitalisation` int NOT NULL DEFAULT '0',
  `observation` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ordonnance` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_centre` int NOT NULL,
  `etape` int DEFAULT NULL,
  PRIMARY KEY (`id_prise_en_charge`)
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_prise_en_charge`
--

INSERT INTO `tbl_prise_en_charge` (`id_prise_en_charge`, `patient_id`, `user_role_id`, `last_consult_user_id`, `last_consult_user_role_id`, `user_id`, `maux`, `temp`, `etat_consultation`, `etat_observation`, `etat_hospitalisation`, `observation`, `ordonnance`, `created_at`, `updated_at`, `id_centre`, `etape`) VALUES
(1, 1, 0, 3, 7, 1, 'Fièvre', 38, 1, 0, 1, 'Néant', '<h2><strong>Ordonnance Médicale</strong></h2><p>1 Anti Bi-Malaril</p><p>1 dose adulte panadol</p><p>2 plaquettes aspirine</p>', '2024-06-01 16:31:43', '2024-09-01 16:31:43', 1, NULL),
(2, 2, 0, NULL, NULL, 1, 'Céphalés', 37, 0, 0, 0, 'Vomissements et diarrhée depuis son admission', NULL, '2024-09-01 16:36:21', '2024-09-01 16:36:21', 0, NULL),
(3, 3, 0, NULL, NULL, 1, 'Douleurs abdominaux', 39, 0, 0, 0, 'Néant', NULL, '2024-09-01 16:48:24', '2024-09-01 16:48:24', 0, NULL),
(4, 1, 0, NULL, NULL, 1, 'Blessure au bras', 38, 0, 0, 0, 'Blessure peu profonde', NULL, '2024-09-01 17:13:33', '2024-09-01 17:13:33', 0, NULL),
(5, 4, 0, 5, 4, 1, 'Fracture du pieds', 37, 1, 0, 1, 'Fracture fermée du pieds gauche', NULL, '2024-09-01 17:28:54', '2024-09-01 17:28:54', 1, NULL),
(6, 3, 0, NULL, NULL, 1, 'Fièvre', 36, 1, 0, 0, 'Néant', NULL, '2024-09-01 18:53:39', '2024-09-01 18:53:39', 0, NULL),
(7, 5, 0, 3, 7, 1, 'Douleurs abdominaux', 40, 1, 0, 1, 'Néant', '<h2><strong>Ordonnance</strong></h2><ol><li> Plaquette d\'antibiotiques</li><li>Compresse pansements</li><li>Pannadol</li></ol>', '2024-09-01 18:55:11', '2024-09-01 18:55:11', 1, NULL),
(8, 1, 0, NULL, NULL, 1, 'Blessure au bras', 41, 0, 0, 0, 'Néant', NULL, '2024-09-22 12:32:54', '2024-09-22 12:32:54', 0, NULL),
(9, 1, 0, NULL, NULL, 1, 'Blessure au bras', 33, 0, 0, 0, 'Néant', NULL, '2024-10-08 14:14:31', '2024-10-08 14:14:31', 0, NULL),
(10, 2, 0, 8, 2, 1, 'Blessure au bras', 34, 0, 0, 0, 'Néant', NULL, '2024-10-08 14:18:28', '2024-10-08 14:18:28', 1, NULL),
(11, 8, 0, 3, 7, 1, 'Maux de ventre + vaumissements', 29, 1, 0, 0, 'Test d\'observation', NULL, '2024-11-15 10:47:44', '2024-11-15 10:47:44', 1, NULL),
(12, 1, 0, 8, 2, 1, 'Iritation de la gorge', 28, 1, 0, 1, 'RAS', NULL, '2024-12-02 14:04:50', '2024-12-02 14:04:50', 1, NULL),
(13, 3, 0, 9, 3, 1, 'Migraine chronique', 28, 0, 0, 0, 'Plaintes de migraine depuis 3 jours', NULL, '2024-12-05 15:54:31', '2024-12-05 15:54:31', 1, NULL),
(14, 1, 0, 3, 7, 1, 'Mal de dos', 27, 0, 0, 0, 'Douleurs chronique au dos', NULL, '2024-12-05 23:21:55', '2024-12-05 23:21:55', 1, NULL),
(15, 3, 0, 3, 7, 1, 'vzvzvz', 27, 0, 0, 0, 'zvzvrzvzvzrvzv', NULL, '2024-12-06 07:53:18', '2024-12-06 07:53:18', 1, NULL),
(16, 9, 0, NULL, NULL, 1, 'Maux de ventre + vaumissements', NULL, 0, 0, 0, 'Néant', NULL, '2024-12-06 08:06:50', '2024-12-06 08:06:50', 0, NULL),
(17, 10, 0, NULL, NULL, 0, 'Deboîtement de la clavicule', NULL, 0, 0, 0, 'Clavicule gauche déboîté et saignant', NULL, '2024-12-06 08:08:52', '2024-12-06 08:08:52', 0, NULL),
(18, 4, 0, 3, 7, 1, 'Maux de dents', 27, 0, 0, 0, 'Mau', NULL, '2024-12-06 09:33:31', '2025-04-07 03:06:32', 1, NULL),
(19, 11, 0, NULL, NULL, 0, 'vzvzvz', NULL, 0, 0, 0, 'Néant', NULL, '2024-12-06 08:33:59', '2024-12-06 08:33:59', 0, NULL),
(20, 12, 0, NULL, NULL, 0, 'Maux de ventre + vaumissements', NULL, 0, 0, 0, 'Néant', NULL, '2024-12-06 08:35:44', '2024-12-06 08:35:44', 0, NULL),
(21, 13, 0, NULL, NULL, 0, 'Sunriser', NULL, 0, 0, 0, 'Haii so winter', NULL, '2024-12-06 09:57:38', '2024-12-06 09:57:38', 0, NULL),
(22, 17, 0, 8, 2, 1, 'Maux de ventre + vaumissements', NULL, 0, 0, 1, 'Néant', NULL, '2024-12-06 16:37:48', '2024-12-06 16:37:48', 1, NULL),
(23, 18, 0, 3, 7, 1, 'Fatigue générale', NULL, 0, 0, 1, 'Néant', NULL, '2024-12-06 16:55:18', '2024-12-06 16:55:18', 1, NULL),
(24, 19, 0, 8, 2, 1, 'Maux de ventre + vaumissements', NULL, 0, 0, 1, 'Néant', NULL, '2024-12-06 16:59:53', '2024-12-06 16:59:53', 1, NULL),
(25, 20, 0, 8, 2, 1, 'vzvzvz', NULL, 0, 0, 0, 'Néant', NULL, '2024-12-06 17:01:57', '2024-12-06 17:01:57', 1, NULL),
(26, 21, 0, 8, 2, 1, 'vzvzvz', NULL, 0, 0, 0, 'Néant', NULL, '2024-12-06 17:05:20', '2024-12-06 17:05:20', 1, NULL),
(27, 22, 0, 8, 2, 1, 'mal de rein', NULL, 0, 0, 1, 'Néant', NULL, '2024-12-18 18:02:14', '2025-04-07 02:42:38', 1, NULL),
(28, 23, 0, 8, 2, 1, 'Fièvre', NULL, 0, 0, 0, 'Anémie', NULL, '2024-12-19 06:53:50', '2024-12-19 06:53:50', 1, NULL),
(29, 24, 0, 3, 7, 1, 'Oreille bourdonnante', 31, 0, 0, 1, 'Joue gauche enflée', NULL, '2024-12-19 07:52:57', '2024-12-19 07:55:32', 1, NULL),
(30, 25, 0, 8, 2, 1, 'Douleur à l\'estomac', NULL, 0, 0, 0, 'vomissement', NULL, '2024-12-19 09:28:39', '2024-12-19 09:28:39', 1, NULL),
(31, 26, 0, 8, 2, 1, 'Tête saignante', 27, 0, 0, 1, 'Blessure à la tête', NULL, '2024-12-19 09:45:08', '2024-12-19 09:46:12', 1, NULL),
(32, 27, 0, 8, 2, 1, 'Douleur à l\'estomac', NULL, 0, 0, 1, 'Néant', NULL, '2024-12-19 10:23:35', '2024-12-19 10:23:35', 1, NULL),
(33, 28, 0, 8, 2, 1, 'Ecoulement nasale', 27, 0, 0, 0, 'Hemorragie', NULL, '2024-12-19 10:26:19', '2024-12-19 10:27:07', 1, NULL),
(34, 29, 0, 8, 2, 1, 'Douleur à l\'estomac', NULL, 0, 0, 1, 'vomissement', NULL, '2024-12-19 10:28:20', '2024-12-19 10:28:20', 1, NULL),
(35, 30, 0, 8, 2, 1, 'diarrhée', 37, 0, 0, 1, 'Néant', NULL, '2024-12-19 10:29:58', '2024-12-19 10:30:58', 1, NULL),
(36, 31, 0, 8, 2, 1, 'Douleur à l\'estomac', 38, 0, 0, 0, 'Néant', NULL, '2024-12-20 11:52:56', '2024-12-20 11:54:44', 1, NULL),
(37, 32, 0, 8, 2, 1, 'accident', 36, 0, 0, 0, 'saignement', NULL, '2024-12-22 07:50:00', '2025-04-07 02:37:34', 1, NULL),
(38, 33, 0, 8, 2, 1, 'Démangeaisons', NULL, 0, 0, 1, 'Néant', NULL, '2024-12-22 11:00:42', '2024-12-22 11:00:42', 1, NULL),
(39, 34, 0, 2, 1, 1, 'mal de pied', NULL, 0, 0, 0, 'Néant', NULL, '2024-12-22 19:11:03', '2024-12-22 19:11:03', 1, NULL),
(40, 35, 0, 8, 2, 1, 'crp', NULL, 0, 0, 0, 'Néant', NULL, '2024-12-27 09:35:32', '2024-12-27 09:35:32', 1, NULL),
(41, 3, 0, 8, 2, 1, 'analyse crp', 38, 0, 0, 0, 'Néant', NULL, '2024-12-27 09:40:28', '2024-12-27 09:40:28', 1, NULL),
(42, 36, 0, 8, 2, 1, 'Douleur à l\'estomac', 38, 0, 0, 0, 'Néant', NULL, '2025-01-04 08:17:54', '2025-01-04 08:18:56', 1, NULL),
(43, 37, 0, 3, 7, 1, 'diarrhée', 32, 0, 0, 1, 'Néant', NULL, '2025-01-04 18:41:08', '2025-01-04 18:41:56', 1, NULL),
(44, 37, 0, 3, 7, 1, 'toux', 36, 0, 0, 1, 'Néant', NULL, '2025-01-04 20:48:12', '2025-04-07 02:41:54', 1, NULL),
(45, 38, 0, 8, 2, 1, 'Douleur à l\'estomac', NULL, 0, 0, 1, 'Néant', NULL, '2025-01-04 21:52:25', '2025-01-04 21:52:25', 1, NULL),
(46, 36, 0, 8, 2, 1, 'toux', 36, 0, 0, 0, 'Néant', NULL, '2025-01-04 22:24:01', '2025-01-04 22:24:01', 1, NULL),
(47, 39, 0, 8, 2, 1, 'Let it go', NULL, 0, 0, 0, 'Keep living', NULL, '2025-02-05 01:22:53', '2025-02-05 01:22:53', 1, NULL),
(48, 40, 0, 2, 1, 1, 'Nouveau', NULL, 0, 0, 0, 'Nouvel enregistrement', NULL, '2025-02-05 06:49:07', '2025-02-05 06:49:07', 1, NULL),
(49, 41, 0, 2, 1, 1, 'Nouveau', 31, 0, 0, 0, 'Nouvel enregistrement', NULL, '2025-02-05 06:56:15', '2025-04-07 02:39:52', 1, NULL),
(50, 42, 0, 2, 1, 1, 'vzvzvz', 33, 0, 0, 0, 'Néant', NULL, '2025-02-05 06:58:40', '2025-04-07 02:39:07', 1, NULL),
(51, 1, 0, 8, 2, 1, 'fadebolou@gmail.com', 29, 0, 0, 0, 'NéantNéantNéant', NULL, '2025-02-05 08:11:17', '2025-02-05 08:11:17', 1, NULL),
(52, 43, 0, 8, 2, 1, 'Fatigue générale', NULL, 1, 0, 0, 'NéantNéantNéantNéantNéantNéantNéant', NULL, '2025-02-05 07:11:55', '2025-02-05 07:11:55', 1, NULL),
(53, 66, 0, 2, 1, 1, 'Patient A', NULL, 1, 0, 2, 'Patient pour test', NULL, '2025-03-27 20:19:57', '2025-03-27 20:19:57', 1, NULL),
(54, 67, 0, 2, 1, 1, 'Patient B', NULL, 0, 0, 0, 'Patient pour test', NULL, '2025-03-27 20:21:22', '2025-03-27 20:21:22', 1, NULL),
(55, 72, 0, 3, 7, 1, 'TestPatht', NULL, 0, 0, 0, 'Néant Observ', NULL, '2025-04-04 15:33:03', '2025-04-04 15:33:03', 1, 1),
(56, 73, 0, 8, 2, 1, 'Hollywood', NULL, 0, 0, 0, 'New', NULL, '2025-04-04 16:59:14', '2025-04-04 16:59:14', 1, 1),
(57, 74, 0, 8, 2, 1, 'Possotomè', NULL, 0, 0, 0, 'Possosotomè', NULL, '2025-04-05 20:29:30', '2025-04-05 20:31:45', 1, 2),
(58, 74, 0, 8, 2, 1, 'May Be', NULL, 1, 1, 0, 'Perhaps', NULL, '2025-04-06 08:56:14', '2025-04-07 03:03:11', 1, NULL),
(59, 75, 0, NULL, NULL, 1, 'Patient', NULL, 1, 0, 0, 'Patient', NULL, '2025-04-07 03:08:31', '2025-04-07 03:08:31', 1, 1),
(60, 76, 0, 8, 2, 1, 'Path', NULL, 0, 0, 0, 'NÄTej', NULL, '2025-04-07 05:36:34', '2025-04-07 05:38:26', 1, 2),
(61, 77, 0, 8, 2, 1, 'Douleurs au genoux', NULL, 0, 0, 0, 'Enflement du genoux droit', NULL, '2025-04-07 05:45:14', '2025-04-07 05:47:45', 1, 2),
(62, 32, 0, 8, 2, 1, 'ssssssss', NULL, 1, 0, 0, 'zzzzzzzzzzzz', NULL, '2025-04-07 09:12:57', '2025-04-07 09:12:57', 1, NULL),
(63, 74, 0, 8, 2, 1, 'azazaz', NULL, 1, 0, 0, 'ok', NULL, '2025-04-07 09:19:17', '2025-04-07 09:19:17', 1, NULL),
(64, 78, 0, 8, 2, 1, 'AUcune Pathologie spécifique', NULL, 1, 0, 0, 'Pas d\'observation constatée', NULL, '2025-04-07 07:35:35', '2025-04-07 07:38:20', 1, 2),
(65, 5, 0, 8, 2, 1, 'Martin', NULL, 1, 0, 0, 'Martin', NULL, '2025-04-07 09:59:45', '2025-04-07 09:59:45', 1, NULL),
(66, 78, 0, 3, 7, 1, 'Pathologie du patient*', NULL, 1, 0, 1, 'Pathologie du patient*', NULL, '2025-04-07 10:41:58', '2025-04-07 13:25:00', 1, NULL),
(67, 79, 0, 3, 7, 1, 'HDHDHDHD', NULL, 1, 0, 1, 'kceeekcecbecec', NULL, '2025-04-07 08:42:17', '2025-04-07 13:25:48', 1, 2),
(68, 68, 0, 8, 2, 1, 'Consultations - Enregistrer des prises en charge de patients', NULL, 1, 0, 0, 'Pathologie du patient*', NULL, '2025-04-07 15:16:11', '2025-04-07 15:16:11', 1, NULL),
(69, 68, 0, NULL, NULL, 1, 'Consultations - Enregistrer des prises en charge de patients', NULL, 0, 0, 0, 'Pathologie du patient*', NULL, '2025-04-07 15:17:22', '2025-04-07 15:17:22', 1, NULL),
(70, 80, 0, 8, 2, 1, 'Technicien', NULL, 1, 1, 0, 'RAS', NULL, '2025-04-07 14:56:09', '2025-04-07 15:00:49', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `rayon_id` int DEFAULT NULL,
  `srayon_id` int DEFAULT NULL,
  `manufacture_id` int DEFAULT NULL,
  `product_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `product_price` int NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `image_un` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `publication_status` int DEFAULT NULL,
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `stock_defective` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `category_id`, `rayon_id`, `srayon_id`, `manufacture_id`, `product_description`, `product_price`, `product_image`, `image_un`, `publication_status`, `stock`, `stock_defective`, `updated_at`, `id_centre`) VALUES
(1, 'Météoxane 60 gélules', 1, NULL, 1, 1, 'Météoxane', 20000, 'image/mtoxane.jpg.jpg', NULL, NULL, 0, 0, '2024-09-11 14:54:57', 0),
(2, 'CarboSylane 48 doses', 1, NULL, 1, 1, 'CarboSylane 48 doses', 2000, 'image/carbosylane.jpg.jpg', NULL, NULL, 2, 0, '2024-09-11 14:55:38', 0),
(3, 'Granions Chondrostéo Articulations 3X90 comprimés', 3, NULL, 5, 1, 'granions', 5000, 'image/granions-chondrosteo-articulations-3x90-comprimes.jpg.jpg', NULL, NULL, 2, 0, '2024-09-11 15:10:05', 0),
(4, 'Bioderma Atoderm Gel Douche 1L', 4, NULL, 6, 1, 'Bioderma Atoderm Gel Douche 1L', 4500, 'image/atoderm-gel-douche-1l.jpg.jpg', NULL, NULL, 3, 0, '2024-09-11 15:16:14', 0),
(5, 'ProRhinel Mouche Bébé + 2 embouts souples jetables', 6, NULL, 7, 1, 'ProRhinel Mouche Bébé + 2 embouts souples jetables', 7500, 'image/mouche-bebe-prorhinel-2-embouts-souples-jetables.jpg.jpg', NULL, NULL, 8, 0, '2024-09-11 15:19:16', 0),
(6, 'Weleda Baume de Massage Vergetures 150ml', 6, NULL, 8, 1, 'Weleda Baume de Massage Vergetures 150ml', 10960, 'image/weleda-baume-de-massage-vergetures-150ml.jpg.jpg', NULL, NULL, 14, 0, '2024-09-11 15:22:36', 0),
(7, 'Pommade nivea eclaircissante', 4, NULL, 9, 2, 'Pommade nivea eclaircissante', 60000, 'image/téléchargement.jfif.jfif', NULL, NULL, 10, 0, '2024-09-14 20:16:53', 0),
(8, 'Compresse 400x400', 3, NULL, 5, 1, 'Compresse de pansement', 1000, 'image/image.png.png', NULL, NULL, 0, 0, '2025-01-23 10:00:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rayon`
--

DROP TABLE IF EXISTS `tbl_rayon`;
CREATE TABLE IF NOT EXISTS `tbl_rayon` (
  `rayon_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `rayon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rayon_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publication_status` int NOT NULL DEFAULT '1',
  `id_centre` int NOT NULL,
  PRIMARY KEY (`rayon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rayon`
--

INSERT INTO `tbl_rayon` (`rayon_id`, `category_id`, `rayon_name`, `rayon_description`, `publication_status`, `id_centre`) VALUES
(1, 1, 'Digestion', 'Digestion', 1, 0),
(2, 1, 'Douleurs et fièvre', 'Douleurs et fièvre', 1, 0),
(3, 1, 'Métabolisme et nutrition', 'Métabolisme et nutrition', 1, 0),
(4, 1, 'Ophtalmologie', 'Ophtalmologie', 1, 0),
(5, 1, 'Rhume, état grippal', 'Rhume, état grippal', 1, 0),
(6, 3, 'Santé', 'Santé', 1, 0),
(7, 3, 'Beauté', 'Beauté', 1, 0),
(8, 4, 'Hygiène du corps', 'Hygiène du corps', 1, 0),
(9, 6, 'Bébé', 'Bébé', 1, 0),
(10, 6, 'Maman', 'Maman', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reactif`
--

DROP TABLE IF EXISTS `tbl_reactif`;
CREATE TABLE IF NOT EXISTS `tbl_reactif` (
  `reactif_id` bigint NOT NULL AUTO_INCREMENT,
  `reactif_nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `stock` int NOT NULL DEFAULT '100',
  `id_centre` int NOT NULL,
  PRIMARY KEY (`reactif_id`),
  KEY `tbl_centre` (`id_centre`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reactif`
--

INSERT INTO `tbl_reactif` (`reactif_id`, `reactif_nom`, `description`, `stock`, `id_centre`) VALUES
(2, 'CYPRESS', '', 99, 1),
(3, 'GSRH', 'CROMATEST', 95, 1),
(4, 'CALCIUM', 'BIOLABO', 98, 1),
(5, 'MAGNESIUM', 'BIOLABO', 84, 1),
(6, 'CREATININE', 'BIOLABO', 98, 1),
(7, 'PROTEINE TOTAL', 'BIOLABO', 100, 1),
(8, 'BILIRUBINE', 'BIOLABO', 100, 1),
(9, 'CHOLESTEROL TOTAL', 'BIOLABO', 100, 1),
(10, 'CHOLESTEROL HDL', 'BIOLABO', 100, 1),
(11, 'TPHA', 'BIOLABO', 100, 1),
(12, 'VDRL', 'BIOLABO', 100, 1),
(13, 'GIEMSA', '', 100, 1),
(14, 'GLYCEMIE', 'BIOLABO', 100, 1),
(15, 'UREE', 'BIOLABO', 100, 1),
(16, 'IONNOGRAMME', '', 100, 1),
(17, 'DILUENT ET LYSE', 'COULTER MEDONIC', 100, 1),
(18, 'LAME', '', 100, 1),
(19, 'TUBES EDTA', '', 100, 1),
(20, 'TUBES SEC AVEC GEL', '', 98, 1),
(21, 'TUBES GLYCEMIE', '', 100, 1),
(22, 'TUBES TP TCK', '', 98, 1),
(23, 'TUBBES  A HEMOLYSE 3.5ML', '', 98, 1),
(24, 'DIASPOT', '', 100, 1),
(25, 'CONES JAUNE', '', 100, 1),
(26, 'CONES BLEU', '', 100, 0),
(27, 'AIGUILLES VACUTAINER', '', 100, 0),
(28, 'LANCETTES', '', 100, 0),
(29, 'COTON', '', 100, 0),
(30, 'GANTS', '', 100, 0),
(31, 'MEDONIC', 'Lyse, diluant', 100, 0),
(32, 'BIOLABO', '', 100, 0),
(33, 'CROMATEST', '', 100, 0),
(34, 'CALIBRATING ', '', 100, 0),
(35, 'RT 7200', '', 100, 0),
(36, 'DIALAB', '', 100, 0),
(37, 'MICROPOINTE', '', 100, 0),
(38, 'NEANT', '', 100, 0),
(39, 'TAMPON', '', 100, 0),
(40, 'EAU PHYSIOLOGIQUE, LUGOL', '', 100, 0),
(41, 'NEANT', '', 100, 0),
(42, '-', '', 100, 0),
(43, '-', '', 100, 0),
(44, 'COULTER MEDONIC', '', 100, 0),
(45, 'UROCOLOR 10', '', 100, 0),
(46, 'IMMUNO COMB', '', 100, 0),
(47, 'DETERMINE HIV1,2', '', 100, 0),
(48, 'BANDELETTE', '', 100, 0),
(49, 'AUCUN ', '', 100, 0),
(50, 'LZARUS', '', 100, 0),
(51, 'LAZARUS', '', 100, 0),
(52, 'TRANSA', 'BIOLABO', 100, 0),
(53, 'SDW', 'SPINREACT', 100, 0),
(54, 'CRP', 'BIOLABO', 100, 0),
(55, 'ASLO ', 'BIOLABO', 100, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reactif_used`
--

DROP TABLE IF EXISTS `tbl_reactif_used`;
CREATE TABLE IF NOT EXISTS `tbl_reactif_used` (
  `id_reactif_used` int NOT NULL AUTO_INCREMENT,
  `reactif_id` int NOT NULL,
  `id_analyse` int NOT NULL,
  `qty` int NOT NULL,
  `user_id` int NOT NULL,
  `id_centre` int NOT NULL,
  `date_used` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_reactif_used`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reactif_used`
--

INSERT INTO `tbl_reactif_used` (`id_reactif_used`, `reactif_id`, `id_analyse`, `qty`, `user_id`, `id_centre`, `date_used`) VALUES
(1, 20, 3, 2, 5, 1, '2024-12-07 17:06:48'),
(2, 23, 3, 2, 5, 1, '2024-12-07 17:06:32'),
(3, 3, 3, 4, 5, 1, '2024-12-07 17:06:20'),
(4, 5, 3, 1, 5, 1, '2024-12-08 12:29:51'),
(5, 5, 2, 2, 5, 1, '2025-02-09 23:20:45'),
(6, 22, 3, 2, 5, 1, '2025-02-12 06:48:02'),
(7, 2, 3, 1, 5, 1, '2025-02-16 22:35:45'),
(8, 4, 13, 1, 5, 1, '2025-03-13 13:19:45'),
(9, 5, 13, 5, 5, 1, '2025-03-13 13:20:00'),
(10, 5, 13, 5, 5, 1, '2025-03-13 14:01:49'),
(11, 3, 3, 1, 5, 1, '2025-03-19 16:59:27'),
(12, 5, 13, 1, 5, 1, '2025-04-04 05:23:05');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_receipt`
--

DROP TABLE IF EXISTS `tbl_receipt`;
CREATE TABLE IF NOT EXISTS `tbl_receipt` (
  `receipt_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `uid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `qr_code` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `code_me_ce_fdgi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `counters` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nim` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_centre` int NOT NULL,
  PRIMARY KEY (`receipt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`receipt_id`, `user_id`, `order_id`, `uid`, `qr_code`, `code_me_ce_fdgi`, `counters`, `nim`, `date_time`, `id_centre`) VALUES
(1, 4, 1, '47b70773-4ff7-4a2b-8014-0c4229d79c01', 'F;TS01010713;TESTA2UUWCFCEYKYG7JVC6Z7;0202112281722;20240914212609', 'TEST-A2UU-WCFC-EYKY-G7JV-C6Z7', '49/50 FV', 'TS01010713', '2024-09-14 20:26:09', 0),
(2, 4, 2, '2ff4cb77-2e5d-4344-9c91-77cc3607f8a9', 'F;TS01010713;TESTSPS7BQXW6UX5QLYUWO5S;0202112281722;20241002123832', 'TEST-SPS7-BQXW-6UX5-QLYU-WO5S', '50/51 FV', 'TS01010713', '2024-10-02 11:38:31', 0),
(3, 4, 5, '361667dd-f5b1-4c7c-ac62-d2fb10a0a045', 'F;TS01010713;TESTR23W4LDFFZNUAKEEVI6K;0202112281722;20241008172217', 'TEST-R23W-4LDF-FZNU-AKEE-VI6K', '53/54 FV', 'TS01010713', '2024-10-08 16:22:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resultats_analyse`
--

DROP TABLE IF EXISTS `tbl_resultats_analyse`;
CREATE TABLE IF NOT EXISTS `tbl_resultats_analyse` (
  `id_resultat` bigint NOT NULL AUTO_INCREMENT,
  `id_demande` bigint NOT NULL,
  `prestation_id` bigint NOT NULL,
  `resultat` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `personnel_id` int NOT NULL,
  `user_role_id` int NOT NULL,
  `centre_id` int NOT NULL,
  `date_resultat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `observation` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_resultat`),
  KEY `tbl_demand_ext` (`id_demande`),
  KEY `tbl_prestation` (`prestation_id`),
  KEY `personnel` (`personnel_id`),
  KEY `user_roles` (`user_role_id`),
  KEY `tbl_centre` (`centre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resultats_analyse`
--

INSERT INTO `tbl_resultats_analyse` (`id_resultat`, `id_demande`, `prestation_id`, `resultat`, `path`, `personnel_id`, `user_role_id`, `centre_id`, `date_resultat`, `updated_at`, `content`, `observation`) VALUES
(1, 48, 6, 'TEST POSITIF', 'Resultat_1743618837_.pdf', 5, 4, 1, '2025-04-02 18:33:57', '2025-04-02 18:33:57', '[]', 'TEST'),
(2, 49, 236, NULL, 'Resultat_1743621063_.pdf', 5, 4, 1, '2025-04-02 19:11:03', '2025-04-02 19:11:03', '[{\"element\":\"El\\u00e9ment\",\"result\":\"test\",\"norme\":\"testtest3\"}]', NULL),
(3, 49, 236, NULL, 'Resultat_1743621083_.pdf', 5, 4, 1, '2025-04-02 19:11:23', '2025-04-02 19:11:23', '[{\"element\":\"El\\u00e9ment\",\"result\":\"test\",\"norme\":\"testtest3\"}]', NULL),
(4, 49, 236, NULL, 'Resultat_1743621140_.pdf', 5, 4, 1, '2025-04-02 19:12:20', '2025-04-02 19:12:20', '[{\"element\":\"El\\u00e9ment\",\"result\":\"test\",\"norme\":\"testtest3\"}]', NULL),
(5, 49, 236, NULL, 'Resultat_1743621734_.pdf', 5, 4, 1, '2025-04-02 19:22:14', '2025-04-02 19:22:14', '[{\"element\":\"El\\u00e9ment\",\"result\":\"TEST\",\"norme\":\"testtest3\"}]', NULL),
(6, 49, 236, NULL, 'Resultat_1743621751_.pdf', 5, 4, 1, '2025-04-02 19:22:31', '2025-04-02 19:22:31', '[{\"element\":\"El\\u00e9ment\",\"result\":\"TEST\",\"norme\":\"testtest3\"}]', NULL),
(7, 49, 236, NULL, 'Resultat_1743742669_.pdf', 5, 4, 1, '2025-04-04 04:57:51', '2025-04-04 04:57:51', '[{\"element\":\"El\\u00e9ment\",\"result\":\"555\",\"norme\":\"testtest3\"}]', NULL),
(8, 51, 107, 'TEST POSITIF', 'Resultat_1743743417_.pdf', 5, 4, 1, '2025-04-04 05:10:17', '2025-04-04 05:10:17', '[]', 'néanti'),
(9, 52, 106, 'TEST NEGATIVE', 'Resultat_1743743460_.pdf', 5, 4, 1, '2025-04-04 05:11:00', '2025-04-04 05:11:00', '[]', 'kkkk'),
(10, 34, 236, NULL, 'Resultat_1743744624_.pdf', 5, 4, 1, '2025-04-04 05:30:24', '2025-04-04 05:30:24', '[{\"element\":\"El\\u00e9ment\",\"result\":\"n\\u00e9ant\",\"norme\":\"testtest3\"}]', NULL),
(11, 41, 236, NULL, 'Resultat_1743779828_.pdf', 5, 4, 1, '2025-04-04 15:17:08', '2025-04-04 15:17:08', '[{\"element\":\"El\\u00e9ment\",\"result\":\"Test de r\\u00e9sulta\",\"norme\":\"testtest3\"}]', NULL),
(12, 65, 159, 'TEST NEGATIVE', 'non défini', 5, 4, 1, '2025-04-08 17:11:23', '2025-04-08 17:11:23', '[]', 'Résultat d\'analyse PSA'),
(13, 63, 216, 'TEST NEGATIVE', 'non défini', 5, 4, 1, '2025-04-08 17:11:41', '2025-04-08 17:11:41', '[]', 'Résultat d\'analyse HIV'),
(14, 58, 233, 'TEST POSITIF', 'non défini', 5, 4, 1, '2025-04-08 17:11:54', '2025-04-08 17:11:54', '[]', 'EGD'),
(15, 62, 221, 'TEST POSITIF', 'non défini', 5, 4, 1, '2025-04-08 17:12:21', '2025-04-08 17:12:21', '[]', 'Oh lala'),
(16, 60, 235, 'TEST POSITIF', 'non défini', 5, 4, 1, '2025-04-08 17:12:30', '2025-04-08 17:12:30', '[]', 'Résultat'),
(17, 59, 234, 'TEST POSITIF', 'non défini', 5, 4, 1, '2025-04-08 17:12:36', '2025-04-08 17:12:36', '[]', 'TETE'),
(18, 61, 220, 'TEST NEGATIVE', 'non défini', 5, 4, 1, '2025-04-08 17:12:57', '2025-04-08 17:12:57', '[]', 'iefiefe'),
(19, 64, 165, 'TEST POSITIF', 'non défini', 5, 4, 1, '2025-04-08 17:13:03', '2025-04-08 17:13:03', '[]', 'iiefe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_srayon`
--

DROP TABLE IF EXISTS `tbl_srayon`;
CREATE TABLE IF NOT EXISTS `tbl_srayon` (
  `srayon_id` int NOT NULL AUTO_INCREMENT,
  `rayon_id` int NOT NULL,
  `srayon_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `srayon_description` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `publication_statu` int DEFAULT '1',
  `id_centre` int DEFAULT NULL,
  PRIMARY KEY (`srayon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_srayon`
--

INSERT INTO `tbl_srayon` (`srayon_id`, `rayon_id`, `srayon_name`, `srayon_description`, `publication_statu`, `id_centre`) VALUES
(1, 1, 'Ballonnement', 'Ballonnement', 1, NULL),
(2, 1, 'Brûlures d\'estomac', 'Brûlures d\'estomac', 1, NULL),
(3, 1, 'Diarrhée', 'Diarrhée', 1, NULL),
(4, 1, 'Nausées, vomissements', 'Nausées, vomissements', 1, NULL),
(5, 7, 'Articulations, muscles', 'Articulations, muscles', 1, NULL),
(6, 8, 'Gel Douche', 'Gel Douche', 1, NULL),
(7, 9, 'Accessoires de bébé', 'Accessoires de bébé', 1, NULL),
(8, 10, 'Soins de grossesse', 'Soins de grossesse', 1, NULL),
(9, 8, 'Pommades', 'Pommades', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type_analyse`
--

DROP TABLE IF EXISTS `tbl_type_analyse`;
CREATE TABLE IF NOT EXISTS `tbl_type_analyse` (
  `id_type_analyse` bigint NOT NULL AUTO_INCREMENT,
  `libelle_analyse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prix_analyse` int NOT NULL,
  `prix_analyse_assure` int NOT NULL,
  `service` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `category` enum('HEMATOLOGIE','PARASITOLOGIE','SEROLOGIE','BIOCHIMIE','IMMUNOLOGIE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `centre_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_type_analyse`),
  KEY `tbl_centre` (`centre_id`)
) ENGINE=MyISAM AUTO_INCREMENT=245 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type_analyse`
--

INSERT INTO `tbl_type_analyse` (`id_type_analyse`, `libelle_analyse`, `prix_analyse`, `prix_analyse_assure`, `service`, `category`, `centre_id`, `created_at`, `updated_at`) VALUES
(1, 'Ablation sonde urinaire ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Accouchement dirigé par sage fem', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Accouchement-Encadré par Gynéco', 30, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Accouchement-Gynécologue ', 50, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'ACCOUChement sage femme', 16, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'ACIDE  URIQUE ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Acte cerclage ', 80, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Acte Médecine générale ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 'Activités thérapeutiques ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'AKOP (Amibe Kyste Oeuf Parasite)', 500, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 'AMIU Gynécologue ', 35, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 'AMIU sage femme ', 30, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 'Anesthésie locale ', 100, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 'Anesthésie Médecin ', 30, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 'ANESTHESIE MEDECIN REANIMATEUR ', 50, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 'AntigèneHbs(AgHBs)', 4, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 'Appendicectomie', 180, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 'ASLO ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 'Aspiration auriculaire par oreil', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 'Aspiration nouveau-né ', 1, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 'Atelle ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'Avis gynécologique/48h ', 4, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, ' Bandage Elastique', 15, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'Bandelette urinaire ', 500, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'Biopsie du col ', 25, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'BLOC OPERATOIRE CAMP CHIRUGICAL ', 70, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'Calcémie ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'Carnet CPN  ', 300, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'CARNET DE SOIN  ', 100, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 'Carte infantile fille ', 500, 0, 'VACCINATION ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 'Certificat de coups et blessure ', 15, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'Certificat de décès ', 5, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'Certificat de dispense de sport ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'Certificat de visite contre visi', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 'Certificat de voyage sur grosses', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 'Certificat Médical de repos', 1, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'Certificat pour permis de condui', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'Certificat Prénuptial ', 10, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'Césarienne (A.I.A)', 180, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'Cholestérol HDL', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'Cholestérol total ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 'Circoncision ', 35, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 'CIRCONCISION ff', 60, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'Confection d\'un anneau de FANTON', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 'Confection plâtre ', 15, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 'Consultation anesthésique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'Consultation Cardio+ECG', 15, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'Consultation cardiologique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'Consultation chirurgicale ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'Consultation Chirurgie Pédiatriq', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'Consultation dermatologique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'Consultation gynécologique', 8, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'Consultation gynécologique perso', 15, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'Consultation Médecine Générale ', 1, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'Consultation Médicale Dr ODJO', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'Consultation Neurologique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'Consultation ORL    ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'Consultation Pédiatrique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'Consultation Rhumatologique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'Consultation Traumatologique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'Consultation Urologique ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'CONSULTATION VOYAGE', 1, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'Contrôle tension artérielle ', 300, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'Coup de sonde ', 3, 0, 'ECHOGHRAPHIE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'CPN (1ere consultation)', 2, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'CPN (suivi)', 1, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 'CPON', 1, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 'Créatininémie ', 2, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 'CRP (C-Réactive Protéine)', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 'Cystotomie ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 'Decerclage ', 25, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 'Déclenchement (travail d\'accouch', 5, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 'Dossier Médical ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 'DOUBLE MISE EN OBSERVATION VIP', 10, 0, 'HOSPITALISATION', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 'DUPLICATA FICHE DE NAISSANCE', 5, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 'ECBU', 10, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 'ECG ', 8, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 'Echo doppler Veineuse ', 30, 0, 'ECHOGHRAPHIE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 'Echographie abdominale ', 15, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 'Echographie abdominopelvienne ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 'ECHOGRAPHIE ENDOVAGINALE/ T', 7, 0, 'ECHOGHRAPHIE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 'Echographie mammaire ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 'Echographie Partie molle ', 20, 0, 'ECHOGHRAPHIE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 'Echographie pelvienne endovagina', 10, 0, 'ECHOGHRAPHIE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 'Echographie pelvienne gynécologu', 7, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 'Echographie rénale ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 'Echographie testiculaire ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 'Echographie thyroïdienne ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 'Echographie vésico-prostatique ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 'Écho. obstétricale/pelvienne Tec', 6, 0, 'ECHOGHRAPHIE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 'Electrophorèse de l’hémoglobine ', 5, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 'Enregistrement RCF ', 2, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 'Episiotomie + suture ', 5, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 'Expulsion de produit de concepti', 12, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'Extraction corps étranger ORL ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'Forfait bloc ', 70, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'Forfait bloc DIRECT-AID ', 50, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'FORFAIT CIRCONCISION', 90, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 'FORFAIT GANTS ', 2, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 'Forfait isoflurane (pour 2 heure', 10, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 'FORFAIT NODULECTOMIE', 20, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'Forfait PLATRE ', 45, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 'Forfait plâtre Dr AHONONGA', 90, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 'Frénectomie ', 10, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 'GEDP (Goutte épaisse)', 1, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 'Glycémie à jeun ', 1, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 'Glycémie capillaire     ', 500, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 'GsRh (Groupage sanguin rhésus)', 2, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 'Hémoglobine Glyqué', 12, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 'Hospi. journalière urgences', 5, 0, 'HOSPITALISATION', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 'Hospitalisation journalière simp', 3, 0, 'HOSPITALISATION', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 'Hospitalisation journalière VIP', 15, 0, 'HOSPITALISATION', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 'Hospitalisation salle de réveil ', 10, 0, 'HOSPITALISATION', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 'HSG (Hystérosalpingographie) + p', 27, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 'Imagerie ', 18, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 'Infiltration du génou ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 'Injection intramusculaire ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 'Injection intraveineuse ', 300, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 'Injection sous-cutanée', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 'Injection VAT ', 200, 0, 'VACCINATION ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 'Ionogramme sanguin ', 5, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 'K acte spécialisé ', 1, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 'Laboratoire ', 125, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 'Lavage auriculaire par oreille ', 2, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 'Lavage oculaire  ', 300, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 'Lavage rhinopharyngé (nasal) par', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 'Lavement baryté ', 25, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 'Magnesémie', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 'Mise en observation horaire aux ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 'Mise en observation VIP ', 5, 0, 'HOSPITALISATION', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 'Monitoring horaire ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 'Monitoring RCF horaire', 500, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 'Mté Déclenchement travail d\'acco', 10, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 'Myomectomie ', 200, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 'NB (Numération des blancs)', 1, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 'Nébulisation par séance       ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 'Nécrosectomie', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 'NFS', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 'NFS + Plaquettes ', 5, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 'Nodulectomie ', 60, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 'Oxygénothérapie horaire    ', 1, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 'Pansement par séance ', 800, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 'Pansement Quotidien (forfait)', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 'Pansement quotidien (forfait+ GA', 700, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 'PERITONITE AIGUE', 250, 0, 'BLOC OPERATOIRE ', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 'PF LAFIA INJECTABLE', 1, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 'PGS', 200, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 'Ponction articulaire ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 'Pose cathéter pour patient exter', 1, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 'Pose de platre ', 20, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 'Pose de sonde urinaire ', 1, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 'Pose DIU ', 1, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 'Pose DIU Gynécologue ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 'Pose et surveillance de perfusio', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 'Pose jadelle ', 1, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 'Pose jadelle gynécologue ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 'Prise de poids ', 200, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 'Produits pharmaceutiques ', 80, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 'PSA ', 15, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 'Rapport médical ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 'Retrait DIU Gynécologue', 8, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 'Retrait jadelle  ', 2, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 'Retrait jadelle Gynécologue ', 8, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 'Révision utérine ', 2, 0, 'MATERNITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 'RUBEOLE', 15, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 'Rx ASP (Abdomen Sans Préparation', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 'Rx Avant-bras face/profil ', 9, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 'Rx Bassin de face ', 9, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 'Rx Bassin face + 2 obliques ', 18, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 'Rx Bassin face + hanche profil ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 'Rx Bras face/profil ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 'Rx Calcanéus face/profil ', 9, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 'Rx Cheville face/profil', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 'Rx Clavicule face', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 'Rx Coccyx face/profil', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 'Rx Coude face/profil', 15, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 'Rx Crâne face/profil', 13, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 'Rx Doigt face/profil', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 'Rx Epaule face/profil', 13, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 'Rx Epaule f/p+rotation intern et', 15, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 'Rx Fémur face/profil ', 12, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 'Rx Genou face/profil  ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 'Rx Genou f/p + ¾ ', 12, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 'Rx Grill costal face + oblique ', 15, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 'Rx Grill costal (thorax osseux) ', 13, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 'Rx Hanche face/profil ', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 'Rx Hirtz (crâne)', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 'Rx Jambe face/profil ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 'Rx Main face/profil', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 'Rx Main f/p + oblique', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 'Rx Mastoïde ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 'Rx Maxillaire défilé deux côtés ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 'Rx Maxillaire défilé un côté  ', 9, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 'Rx Membre inferieur avec mesure ', 22, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 'Rx Orteil face/profil ', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 'Rx Os propres du nez', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 'Rx Patella face/profil ', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 'Rx Pied face/profil', 8, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 'Rx Pied f/p + ¾ ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 'Rx Poignet face/profil', 9, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 'Rx Pulmonaire face', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 'Rx Pulmonaire face/profil ', 14, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 'Rx pulmonaire voyageur (forfait)', 6, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 'Rx Rachis cervical face/profil', 13, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 'Rx Rachis cervical f/p + ¾ ', 18, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 'Rx Rachis dorsal face/profil  ', 15, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 'Rx Rachis lombaire face/profil', 15, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 'Rx Rachis lombaire f/p + ¾ ', 25, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 'Rx Rachis lombosacré face/profil', 15, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 'Rx Scapula face/profil', 9, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 'Rx Sinus Blondeau', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 'Rx Sternum face/profil', 13, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 'SDW (Séro Diagnostic de Widal)', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 'Séance de kinésithérapie ', 5, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 'SEROLOGIE HCV EXT', 14, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 'Sérologie HIV     ', 2, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 'Sérologie HVC      ', 14, 0, 'SPECIALITE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 'Suture par unité de point   ', 500, 0, 'MEDECINE GENERALE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 'Taux d’hémoglobine (Tx d’Hb)', 1, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 'TBG Sérique   ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 'TBG Urinaire     ', 1, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 'TCK', 5, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 'Télécœur ', 10, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 'TOGD (Transit oesogastroduodénal', 25, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 'TOXOPLASMOSE', 15, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 'TPHA   ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 'TP (Temps de prothrombine)', 5, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 'Transaminases ALAT (TGP)+ASAT(TG', 5, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 'Triglycérides ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 'UCR (Urétrocystographieretrograd', 25, 0, 'RADIO', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 'Urée', 1, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 'VDRL ', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 'VITAMINE D', 15, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 'VS (Vitesse de sédimentation)', 3, 0, 'LABORATOIRE', NULL, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 'TEtt', 666, 666, NULL, NULL, 1, '2024-12-18 12:57:22', '2024-12-18 12:57:22'),
(236, 'NFS TEST', 1200, 100, 'LABORATOIRE', 'HEMATOLOGIE', 1, '2025-03-27 22:33:58', '2025-03-27 21:30:56'),
(237, 'NFS TEST', 1200, 100, NULL, 'HEMATOLOGIE', 1, '2025-03-28 13:47:29', '2025-03-28 13:47:29'),
(238, 'NFS TEST', 1200, 100, NULL, 'HEMATOLOGIE', 1, '2025-03-28 13:48:30', '2025-03-28 13:48:30'),
(239, 'NFS TEST', 1200, 100, NULL, 'HEMATOLOGIE', 1, '2025-03-28 13:49:04', '2025-03-28 13:49:04'),
(240, 'NFS TEST', 1200, 100, NULL, 'HEMATOLOGIE', 1, '2025-03-28 13:52:54', '2025-03-28 13:52:54'),
(241, 'NFS TEST', 1200, 100, NULL, 'HEMATOLOGIE', 1, '2025-03-28 13:53:31', '2025-03-28 13:53:31'),
(242, 'NFS TEST', 1200, 100, NULL, 'HEMATOLOGIE', 1, '2025-03-28 13:53:45', '2025-03-28 13:53:45'),
(243, 'NFS TEST', 1200, 100, NULL, 'HEMATOLOGIE', 1, '2025-03-28 13:54:15', '2025-03-28 13:54:15'),
(244, 'SFN', 50000, 0, NULL, 'HEMATOLOGIE', 1, '2025-04-04 03:06:56', '2025-04-04 03:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_role_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_centre` int NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `tbl_centre` (`id_centre`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_role_id`, `email`, `id_centre`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '0', 'acceuil@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-08-31 09:06:30', '2024-08-31 09:06:30'),
(2, '1', 'caisse@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-01 16:47:18', '2024-09-01 16:47:18'),
(3, '7', 'chirurgie@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-04 08:06:27', '2024-09-04 08:06:27'),
(4, '9', 'pharmacie@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-11 06:02:28', '2024-09-11 06:02:28'),
(5, '4', 'labo@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-12 06:54:24', '2024-09-12 06:54:24'),
(6, '10', 'admin@admin', 1, NULL, '4eef1e1ea34879a2ae60c60815927ed9', NULL, '2024-11-04 06:26:45', '2024-11-04 06:26:45'),
(9, '3', 'sage@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-12-05 14:14:51', '2024-12-05 14:14:51'),
(8, '2', 'gene@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-12-05 14:10:46', '2024-12-05 14:10:46'),
(10, '11', 'medecinchef@gmail.com', 0, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-12-18 14:14:54', '2024-12-18 14:14:54'),
(11, '35', 'inf@gmail.com', 1, NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2025-03-30 02:37:06', '2025-03-30 02:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sup_code` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sup_code_id` int NOT NULL,
  `is_consult` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `designation`, `title`, `sup_code`, `sup_code_id`, `is_consult`, `created_at`, `updated_at`) VALUES
(0, 'Accueil', 'Accueil de la Clinique', '', 0, 0, '2022-08-02 17:46:08', '2022-08-02 10:00:13'),
(1, 'Caisse', 'Caissière', 'DG', 0, 0, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(2, 'Médecine générale', 'Médecin généraliste', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(3, 'Maternité', 'Sage-Femme', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(4, 'Laboratoire', 'Laborantin', 'DG', 0, 2, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(5, 'Echographie', 'Echographie', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(6, 'Radiologie', 'Radiologue', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(7, 'Bloc opératoire', 'Chirurgien', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(8, 'Vaccination', 'Vaccination', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(9, 'Phamarcie', 'Phamarcienne', 'DG', 0, 0, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(10, 'Admin', 'Admin', 'ADMIN', 0, 0, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(11, 'Medecin Chef', 'Medecin Chef', 'Chef', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(35, 'Infirmerie', 'Infirmier', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
