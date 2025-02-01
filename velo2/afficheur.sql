-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : sam. 01 fév. 2025 à 09:37
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `afficheur`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `mot_de_passe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `administrateurs`
--

INSERT INTO `administrateurs` (`id`, `nom`, `mail`, `mot_de_passe`) VALUES
(3, 'Professeur', 'professeur@carnus.fr', 'administrateur'),
(4, 'Kamal', 'k.b@carnus.fr', '81d4e0484ff85438372680cc032b7939');

-- --------------------------------------------------------

--
-- Structure de la table `donnees`
--

CREATE TABLE `donnees` (
  `id` int(11) NOT NULL,
  `localisation` varchar(100) NOT NULL,
  `soleil` float NOT NULL,
  `temperature` float NOT NULL,
  `humidite` float NOT NULL,
  `vent_vitesse` float NOT NULL,
  `vent_direction` varchar(50) NOT NULL,
  `panneau_solaire` float NOT NULL,
  `batterie` float NOT NULL,
  `velos` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `donnees`
--

INSERT INTO `donnees` (`id`, `localisation`, `soleil`, `temperature`, `humidite`, `vent_vitesse`, `vent_direction`, `panneau_solaire`, `batterie`, `velos`, `date`) VALUES
(4, 'Local à vélos', 12.76, 18.4, 56.7, 25.9, 'Nord Ouest', 6, 72, 12, '2024-05-25 14:09:44'),
(5, 'Local à vélos', 14.5, 17.8, 59.1, 25.2, 'Ouest', 8, 69, 9, '2024-05-25 14:10:55'),
(6, 'Local à Vélos', 18.6, 15.2, 63.5, 19.5, 'Nord', 11, 83, 5, '2024-05-25 14:56:54'),
(7, 'Local Vélo', 12.4, 15.7, 30, 12.4, 'N', 123, 80, 4, '2024-07-02 15:01:32');

-- --------------------------------------------------------

--
-- Structure de la table `informations`
--

CREATE TABLE `informations` (
  `id` int(11) NOT NULL,
  `filière` varchar(100) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `détails` varchar(2047) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `informations`
--

INSERT INTO `informations` (`id`, `filière`, `titre`, `détails`, `date`) VALUES
(1, 'BTS SNIR', 'Epreuves écrites', '15-16 mai 2024', '2024-04-20 07:40:21'),
(2, 'BTS CIEL', '1ère année', 'Les étudiants ne pourront pas aller en stage s\'ils n\'ont pas suivi la totalité de la formation à l\'habilitation électrique.', '2024-04-20 07:40:21'),
(7, 'BTS SNIR', 'Rapport et Oral de stage', 'La date des oraux de stage est prévue pour le lundi 22 avril 2024 à partir de 8 h.\r\nDépôt des rapports de stage au format numérique \'.PDF\'', '2024-04-20 13:34:13'),
(9, 'BTS CIEL', 'Information', 'La formation s’articule autour du réseau informatique (conception, mise en place et maintenance) et de la Cybersécurité.\r\nA l’issue du BTS, les étudiants, via notre partenariat avec l’Ecole d’Ingénieurs 3iL pourront poursuivre leur étude sur un cycle d’ingénieur.', '2024-05-12 12:28:17'),
(10, 'BTS SNIR', 'Information sur le projet', 'Dépôt des dossiers au format numérique \'.PDF\'\r\nLes relevés de notes seront consultables par les candidats sur leur espace cyclades dans les jours suivant la publication des résultats. Ils ne feront ainsi plus l’objet d’un envoi par courrier. ', '2024-05-12 12:28:17'),
(12, 'BTS MCO', 'Détails de la formation', 'La formation s’articule autour du développement de la relation client, de la dynamisation de l’offre commerciale et du management de l’équipe commerciale.\r\nVous pouvez suivre la formation soit avec le statut étudiant ou avec le statut d’apprenti.', '2024-05-12 14:36:18');

-- --------------------------------------------------------

--
-- Structure de la table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `description` varchar(250) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `photos`
--

INSERT INTO `photos` (`id`, `titre`, `description`, `image`) VALUES
(8, 'Avenue Victor Hugo', 'Vue de la cathédrale de Rodez et de l\'avenue Victor Hugo', 'R4.jpg'),
(47, 'Ville', 'image en plus', 'R1.jpg'),
(49, 'Carnus', 'Image du bâtiment Carnus', 'image22.jpg'),
(50, 'Carnus R', 'Photo de rentrée', '1725461480632.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `donnees`
--
ALTER TABLE `donnees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `informations`
--
ALTER TABLE `informations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `donnees`
--
ALTER TABLE `donnees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `informations`
--
ALTER TABLE `informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
