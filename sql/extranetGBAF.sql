-- phpMyAdmin SQL Dump
-- version 4.9.7deb1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 16 juin 2021 à 21:05
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
-- Structure de la table `commentaire`
--
-- Création : mer. 16 juin 2021 à 13:42
-- Dernière modification : mer. 16 juin 2021 à 12:21
--

CREATE TABLE `commentaire` (
  `id` int NOT NULL,
  `id_partenaires` int NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `commentaire` text NOT NULL,
  `date_commentaire` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- RELATIONS POUR LA TABLE `commentaire`:
--

-- --------------------------------------------------------

--
-- Structure de la table `partenaires`
--
-- Création : mer. 16 juin 2021 à 18:17
--

CREATE TABLE `partenaires` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `vignette` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- RELATIONS POUR LA TABLE `partenaires`:
--

--
-- Déchargement des données de la table `partenaires`
--

INSERT INTO `partenaires` (`id`, `nom`, `description`, `logo`, `vignette`) VALUES
(1, 'Formation&Co', 'Formation&co est une association française présente sur tout le territoire. Son ambition est de donner\r\n          à tous l\'opportunité de se former sans conditions de revenus ni prérequis. Cette association entend encourager \r\n          l\'entreprenariat et faire fonctionner l\'ascenceur social. Pour tendre vers cet objectif, cet organisme propose \r\n          à des personnes issues de tout milieu de devenir entrepreneur grâce à un crédit et un accompagnement professionnel et personnalisé.\r\n          Le service proposé consiste des points suivants :\r\n- Un financement jusqu’à 30 000€\r\n- Un suivi personnalisé et gratuit\r\n- Une lutte acharnée contre les freins sociétaux et les stéréotypes\r\nLe financement est possible, peu importe le métier : coiffeur, banquier, éleveur de chèvres…\r\n          Nous collaborons avec des personnes talentueuses et motivées.\r\n          Vous n’avez pas de diplômes ? Ce n’est pas un problème pour nous ! Nos financements s’adressent à tous.', 'business-02.jpg', 'formation-co.png'),
(2, 'ProtectPeople', ' Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.\r\n          Chez Protectpeople, chacun cotise selon ses moyens et reçoit selon ses besoins.\r\n          Proectecpeople est ouvert à tous, sans considération d’âge ou d’état de santé.\r\n          Nous garantissons un accès aux soins et une retraite.\r\n          Chaque année, nous collectons et répartissons 300 milliards d’euros.', 'business-01.jpg', 'protectpeople.png'),
(3, 'DSA France', 'Dsa France accélère la croissance du territoire et s’engage avec les collectivités territoriales.\r\nNous accompagnons les entreprises dans les étapes clés de leur évolution.\r\n          Notre philosophie : s’adapter à chaque entreprise.\r\n          Nous les accompagnons pour voir plus grand et plus loin et proposons des solutions de financement adaptées à chaque étape de la vie des entreprises', 'Dsa_france.png', 'Dsa_france.png'),
(4, 'CDE', 'La CDE (Chambre Des Entrepreneurs) accompagne les entreprises dans leurs démarches de formation. \nSon président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents des CDE.', 'business-05.jpg\r\n', 'CDE.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--
-- Création : lun. 14 juin 2021 à 09:44
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `prenom` varchar(45) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `question` varchar(255) NOT NULL,
  `reponse` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- RELATIONS POUR LA TABLE `user`:
--

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `prenom`, `nom`, `password`, `question`, `reponse`) VALUES
(11, 'Fred', '', '', '$2y$10$4KgzGq2Y2S4ES25nks/.POP4XNruPLR85mf1hBQUFGImVpWWiq42C', 'Comment s\'appelait votre premier animal de compagnie ?', 'Bdlb'),
(20, 'Claire', 'Claire', 'Gouarne', '$2y$10$VvKEz9qat57e0plUokzBP.QehtLv6BsDiA4Oe4nlZeApDMNcz43Gq', 'Comment s\'appelait votre premier animal de compagnie ?', 'Pdt'),
(22, 'Emma', 'Emma', 'Despo', '$2y$10$8U6LyqwQLwlFlQAVMv9YMOjleBd57WNhNyp3sNNfGlQ6sejr5ep5O', 'Quel est votre plat préféré ?', 'Pdt'),
(23, 'Tarte', 'tarte', 'tarte', '$2y$10$ql.MKLbaGz0ZPXovBwBzKOHhuItzSld.8WlWj095DLfVd9Hzn5Avq', 'Quel est votre plat préféré ?', 'tarte');

-- --------------------------------------------------------

--
-- Structure de la table `votes`
--
-- Création : mer. 16 juin 2021 à 13:55
--

CREATE TABLE `votes` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `id_partenaires` int NOT NULL,
  `votes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- RELATIONS POUR LA TABLE `votes`:
--   `id_partenaires`
--       `partenaires` -> `id`
--   `id_user`
--       `user` -> `id`
--

--
-- Déchargement des données de la table `votes`
--

INSERT INTO `votes` (`id`, `id_user`, `id_partenaires`, `votes`) VALUES
(1, 20, 3, 1),
(2, 20, 1, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `partenaires`
--
ALTER TABLE `partenaires`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_partenaires_votes` (`id_partenaires`),
  ADD KEY `fk_user_votes` (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `partenaires`
--
ALTER TABLE `partenaires`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_partenaires_votes` FOREIGN KEY (`id_partenaires`) REFERENCES `partenaires` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_user_votes` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
