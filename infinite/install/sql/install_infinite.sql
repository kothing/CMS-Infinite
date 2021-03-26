-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 15, 2020 at 06:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;

--
-- Database: `install_infinite`
--

-- --------------------------------------------------------

--
-- Table structure for table `ad_spaces`
--

CREATE TABLE `ad_spaces` (
  `id` int(11) NOT NULL,
  `ad_space` text DEFAULT NULL,
  `ad_code_728` text DEFAULT NULL,
  `ad_code_468` text DEFAULT NULL,
  `ad_code_300` text DEFAULT NULL,
  `ad_code_234` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ad_spaces`
--

INSERT INTO `ad_spaces` (`id`, `ad_space`, `ad_code_728`, `ad_code_468`, `ad_code_300`, `ad_code_234`) VALUES
(1, 'index_top', NULL, NULL, NULL, NULL),
(2, 'index_bottom', NULL, NULL, NULL, NULL),
(3, 'post_top', NULL, NULL, NULL, NULL),
(4, 'post_bottom', NULL, NULL, NULL, NULL),
(5, 'category_top', NULL, NULL, NULL, NULL),
(6, 'category_bottom', NULL, NULL, NULL, NULL),
(7, 'tag_top', NULL, NULL, NULL, NULL),
(8, 'tag_bottom', NULL, NULL, NULL, NULL),
(9, 'search_top', NULL, NULL, NULL, NULL),
(10, 'search_bottom', NULL, NULL, NULL, NULL),
(11, 'profile_top', NULL, NULL, NULL, NULL),
(12, 'profile_bottom', NULL, NULL, NULL, NULL),
(13, 'reading_list_top', NULL, NULL, NULL, NULL),
(14, 'reading_list_bottom', NULL, NULL, NULL, NULL),
(15, 'sidebar_top', NULL, NULL, NULL, NULL),
(16, 'sidebar_bottom', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `name` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `category_order` smallint(6) DEFAULT NULL,
  `show_on_menu` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `comment` varchar(5000) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` varchar(5000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE `followers` (
  `id` int(11) NOT NULL,
  `following_id` int(11) DEFAULT NULL,
  `follower_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

CREATE TABLE `fonts` (
  `id` int(11) NOT NULL,
  `font_name` varchar(255) DEFAULT NULL,
  `font_url` varchar(2000) DEFAULT NULL,
  `font_family` varchar(500) DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`id`, `font_name`, `font_url`, `font_family`, `is_default`) VALUES
(1, 'Arial', NULL, 'font-family: Arial, Helvetica, sans-serif', 1),
(2, 'Arvo', '<link href=\"https://fonts.googleapis.com/css?family=Arvo:400,700&display=swap\" rel=\"stylesheet\">\r\n', 'font-family: \"Arvo\", Helvetica, sans-serif', 0),
(3, 'Averia Libre', '<link href=\"https://fonts.googleapis.com/css?family=Averia+Libre:300,400,700&display=swap\" rel=\"stylesheet\">\r\n', 'font-family: \"Averia Libre\", Helvetica, sans-serif', 0),
(4, 'Bitter', '<link href=\"https://fonts.googleapis.com/css?family=Bitter:400,400i,700&display=swap&subset=latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Bitter\", Helvetica, sans-serif', 0),
(5, 'Cabin', '<link href=\"https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap&subset=latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Cabin\", Helvetica, sans-serif', 0),
(6, 'Cherry Swash', '<link href=\"https://fonts.googleapis.com/css?family=Cherry+Swash:400,700&display=swap&subset=latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Cherry Swash\", Helvetica, sans-serif', 0),
(7, 'Encode Sans', '<link href=\"https://fonts.googleapis.com/css?family=Encode+Sans:300,400,500,600,700&display=swap&subset=latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Encode Sans\", Helvetica, sans-serif', 0),
(8, 'Helvetica', NULL, 'font-family: Helvetica, sans-serif', 1),
(9, 'Hind', '<link href=\"https://fonts.googleapis.com/css?family=Hind:300,400,500,600,700&display=swap&subset=devanagari,latin-ext\" rel=\"stylesheet\">', 'font-family: \"Hind\", Helvetica, sans-serif', 0),
(10, 'Josefin Sans', '<link href=\"https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,600,700&display=swap&subset=latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Josefin Sans\", Helvetica, sans-serif', 0),
(11, 'Kalam', '<link href=\"https://fonts.googleapis.com/css?family=Kalam:300,400,700&display=swap&subset=devanagari,latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Kalam\", Helvetica, sans-serif', 0),
(12, 'Khula', '<link href=\"https://fonts.googleapis.com/css?family=Khula:300,400,600,700&display=swap&subset=devanagari,latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Khula\", Helvetica, sans-serif', 0),
(13, 'Lato', '<link href=\"https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap&subset=latin-ext\" rel=\"stylesheet\">', 'font-family: \"Lato\", Helvetica, sans-serif', 0),
(14, 'Lora', '<link href=\"https://fonts.googleapis.com/css?family=Lora:400,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Lora\", Helvetica, sans-serif', 0),
(15, 'Merriweather', '<link href=\"https://fonts.googleapis.com/css?family=Merriweather:300,400,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Merriweather\", Helvetica, sans-serif', 0),
(16, 'Montserrat', '<link href=\"https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Montserrat\", Helvetica, sans-serif', 0),
(17, 'Mukta', '<link href=\"https://fonts.googleapis.com/css?family=Mukta:300,400,500,600,700&display=swap&subset=devanagari,latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Mukta\", Helvetica, sans-serif', 0),
(18, 'Nunito', '<link href=\"https://fonts.googleapis.com/css?family=Nunito:300,400,600,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Nunito\", Helvetica, sans-serif', 0),
(19, 'Open Sans', '<link href=\"https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese\" rel=\"stylesheet\">', 'font-family: \"Open Sans\", Helvetica, sans-serif', 0),
(20, 'Oswald', '<link href=\"https://fonts.googleapis.com/css?family=Oswald:300,400,500,600,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext,vietnamese\" rel=\"stylesheet\">', 'font-family: \"Oswald\", Helvetica, sans-serif', 0),
(21, 'Oxygen', '<link href=\"https://fonts.googleapis.com/css?family=Oxygen:300,400,700&display=swap&subset=latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Oxygen\", Helvetica, sans-serif', 0),
(22, 'Poppins', '<link href=\"https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap&subset=devanagari,latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Poppins\", Helvetica, sans-serif', 0),
(23, 'PT Sans', '<link href=\"https://fonts.googleapis.com/css?family=PT+Sans:400,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"PT Sans\", Helvetica, sans-serif', 0),
(24, 'Raleway', '<link href=\"https://fonts.googleapis.com/css?family=Raleway:300,400,500,600,700&display=swap&subset=latin-ext\" rel=\"stylesheet\">\r\n', 'font-family: \"Raleway\", Helvetica, sans-serif', 0),
(25, 'Roboto', '<link href=\"https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese\" rel=\"stylesheet\">', 'font-family: \"Roboto\", Helvetica, sans-serif', 0),
(26, 'Roboto Condensed', '<link href=\"https://fonts.googleapis.com/css?family=Roboto+Condensed:300,400,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Roboto Condensed\", Helvetica, sans-serif', 0),
(27, 'Roboto Slab', '<link href=\"https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,500,600,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Roboto Slab\", Helvetica, sans-serif', 0),
(28, 'Rokkitt', '<link href=\"https://fonts.googleapis.com/css?family=Rokkitt:300,400,500,600,700&display=swap&subset=latin-ext,vietnamese\" rel=\"stylesheet\">\r\n', 'font-family: \"Rokkitt\", Helvetica, sans-serif', 0),
(29, 'Source Sans Pro', '<link href=\"https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese\" rel=\"stylesheet\">', 'font-family: \"Source Sans Pro\", Helvetica, sans-serif', 0),
(30, 'Titillium Web', '<link href=\"https://fonts.googleapis.com/css?family=Titillium+Web:300,400,600,700&display=swap&subset=latin-ext\" rel=\"stylesheet\">', 'font-family: \"Titillium Web\", Helvetica, sans-serif', 0),
(31, 'Ubuntu', '<link href=\"https://fonts.googleapis.com/css?family=Ubuntu:300,400,500,700&display=swap&subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext\" rel=\"stylesheet\">', 'font-family: \"Ubuntu\", Helvetica, sans-serif', 0),
(32, 'Verdana', NULL, 'font-family: Verdana, Helvetica, sans-serif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gallery_albums`
--

CREATE TABLE `gallery_albums` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `gallery_categories`
--

CREATE TABLE `gallery_categories` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `name` varchar(255) DEFAULT NULL,
  `album_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `site_lang` tinyint(4) NOT NULL DEFAULT 1,
  `layout` varchar(30) DEFAULT 'layout_1',
  `dark_mode` tinyint(1) DEFAULT 0,
  `timezone` varchar(255) DEFAULT 'America/New_York',
  `slider_active` tinyint(1) DEFAULT 1,
  `site_color` varchar(30) DEFAULT 'default',
  `show_pageviews` tinyint(1) DEFAULT 1,
  `show_rss` tinyint(1) DEFAULT 1,
  `file_manager_show_all_files` tinyint(1) DEFAULT 0,
  `logo_path` varchar(255) DEFAULT NULL,
  `mobile_logo_path` varchar(255) DEFAULT NULL,
  `favicon_path` varchar(255) DEFAULT NULL,
  `facebook_app_id` varchar(500) DEFAULT NULL,
  `facebook_app_secret` varchar(500) DEFAULT NULL,
  `google_client_id` varchar(500) DEFAULT NULL,
  `google_client_secret` varchar(500) DEFAULT NULL,
  `google_analytics` text DEFAULT NULL,
  `google_adsense_code` text DEFAULT NULL,
  `mail_library` varchar(100) DEFAULT 'swift',
  `mail_protocol` varchar(100) DEFAULT 'smtp',
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT '587',
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_title` varchar(255) DEFAULT NULL,
  `send_email_contact_messages` tinyint(1) DEFAULT 0,
  `mail_options_account` varchar(255) DEFAULT NULL,
  `facebook_comment` text DEFAULT NULL,
  `pagination_per_page` tinyint(4) DEFAULT 6,
  `menu_limit` tinyint(4) DEFAULT 5,
  `multilingual_system` tinyint(1) DEFAULT 1,
  `registration_system` tinyint(1) DEFAULT 1,
  `comment_system` tinyint(1) DEFAULT 1,
  `comment_approval_system` tinyint(1) DEFAULT 1,
  `approve_posts_before_publishing` tinyint(1) DEFAULT 1,
  `emoji_reactions` tinyint(1) DEFAULT 1,
  `inf_key` varchar(500) NOT NULL,
  `purchase_code` varchar(500) NOT NULL,
  `recaptcha_site_key` varchar(500) DEFAULT NULL,
  `recaptcha_secret_key` varchar(500) DEFAULT NULL,
  `recaptcha_lang` varchar(30) DEFAULT NULL,
  `cache_system` tinyint(1) DEFAULT 0,
  `cache_refresh_time` int(11) DEFAULT 1800,
  `refresh_cache_database_changes` tinyint(1) DEFAULT 0,
  `maintenance_mode_title` varchar(500) DEFAULT 'Coming Soon! ',
  `maintenance_mode_description` varchar(5000) DEFAULT NULL,
  `maintenance_mode_status` tinyint(1) DEFAULT 0,
  `sitemap_frequency` varchar(30) DEFAULT 'monthly',
  `sitemap_last_modification` varchar(30) DEFAULT 'server_response',
  `sitemap_priority` varchar(30) DEFAULT 'automatically',
  `custom_css_codes` mediumtext DEFAULT NULL,
  `custom_javascript_codes` mediumtext DEFAULT NULL,
  `last_cron_update` timestamp NULL DEFAULT current_timestamp(),
  `version` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_lang`, `layout`, `dark_mode`, `timezone`, `slider_active`, `site_color`, `show_pageviews`, `show_rss`, `file_manager_show_all_files`, `logo_path`, `mobile_logo_path`, `favicon_path`, `facebook_app_id`, `facebook_app_secret`, `google_client_id`, `google_client_secret`, `google_analytics`, `google_adsense_code`, `mail_library`, `mail_protocol`, `mail_host`, `mail_port`, `mail_username`, `mail_password`, `mail_title`, `send_email_contact_messages`, `mail_options_account`, `facebook_comment`, `pagination_per_page`, `menu_limit`, `multilingual_system`, `registration_system`, `comment_system`, `comment_approval_system`, `approve_posts_before_publishing`, `emoji_reactions`, `inf_key`, `purchase_code`, `recaptcha_site_key`, `recaptcha_secret_key`, `recaptcha_lang`, `cache_system`, `cache_refresh_time`, `refresh_cache_database_changes`, `maintenance_mode_title`, `maintenance_mode_description`, `maintenance_mode_status`, `sitemap_frequency`, `sitemap_last_modification`, `sitemap_priority`, `custom_css_codes`, `custom_javascript_codes`, `last_cron_update`, `version`) VALUES
(1, 1, 'layout_2', 0, 'America/New_York', 1, 'default', 1, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'swift', 'smtp', NULL, '587', NULL, NULL, 'Infinite', 0, NULL, NULL, 12, 7, 1, 1, 1, 1, 1, 1, '', '', NULL, NULL, 'en', 0, 1800, 0, 'Coming Soon! ', NULL, 0, 'monthly', 'server_response', 'automatically', NULL, NULL, '2020-08-03 23:58:10', '4.0.2');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mime` varchar(30) DEFAULT 'jpg',
  `file_name` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `short_form` varchar(30) NOT NULL,
  `language_code` varchar(30) NOT NULL,
  `text_direction` varchar(10) NOT NULL,
  `text_editor_lang` varchar(20) NOT NULL DEFAULT 'en',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `language_order` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `short_form`, `language_code`, `text_direction`, `text_editor_lang`, `status`, `language_order`) VALUES
(1, 'English', 'en', 'en-US', 'ltr', 'en', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `language_translations`
--

CREATE TABLE `language_translations` (
  `id` int(11) NOT NULL,
  `lang_id` smallint(6) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `translation` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language_translations`
--

INSERT INTO `language_translations` (`id`, `lang_id`, `label`, `translation`) VALUES
(1, 1, 'home', 'Home'),
(2, 1, 'gallery', 'Gallery'),
(3, 1, 'login', 'Login'),
(4, 1, 'register', 'Register'),
(5, 1, 'logout', 'Logout'),
(6, 1, 'reset_password', 'Reset Password'),
(7, 1, 'admin_panel', 'Admin Panel'),
(8, 1, 'reading_list', 'Reading List'),
(9, 1, 'change_password', 'Change Password'),
(10, 1, 'update_profile', 'Update Profile'),
(11, 1, 'tag', 'Tag'),
(12, 1, 'tags', 'Tags'),
(13, 1, 'search', 'Search'),
(14, 1, 'search_exp', 'Search...'),
(15, 1, 'email', 'Email'),
(16, 1, 'name', 'Name'),
(17, 1, 'message', 'Message'),
(18, 1, 'comment', 'Comment'),
(19, 1, 'username', 'Username'),
(20, 1, 'password', 'Password'),
(21, 1, 'confirm_password', 'Confirm Password'),
(22, 1, 'old_password', 'Old Password'),
(23, 1, 'readmore', 'Read More'),
(24, 1, 'reply', 'Reply'),
(25, 1, 'submit', 'Submit'),
(26, 1, 'subscribe', 'Subscribe'),
(27, 1, 'send_reset_link', 'Send Password Reset Link'),
(28, 1, 'change_avatar', 'Change Avatar'),
(29, 1, 'save_changes', 'Save Changes'),
(30, 1, 'delete', 'Delete'),
(31, 1, 'add_reading_list', 'Add to Reading List'),
(32, 1, 'delete_reading_list', 'Remove from Reading List'),
(33, 1, 'popular_posts', 'Popular Posts'),
(34, 1, 'our_picks', 'Our Picks'),
(35, 1, 'category', 'Category'),
(36, 1, 'categories', 'Categories'),
(37, 1, 'random_posts', 'Random Posts'),
(38, 1, 'related_posts', 'Related Posts'),
(39, 1, 'site_comments', 'Comments'),
(40, 1, 'facebook_comments', 'Facebook Comments'),
(41, 1, 'leave_reply', 'Leave a Reply'),
(42, 1, 'search_noresult', 'No results found.'),
(43, 1, 'about', 'About'),
(44, 1, 'social_media', 'Social Media'),
(45, 1, 'newsletter_exp', 'Subscribe here to get interesting stuff and updates!'),
(46, 1, 'comments', 'Comments'),
(47, 1, 'warning', 'Warning!'),
(48, 1, 'reading_list_empty', 'Your reading list is empty.'),
(49, 1, 'all', 'All'),
(50, 1, 'more', 'More'),
(51, 1, 'leave_message', 'Leave a Message'),
(52, 1, 'posts', 'Posts'),
(53, 1, 'all_posts', 'All Posts'),
(54, 1, 'rss_all_posts', 'RSS All Posts'),
(55, 1, 'load_more_comments', 'Load More Comments'),
(56, 1, 'slug', 'Slug'),
(57, 1, 'author', 'Author'),
(58, 1, 'my_posts', 'My Posts'),
(59, 1, 'January', 'Jan'),
(60, 1, 'February', 'Feb'),
(61, 1, 'March', 'Mar'),
(62, 1, 'April', 'Apr'),
(63, 1, 'May', 'May'),
(64, 1, 'June', 'Jun'),
(65, 1, 'July', 'Jul'),
(66, 1, 'August', 'Aug'),
(67, 1, 'September', 'Sep'),
(68, 1, 'October', 'Oct'),
(69, 1, 'November', 'Nov'),
(70, 1, 'December', 'Dec'),
(71, 1, 'page_not_found', 'Page not found'),
(72, 1, 'page_not_found_sub', 'The page you are looking for doesn\'t exist.'),
(73, 1, 'go_to_home', 'Go to Homepage'),
(74, 1, 'message_newsletter_success', 'Your email address has been successfully added!'),
(75, 1, 'message_newsletter_error', 'Your email address is already registered!'),
(76, 1, 'message_contact_success', 'Your message has been sent successfully!'),
(77, 1, 'message_contact_error', 'There was a problem while sending your message!'),
(78, 1, 'message_register_error', 'There was a problem during registration. Please try again!'),
(79, 1, 'message_profile', 'Profile updated successfully!'),
(80, 1, 'message_change_password', 'Your password has been successfully changed!'),
(81, 1, 'message_login_for_comment', 'You need to login to write a comment!'),
(82, 1, 'message_invalid_email', 'Invalid email address!'),
(83, 1, 'message_page_auth', 'You must be logged in to view this page!'),
(84, 1, 'message_post_auth', 'You must be logged in to view this post!'),
(85, 1, 'message_slug_error', 'The slug you entered is being used by another user!'),
(86, 1, 'login_error', 'Wrong username or password!'),
(87, 1, 'message_ban_error', 'Your account has been banned!'),
(88, 1, 'reset_password_error', 'We can\'t find a user with that e-mail address!'),
(89, 1, 'change_password_error', 'There was a problem changing your password!'),
(90, 1, 'wrong_password_error', 'Wrong old password!'),
(91, 1, 'email_unique_error', 'The email has already been taken.'),
(92, 1, 'gallery_categories', 'Gallery Categories'),
(93, 1, 'index', 'Index'),
(94, 1, 'navigation', 'Navigation'),
(95, 1, 'admin', 'Admin'),
(96, 1, 'panel', 'Panel'),
(97, 1, 'view_site', 'View Site'),
(98, 1, 'online', 'Online'),
(99, 1, 'main_nav', 'MAIN NAVIGATION'),
(100, 1, 'add_link', 'Add Menu Link'),
(101, 1, 'update_link', 'Update Menu Link'),
(102, 1, 'update_image', 'Update Image'),
(103, 1, 'link', 'Link'),
(104, 1, 'parent_link', 'Parent Link'),
(105, 1, 'pages', 'Pages'),
(106, 1, 'page', 'Page'),
(107, 1, 'add_page', 'Add Page'),
(108, 1, 'add_post', 'Add Post'),
(109, 1, 'pending_posts', 'Pending Posts'),
(110, 1, 'subcategories', 'Subcategories'),
(111, 1, 'images', 'Images'),
(112, 1, 'contact_messages', 'Contact Messages'),
(113, 1, 'newsletter', 'Newsletter'),
(114, 1, 'ad_spaces', 'Ad Spaces'),
(115, 1, 'users', 'Users'),
(116, 1, 'seo_tools', 'SEO Tools'),
(117, 1, 'seo_options', 'SEO options'),
(118, 1, 'settings', 'Settings'),
(119, 1, 'send_email_registered', 'Send Email to Registered Emails'),
(120, 1, 'subject', 'Subject'),
(121, 1, 'send_email', 'Send Email'),
(122, 1, 'registered_emails', 'Registered Emails'),
(123, 1, 'more_info', 'More info'),
(124, 1, 'view_all', 'View All'),
(125, 1, 'subcategory', 'Subcategory'),
(126, 1, 'select', 'Select'),
(127, 1, 'title', 'Title'),
(128, 1, 'slug_exp', 'If you leave it blank, it will be generated automatically.'),
(129, 1, 'description', 'Description'),
(130, 1, 'meta_tag', 'Meta Tag'),
(131, 1, 'keywords', 'Keywords'),
(132, 1, 'location', 'Location'),
(133, 1, 'header', 'Header'),
(134, 1, 'footer', 'Footer'),
(135, 1, 'visibility', 'Visibility'),
(136, 1, 'show', 'Show'),
(137, 1, 'hide', 'Hide'),
(138, 1, 'show_only_registered', 'Show Only to Registered Users'),
(139, 1, 'yes', 'Yes'),
(140, 1, 'no', 'No'),
(141, 1, 'show_title', 'Show Title'),
(142, 1, 'show_breadcrumb', 'Show Breadcrumb'),
(143, 1, 'show_right_column', 'Show Right Column'),
(144, 1, 'update_page', 'Update Page'),
(145, 1, 'id', 'Id'),
(146, 1, 'page_type', 'Page Type'),
(147, 1, 'date', 'Date'),
(148, 1, 'options', 'Options'),
(149, 1, 'custom', 'Custom'),
(150, 1, 'default', 'Default'),
(151, 1, 'select_option', 'Select an option'),
(152, 1, 'edit', 'Edit'),
(153, 1, 'summary', 'Summary'),
(154, 1, 'add_slider', 'Add to Slider'),
(155, 1, 'remove_slider', 'Remove From Slider'),
(156, 1, 'add_picked', 'Add to Our Picks'),
(157, 1, 'remove_picked', 'Remove From Our Picks'),
(158, 1, 'type_tag', 'Type tag and hit enter'),
(159, 1, 'main_image', 'Main Image'),
(160, 1, 'select_image', 'Select image'),
(161, 1, 'additional_images', 'Additional Images'),
(162, 1, 'select_images', 'Select images'),
(163, 1, 'optional_url', 'Optional Url'),
(164, 1, 'content', 'Content'),
(165, 1, 'update_post', 'Update Post'),
(166, 1, 'change_image', 'Change image'),
(167, 1, 'add_images', 'Add images'),
(168, 1, 'image', 'Image'),
(169, 1, 'slider', 'Slider'),
(170, 1, 'approve', 'Approve'),
(171, 1, 'add_category', 'Add Category'),
(172, 1, 'category_name', 'Category Name'),
(173, 1, 'update_category', 'Update Category'),
(174, 1, 'parent_category', 'Parent Category'),
(175, 1, 'add_subcategory', 'Add Subcategory'),
(176, 1, 'post', 'Post'),
(177, 1, 'primary_font', 'Primary Font (Main)'),
(178, 1, 'secondary_font', 'Secondary Font (Titles)'),
(179, 1, 'tertiary_font', 'Tertiary Font (Post & Page Text)'),
(180, 1, 'add_image', 'Add Image'),
(181, 1, 'show_on_menu', 'Show on Menu'),
(182, 1, 'site_title', 'Site Title'),
(183, 1, 'home_title', 'Home Title'),
(184, 1, 'google_analytics', 'Google Analytics'),
(185, 1, 'google_analytics_code', 'Google Analytics Code'),
(186, 1, 'generate_sitemap', 'Generate Sitemap'),
(187, 1, 'sitemap', 'Sitemap'),
(188, 1, 'frequency', 'Frequency'),
(189, 1, 'frequency_exp', 'This value indicates how frequently the content at a particular URL is likely to change '),
(190, 1, 'none', 'None'),
(191, 1, 'always', 'Always'),
(192, 1, 'hourly', 'Hourly'),
(193, 1, 'daily', 'Daily'),
(194, 1, 'weekly', 'Weekly'),
(195, 1, 'monthly', 'Monthly'),
(196, 1, 'yearly', 'Yearly'),
(197, 1, 'never', 'Never'),
(198, 1, 'last_modification', 'Last Modification'),
(199, 1, 'last_modification_exp', 'The time the URL was last modified'),
(200, 1, 'server_response', 'Server\'s Response'),
(201, 1, 'priority', 'Priority'),
(202, 1, 'priority_exp', 'The priority of a particular URL relative to other pages on the same site'),
(203, 1, 'priority_none', 'Automatically Calculated Priority'),
(204, 1, 'generate', 'Generate'),
(205, 1, 'select_ad_spaces', 'Select Ad Space'),
(206, 1, 'ad_space', 'Ad Space'),
(207, 1, 'index_top_ad_space', 'Index (Top)'),
(207, 1, 'index_bottom_ad_space', 'Index (Bottom)'),
(209, 1, 'post_top_ad_space', 'Post Details (Top)'),
(210, 1, 'post_bottom_ad_space', 'Post Details (Bottom)'),
(211, 1, 'category_top_ad_space', 'Category (Top)'),
(212, 1, 'category_bottom_ad_space', 'Category (Bottom)'),
(213, 1, 'tag_top_ad_space', 'Tag (Top)'),
(214, 1, 'tag_bottom_ad_space', 'Tag (Bottom)'),
(215, 1, 'search_top_ad_space', 'Search (Top)'),
(216, 1, 'search_bottom_ad_space', 'Search (Bottom)'),
(217, 1, 'profile_top_ad_space', 'Profile (Top)'),
(218, 1, 'profile_bottom_ad_space', 'Profile (Bottom)'),
(219, 1, 'reading_list_top_ad_space', 'Reading List (Top)'),
(220, 1, 'reading_list_bottom_ad_space', 'Reading List (Bottom)'),
(221, 1, 'sidebar_top_ad_space', 'Sidebar (Top)'),
(222, 1, 'sidebar_bottom_ad_space', 'Sidebar (Bottom)'),
(223, 1, 'banner', 'Banner'),
(224, 1, 'paste_ad_code', 'Ad Code'),
(225, 1, 'upload_your_banner', 'Create Ad Code'),
(226, 1, 'paste_ad_url', 'Ad Url'),
(227, 1, 'general_settings', 'General Settings'),
(228, 1, 'email_settings', 'Email Settings'),
(229, 1, 'contact_settings', 'Contact Settings'),
(230, 1, 'social_media_settings', 'Social Media Settings'),
(231, 1, 'visual_settings', 'Visual Settings'),
(232, 1, 'language', 'Language'),
(233, 1, 'app_name', 'Application Name'),
(234, 1, 'show_post_view_counts', 'Show Post View Counts'),
(235, 1, 'rss', 'RSS'),
(236, 1, 'optional_url_name', 'Post Optional Url Button Name'),
(237, 1, 'pagination_number_posts', 'Number of Posts Per Page (Pagination)'),
(238, 1, 'menu_limit', 'Menu Limit'),
(239, 1, 'footer_about_section', 'Footer About Section'),
(240, 1, 'protocol', 'Protocol'),
(241, 1, 'smtp', 'SMTP'),
(242, 1, 'mail', 'Mail'),
(243, 1, 'host', 'Host'),
(244, 1, 'port', 'Port'),
(245, 1, 'gmail_smtp', 'Gmail SMTP'),
(246, 1, 'address', 'Address'),
(247, 1, 'phone', 'Phone'),
(248, 1, 'contact_text', 'Contact Text'),
(249, 1, 'url', 'Url'),
(250, 1, 'select_color', 'Select Color'),
(251, 1, 'logo', 'Logo'),
(252, 1, 'change_logo', 'Change logo'),
(253, 1, 'favicon', 'Favicon'),
(254, 1, 'change_favicon', 'Change favicon'),
(255, 1, 'facebook_comments_code', 'Facebook Comments Plugin Code'),
(256, 1, 'user', 'User'),
(257, 1, 'avatar', 'Avatar'),
(258, 1, 'role', 'Role'),
(259, 1, 'change_user_role', 'Change User Role'),
(260, 1, 'save', 'Save'),
(261, 1, 'close', 'Close'),
(262, 1, 'layout', 'Layout'),
(263, 1, 'banned', 'Banned'),
(264, 1, 'active', 'Active'),
(265, 1, 'ban_user', 'Ban User'),
(266, 1, 'remove_ban', 'Remove Ban'),
(267, 1, 'status', 'Status'),
(268, 1, 'copyright', 'Copyright'),
(269, 1, 'delete_all', 'Delete All'),
(270, 1, 'registration_system', 'Registration System'),
(271, 1, 'comment_system', 'Comment System'),
(272, 1, 'confirm_page', 'Are you sure you want to delete this page?'),
(273, 1, 'confirm_poll', 'Are you sure you want to delete this poll?'),
(274, 1, 'confirm_post', 'Are you sure you want to delete this post?'),
(275, 1, 'confirm_category', 'Are you sure you want to delete this category?'),
(276, 1, 'confirm_comment', 'Are you sure you want to delete this comment?'),
(277, 1, 'confirm_message', 'Are you sure you want to delete this message?'),
(278, 1, 'confirm_user', 'Are you sure you want to delete this user?'),
(279, 1, 'confirm_email', 'Are you sure you want to delete this email address?'),
(280, 1, 'confirm_image', 'Are you sure you want to delete this image?'),
(281, 1, 'confirm_ban', 'Are you sure you want to ban this user?'),
(282, 1, 'confirm_remove_ban', 'Are you sure you want to remove ban for this user?'),
(283, 1, 'confirm_link', 'Are you sure you want to delete this link?'),
(284, 1, 'confirm_language', 'Are you sure you want to delete this language?'),
(285, 1, 'confirm_posts', 'Are you sure you want to delete selected posts?'),
(286, 1, 'confirm_comments', 'Are you sure you want to delete selected comments?'),
(287, 1, 'msg_suc_added', 'successfully added!'),
(288, 1, 'msg_suc_updated', 'successfully updated!'),
(289, 1, 'msg_suc_deleted', 'successfully deleted!'),
(290, 1, 'msg_error', 'An error occurred please try again!'),
(291, 1, 'msg_email_sent', 'Email successfully sent!'),
(292, 1, 'msg_role_changed', 'User role successfully changed!'),
(293, 1, 'msg_delete_subcategories', 'Please delete subcategories belonging to this category first!'),
(294, 1, 'msg_delete_posts', 'Please delete posts belonging to this category first!'),
(295, 1, 'msg_delete_images', 'Please delete images belonging to this category first!'),
(296, 1, 'msg_add_slider', 'Post added to slider!'),
(297, 1, 'msg_remove_slider', 'Post removed from slider!'),
(298, 1, 'msg_add_picked', 'Post added to our picks!'),
(299, 1, 'msg_remove_picked', 'Post removed from our picks!'),
(300, 1, 'msg_post_approved', 'Post approved!'),
(301, 1, 'msg_img_uploaded', 'Image Successfully Uploaded!'),
(302, 1, 'msg_page_delete', 'Default pages can not be deleted!'),
(303, 1, 'msg_user_banned', 'User successfully banned!'),
(304, 1, 'msg_ban_removed', 'User ban successfully removed!'),
(305, 1, 'msg_recaptcha', 'Please confirm that you are not a robot!'),
(306, 1, 'google_recaptcha', 'Google reCAPTCHA'),
(307, 1, 'site_key', 'Site Key'),
(308, 1, 'secret_key', 'Secret Key'),
(309, 1, 'language_settings', 'Language Settings'),
(310, 1, 'default_language', 'Default Language'),
(311, 1, 'add_language', 'Add Language'),
(312, 1, 'language_name', 'Language Name'),
(313, 1, 'language_code', 'Language Code'),
(314, 1, 'short_form', 'Short Form'),
(315, 1, 'text_direction', 'Text Direction'),
(316, 1, 'left_to_right', 'Left to Right'),
(317, 1, 'right_to_left', 'Right to Left'),
(318, 1, 'inactive', 'Inactive'),
(319, 1, 'languages', 'Languages'),
(320, 1, 'folder_name', 'Folder Name'),
(321, 1, 'order', 'Order'),
(322, 1, 'msg_language_delete', 'Default language cannot be deleted!'),
(323, 1, 'phrases', 'Phrases'),
(324, 1, 'back', 'Back'),
(325, 1, 'update_language', 'Update Language'),
(326, 1, 'msg_page_slug_error', 'Invalid page slug!'),
(327, 1, 'shared', 'Shared'),
(328, 1, 'update_subcategory', 'Update Subcategory'),
(329, 1, 'site_description', 'Site Description'),
(330, 1, 'download_sitemap', 'Download Sitemap'),
(331, 1, 'update_sitemap', 'Update Sitemap'),
(332, 1, 'settings_language', 'Settings Language'),
(333, 1, 'multilingual_system', 'Multilingual System'),
(334, 1, 'enable', 'Enable'),
(335, 1, 'disable', 'Disable'),
(336, 1, 'view_results', 'View Results'),
(337, 1, 'emoji_reactions', 'Emoji Reactions'),
(338, 1, 'whats_your_reaction', 'What\'s Your Reaction?'),
(339, 1, 'like', 'Like'),
(340, 1, 'dislike', 'Dislike'),
(341, 1, 'love', 'Love'),
(342, 1, 'funny', 'Funny'),
(343, 1, 'angry', 'Angry'),
(344, 1, 'sad', 'Sad'),
(345, 1, 'wow', 'Wow'),
(346, 1, 'poll', 'Poll'),
(347, 1, 'polls', 'Polls'),
(348, 1, 'add_poll', 'Add Poll'),
(349, 1, 'option_1', 'Option 1'),
(350, 1, 'option_2', 'Option 2'),
(351, 1, 'option_3', 'Option 3'),
(352, 1, 'option_4', 'Option 4'),
(353, 1, 'option_5', 'Option 5'),
(354, 1, 'option_6', 'Option 6'),
(355, 1, 'option_7', 'Option 7'),
(356, 1, 'option_8', 'Option 8'),
(357, 1, 'option_9', 'Option 9'),
(358, 1, 'option_10', 'Option 10'),
(359, 1, 'optional', 'Optional'),
(360, 1, 'question', 'Question'),
(361, 1, 'all_users_can_vote', 'All Users Can Vote'),
(362, 1, 'filter', 'Filter'),
(363, 1, 'post_type', 'Post Type'),
(364, 1, 'publish', 'Publish'),
(365, 1, 'date_publish', 'Date Publish'),
(366, 1, 'post_details', 'Post Details'),
(367, 1, 'save_draft', 'Save as Draft'),
(368, 1, 'slider_posts', 'Slider Posts'),
(369, 1, 'drafts', 'Drafts'),
(370, 1, 'slider_order', 'Slider Order'),
(371, 1, 'update_poll', 'Update Poll'),
(372, 1, 'voting_poll', 'Voting Poll'),
(373, 1, 'view_options', 'View Options'),
(374, 1, 'vote', 'Vote'),
(375, 1, 'total_vote', 'Total Vote:'),
(376, 1, 'voted_message', 'You already voted this poll before.'),
(377, 1, 'profile', 'Profile'),
(378, 1, 'about_me', 'About Me'),
(379, 1, 'form_validation_required', 'The {field} field is required.'),
(380, 1, 'form_validation_min_length', 'The {field} field must be at least {param} characters in length.'),
(381, 1, 'form_validation_max_length', 'The {field} field cannot exceed {param} characters in length.'),
(382, 1, 'form_validation_matches', 'The {field} field does not match the {param} field.'),
(383, 1, 'form_validation_is_unique', 'The {field} field must contain a unique value.'),
(384, 1, 'msg_updated', 'Changes successfully saved!'),
(385, 1, 'msg_deleted', 'Item successfully deleted!'),
(386, 1, 'video', 'Video'),
(387, 1, 'add_video', 'Add Video'),
(388, 1, 'get_video_from_url', 'Get Video from Url'),
(389, 1, 'get_video', 'Get Video'),
(340, 1, 'video_url', 'Video Url'),
(391, 1, 'video_embed_code', 'Video Embed Code'),
(392, 1, 'video_thumbnails', 'Video Thumbnails'),
(393, 1, 'video_image', 'Video Image'),
(394, 1, 'or', 'or'),
(395, 1, 'add_image_url', 'Add Image Url'),
(396, 1, 'update_video', 'Update Video'),
(397, 1, 'admin_panel_link', 'Admin Panel Link'),
(398, 1, 'social_accounts', 'Social Accounts'),
(399, 1, 'msg_username_unique_error', 'The username has already been taken.'),
(400, 1, 'msg_slug_used', 'The slug you entered is being used by another user!'),
(401, 1, 'just_now', 'Just Now'),
(402, 1, 'minute_ago', 'minute ago'),
(403, 1, 'minutes_ago', 'minutes ago'),
(404, 1, 'hour_ago', 'hour ago'),
(405, 1, 'hours_ago', 'hours ago'),
(406, 1, 'day_ago', 'day ago'),
(407, 1, 'days_ago', 'days ago'),
(408, 1, 'month_ago', 'month ago'),
(409, 1, 'months_ago', 'months ago'),
(410, 1, 'year_ago', 'year ago'),
(411, 1, 'years_ago', 'years ago'),
(412, 1, 'follow', 'Follow'),
(413, 1, 'unfollow', 'Unfollow'),
(414, 1, 'following', 'Following'),
(415, 1, 'followers', 'Followers'),
(416, 1, 'member_since', 'Member since'),
(417, 1, 'show_email_on_profile', 'Show Email on Profile Page'),
(418, 1, 'cache_system', 'Cache System'),
(419, 1, 'cache_refresh_time', 'Cache Refresh Time (Minute)'),
(420, 1, 'cache_refresh_time_exp', 'After this time, your cache files will be refreshed.'),
(421, 1, 'refresh_cache_database_changes', 'Refresh Cache Files When Database Changes'),
(422, 1, 'reset_cache', 'Reset Cache'),
(423, 1, 'msg_reset_cache', 'All cache files have been deleted!'),
(424, 1, 'terms_conditions', 'Terms & Conditions'),
(425, 1, 'terms_conditions_exp', 'I have read and agree to the'),
(426, 1, 'email_option_contact_messages', 'Send contact messages to email address'),
(427, 1, 'admin_emails_will_send', 'Admin emails will be sent to this address'),
(428, 1, 'email_options', 'Email Options'),
(429, 1, 'gmail_warning', 'To send e-mails with Gmail server, please read Email Settings section in our documentation.'),
(430, 1, 'logo_email', 'Logo Email'),
(431, 1, 'mail_library', 'Mail Library'),
(432, 1, 'contact_message', 'Contact Message'),
(433, 1, 'subscribers', 'Subscribers'),
(434, 1, 'preview', 'Preview'),
(435, 1, 'send_email_subscribers', 'Send Email to Subscribers'),
(436, 1, 'msg_subscriber_deleted', 'Subscriber successfully deleted!'),
(437, 1, 'confirm_subscriber', 'Are you sure you want to delete this subscriber?'),
(438, 1, 'unsubscribe', 'Unsubscribe'),
(439, 1, 'unsubscribe_successful', 'Unsubscribe Successful!'),
(440, 1, 'msg_unsubscribe', 'You will no longer receive emails from us!'),
(441, 1, 'email_reset_password', 'Please click on the button below to reset your password.'),
(442, 1, 'msg_reset_password_success', 'We\'ve sent an email for resetting your password to your email address. Please check your email for next steps.'),
(443, 1, 'forgot_password', 'Forgot Password'),
(444, 1, 'new_password', 'New Password'),
(445, 1, 'album', 'Album'),
(446, 1, 'albums', 'Albums'),
(447, 1, 'gallery_albums', 'Gallery Albums'),
(448, 1, 'add_album', 'Add Album'),
(449, 1, 'album_name', 'Album Name'),
(450, 1, 'msg_delete_album', 'Please delete categories belonging to this album first!'),
(451, 1, 'confirm_album', 'Are you sure you want to delete this album?'),
(452, 1, 'update_album', 'Update Album'),
(453, 1, 'select_multiple_images', 'You can select multiple images.'),
(454, 1, 'album_cover', 'Album Cover'),
(455, 1, 'set_as_album_cover', 'Set as Album Cover'),
(456, 1, 'rss_feeds', 'RSS Feeds'),
(457, 1, 'cookies_warning', 'Cookies Warning'),
(458, 1, 'show_cookies_warning', 'Show Cookies Warning'),
(459, 1, 'uploading', 'Uploading...'),
(460, 1, 'add_user', 'Add User'),
(461, 1, 'msg_user_added', 'User successfully added!'),
(462, 1, 'leave_your_comment', 'Leave your comment...'),
(463, 1, 'post_comment', 'Post Comment'),
(464, 1, 'comment_approval_system', 'Comment Approval System'),
(465, 1, 'approved_comments', 'Approved Comments'),
(466, 1, 'pending_comments', 'Pending Comments'),
(467, 1, 'recently_added_comments', 'Recently added comments'),
(468, 1, 'recently_added_unapproved_comments', 'Recently added unapproved comments'),
(469, 1, 'recently_added_contact_messages', 'Recently added contact messages'),
(470, 1, 'recently_registered_users', 'Recently registered users'),
(471, 1, 'msg_comment_sent_successfully', 'Your comment has been sent. It will be published after being reviewed by the site management.'),
(472, 1, 'msg_comment_approved', 'Comment successfully approved!'),
(473, 1, 'please_select_option', 'Please select an option!'),
(474, 1, 'post_owner', 'Post Owner'),
(475, 1, 'timezone', 'Timezone'),
(476, 1, 'themes', 'Themes'),
(477, 1, 'activated', 'Activated'),
(478, 1, 'activate', 'Activate'),
(479, 1, 'light_mode', 'Light Mode'),
(480, 1, 'dark_mode', 'Dark Mode'),
(481, 1, 'approve_posts_before_publishing', 'Approve Posts Before Publishing'),
(482, 1, 'emoji_reactions_type', 'Emoji Reactions Type'),
(483, 1, 'gif_animated', 'GIF (Animated)'),
(484, 1, 'png_not_animated', 'PNG (Not Animated)'),
(485, 1, 'text_editor_language', 'Text Editor Language'),
(486, 1, 'site_language', 'Site Language'),
(487, 1, 'social_login_settings', 'Social Login Settings'),
(488, 1, 'app_id', 'App ID'),
(489, 1, 'app_secret', 'App Secret'),
(490, 1, 'client_id', 'Client ID'),
(491, 1, 'client_secret', 'Client Secret'),
(492, 1, 'connect_with_facebook', 'Connect with Facebook'),
(493, 1, 'connect_with_google', 'Connect with Google'),
(494, 1, 'or_register_with_email', 'Or register with email'),
(495, 1, 'or_login_with_email', 'Or login with email'),
(496, 1, 'username_or_email', 'Username or email'),
(497, 1, 'msg_register_success', 'Your account has been created successfully!'),
(498, 1, 'files', 'Files'),
(499, 1, 'files_exp', 'Downloadable additional files (.pdf, .docx, .zip etc..)'),
(500, 1, 'select_file', 'Select File'),
(501, 1, 'main_post_image', 'Main post image'),
(502, 1, 'more_main_images', 'More main images (slider will be active)'),
(503, 1, 'upload_image', 'Upload Image'),
(504, 1, 'drag_drop_files_here', 'Drag and drop files here or'),
(505, 1, 'browse_files', 'Browse Files'),
(506, 1, 'txt_processing', 'Processing...'),
(507, 1, 'file_upload', 'File Upload'),
(508, 1, 'msg_register_character_error', 'You cannot use the @ character in the username!'),
(509, 1, 'google_adsense_code', 'Google Adsense Code'),
(510, 1, 'edit_translations', 'Edit Translations'),
(511, 1, 'mobile_logo', 'Mobile Logo'),
(512, 1, 'import_rss_feed', 'Import RSS Feed'),
(513, 1, 'feed_name', 'Feed Name'),
(514, 1, 'feed_url', 'Feed URL'),
(515, 1, 'number_of_posts_import', 'Number of Posts to Import'),
(516, 1, 'show_images_from_original_source', 'Show Images from Original Source'),
(517, 1, 'download_images_my_server', 'Download Images to My Server'),
(518, 1, 'auto_update', 'Auto Update'),
(519, 1, 'show_read_more_button', 'Show Read More Button'),
(520, 1, 'add_posts_as_draft', 'Add Posts as Draft'),
(521, 1, 'read_more_button_text', 'Read More Button Text'),
(522, 1, 'update', 'Update'),
(523, 1, 'msg_rss_warning', 'If you chose to download the images to your server, adding posts will take more time and will use more resources. If you see any problems, increase \'max_execution_time\' and \'memory_limit\' values from your server settings.'),
(524, 1, 'msg_cron_feed', 'With this URL you can automatically update your feeds.'),
(525, 1, 'update_rss_feed', 'Update Rss Feed'),
(526, 1, 'feed', 'Feed'),
(527, 1, 'generate_keywords_from_title', 'Generate Keywords from Title'),
(528, 1, 'confirm_item', 'Are you sure you want to delete this item?'),
(529, 1, 'file_manager', 'File Manager'),
(530, 1, 'show_all_files', 'Show all Files'),
(531, 1, 'show_only_own_files', 'Show Only Users Own Files'),
(532, 1, 'maintenance_mode', 'Maintenance Mode'),
(533, 1, 'msg_cron_sitemap', 'With this URL you can automatically update your sitemap.'),
(534, 1, 'custom_css_codes', 'Custom CSS Codes'),
(535, 1, 'custom_javascript_codes', 'Custom JavaScript Codes'),
(536, 1, 'custom_css_codes_exp', 'These codes will be added to the header of the site.'),
(537, 1, 'custom_javascript_codes_exp', 'These codes will be added to the footer of the site.'),
(538, 1, 'font_settings', 'Font Settings'),
(539, 1, 'site_font', 'Site Font'),
(540, 1, 'add_font', 'Add Font'),
(541, 1, 'font_family', 'Font Family'),
(542, 1, 'fonts', 'Fonts'),
(543, 1, 'update_font', 'Update Font'),
(544, 1, 'msg_item_added', 'Item successfully added!');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `title` varchar(500) DEFAULT NULL,
  `page_description` varchar(500) DEFAULT NULL,
  `page_keywords` varchar(500) DEFAULT NULL,
  `slug` varchar(500) DEFAULT NULL,
  `is_custom` tinyint(1) DEFAULT 1,
  `page_content` longtext DEFAULT NULL,
  `page_order` int(11) DEFAULT 5,
  `page_active` tinyint(1) DEFAULT 1,
  `title_active` tinyint(1) DEFAULT 1,
  `breadcrumb_active` tinyint(1) DEFAULT 1,
  `right_column_active` tinyint(1) DEFAULT 1,
  `need_auth` tinyint(1) DEFAULT 0,
  `location` varchar(255) DEFAULT 'header',
  `link` varchar(1000) DEFAULT NULL,
  `parent_id` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `lang_id`, `title`, `page_description`, `page_keywords`, `slug`, `is_custom`, `page_content`, `page_order`, `page_active`, `title_active`, `breadcrumb_active`, `right_column_active`, `need_auth`, `location`, `link`, `parent_id`, `created_at`) VALUES
(1, 1, 'Gallery', 'Gallery Page', 'gallery, infinite', 'gallery', 0, NULL, 5, 1, 1, 1, 0, 0, 'header', NULL, 0, '2020-08-04 00:07:21'),
(2, 1, 'Contact', 'Contact Page', 'contact, infinite', 'contact', 0, NULL, 6, 1, 1, 1, 0, 0, 'header', NULL, 0, '2020-08-04 00:07:21'),
(3, 1, 'Terms & Conditions', 'Terms & Conditions Page', 'terms, conditions, infinite', 'terms-conditions', 0, NULL, 1, 1, 1, 1, 0, 0, 'footer', NULL, 0, '2020-08-04 00:07:21');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `title` varchar(500) DEFAULT NULL,
  `album_id` int(11) DEFAULT 1,
  `category_id` int(11) DEFAULT NULL,
  `path_big` varchar(255) DEFAULT NULL,
  `path_small` varchar(255) DEFAULT NULL,
  `is_album_cover` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `question` text DEFAULT NULL,
  `option1` text DEFAULT NULL,
  `option2` text DEFAULT NULL,
  `option3` text DEFAULT NULL,
  `option4` text DEFAULT NULL,
  `option5` text DEFAULT NULL,
  `option6` text DEFAULT NULL,
  `option7` text DEFAULT NULL,
  `option8` text DEFAULT NULL,
  `option9` text DEFAULT NULL,
  `option10` text DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `poll_votes`
--

CREATE TABLE `poll_votes` (
  `id` int(11) NOT NULL,
  `poll_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `vote` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `title` varchar(500) DEFAULT NULL,
  `title_slug` varchar(500) DEFAULT NULL,
  `title_hash` varchar(500) DEFAULT NULL,
  `summary` varchar(1000) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_big` varchar(255) DEFAULT NULL,
  `image_mid` varchar(255) DEFAULT NULL,
  `image_small` varchar(255) DEFAULT NULL,
  `image_slider` varchar(255) DEFAULT NULL,
  `image_mime` varchar(100) DEFAULT 'jpg',
  `is_slider` tinyint(1) DEFAULT 0,
  `is_picked` tinyint(1) DEFAULT 0,
  `hit` int(11) DEFAULT 0,
  `slider_order` tinyint(4) DEFAULT 0,
  `optional_url` varchar(1000) DEFAULT NULL,
  `post_type` varchar(30) DEFAULT 'post',
  `video_url` varchar(1000) DEFAULT NULL,
  `video_embed_code` varchar(1000) DEFAULT NULL,
  `image_url` varchar(1000) DEFAULT NULL,
  `need_auth` tinyint(1) DEFAULT 0,
  `feed_id` int(11) DEFAULT NULL,
  `post_url` varchar(1000) DEFAULT NULL,
  `show_post_url` tinyint(1) DEFAULT 1,
  `visibility` tinyint(1) DEFAULT 1,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_files`
--

CREATE TABLE `post_files` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `file_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `post_images`
--

CREATE TABLE `post_images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `image_path` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reactions`
--

CREATE TABLE `reactions` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `re_like` int(11) DEFAULT 0,
  `re_dislike` int(11) DEFAULT 0,
  `re_love` int(11) DEFAULT 0,
  `re_funny` int(11) DEFAULT 0,
  `re_angry` int(11) DEFAULT 0,
  `re_sad` int(11) DEFAULT 0,
  `re_wow` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `reading_lists`
--

CREATE TABLE `reading_lists` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `rss_feeds`
--

CREATE TABLE `rss_feeds` (
  `id` int(11) NOT NULL,
  `lang_id` int(11) DEFAULT 1,
  `feed_name` varchar(500) DEFAULT NULL,
  `feed_url` varchar(1000) DEFAULT NULL,
  `post_limit` smallint(6) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_saving_method` varchar(30) DEFAULT 'url',
  `generate_keywords_from_title` tinyint(1) NOT NULL DEFAULT 1,
  `auto_update` tinyint(1) DEFAULT 1,
  `read_more_button` tinyint(1) DEFAULT 1,
  `read_more_button_text` varchar(255) DEFAULT 'Read More',
  `user_id` int(11) DEFAULT NULL,
  `add_posts_as_draft` tinyint(1) DEFAULT 0,
  `is_cron_updated` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `lang_id` tinyint(4) DEFAULT 1,
  `application_name` varchar(255) DEFAULT 'Infinite',
  `site_title` varchar(255) DEFAULT NULL,
  `home_title` varchar(255) DEFAULT NULL,
  `site_description` varchar(500) DEFAULT NULL,
  `keywords` varchar(500) DEFAULT NULL,
  `primary_font` smallint(6) DEFAULT 19,
  `secondary_font` smallint(6) DEFAULT 25,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `telegram_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `optional_url_button_name` varchar(500) DEFAULT 'Click Here to Visit',
  `about_footer` varchar(1000) DEFAULT NULL,
  `contact_text` text DEFAULT NULL,
  `contact_address` varchar(500) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `copyright` varchar(500) DEFAULT 'Copyright 2099 Infinite - All Rights Reserved.',
  `cookies_warning` tinyint(1) DEFAULT 0,
  `cookies_warning_text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `lang_id`, `application_name`, `site_title`, `home_title`, `site_description`, `keywords`, `primary_font`, `secondary_font`, `facebook_url`, `twitter_url`, `instagram_url`, `pinterest_url`, `linkedin_url`, `vk_url`, `telegram_url`, `youtube_url`, `optional_url_button_name`, `about_footer`, `contact_text`, `contact_address`, `contact_email`, `contact_phone`, `copyright`, `cookies_warning`, `cookies_warning_text`) VALUES
(1, 1, 'Infinite', 'Infinite - Blog Magazine Script', 'Index', 'Infinite - Blog Magazine Script', 'Infinite, Blog, Magazine', 19, 25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Click Here to Visit', NULL, NULL, NULL, NULL, NULL, 'Copyright 2099 Infinite - All Rights Reserved.', 1, '<p>This site uses cookies. By continuing to browse the site you are agreeing to our use of cookies <a href=\"#">Find out more here</a></p>');

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  `tag_slug` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT 'name@domain.com',
  `password` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `role` varchar(30) DEFAULT 'user',
  `user_type` varchar(30) DEFAULT 'registered',
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `about_me` varchar(5000) DEFAULT NULL,
  `last_seen` timestamp NULL DEFAULT NULL,
  `facebook_url` varchar(500) DEFAULT NULL,
  `twitter_url` varchar(500) DEFAULT NULL,
  `instagram_url` varchar(500) DEFAULT NULL,
  `pinterest_url` varchar(500) DEFAULT NULL,
  `linkedin_url` varchar(500) DEFAULT NULL,
  `vk_url` varchar(500) DEFAULT NULL,
  `telegram_url` varchar(500) DEFAULT NULL,
  `youtube_url` varchar(500) DEFAULT NULL,
  `show_email_on_profile` tinyint(1) DEFAULT 1,
  `site_color` varchar(30) DEFAULT 'default',
  `site_mode` varchar(10) DEFAULT 'light',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ad_spaces`
--
ALTER TABLE `ad_spaces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lang_id` (`lang_id`),
  ADD KEY `idx_parent_id` (`parent_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_parent_id` (`parent_id`),
  ADD KEY `idx_post_id` (`post_id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_status` (`status`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_following_id` (`following_id`),
  ADD KEY `idx_follower_id` (`follower_id`);

--
-- Indexes for table `fonts`
--
ALTER TABLE `fonts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_albums`
--
ALTER TABLE `gallery_albums`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language_translations`
--
ALTER TABLE `language_translations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lang_id` (`lang_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `poll_votes`
--
ALTER TABLE `poll_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lang_id` (`lang_id`),
  ADD KEY `idx_category_id` (`category_id`),
  ADD KEY `idx_is_slider` (`is_slider`),
  ADD KEY `idx_is_picked` (`is_picked`),
  ADD KEY `idx_visibility` (`visibility`),
  ADD KEY `idx_status` (`status`),
  ADD KEY `idx_created_at` (`created_at`),
  ADD KEY `idx_user_id` (`user_id`);

--
-- Indexes for table `post_files`
--
ALTER TABLE `post_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post_images`
--
ALTER TABLE `post_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reactions`
--
ALTER TABLE `reactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reading_lists`
--
ALTER TABLE `reading_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rss_feeds`
--
ALTER TABLE `rss_feeds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_post_id` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ad_spaces`
--
ALTER TABLE `ad_spaces`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fonts`
--
ALTER TABLE `fonts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `gallery_albums`
--
ALTER TABLE `gallery_albums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gallery_categories`
--
ALTER TABLE `gallery_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `language_translations`
--
ALTER TABLE `language_translations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=544;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `poll_votes`
--
ALTER TABLE `poll_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_files`
--
ALTER TABLE `post_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_images`
--
ALTER TABLE `post_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reactions`
--
ALTER TABLE `reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reading_lists`
--
ALTER TABLE `reading_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rss_feeds`
--
ALTER TABLE `rss_feeds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
