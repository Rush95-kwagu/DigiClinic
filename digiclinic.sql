-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 03 oct. 2024 à 06:34
-- Version du serveur : 8.0.27
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `digiclinic`
--

-- --------------------------------------------------------

--
-- Structure de la table `admins`
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE IF NOT EXISTS `admins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departement`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departement_generales`
--

DROP TABLE IF EXISTS `departement_generales`;
CREATE TABLE IF NOT EXISTS `departement_generales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_depart` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `medecin_id` bigint UNSIGNED DEFAULT NULL,
  `chef_departement_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departement_generales_medecin_id_foreign` (`medecin_id`),
  KEY `departement_generales_chef_departement_id_foreign` (`chef_departement_id`),
  KEY `departement_generales_service_id_foreign` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `departement_speciales`
--

DROP TABLE IF EXISTS `departement_speciales`;
CREATE TABLE IF NOT EXISTS `departement_speciales` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_depart` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `doctors_id` bigint UNSIGNED DEFAULT NULL,
  `chef_departement_id` bigint UNSIGNED DEFAULT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departement_speciales_doctors_id_foreign` (`doctors_id`),
  KEY `departement_speciales_chef_departement_id_foreign` (`chef_departement_id`),
  KEY `departement_speciales_service_id_foreign` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `medecins`
--

DROP TABLE IF EXISTS `medecins`;
CREATE TABLE IF NOT EXISTS `medecins` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `specialite` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `diplome` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `annee_experience` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `personnel_id` bigint UNSIGNED DEFAULT NULL,
  `departement_id` bigint UNSIGNED DEFAULT NULL,
  `patient_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medecins_personnel_id_foreign` (`personnel_id`),
  KEY `medecins_departement_id_foreign` (`departement_id`),
  KEY `medecins_patient_id_foreign` (`patient_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
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
-- Structure de la table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personnel`
--

DROP TABLE IF EXISTS `personnel`;
CREATE TABLE IF NOT EXISTS `personnel` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `qualification` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialite` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` date NOT NULL,
  `departement` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `ville` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_id` bigint UNSIGNED DEFAULT NULL,
  `departement_id` bigint UNSIGNED DEFAULT NULL,
  `photo` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personnels_email_unique` (`email`),
  KEY `personnels_service_id_foreign` (`service_id`),
  KEY `personnels_departement_id_foreign` (`departement_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personnel`
--

INSERT INTO `personnel` (`id`, `nom`, `prenom`, `sexe`, `qualification`, `specialite`, `birthdate`, `departement`, `ville`, `telephone`, `adresse`, `email`, `service_id`, `departement_id`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Jones', 'John', 'M', 'Inf', 'Infirmier', '2024-08-31', 'Dentiste', 'Cotonou', '96868950', 'Zokpa', 'johnjones@gmail.com', 1, 1, '', NULL, NULL),
(2, 'TIANDO', 'Herman', 'M', 'Inf', 'Infirmier', '2024-08-31', 'Dentiste', 'Cotonou', '96868950', 'Zokpa', 'tiandorman@gmail.com', 1, 1, '', NULL, NULL),
(3, 'FOX', 'Jenner', 'F', 'Dr', 'Chirugien', '2024-08-31', 'Dentiste', 'Cotonou', '96868950', 'Zokpa', 'foxjenner@gmail.com', 1, 1, '', NULL, NULL),
(4, 'COLE', 'Jenner', 'F', 'Dr', 'Caissière', '2024-08-31', 'Pharmacie', 'Cotonou', '96868950', 'Zokpa', 'pharmacie@gmail.com', 1, 1, '', NULL, NULL),
(5, 'KILMER', 'Thuram', 'M', 'Dr', 'Laborantin', '2024-08-31', 'Labo', 'Cotonou', '96868950', 'Zokpa', 'labo@gmail.com', 1, 1, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `code_serve` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `libelle` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialite` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `telephone` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `room_number` int NOT NULL,
  `status` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `chief_service_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `services_code_serve_unique` (`code_serve`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `services`
--

INSERT INTO `services` (`id`, `code_serve`, `libelle`, `specialite`, `email`, `telephone`, `room_number`, `status`, `chief_service_id`, `created_at`, `updated_at`) VALUES
(1, 'test', 'test', 'Specialité Médicale', 'tiandorman@gmail.com', '98965658', 12, 'Fonctionnel', 1, '2024-08-30 18:56:12', '2024-08-30 18:56:12');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_analyse`
--

