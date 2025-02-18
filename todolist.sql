-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 19 fév. 2025 à 00:27
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `todolist`
--

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 2),
(7, '2025_02_18_193721_create_tasks_table', 3),
(11, '2025_02_18_193857_create_tasks_table', 4),
(13, '2025_02_18_201503_add_timestamps_to_tasks_table', 5),
(14, '2025_02_18_201910_add_timestamps_to_tasks_table', 6),
(15, '2025_02_18_202118_create_tasks_table', 7);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('saidi.benamor.hamza@gmail.com', '$2y$12$ryt9KrM90dK5BqTLEveI9uJKnVenlgbpWuQL2e4gKetSCpIKBHYkW', '2025-02-18 21:55:38');

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `completed` tinyint(1) NOT NULL DEFAULT 0,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `completed`, `due_date`, `created_at`, `updated_at`) VALUES
(5, 1, 'ben3mor hamza', 'Affiche une fenêtre modale lors du clic sur \"Modifier\".\nCharge les données de la tâche avec AJAX.\nEnregistre les modifications en AJAX et met à jour la page sans rechargement.', 0, '2025-02-28', '2025-02-18 19:46:34', '2025-02-18 22:08:38'),
(6, 1, 'eeeeeeeeee', 'eeeeeeeeeee', 0, '2025-02-18', '2025-02-18 19:48:52', '2025-02-18 19:48:52'),
(7, 11, 'aaaaaaaaaaaaaaaa', 'vvvvvvaaaaaaaaaaaaaaaaaaaaaaaaaavvvvv', 0, '2025-02-20', '2025-02-18 22:12:06', '2025-02-18 22:14:56'),
(14, 11, 'asa', 'axsx', 0, '2025-01-30', '2025-02-18 22:15:12', '2025-02-18 22:26:26'),
(15, 11, 'asa', 'zsazsdazdazd', 0, '2025-01-30', '2025-02-18 22:15:14', '2025-02-18 22:15:14'),
(16, 11, 'asacccccccccc', 'zsazsdazdazdccc', 0, '2025-01-30', '2025-02-18 22:15:15', '2025-02-18 22:16:17'),
(22, 11, 'addssdsdqsssss', 'qsdqsdqsdq', 0, '2025-02-26', '2025-02-18 22:25:16', '2025-02-18 22:25:16');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'saidirrrrrrrrrrrr', 'hamza@digilinks.io', NULL, '$2y$12$mdNudTqhP5PCBZmz7FuCluAQMlPq5wClvz2ijjGsP9U0cagvXpnea', NULL, '2025-02-18 18:56:34', '2025-02-18 18:56:34'),
(2, 'saidi', 'hamza@digilinksd.io', NULL, '$2y$12$.EGVzdetaX3XJB3ZM33BhOmIZDbVNtPun2RHEnvMCZGWqeC7OygDG', NULL, '2025-02-18 20:59:37', '2025-02-18 20:59:37'),
(3, 'qsxcqsc', 'qscscqscqsc@digilinks.io', NULL, '$2y$12$JciGlsuhaV62TKUKqKtU2.gI2GKiOD9xrK8rh/iEvzxhi49o1JpYK', NULL, '2025-02-18 21:01:39', '2025-02-18 21:01:39'),
(4, 'sxcqscqsc', 'hamqcscqcsqscza@digilinksd.io', NULL, '$2y$12$86m54ccDXEDI5sDGZZKAteVzKSOiEf9nQQ8fgdVYiYp/c7.GvW9l.', NULL, '2025-02-18 21:02:08', '2025-02-18 21:02:08'),
(5, 'ezdsdqsd', 'hamzaqsdqsd@digilinks.io', NULL, '$2y$12$tMVP5aIKEDIJbqEC7xtX2OVEgdTIoUXr.6SebU5nd1LSirnwbq/GK', NULL, '2025-02-18 21:05:29', '2025-02-18 21:05:29'),
(6, 'qscqss', 'qcqscqhamza@digilinks.io', NULL, '$2y$12$uTK/Rg0z2zLlvBv826svDuUWFut8otNmhkFdBXBeXT6D8imKYC1ry', NULL, '2025-02-18 21:07:50', '2025-02-18 21:07:50'),
(7, 'saidi', 'asma@digilinks.io', NULL, '$2y$12$Q.ji1HwIYuu9JhtKkLSS3.5SYNxzTqerpc1DeZD4DDP5zFoEBLMLK', NULL, '2025-02-18 21:08:42', '2025-02-18 21:08:42'),
(8, 'saidi', 'haeeeeeeeemza@digilinks.io', NULL, '$2y$12$eIET7VfcT0F9ow.QVgGHteO5VJ1lYk1sny3ZFqsgChSy7valfbDaW', NULL, '2025-02-18 21:09:52', '2025-02-18 21:09:52'),
(9, 'saidi', 'aaaaaaaaaaaaaaa@digilinks.io', NULL, '$2y$12$SYAv1tAlUeUdibKu8v.yy.xvpZgBf89kdaJhC/Lee80Fwdab0AZ1W', NULL, '2025-02-18 21:11:52', '2025-02-18 21:11:52'),
(10, 'saidi', 'hamza22222@digilinks.io', NULL, '$2y$12$Bk2CAd8ozOzaNbn66vval.tbbJCn4fIzD0BZgYgNMHCgKt6mqiTh2', NULL, '2025-02-18 21:30:01', '2025-02-18 21:30:01'),
(11, 'Hamza Saidi', 'saidi.benamor.hamza@gmail.com', NULL, '$2y$12$NFevQp/yL1ru6.SmDGbX5O3zRPihJ7UIpjYjREGmiNg30TGlILD..', NULL, '2025-02-18 21:37:31', '2025-02-18 21:37:31');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
