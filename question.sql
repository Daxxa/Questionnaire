-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3003
-- Время создания: Мар 18 2019 г., 17:18
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `question`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anon_answers`
--

CREATE TABLE `anon_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `poll_id` int(10) UNSIGNED NOT NULL,
  `count` int(11) NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `anon_answers`
--

INSERT INTO `anon_answers` (`id`, `poll_id`, `count`, `answer_id`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 1, '2019-02-01 09:25:31', '2019-02-01 09:25:31'),
(7, 1, 2, 5, '2019-02-01 09:25:31', '2019-02-01 09:25:31'),
(8, 1, 3, 6, '2019-02-01 09:25:31', '2019-02-01 09:25:31'),
(9, 1, 1, 4, '2019-02-01 09:29:18', '2019-02-01 09:29:18'),
(10, 2, 1, 10, '2019-02-15 06:44:33', '2019-02-15 06:44:33'),
(11, 2, 1, 13, '2019-02-15 06:44:33', '2019-02-15 06:44:33'),
(12, 2, 1, 15, '2019-02-15 06:44:33', '2019-02-15 06:44:33'),
(13, 1, 1, 7, '2019-02-18 05:03:57', '2019-02-18 05:03:57'),
(28, 13, 1, 30, '2019-03-17 09:26:00', '2019-03-17 09:26:00'),
(29, 13, 1, 31, '2019-03-17 09:26:00', '2019-03-17 09:26:00'),
(30, 13, 1, 33, '2019-03-17 09:26:00', '2019-03-17 09:26:00'),
(31, 13, 1, 35, '2019-03-17 09:26:00', '2019-03-17 09:26:00'),
(32, 13, 1, 37, '2019-03-17 09:26:00', '2019-03-17 09:26:00'),
(33, 16, 2, 46, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(34, 16, 2, 47, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(35, 16, 1, 48, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(36, 16, 1, 51, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(37, 16, 5, 54, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(38, 16, 5, 59, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(39, 16, 5, 39, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(40, 16, 5, 42, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(41, 16, 3, 45, '2019-03-18 11:58:38', '2019-03-18 11:58:38'),
(42, 16, 1, 49, '2019-03-18 11:58:39', '2019-03-18 11:58:39'),
(43, 16, 4, 50, '2019-03-18 11:58:39', '2019-03-18 11:58:39'),
(44, 16, 1, 52, '2019-03-18 11:58:39', '2019-03-18 11:58:39'),
(45, 16, 3, 44, '2019-03-18 11:58:39', '2019-03-18 11:58:39');

-- --------------------------------------------------------

--
-- Структура таблицы `answer`
--

CREATE TABLE `answer` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `answer`
--

INSERT INTO `answer` (`id`, `title`, `type`, `question_id`, `created_at`, `updated_at`) VALUES
(1, 'Answer 1', 'checkbox', 9, '2019-01-29 11:38:23', '2019-01-29 15:36:16'),
(2, 'Answer 2', 'checkbox', 9, '2019-01-29 11:54:49', '2019-01-29 11:54:49'),
(4, 'Answer 1 Q2', 'radiobutton', 19, '2019-01-30 17:22:04', '2019-01-30 17:22:04'),
(5, 'Answer 2 Q2', 'radiobutton', 19, '2019-01-30 17:22:16', '2019-01-30 17:22:16'),
(6, 'Answer 1 Input Q2', 'input', 21, '2019-01-30 17:23:42', '2019-01-30 17:23:42'),
(7, 'Answer 1 Q4', 'checkbox', 22, '2019-02-01 10:17:57', '2019-02-01 10:17:57'),
(8, 'Answer 2 Q4', 'checkbox', 22, '2019-02-01 10:18:08', '2019-02-01 10:18:08'),
(9, 'Answer 3 Q4', 'checkbox', 22, '2019-02-01 10:18:20', '2019-02-01 10:18:20'),
(10, 'I dont know', 'radiobutton', 5, '2019-02-01 11:14:36', '2019-02-01 11:14:36'),
(11, 'Because of something', 'radiobutton', 5, '2019-02-01 11:14:52', '2019-02-01 11:14:52'),
(12, 'Haha. It isn`t possible', 'radiobutton', 5, '2019-02-01 11:15:13', '2019-02-01 11:15:28'),
(13, 'Write it', 'input', 10, '2019-02-01 11:16:10', '2019-02-01 11:16:10'),
(14, 'Cat', 'checkbox', 12, '2019-02-01 11:16:29', '2019-02-01 11:16:29'),
(15, 'Dog', 'checkbox', 12, '2019-02-01 11:16:34', '2019-02-01 11:16:34'),
(16, 'Chicken', 'checkbox', 12, '2019-02-01 11:16:40', '2019-02-01 11:16:40'),
(17, 'Else', 'checkbox', 12, '2019-02-01 11:16:48', '2019-02-01 11:16:48'),
(19, 'You are my friend', 'radiobutton', 23, '2019-02-19 06:29:24', '2019-02-19 06:29:24'),
(20, 'You are boy', 'radiobutton', 23, '2019-02-19 06:29:33', '2019-02-19 06:29:33'),
(21, 'You are girl', 'radiobutton', 23, '2019-02-19 06:29:43', '2019-02-19 06:29:43'),
(22, 'Cats', 'checkbox', 24, '2019-02-19 06:31:20', '2019-02-19 06:31:20'),
(23, 'Dogs', 'checkbox', 24, '2019-02-19 06:31:31', '2019-02-19 06:31:31'),
(24, 'Rabbits', 'checkbox', 24, '2019-02-19 06:32:02', '2019-02-19 06:32:02'),
(25, 'Write your opinion.', 'input', 25, '2019-02-19 06:33:03', '2019-02-19 06:33:03'),
(26, 'Red', 'radiobutton', 26, '2019-03-10 16:57:03', '2019-03-10 16:57:03'),
(27, 'Blue', 'radiobutton', 26, '2019-03-10 16:57:11', '2019-03-10 16:57:11'),
(28, 'Pink', 'radiobutton', 26, '2019-03-10 16:57:21', '2019-03-10 16:57:21'),
(29, 'Green', 'radiobutton', 26, '2019-03-10 16:57:31', '2019-03-10 16:57:31'),
(30, 'Відповідь 1', 'checkbox', 30, '2019-03-17 09:17:22', '2019-03-17 09:17:22'),
(31, 'Відповідь 2', 'checkbox', 30, '2019-03-17 09:17:42', '2019-03-17 09:17:42'),
(32, 'Відповідь 1', 'radiobutton', 31, '2019-03-17 09:19:00', '2019-03-17 09:19:00'),
(33, 'Відповідь 2', 'radiobutton', 31, '2019-03-17 09:19:12', '2019-03-17 09:19:12'),
(34, 'Відповідь 3', 'radiobutton', 31, '2019-03-17 09:19:23', '2019-03-17 09:19:23'),
(35, 'Відповідь 1', 'input', 28, '2019-03-17 09:19:44', '2019-03-17 09:19:44'),
(36, 'Відповідь 1', 'radiobutton', 29, '2019-03-17 09:20:10', '2019-03-17 09:20:10'),
(37, 'Відповідь 2', 'radiobutton', 29, '2019-03-17 09:20:17', '2019-03-17 09:20:17'),
(38, 'Жінка', 'radiobutton', 32, '2019-03-18 11:30:59', '2019-03-18 11:30:59'),
(39, 'Чоловік', 'radiobutton', 32, '2019-03-18 11:31:06', '2019-03-18 11:31:06'),
(40, 'менше 18', 'radiobutton', 33, '2019-03-18 11:31:46', '2019-03-18 11:31:46'),
(41, '18-25', 'radiobutton', 33, '2019-03-18 11:31:54', '2019-03-18 11:31:54'),
(42, '25-35', 'radiobutton', 33, '2019-03-18 11:32:01', '2019-03-18 11:32:01'),
(43, '35-45', 'radiobutton', 33, '2019-03-18 11:32:09', '2019-03-18 11:32:09'),
(44, 'більше 45', 'radiobutton', 33, '2019-03-18 11:32:16', '2019-03-18 11:32:16'),
(45, 'Інформація від виробника', 'checkbox', 34, '2019-03-18 11:35:17', '2019-03-18 11:35:17'),
(46, 'Особистий досвід', 'checkbox', 34, '2019-03-18 11:35:26', '2019-03-18 11:35:26'),
(47, 'Відгуки покупців', 'checkbox', 34, '2019-03-18 11:35:36', '2019-03-18 11:35:36'),
(48, 'Реклама', 'checkbox', 34, '2019-03-18 11:35:44', '2019-03-18 11:35:44'),
(49, 'Статті спеціалістів', 'checkbox', 34, '2019-03-18 11:35:54', '2019-03-18 11:35:54'),
(50, 'Інше', 'checkbox', 34, '2019-03-18 11:36:01', '2019-03-18 11:36:01'),
(51, 'Так', 'radiobutton', 35, '2019-03-18 11:37:04', '2019-03-18 11:37:04'),
(52, 'Ні', 'radiobutton', 35, '2019-03-18 11:37:12', '2019-03-18 11:37:12'),
(53, 'Електронна пошта', 'checkbox', 36, '2019-03-18 11:40:15', '2019-03-18 11:40:15'),
(54, 'Інтернет', 'checkbox', 36, '2019-03-18 11:40:26', '2019-03-18 11:40:26'),
(55, 'Зовнішня реклама', 'checkbox', 36, '2019-03-18 11:40:41', '2019-03-18 11:40:41'),
(56, 'Друкована реклама', 'checkbox', 36, '2019-03-18 11:40:56', '2019-03-18 11:40:56'),
(57, 'Радіо', 'checkbox', 36, '2019-03-18 11:41:03', '2019-03-18 11:41:03'),
(58, 'Інше', 'checkbox', 36, '2019-03-18 11:41:09', '2019-03-18 11:41:09'),
(59, 'Ваше відношення до реклами', 'input', 37, '2019-03-18 11:42:39', '2019-03-18 11:42:39'),
(60, 'Зовнішня реклама', 'checkbox', 38, '2019-03-18 12:11:42', '2019-03-18 12:11:42'),
(61, 'Друкована реклама', 'checkbox', 38, '2019-03-18 12:12:07', '2019-03-18 12:12:07'),
(62, 'Інтернет', 'checkbox', 38, '2019-03-18 12:12:14', '2019-03-18 12:12:14'),
(63, 'Інший варіант', 'checkbox', 38, '2019-03-18 12:12:22', '2019-03-18 12:12:22'),
(64, 'Часто, я постійний клієнт', 'radiobutton', 39, '2019-03-18 12:14:23', '2019-03-18 12:14:23'),
(65, 'Час від часу', 'radiobutton', 39, '2019-03-18 12:14:33', '2019-03-18 12:14:33'),
(66, 'Зробив покупку вперше', 'radiobutton', 39, '2019-03-18 12:14:54', '2019-03-18 12:14:54'),
(67, 'Активна реклама', 'checkbox', 40, '2019-03-18 12:16:14', '2019-03-18 12:16:14'),
(68, 'Рекомендації друзів', 'checkbox', 40, '2019-03-18 12:16:26', '2019-03-18 12:16:26'),
(69, 'Репутація на ринку', 'checkbox', 40, '2019-03-18 12:16:42', '2019-03-18 12:16:42'),
(70, 'Другий параметр', 'checkbox', 40, '2019-03-18 12:16:57', '2019-03-18 12:16:57');

-- --------------------------------------------------------

--
-- Структура таблицы `comment_answer`
--

CREATE TABLE `comment_answer` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anon_answer_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comment_answer`
--

INSERT INTO `comment_answer` (`id`, `text`, `anon_answer_id`, `created_at`, `updated_at`) VALUES
(18, 'Some text here', 8, '2019-02-01 09:25:31', '2019-02-01 09:25:31'),
(19, 'Some new text', 8, '2019-02-01 09:29:18', '2019-02-01 09:29:18'),
(20, 'Nothing', 11, '2019-02-15 06:44:33', '2019-02-15 06:44:33'),
(21, 'ghghshhghjs', 8, '2019-02-18 05:03:57', '2019-02-18 05:03:57'),
(27, 'Відкрита відповідь', 31, '2019-03-17 09:26:00', '2019-03-17 09:26:00'),
(28, 'Позитивне, вона є необхідною в наш час.', 38, '2019-03-18 11:57:56', '2019-03-18 11:57:56'),
(29, 'Негативне, вона непотрібна, вводить в оману', 38, '2019-03-18 11:58:39', '2019-03-18 11:58:39');

-- --------------------------------------------------------

--
-- Структура таблицы `included_polls`
--

CREATE TABLE `included_polls` (
  `id` int(10) UNSIGNED NOT NULL,
  `poll_id` int(10) UNSIGNED NOT NULL,
  `included_poll_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `included_polls`
--

INSERT INTO `included_polls` (`id`, `poll_id`, `included_poll_id`, `created_at`, `updated_at`) VALUES
(23, 13, 14, '2019-03-17 08:43:01', '2019-03-17 08:43:01'),
(24, 16, 15, '2019-03-18 11:34:12', '2019-03-18 11:34:12'),
(25, 17, 15, '2019-03-18 12:17:28', '2019-03-18 12:17:28');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(8, '2019_01_18_140355_entrust_setup_tables', 2),
(9, '2019_01_18_173836_create_pulls_table', 3),
(17, '2019_01_18_174414_create_questions_table', 4),
(20, '2019_01_28_082458_create_answers_table', 5),
(21, '2019_01_28_085542_create_included_polls_table', 5),
(22, '2019_01_28_091044_create_anon_answers_table', 6),
(23, '2019_01_28_083842_create_comment_answers_table', 7),
(24, '2019_01_30_112704_crate_url_table', 8);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('ggg@gmail.com', '$2y$10$ySDX0BHU.13JqjhEsePxq./ZLcV2Vi4xW0CacwIdYhycQKQvl0ZrS', '2019-03-10 16:52:40');

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'create-poll', 'Create Polls', 'create new polls', '2019-01-22 10:52:55', '2019-01-22 10:52:55');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `poll`
--

CREATE TABLE `poll` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `poll`
--

INSERT INTO `poll` (`id`, `title`, `text`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Some title', 'Some description and more and more1', 1, '2019-01-18 18:10:56', '2019-01-29 09:21:17'),
(2, 'New one', 'How are you?', 1, '2019-01-18 18:39:34', '2019-01-21 08:35:46'),
(13, 'Назва опитування', 'Опист опитування', 3, '2019-03-17 08:36:35', '2019-03-17 08:36:35'),
(14, 'Назва опитування 2', 'Опис опитування 2', 3, '2019-03-17 08:38:28', '2019-03-17 08:38:28'),
(15, 'Загальні питання', 'Для включення в інші питання', 2, '2019-03-18 11:30:24', '2019-03-18 11:30:24'),
(16, 'РІвень довіри до реклами', 'Визначення рівня довіри до реклами', 2, '2019-03-18 11:34:01', '2019-03-18 11:34:01'),
(17, 'Оцінка якості роботи продуктової компанії', 'Оцінка якості продуктової компанії', 2, '2019-03-18 12:10:26', '2019-03-18 12:17:14');

-- --------------------------------------------------------

--
-- Структура таблицы `question`
--

CREATE TABLE `question` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `question`
--

INSERT INTO `question` (`id`, `title`, `text`, `poll_id`, `created_at`, `updated_at`) VALUES
(5, 'Question one', 'How is this possible?', 2, '2019-01-21 13:53:06', '2019-01-21 15:57:32'),
(9, 'FirstQ title', 'text first question', 1, '2019-01-21 13:57:11', '2019-01-30 16:58:46'),
(10, 'The second question', 'What are you doing?', 2, '2019-01-21 14:35:58', '2019-01-21 15:58:18'),
(12, 'The third question', 'Can you imagine it', 2, '2019-01-21 14:36:13', '2019-01-21 15:59:56'),
(19, 'Second question title', 'text second question', 1, '2019-01-29 09:38:58', '2019-01-30 16:13:20'),
(21, 'Third question', 'Some text Q2', 1, '2019-01-30 17:23:22', '2019-01-30 17:23:22'),
(22, 'Fourth Question Title', 'Fourth Question Text', 1, '2019-02-01 10:17:19', '2019-02-01 10:17:19'),
(23, 'Do you know me?', 'Do you know my name?', 3, '2019-02-19 06:20:17', '2019-02-19 06:20:17'),
(24, 'I like..', 'I like...', 3, '2019-02-19 06:30:58', '2019-02-19 06:30:58'),
(25, 'What do you think about me?', 'Your opinion about me.', 3, '2019-02-19 06:32:37', '2019-02-19 06:32:37'),
(26, 'My favorite color is...', 'What color is my favorite?', 4, '2019-03-10 16:56:43', '2019-03-10 16:56:43'),
(27, 'My fav', 'ffdflkdsf', 4, '2019-03-10 16:57:56', '2019-03-10 16:57:56'),
(28, 'Включене питання 1', 'Опис включеного питання', 14, '2019-03-17 08:40:54', '2019-03-17 08:40:54'),
(29, 'Включене питання 2', 'Опис включеного питання 2', 14, '2019-03-17 08:41:37', '2019-03-17 08:41:37'),
(30, 'Назва питання 1', 'Опис питання', 13, '2019-03-17 08:42:37', '2019-03-17 08:42:37'),
(31, 'Назва питання 2', 'Опис питання 2', 13, '2019-03-17 08:42:57', '2019-03-17 08:42:57'),
(32, 'Ваша стать?', 'Стать', 15, '2019-03-18 11:30:47', '2019-03-18 11:30:47'),
(33, 'Ваш вік.', 'Ваш вік?', 15, '2019-03-18 11:31:30', '2019-03-18 11:31:30'),
(34, 'Якими джерелами ви користуєтеся при виборі товару?', 'Які джерела використовуються при вибору товару', 16, '2019-03-18 11:34:58', '2019-03-18 11:34:58'),
(35, 'Чи ви вибираєте  увагу на рекламу при виборі товару?', 'Звернення уваги на рекламу при виборі товару', 16, '2019-03-18 11:36:49', '2019-03-18 11:36:49'),
(36, 'З яких джерел ви дізнаєтеся  інформацію про товари', 'З яких джерел ви дізнаєтеся  інформацію про товари', 16, '2019-03-18 11:39:52', '2019-03-18 11:39:52'),
(37, 'Як  ви відноситися до реклами товарів та послуг?', 'Ваше відношення до реклами та послуг', 16, '2019-03-18 11:42:01', '2019-03-18 11:42:01'),
(38, 'Звідки ви взнали про наш магазин?', 'Звідки ви взнали про наш магазин?', 17, '2019-03-18 12:11:25', '2019-03-18 12:11:25'),
(39, 'Як часто ви купуєте у нас товари?', 'Частота купування товарів', 17, '2019-03-18 12:13:38', '2019-03-18 12:13:38'),
(40, 'Які параметри стали  для вас головними при виборі товарів?', 'Головні парамитри вибору товару', 17, '2019-03-18 12:15:57', '2019-03-18 12:15:57');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'client', 'client', 'User is allowed to create, edit, delete own pulls', '2019-01-21 08:25:27', '2019-01-21 08:25:27');

-- --------------------------------------------------------

--
-- Структура таблицы `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `url`
--

CREATE TABLE `url` (
  `id` int(10) UNSIGNED NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `poll_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `url`
--

INSERT INTO `url` (`id`, `url`, `poll_id`, `created_at`, `updated_at`) VALUES
(1, 'fd5f6s5fdg2sni5', 1, '2019-01-30 07:22:43', '2019-01-30 08:12:08'),
(2, 'ecf8f24ef48ef5386207a751ca28c13a', 1, '2019-02-01 10:43:30', '2019-02-01 10:43:30'),
(3, '51c6d814b384f0eec9355a45ba121da1', 1, '2019-02-01 10:48:28', '2019-02-01 10:48:28'),
(4, '43ebbb678d2ac7bc7876dee33005ccea', 1, '2019-02-01 10:49:04', '2019-02-01 10:49:04'),
(5, 'ad37b1fe3de9d84a22e605f2c5da38e3', 1, '2019-02-01 10:49:14', '2019-02-01 10:49:14'),
(6, 'b954e20b5999106c04abd4d28b00d07e', 1, '2019-02-01 10:49:30', '2019-02-01 10:49:30'),
(7, '21f34a14a3cd7377b32e7140e5979ed1', 1, '2019-02-01 10:49:32', '2019-02-01 10:49:32'),
(8, '8a4f35a7aeeee855089764a26e3efd3d', 1, '2019-02-01 10:53:10', '2019-02-01 10:53:10'),
(9, '3084374a557b5a3ab0e4f66976103329', 1, '2019-02-01 11:02:50', '2019-02-01 11:02:50'),
(10, 'f0ccd9aead06a57b8dadd93dbc0fcbc4', 1, '2019-02-02 11:54:14', '2019-02-02 11:54:14'),
(11, '81d11b2ca1625bfb4f3d835a85511cc5', 1, '2019-02-14 06:14:00', '2019-02-14 06:14:00'),
(12, '2f9bd86de676f2e7e5ae5671cc3f51be', 1, '2019-02-14 19:43:07', '2019-02-14 19:43:07'),
(13, 'cc4051821d045523e9d71421c3a053d0', 1, '2019-02-14 19:44:49', '2019-02-14 19:44:49'),
(14, 'f6151e9b2ad855dd1534291410654fdb', 1, '2019-02-14 19:45:38', '2019-02-14 19:45:38'),
(15, '70b416971ec1206b5cef154941ffd11c', 1, '2019-02-14 19:46:06', '2019-02-14 19:46:06'),
(16, '33c4aeba1b949ea8053bc399886d82a4', 1, '2019-02-14 19:47:04', '2019-02-14 19:47:04'),
(17, '0a83f1fdef6a1763e988f819f0d91240', 1, '2019-02-14 19:47:23', '2019-02-14 19:47:23'),
(18, '7f8f7d503f2cb9321622c52cf6480c86', 1, '2019-02-14 19:48:57', '2019-02-14 19:48:57'),
(19, '9cc8145a3c730890f4c551df66add5e3', 1, '2019-02-14 19:49:47', '2019-02-14 19:49:47'),
(20, 'b7db29508c4348638ad2b005b0e4769d', 1, '2019-02-14 19:51:54', '2019-02-14 19:51:54'),
(21, '7a9e081e6b42b758ffd9d8531ec4182c', 1, '2019-02-14 19:52:17', '2019-02-14 19:52:17'),
(22, '0e9502f36c317a81842df638df0426ea', 1, '2019-02-14 19:52:36', '2019-02-14 19:52:36'),
(23, 'babcf0a395004c4b188cdc7d18c4007d', 1, '2019-02-14 20:46:37', '2019-02-14 20:46:37'),
(24, 'f350c98ff258fdb71fc9ca37c36721dd', 1, '2019-02-15 06:11:58', '2019-02-15 06:11:58'),
(25, 'a01759d046adc0f050bd08b2dc51214f', 2, '2019-02-15 06:38:30', '2019-02-15 06:38:30'),
(26, '97c3bb9cd025114b02d3bf624b5c3540', 1, '2019-02-15 07:08:57', '2019-02-15 07:08:57'),
(27, 'a404e7114224fdeafad8fde19d0a3f84', 1, '2019-02-15 07:10:50', '2019-02-15 07:10:50'),
(28, '7b00c6c7a9cd9862f1743316e8c807e0', 2, '2019-02-15 07:11:01', '2019-02-15 07:11:01'),
(29, '94d732aadd6b8016119c96458862eba7', 2, '2019-02-18 05:02:29', '2019-02-18 05:02:29'),
(30, 'a060ed63d022867de703b5e8f945493a', 1, '2019-02-18 05:03:40', '2019-02-18 05:03:40'),
(40, 'cf6e4cfc7d985c7afc290664bb2a8125', 13, '2019-03-17 09:20:34', '2019-03-17 09:20:34'),
(41, '9eb0b0cf1126d633d3676b07c253481e', 13, '2019-03-18 07:40:31', '2019-03-18 07:40:31'),
(42, '20b01b8a9cc6c7035b3f3d089e878b41', 13, '2019-03-18 07:48:43', '2019-03-18 07:48:43'),
(43, 'cce4d73f2c9e614b3ad49ff0ad8ecd75', 16, '2019-03-18 11:57:13', '2019-03-18 11:57:13');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'daria', 'ggg@gmail.com', '$2y$10$fVncqIuW4AQrQTjxzaVZDuxFO./dliCcgMBoWd/4fJl21ZqCQ8Vle', 'hK4WDhn6iuIGmBE0Gv8A4OmVJTxB7PZVSPNEaiBLRZsc4crIfjmS3pAKYYqS', '2019-01-18 11:54:42', '2019-01-18 11:54:42'),
(2, 'Alex', 'alex@gmail.com', '$2y$10$eYPfxDuzYu4.N5WR./SXTOiYKa4hPhBbHlTYYSnIfUtl8T5dbXwwm', 'A3ky5Zb2CiGe0lPHScedQJUFYR2HHeznsFC7PtgWhCQLQTQRynxRzw4VO7A0', '2019-02-19 06:09:53', '2019-02-19 06:09:53'),
(3, 'Olya', 'olya@gmail.com', '$2y$10$qBtsmg2Zec3Z2BpMtTR.gumY/jQpoSy0Oko5gbpy.MRky/AjXcrNO', 'VWlhrtmcpBEHjIcs61yoAoIklxfyDstskHRkruTLwc07p1HUfppTkHfnDjMm', '2019-02-19 06:10:25', '2019-02-19 06:10:25');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anon_answers`
--
ALTER TABLE `anon_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anon_answers_poll_id_foreign` (`poll_id`),
  ADD KEY `anon_answers_answer_id_foreign` (`answer_id`);

--
-- Индексы таблицы `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answer_question_id_foreign` (`question_id`);

--
-- Индексы таблицы `comment_answer`
--
ALTER TABLE `comment_answer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_answer_anon_answer_id_foreign` (`anon_answer_id`);

--
-- Индексы таблицы `included_polls`
--
ALTER TABLE `included_polls`
  ADD PRIMARY KEY (`id`),
  ADD KEY `included_polls_poll_id_foreign` (`poll_id`),
  ADD KEY `included_polls_included_poll_id_foreign` (`included_poll_id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `poll`
--
ALTER TABLE `poll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `poll_user_id_foreign` (`user_id`);

--
-- Индексы таблицы `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Индексы таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `url`
--
ALTER TABLE `url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url_poll_id_foreign` (`poll_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `anon_answers`
--
ALTER TABLE `anon_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT для таблицы `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
--
-- AUTO_INCREMENT для таблицы `comment_answer`
--
ALTER TABLE `comment_answer`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT для таблицы `included_polls`
--
ALTER TABLE `included_polls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `poll`
--
ALTER TABLE `poll`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT для таблицы `question`
--
ALTER TABLE `question`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT для таблицы `url`
--
ALTER TABLE `url`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `anon_answers`
--
ALTER TABLE `anon_answers`
  ADD CONSTRAINT `anon_answers_answer_id_foreign` FOREIGN KEY (`answer_id`) REFERENCES `answer` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `anon_answers_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `answer`
--
ALTER TABLE `answer`
  ADD CONSTRAINT `answer_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `question` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comment_answer`
--
ALTER TABLE `comment_answer`
  ADD CONSTRAINT `comment_answer_anon_answer_id_foreign` FOREIGN KEY (`anon_answer_id`) REFERENCES `anon_answers` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `included_polls`
--
ALTER TABLE `included_polls`
  ADD CONSTRAINT `included_polls_included_poll_id_foreign` FOREIGN KEY (`included_poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `included_polls_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `poll`
--
ALTER TABLE `poll`
  ADD CONSTRAINT `poll_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `url`
--
ALTER TABLE `url`
  ADD CONSTRAINT `url_poll_id_foreign` FOREIGN KEY (`poll_id`) REFERENCES `poll` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
