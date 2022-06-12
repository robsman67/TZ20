-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 12 juin 2022 à 11:49
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tz20`
--

-- --------------------------------------------------------

--
-- Structure de la table `catégorie_produit`
--

CREATE TABLE `catégorie_produit` (
  `ID_produit` int(255) NOT NULL,
  `ID_nom_catégorie` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `catégorie_produit`
--

INSERT INTO `catégorie_produit` (`ID_produit`, `ID_nom_catégorie`) VALUES
(7, 1),
(8, 1),
(3, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `ID_commande` int(11) NOT NULL,
  `Date` date NOT NULL,
  `ID_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `comp_commande`
--

CREATE TABLE `comp_commande` (
  `ID_commande` int(11) NOT NULL,
  `ID_produit` int(11) NOT NULL,
  `prix_vente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `nom_catégorie`
--

CREATE TABLE `nom_catégorie` (
  `ID_nom_categorie` int(255) NOT NULL,
  `nom_categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `nom_catégorie`
--

INSERT INTO `nom_catégorie` (`ID_nom_categorie`, `nom_categorie`) VALUES
(1, 'jeux'),
(3, 'console');

-- --------------------------------------------------------

--
-- Structure de la table `pannier`
--

CREATE TABLE `pannier` (
  `id_pannier` int(11) NOT NULL,
  `ID_produit` int(11) NOT NULL,
  `ID_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `pannier`
--

INSERT INTO `pannier` (`id_pannier`, `ID_produit`, `ID_utilisateur`) VALUES
(1, 7, 38),
(15, 8, 13),
(16, 7, 13),
(17, 7, 13);

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `id` int(100) NOT NULL,
  `Nom` varchar(100) NOT NULL,
  `Prix` int(255) NOT NULL,
  `Image` varchar(1000) NOT NULL,
  `nb_stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `Nom`, `Prix`, `Image`, `nb_stock`) VALUES
(3, 'PS5', 500, '5', 0),
(5, 'XBOX ', 500, '10', 1),
(7, 'Elden ring', 50, '5', 500),
(8, 'Gran Turismo 7', 60, '5', 5);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prénom` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `nom`, `prénom`, `login`, `password`, `date`) VALUES
(13, 'jffjj', 'jfjf', 'jeje', 'jeje', '0000-00-00'),
(14, 'jdjd', 'jcjc', 'cjjfc', 'jfdjd', '0000-00-00'),
(15, 'ncnjc', 'jfj', 'jdj', 'djdj', '0000-00-00'),
(16, 'robert', 'ekjejdje', 'kekje', 'jeke', '0000-00-00'),
(17, 'kd', 'dkdk', 'dkd', ',ff', '0000-00-00'),
(18, 'djdj', 'jffd', 'jd', 'jdj', '0000-00-00'),
(19, 'jfj', 'jfjf', ',cfk', 'jfdjf', '0000-00-00'),
(20, 'ooio', 'hjd', 'jej', 'jdj', '0000-00-00'),
(21, 'ooio', 'ncn', 'jej', 'jdj', '0000-00-00'),
(23, 'orioe&agrave;', 'eiei', 'jej', 'jeje', '0000-00-00'),
(33, 'jfjfjf', 'fkfjjdf', 'jdjd', 'djdjdj', '0000-00-00'),
(34, 'djekiero', 'ekiek', 'hdhd', 'dkdjj', '0000-00-00'),
(35, 'kdkddk', 'dkdkid', ',dd,', 'kridk', '0000-00-00'),
(36, 'dkdkdk', 'vvvcv', ',xc,d', 'd,d,k', '0000-00-00'),
(38, 'ndd', 'djdj', 'robert', 'robert', '0000-00-00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `catégorie_produit`
--
ALTER TABLE `catégorie_produit`
  ADD PRIMARY KEY (`ID_produit`),
  ADD KEY `ID_nom_catégorie` (`ID_nom_catégorie`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`ID_commande`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `comp_commande`
--
ALTER TABLE `comp_commande`
  ADD PRIMARY KEY (`ID_commande`),
  ADD KEY `ID_produit` (`ID_produit`);

--
-- Index pour la table `nom_catégorie`
--
ALTER TABLE `nom_catégorie`
  ADD PRIMARY KEY (`ID_nom_categorie`);

--
-- Index pour la table `pannier`
--
ALTER TABLE `pannier`
  ADD PRIMARY KEY (`id_pannier`),
  ADD KEY `ID_produit` (`ID_produit`),
  ADD KEY `ID_utilisateur` (`ID_utilisateur`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `ID_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `comp_commande`
--
ALTER TABLE `comp_commande`
  MODIFY `ID_commande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `nom_catégorie`
--
ALTER TABLE `nom_catégorie`
  MODIFY `ID_nom_categorie` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `pannier`
--
ALTER TABLE `pannier`
  MODIFY `id_pannier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `catégorie_produit`
--
ALTER TABLE `catégorie_produit`
  ADD CONSTRAINT `catégorie_produit_ibfk_1` FOREIGN KEY (`ID_produit`) REFERENCES `produit` (`id`),
  ADD CONSTRAINT `catégorie_produit_ibfk_2` FOREIGN KEY (`ID_nom_catégorie`) REFERENCES `nom_catégorie` (`ID_nom_categorie`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`id`);

--
-- Contraintes pour la table `comp_commande`
--
ALTER TABLE `comp_commande`
  ADD CONSTRAINT `comp_commande_ibfk_1` FOREIGN KEY (`ID_commande`) REFERENCES `commande` (`ID_commande`),
  ADD CONSTRAINT `comp_commande_ibfk_2` FOREIGN KEY (`ID_produit`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `pannier`
--
ALTER TABLE `pannier`
  ADD CONSTRAINT `pannier_ibfk_1` FOREIGN KEY (`ID_utilisateur`) REFERENCES `utilisateur` (`id`),
  ADD CONSTRAINT `pannier_ibfk_2` FOREIGN KEY (`ID_produit`) REFERENCES `produit` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