DROP TABLE IF EXISTS `tbl_analyse`;
CREATE TABLE IF NOT EXISTS `tbl_analyse` (
  `id_analyse` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `id_type_analyse` int DEFAULT NULL,
  `analyse` varchar(500) DEFAULT NULL,
  `prix` int DEFAULT NULL,
  `prix_manuel` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `statut_analyse` int NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_analyse`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_analyse`
--

INSERT INTO `tbl_analyse` (`id_analyse`, `patient_id`, `id_type_analyse`, `analyse`, `prix`, `prix_manuel`, `user_id`, `statut_analyse`, `created_at`) VALUES
(1, 1, 13, NULL, 7000, NULL, 5, 0, '2024-10-02 14:10:59');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_approvisionnement`
--

DROP TABLE IF EXISTS `tbl_approvisionnement`;
CREATE TABLE IF NOT EXISTS `tbl_approvisionnement` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `stock` int NOT NULL,
  `stock_defective` int NOT NULL,
  `comments` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `received_products_product_id_foreign` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_approvisionnement`
--

INSERT INTO `tbl_approvisionnement` (`id`, `admin_id`, `product_id`, `stock`, `stock_defective`, `comments`, `created_at`, `updated_at`) VALUES
(1, 0, 1, 3, 1, NULL, NULL, NULL),
(2, 0, 2, 10, 1, NULL, NULL, NULL),
(3, 0, 3, 12, 0, NULL, NULL, NULL),
(4, 0, 4, 8, 1, NULL, NULL, NULL),
(5, 0, 5, 9, 4, NULL, NULL, NULL),
(6, 0, 6, 16, 5, NULL, NULL, NULL),
(7, 0, 7, 12, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_caisse_prise_en_charge`
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
  PRIMARY KEY (`id_caisse_prise_en_charge`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_caisse_prise_en_charge`
--

INSERT INTO `tbl_caisse_prise_en_charge` (`id_caisse_prise_en_charge`, `id_prise_en_charge`, `user_id`, `user_role_id`, `frais_consultation`, `frais_hospitalisation`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 2500, NULL, '2024-09-01 16:31:43', '2024-09-01 16:31:43'),
(2, 2, NULL, NULL, NULL, NULL, '2024-09-01 16:36:21', '2024-09-01 16:36:21'),
(3, 3, NULL, NULL, NULL, NULL, '2024-09-01 16:48:24', '2024-09-01 16:48:24'),
(4, 4, NULL, NULL, NULL, NULL, '2024-09-01 17:13:33', '2024-09-01 17:13:33'),
(5, 5, 2, 1, 2500, NULL, '2024-09-01 17:28:54', '2024-09-01 17:28:54'),
(6, 6, 2, 1, 10000, NULL, '2024-09-01 18:53:39', '2024-09-01 18:53:39'),
(7, 7, 2, 1, 10000, NULL, '2024-09-01 18:55:11', '2024-09-01 18:55:11'),
(8, 8, NULL, NULL, NULL, NULL, '2024-09-22 12:32:54', '2024-09-22 12:32:54');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_category`
--

DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` int DEFAULT '1',
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `category_description`, `publication_status`, `updated_at`) VALUES
(1, 'Médicaments', 'Médicaments', 1, NULL),
(2, 'Compléments Alimentaires', 'Compléments Alimentaires', 1, NULL),
(3, 'Beauté et Soins', 'Beauté et Soins', 1, NULL),
(4, 'Hygiène et Bien-être', 'Hygiène et Bien-être', 1, NULL),
(5, 'Médecine douce et Santé', 'Médecine douce et Santé', 1, NULL),
(6, 'Grossesse et Bébé', 'Grossesse et Bébé', NULL, NULL),
(7, 'Vétérinaire', 'Vétérinaire', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_chambre`
--

DROP TABLE IF EXISTS `tbl_chambre`;
CREATE TABLE IF NOT EXISTS `tbl_chambre` (
  `id_chambre` int NOT NULL AUTO_INCREMENT,
  `libelle_chambre` varchar(255) NOT NULL,
  `etat_chambre` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_chambre`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_chambre`
--

INSERT INTO `tbl_chambre` (`id_chambre`, `libelle_chambre`, `etat_chambre`) VALUES
(1, '1', 1),
(2, '2', 1),
(3, '3', 1),
(4, '4', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_consultation`
--

DROP TABLE IF EXISTS `tbl_consultation`;
CREATE TABLE IF NOT EXISTS `tbl_consultation` (
  `id_consultation` int NOT NULL AUTO_INCREMENT,
  `id_prise_en_charge` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `user_role_id` int DEFAULT NULL,
  `diagnostic` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `new_temp` int DEFAULT NULL,
  `observation` varchar(500) DEFAULT NULL,
  `is_hospitalisation` int NOT NULL DEFAULT '0',
  `id_lit` int DEFAULT NULL,
  `fichier_joint` text,
  `etat_traitement` int NOT NULL DEFAULT '0',
  `conslt_created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `conslt_updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_consultation`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_consultation`
--

INSERT INTO `tbl_consultation` (`id_consultation`, `id_prise_en_charge`, `user_id`, `user_role_id`, `diagnostic`, `new_temp`, `observation`, `is_hospitalisation`, `id_lit`, `fichier_joint`, `etat_traitement`, `conslt_created_at`, `conslt_updated_at`) VALUES
(1, 1, 3, 7, '<p>Il s\'agit potentiellement d\'un début de palu</p>', NULL, 'Analyses médicales requises', 0, NULL, 'Uploads/consultations/EXPOSE HIST-GEO.pdf', 1, '2024-09-05 14:43:46', '2024-09-05 14:43:46'),
(2, 7, 3, 7, 'Il s\'agit potentiellement d\'un apindice', NULL, 'Faire une écho', 0, NULL, NULL, 1, '2024-09-13 14:12:37', '2024-09-13 14:12:37'),
(3, 1, 5, 4, '<p>Analyses effectuées indiquant un fort taux de bactéries paludéens</p>', NULL, 'Prescrire une ordonnance en conséquence', 0, NULL, 'Uploads/consultations/LM BOURSE D\'etude.pdf', 1, '2024-09-13 15:29:32', '2024-09-13 15:29:32'),
(4, 1, 3, 7, 'Le patient souffrait en effet du palu.\r\nUne ordonnance lui sera délivré en conséquence.\r\nOrdonnance Médicale', NULL, NULL, 0, NULL, NULL, 1, '2024-09-13 15:56:52', '2024-09-13 15:56:52'),
(5, 5, 3, 7, 'Fracture fermée', NULL, 'Mettre en observation avec platre', 1, 1, NULL, 1, '2024-09-14 19:52:48', '2024-09-14 19:52:48'),
(6, 7, 5, 4, 'Echo réalisé confirmant l\'apindice', NULL, 'Opération d\'urgence requise', 0, NULL, 'Uploads/consultations/1ere Session AOUT 2024 Liste des candidats admis31_08_2024 13_15_22_62.pdf', 1, '2024-09-14 20:02:41', '2024-09-14 20:02:41'),
(7, 7, 3, 7, 'Opération réalisé avec succès. Une ordonnance sera de mise pour la convalescence', NULL, NULL, 0, NULL, NULL, 1, '2024-09-14 20:04:27', '2024-09-14 20:04:27');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_frais_consutation`
--

DROP TABLE IF EXISTS `tbl_frais_consutation`;
CREATE TABLE IF NOT EXISTS `tbl_frais_consutation` (
  `id_frais_consultation` int NOT NULL,
  `nom_consultation` varchar(255) NOT NULL,
  `montant_consultation` int NOT NULL,
  `etat` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_frais_consultation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_frais_consutation`
--

INSERT INTO `tbl_frais_consutation` (`id_frais_consultation`, `nom_consultation`, `montant_consultation`, `etat`) VALUES
(1, 'Consultation générale', 2500, 1),
(2, 'Consultation dentaire', 10000, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_frais_hospitalisation`
--

DROP TABLE IF EXISTS `tbl_frais_hospitalisation`;
CREATE TABLE IF NOT EXISTS `tbl_frais_hospitalisation` (
  `id_frais_hospital` int NOT NULL,
  `nom_hospital` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `montant_hospital` int NOT NULL,
  `etat` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_frais_hospital`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_frais_hospitalisation`
--

INSERT INTO `tbl_frais_hospitalisation` (`id_frais_hospital`, `nom_hospital`, `montant_hospital`, `etat`) VALUES
(1, 'H-7 jours', 15000, 1),
(2, 'H [7-15] jours', 20000, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_guest`
--

DROP TABLE IF EXISTS `tbl_guest`;
CREATE TABLE IF NOT EXISTS `tbl_guest` (
  `guest_id` int NOT NULL AUTO_INCREMENT,
  `guest_first_name` varchar(255) NOT NULL,
  `guest_last_name` varchar(255) NOT NULL,
  `guest_ifu` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `guest_country` varchar(255) NOT NULL,
  `guest_address` varchar(255) NOT NULL,
  `guest_mobile_number` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `guest_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`guest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_guest`
--

INSERT INTO `tbl_guest` (`guest_id`, `guest_first_name`, `guest_last_name`, `guest_ifu`, `guest_country`, `guest_address`, `guest_mobile_number`, `guest_email`) VALUES
(2, 'John', 'SMITH', '0202324568794', 'Bénin', 'Abomey-calavi , Bidossessi', '+22967361565', 'tiandorman@gmail.com'),
(3, 'Max', 'PAYNE', '0202324568794', 'Bénin', 'Abomey-calavi , Bidossessi', '+22966756558', 'tiandorman@gmail.com'),
(1, 'Achat', 'Client(Anonyme)', '0000000000000', 'Bénin', 'Cotonou', '+22900000000', NULL),
(20, 'Herman', 'TIANDO', '0202324568794', 'Bénin', 'Cotonou Abomey calavi', '+22967361565', 'tiandorman@gmail.com'),
(21, 'Peter', 'WAYNE', '0202324568794', 'Bénin', 'Cotonou Abomey calavi', '+22967361565', 'tiandorman@gmail.com'),
(22, 'Paul', 'LOGAN', '0202324568794', 'Benin', 'CSB TANKPE RUE NEWLAND', '+22960001202', 'tiandorman@gmail.com'),
(24, 'Carter', 'FOX', NULL, '', '', '+19699879635', NULL),
(25, 'Kalvin', 'QUEEN', NULL, '', '', '+22960403050', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_lits`
--

DROP TABLE IF EXISTS `tbl_lits`;
CREATE TABLE IF NOT EXISTS `tbl_lits` (
  `id_lit` int NOT NULL AUTO_INCREMENT,
  `id_chambre` int NOT NULL,
  `lit` varchar(255) NOT NULL,
  `statut` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_lit`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_lits`
--

INSERT INTO `tbl_lits` (`id_lit`, `id_chambre`, `lit`, `statut`) VALUES
(1, 1, 'lit1', 1),
(2, 1, 'lit2', 0),
(3, 1, 'lit3', 0),
(4, 1, 'lit4', 0),
(5, 2, 'lit1', 1),
(6, 2, 'lit2', 0),
(7, 2, 'lit3', 0),
(8, 3, 'lit1', 0),
(9, 3, 'lit2', 0),
(10, 4, 'lit1', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_manufacture`
--

DROP TABLE IF EXISTS `tbl_manufacture`;
CREATE TABLE IF NOT EXISTS `tbl_manufacture` (
  `manufacture_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `manufacture_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacture_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `publication_status` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`manufacture_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_manufacture`
--

INSERT INTO `tbl_manufacture` (`manufacture_id`, `manufacture_name`, `manufacture_description`, `publication_status`, `created_at`, `updated_at`) VALUES
(1, 'Sans marque', 'Sans marque', 1, NULL, NULL),
(2, 'Nivea', 'Nivea produt', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_order`
--

DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE IF NOT EXISTS `tbl_order` (
  `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int DEFAULT NULL,
  `guest_id` int DEFAULT NULL,
  `shipping_id` int NOT NULL,
  `payment_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_total` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_statut` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`order_id`),
  KEY `guest_id` (`guest_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `transaction_id`, `customer_id`, `guest_id`, `shipping_id`, `payment_id`, `order_total`, `order_status`, `created_date`, `updated_at`, `order_statut`) VALUES
(1, 'CAISSE04-14-09-2024 20:26:05', NULL, 1, 0, '1', '21500', 'Cloturé', '2024-09-14 20:26:05', NULL, 0),
(2, 'CAISSE04-02-10-2024 11:38:28', NULL, 1, 0, '2', '15000', 'Cloturé', '2024-10-02 11:38:28', NULL, 0);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_order_details`
--

DROP TABLE IF EXISTS `tbl_order_details`;
CREATE TABLE IF NOT EXISTS `tbl_order_details` (
  `order_details_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `category_id` int NOT NULL,
  `taxe_id` varchar(2) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_size` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `product_sales_quantity` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `command_statut` int NOT NULL DEFAULT '0',
  `date_cloture` date DEFAULT NULL,
  PRIMARY KEY (`order_details_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_order_details`
--

INSERT INTO `tbl_order_details` (`order_details_id`, `user_id`, `order_id`, `product_id`, `category_id`, `taxe_id`, `product_name`, `product_price`, `product_size`, `product_sales_quantity`, `created_at`, `updated_at`, `command_statut`, `date_cloture`) VALUES
(1, 4, 1, 3, 3, 'AU', 'Granions Chondrostéo Articulations 3X90 comprimés', '5000', NULL, '2', '2024-09-14 20:26:05', NULL, 0, NULL),
(2, 4, 1, 2, 1, 'AU', 'CarboSylane 48 doses', '2000', NULL, '2', '2024-09-14 20:26:05', NULL, 0, NULL),
(3, 4, 1, 5, 6, 'AU', 'ProRhinel Mouche Bébé + 2 embouts souples jetables', '7500', NULL, '1', '2024-09-14 20:26:05', NULL, 0, NULL),
(4, 4, 2, 3, 3, 'AU', 'Granions Chondrostéo Articulations 3X90 comprimés', '5000', NULL, '3', '2024-10-02 11:38:28', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_panier`
--

DROP TABLE IF EXISTS `tbl_panier`;
CREATE TABLE IF NOT EXISTS `tbl_panier` (
  `panier_id` int NOT NULL AUTO_INCREMENT,
  `taxe_id` varchar(2) DEFAULT NULL,
  `guest_id` int NOT NULL,
  `user_id` int NOT NULL,
  `product_id` int NOT NULL,
  `prix` int NOT NULL,
  `qty` int NOT NULL,
  `total` int NOT NULL,
  `panier_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`panier_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure de la table `tbl_patient`
--

DROP TABLE IF EXISTS `tbl_patient`;
CREATE TABLE IF NOT EXISTS `tbl_patient` (
  `patient_id` int NOT NULL AUTO_INCREMENT,
  `nom_patient` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `prenom_patient` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nip` int NOT NULL,
  `telephone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `contact_urgence` varchar(255) NOT NULL,
  `email_patient` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nationalite` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `sexe_patient` varchar(1) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `smatrimonial` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `datenais` date NOT NULL,
  `pcreated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pupdated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `adresse` varchar(255) NOT NULL,
  `gsang` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_patient`
--

INSERT INTO `tbl_patient` (`patient_id`, `nom_patient`, `prenom_patient`, `nip`, `telephone`, `contact_urgence`, `email_patient`, `nationalite`, `sexe_patient`, `smatrimonial`, `datenais`, `pcreated_at`, `pupdated_at`, `adresse`, `gsang`) VALUES
(1, 'LOGAN', 'Patricia', 789258740, '+22967361565', '+99967361565', 'loganpaul@gmail.com', 'Béninois', 'F', 'Marié ', '1994-09-01', '2024-09-01 12:03:30', '2024-09-01 12:03:30', 'Haie vive, cotonou', 'B-'),
(2, 'ATAOU', 'Brenda', 788984563, '+22869589878', '+22669589878', 'ataoupatrice@gmail.com', 'Togolais', 'F', 'Célibataire', '1999-03-01', '2024-09-01 12:03:30', '2024-09-01 12:03:30', '', 'A+'),
(3, 'Mark', 'Otto', 600000, '+22967361565', '+33987456115', 'markotto@gmail.com', 'Béninoise', 'M', 'Marié', '2010-01-01', '2024-09-01 17:13:33', '2024-09-01 17:13:33', '', ''),
(4, 'Wayne', 'Carter', 2, '+22960002034', '+22987954441', 'waynecarter@gmail.com', 'Américain', 'M', 'Célibataire', '1970-03-01', '2024-09-01 17:28:54', '2024-09-01 17:28:54', '', ''),
(5, 'Martin', 'Khalid', 600000, '+24169696969', '+26069020249', 'waynecarter@gmail.com', 'Béninoise', 'M', 'Marié', '2000-01-01', '2024-09-01 18:55:11', '2024-09-01 18:55:11', 'Zogbadjè clinique Merveille', '');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_payment`
--

DROP TABLE IF EXISTS `tbl_payment`;
CREATE TABLE IF NOT EXISTS `tbl_payment` (
  `payment_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `payment_method` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_payment`
--

INSERT INTO `tbl_payment` (`payment_id`, `payment_method`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 'caisse', 'Payé', '2024-09-14 20:26:05', NULL),
(2, 'caisse', 'Payé', '2024-10-02 11:38:28', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_prise_en_charge`
--

DROP TABLE IF EXISTS `tbl_prise_en_charge`;
CREATE TABLE IF NOT EXISTS `tbl_prise_en_charge` (
  `id_prise_en_charge` int NOT NULL AUTO_INCREMENT,
  `patient_id` int NOT NULL,
  `user_role_id` int NOT NULL,
  `last_consult_user_id` int DEFAULT NULL,
  `last_consult_user_role_id` int DEFAULT NULL,
  `user_id` int NOT NULL,
  `maux` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `temp` int DEFAULT NULL,
  `etat_consultation` int NOT NULL DEFAULT '0',
  `etat_hospitalisation` int NOT NULL DEFAULT '0',
  `observation` text NOT NULL,
  `ordonnance` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_prise_en_charge`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_prise_en_charge`
--

INSERT INTO `tbl_prise_en_charge` (`id_prise_en_charge`, `patient_id`, `user_role_id`, `last_consult_user_id`, `last_consult_user_role_id`, `user_id`, `maux`, `temp`, `etat_consultation`, `etat_hospitalisation`, `observation`, `ordonnance`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 3, 7, 1, 'Fièvre', 38, 1, 1, 'Néant', '<h2><strong>Ordonnance Médicale</strong></h2><p>1 Anti Bi-Malaril</p><p>1 dose adulte panadol</p><p>2 plaquettes aspirine</p>', '2024-06-01 16:31:43', '2024-09-01 16:31:43'),
(2, 2, 0, NULL, NULL, 1, 'Céphalés', 37, 0, 0, 'Vomissements et diarrhée depuis son admission', NULL, '2024-09-01 16:36:21', '2024-09-01 16:36:21'),
(3, 3, 0, NULL, NULL, 1, 'Douleurs abdominaux', 39, 0, 0, 'Néant', NULL, '2024-09-01 16:48:24', '2024-09-01 16:48:24'),
(4, 1, 0, NULL, NULL, 1, 'Blessure au bras', 38, 0, 0, 'Blessure peu profonde', NULL, '2024-09-01 17:13:33', '2024-09-01 17:13:33'),
(5, 4, 0, 3, 7, 1, 'Fracture du pieds', 37, 1, 0, 'Fracture fermée du pieds gauche', NULL, '2024-09-01 17:28:54', '2024-09-01 17:28:54'),
(6, 3, 0, NULL, NULL, 1, 'Fièvre', 36, 1, 0, 'Néant', NULL, '2024-09-01 18:53:39', '2024-09-01 18:53:39'),
(7, 5, 0, 3, 7, 1, 'Douleurs abdominaux', 40, 1, 1, 'Néant', '<h2><strong>Ordonnance</strong></h2><ol><li> Plaquette d\'antibiotiques</li><li>Compresse pansements</li><li>Pannadol</li></ol>', '2024-09-01 18:55:11', '2024-09-01 18:55:11'),
(8, 1, 0, NULL, NULL, 1, 'Blessure au bras', 41, 0, 0, 'Néant', NULL, '2024-09-22 12:32:54', '2024-09-22 12:32:54');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_products`
--

DROP TABLE IF EXISTS `tbl_products`;
CREATE TABLE IF NOT EXISTS `tbl_products` (
  `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  `rayon_id` int DEFAULT NULL,
  `srayon_id` int DEFAULT NULL,
  `manufacture_id` int DEFAULT NULL,
  `product_description` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_price` int NOT NULL,
  `product_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_un` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `publication_status` int DEFAULT NULL,
  `stock` int UNSIGNED NOT NULL DEFAULT '0',
  `stock_defective` int NOT NULL DEFAULT '0',
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tbl_products`
--

INSERT INTO `tbl_products` (`product_id`, `product_name`, `category_id`, `rayon_id`, `srayon_id`, `manufacture_id`, `product_description`, `product_price`, `product_image`, `image_un`, `publication_status`, `stock`, `stock_defective`, `updated_at`) VALUES
(1, 'Météoxane 60 gélules', 1, NULL, 1, 1, 'Météoxane', 20000, 'image/mtoxane.jpg.jpg', NULL, NULL, 4, 0, '2024-09-11 14:54:57'),
(2, 'CarboSylane 48 doses', 1, NULL, 1, 1, 'CarboSylane 48 doses', 2000, 'image/carbosylane.jpg.jpg', NULL, NULL, 8, 0, '2024-09-11 14:55:38'),
(3, 'Granions Chondrostéo Articulations 3X90 comprimés', 3, NULL, 5, 1, 'granions', 5000, 'image/granions-chondrosteo-articulations-3x90-comprimes.jpg.jpg', NULL, NULL, 7, 0, '2024-09-11 15:10:05'),
(4, 'Bioderma Atoderm Gel Douche 1L', 4, NULL, 6, 1, 'Bioderma Atoderm Gel Douche 1L', 4500, 'image/atoderm-gel-douche-1l.jpg.jpg', NULL, NULL, 6, 0, '2024-09-11 15:16:14'),
(5, 'ProRhinel Mouche Bébé + 2 embouts souples jetables', 6, NULL, 7, 1, 'ProRhinel Mouche Bébé + 2 embouts souples jetables', 7500, 'image/mouche-bebe-prorhinel-2-embouts-souples-jetables.jpg.jpg', NULL, NULL, 8, 0, '2024-09-11 15:19:16'),
(6, 'Weleda Baume de Massage Vergetures 150ml', 6, NULL, 8, 1, 'Weleda Baume de Massage Vergetures 150ml', 10960, 'image/weleda-baume-de-massage-vergetures-150ml.jpg.jpg', NULL, NULL, 16, 0, '2024-09-11 15:22:36'),
(7, 'Pommade nivea eclaircissante', 4, NULL, 9, 2, 'Pommade nivea eclaircissante', 60000, 'image/téléchargement.jfif.jfif', NULL, NULL, 10, 0, '2024-09-14 20:16:53');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_rayon`
--

DROP TABLE IF EXISTS `tbl_rayon`;
CREATE TABLE IF NOT EXISTS `tbl_rayon` (
  `rayon_id` int NOT NULL AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `rayon_name` varchar(255) NOT NULL,
  `rayon_description` varchar(255) NOT NULL,
  `publication_status` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`rayon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_rayon`
--

INSERT INTO `tbl_rayon` (`rayon_id`, `category_id`, `rayon_name`, `rayon_description`, `publication_status`) VALUES
(1, 1, 'Digestion', 'Digestion', 1),
(2, 1, 'Douleurs et fièvre', 'Douleurs et fièvre', 1),
(3, 1, 'Métabolisme et nutrition', 'Métabolisme et nutrition', 1),
(4, 1, 'Ophtalmologie', 'Ophtalmologie', 1),
(5, 1, 'Rhume, état grippal', 'Rhume, état grippal', 1),
(6, 3, 'Santé', 'Santé', 1),
(7, 3, 'Beauté', 'Beauté', 1),
(8, 4, 'Hygiène du corps', 'Hygiène du corps', 1),
(9, 6, 'Bébé', 'Bébé', 1),
(10, 6, 'Maman', 'Maman', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_receipt`
--

DROP TABLE IF EXISTS `tbl_receipt`;
CREATE TABLE IF NOT EXISTS `tbl_receipt` (
  `receipt_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_id` int NOT NULL,
  `uid` varchar(255) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `code_me_ce_fdgi` varchar(255) NOT NULL,
  `counters` varchar(255) NOT NULL,
  `nim` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`receipt_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_receipt`
--

INSERT INTO `tbl_receipt` (`receipt_id`, `user_id`, `order_id`, `uid`, `qr_code`, `code_me_ce_fdgi`, `counters`, `nim`, `date_time`) VALUES
(1, 4, 1, '47b70773-4ff7-4a2b-8014-0c4229d79c01', 'F;TS01010713;TESTA2UUWCFCEYKYG7JVC6Z7;0202112281722;20240914212609', 'TEST-A2UU-WCFC-EYKY-G7JV-C6Z7', '49/50 FV', 'TS01010713', '2024-09-14 20:26:09'),
(2, 4, 2, '2ff4cb77-2e5d-4344-9c91-77cc3607f8a9', 'F;TS01010713;TESTSPS7BQXW6UX5QLYUWO5S;0202112281722;20241002123832', 'TEST-SPS7-BQXW-6UX5-QLYU-WO5S', '50/51 FV', 'TS01010713', '2024-10-02 11:38:31');

-- --------------------------------------------------------

--
-- Structure de la table `tbl_srayon`
--

DROP TABLE IF EXISTS `tbl_srayon`;
CREATE TABLE IF NOT EXISTS `tbl_srayon` (
  `srayon_id` int NOT NULL AUTO_INCREMENT,
  `rayon_id` int NOT NULL,
  `srayon_name` varchar(255) NOT NULL,
  `srayon_description` text NOT NULL,
  `publication_statu` int DEFAULT '1',
  PRIMARY KEY (`srayon_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `tbl_srayon`
--

INSERT INTO `tbl_srayon` (`srayon_id`, `rayon_id`, `srayon_name`, `srayon_description`, `publication_statu`) VALUES
(1, 1, 'Ballonnement', 'Ballonnement', 1),
(2, 1, 'Brûlures d\'estomac', 'Brûlures d\'estomac', 1),
(3, 1, 'Diarrhée', 'Diarrhée', 1),
(4, 1, 'Nausées, vomissements', 'Nausées, vomissements', 1),
(5, 7, 'Articulations, muscles', 'Articulations, muscles', 1),
(6, 8, 'Gel Douche', 'Gel Douche', 1),
(7, 9, 'Accessoires de bébé', 'Accessoires de bébé', 1),
(8, 10, 'Soins de grossesse', 'Soins de grossesse', 1),
(9, 8, 'Pommades', 'Pommades', 1);

-- --------------------------------------------------------

--
-- Structure de la table `tbl_type_analyse`
--

DROP TABLE IF EXISTS `tbl_type_analyse`;
CREATE TABLE IF NOT EXISTS `tbl_type_analyse` (
  `id_type_analyse` int NOT NULL AUTO_INCREMENT,
  `libelle_analyse` varchar(500) NOT NULL,
  `prix_analyse` int NOT NULL,
  `statut` int NOT NULL,
  PRIMARY KEY (`id_type_analyse`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `tbl_type_analyse`
--

INSERT INTO `tbl_type_analyse` (`id_type_analyse`, `libelle_analyse`, `prix_analyse`, `statut`) VALUES
(1, 'Analyse Cytogénétique constitutionnelle', 15000, 0),
(2, 'Analyse Cytogénétique tumorale', 20000, 0),
(3, 'Analyse Cytogénétique moléculaire', 10000, 0),
(4, 'Screening biochimique avec évaluation du risque d’anomalies \r\ngénétiques du fœtus', 20000, 0),
(5, 'Tests de génétique moléculaire à la recherche d’anomalies génétiques \r\ndu fœtus .', 30000, 0),
(6, 'Analyse Virologie', 5000, 0),
(7, 'Analyse Bactériologie/Mycologie', 8000, 0),
(8, 'Analyse Parasitologie', 9000, 0),
(9, 'Allergologie et immunologie clinique', 6000, 0),
(10, 'Dermatologie et vénérologie', 5000, 0),
(11, 'Endocrinologie – diabétologie', 4000, 0),
(12, 'Gastroentérologie', 6000, 0),
(13, 'Gynécologie et obstétrique', 7000, 0),
(14, 'Hématologie et oncologie médicale', 12000, 0),
(15, 'Rhumatologie', 3000, 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_role_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `user_role_id`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '0', 'johnjones@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-08-31 09:06:30', '2024-08-31 09:06:30'),
(2, '1', 'tiandorman@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-01 16:47:18', '2024-09-01 16:47:18'),
(3, '7', 'foxjenner@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-04 08:06:27', '2024-09-04 08:06:27'),
(4, '9', 'pharmacie@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-11 06:02:28', '2024-09-11 06:02:28'),
(5, '4', 'labo@gmail.com', NULL, '25f9e794323b453885f5181f1b624d0b', NULL, '2024-09-12 06:54:24', '2024-09-12 06:54:24');

-- --------------------------------------------------------

--
-- Structure de la table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
CREATE TABLE IF NOT EXISTS `user_roles` (
  `user_role_id` tinyint UNSIGNED NOT NULL AUTO_INCREMENT,
  `designation` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sup_code` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sup_code_id` int NOT NULL,
  `is_consult` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`user_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Déchargement des données de la table `user_roles`
--

INSERT INTO `user_roles` (`user_role_id`, `designation`, `title`, `sup_code`, `sup_code_id`, `is_consult`, `created_at`, `updated_at`) VALUES
(0, 'Accueil', 'Accueil de la Clinique', '', 0, 0, '2022-08-02 17:46:08', '2022-08-02 10:00:13'),
(1, 'Caisse', 'Caisse de la clinique', 'DG', 0, 0, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(2, 'Médecine générale', 'Médecin générale', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(3, 'Maternité', 'Maternité', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(4, 'Laboratoire', 'Laboratoire', 'DG', 0, 2, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(5, 'Echographie', 'Echographie', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(6, 'Radiologie', 'Radiologie', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(7, 'Bloc opératoire', 'Bloc opératoire', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(8, 'Vaccination', 'Vaccination', 'DG', 0, 1, '2022-08-02 09:57:43', '2022-08-02 09:57:43'),
(9, 'Phamarcie', 'Phamarcie', 'DG', 0, 0, '2022-08-02 09:57:43', '2022-08-02 09:57:43');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
