-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 20 mai 2021 à 23:34
-- Version du serveur :  8.0.25-0ubuntu0.21.04.1
-- Version de PHP : 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `extranetGBAF`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_partenaires` int NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `date_com` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `commentaires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `id_user`, `id_partenaires`, `auteur`, `date_com`, `commentaires`) VALUES
(1, 1, 1, 'Fred', '2021-05-02 14:31:02', 'Excellent service !'),
(2, 2, 1, 'Luc', '2021-05-02 18:12:58', 'Très beau projet pour rendre accessible la formation professionnelle'),
(3, 1, 4, 'Bullus', '2021-05-03 08:41:02', 'Jamais déçu de ce service'),
(4, 3, 2, 'Lou', '2021-05-03 10:39:11', 'Très intéressant'),
(5, 3, 1, 'Raptor', '2021-05-03 10:42:09', 'Toujours de bons retours de cette organisme'),
(6, 4, 1, 'Jo', '2021-05-03 14:01:47', 'Un très beau projet porté par des gens efficaces');

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `img_id` int NOT NULL,
  `img_nom` varchar(50) NOT NULL,
  `img_taille` varchar(25) NOT NULL,
  `img_type` varchar(25) NOT NULL,
  `img_desc` varchar(100) NOT NULL,
  `img_blob` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--

CREATE TABLE `partenaires` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varbinary(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `partenaires`
--

INSERT INTO `partenaires` (`id`, `nom`, `description`, `logo`) VALUES
(1, 'Formation&Co', 'Formation&co est une association française présente sur tout le territoire. <br>\n        Nous proposons à des personnes issues de tout milieu de devenir entrepreneur grâce\n        à un crédit et un accompagnement professionnel et personnalisé.', 0x466f726d26436f),
(2, 'ProtectPeople', 'Chez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins. ProtectPeople est ouvert à tous.', 0x50726f7465637450656f706c65),
(3, 'DSA France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.', ''),
(4, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.', '');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reponse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `question`, `reponse`) VALUES
(11, 'Fred', '$2y$10$4KgzGq2Y2S4ES25nks/.POP4XNruPLR85mf1hBQUFGImVpWWiq42C', 'fred@pqp.fr', 'Comment s\'appelait votre premier animal de compagnie ?', 'Bdlb');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--

CREATE TABLE `votes` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_partenaires` int NOT NULL,
  `votes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`img_id`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`);

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `img_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
