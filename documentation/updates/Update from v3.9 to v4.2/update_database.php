<?php
define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);
chdir(__DIR__);
$pathsConfig = FCPATH . 'app/Config/Paths.php';
require realpath($pathsConfig) ?: $pathsConfig;
$paths = new Config\Paths();
$bootstrap = rtrim($paths->systemDirectory, '\\/ ') . DIRECTORY_SEPARATOR . 'bootstrap.php';
$app = require realpath($bootstrap) ?: $bootstrap;

$dbArray = new \Config\Database();
@$conn = mysqli_connect($dbArray->default['hostname'], $dbArray->default['username'], $dbArray->default['password'], $dbArray->default['database']);
if (empty($conn)) {
    echo 'Database connection failed! Check your database credentials in the "app/Config/Database.php" file.';
    exit();
}
$conn->query("SET CHARACTER SET utf8");
$conn->query("SET NAMES utf8");

function runQuery($sql)
{
    global $conn;
    return mysqli_query($conn, $sql);
}

if (isset($_POST["btn_submit"])) {
    update($conn);
    $success = 'The update has been successfully completed! Please delete the "update_database.php" file.';
}

function update()
{
    updateFrom39To40();
    sleep(1);
    updateFrom40To41();
    sleep(1);
    updateFrom41To42();
}

function updateFrom39To40()
{
    $tableSessions = "CREATE TABLE IF NOT EXISTS `ci_sessions` (
    `id` varchar(128) NOT NULL,
    `ip_address` varchar(45) NOT NULL,
    `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
    `data` blob NOT NULL,
    KEY `ci_sessions_timestamp` (`timestamp`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    $tableFonts = "CREATE TABLE `fonts` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `font_name` varchar(255) DEFAULT NULL,
    `font_url` varchar(2000) DEFAULT NULL,
    `font_family` varchar(500) DEFAULT NULL,
    `is_default` tinyint(1) DEFAULT '0'
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    $tableTranslations = "CREATE TABLE `language_translations` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `lang_id` smallint(6) DEFAULT NULL,
    `label` varchar(255) DEFAULT NULL,
    `translation` varchar(500) DEFAULT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    $tableFeeds = "CREATE TABLE `rss_feeds` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
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
    `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    runQuery($tableSessions);
    runQuery($tableFonts);
    runQuery($tableTranslations);
    runQuery($tableFeeds);
    runQuery("ALTER TABLE files ADD COLUMN `user_id` INT(11) DEFAULT 1;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `file_manager_show_all_files` TINYINT(1) DEFAULT 0;");
    runQuery("ALTER TABLE general_settings DROP COLUMN `primary_font`;");
    runQuery("ALTER TABLE general_settings DROP COLUMN `secondary_font`;");
    runQuery("ALTER TABLE general_settings DROP COLUMN `text_editor_lang`;");
    runQuery("ALTER TABLE general_settings DROP COLUMN `emoji_reactions_type`;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `maintenance_mode_title` VARCHAR(500) DEFAULT 'Coming Soon!';");
    runQuery("ALTER TABLE general_settings ADD COLUMN `maintenance_mode_description` VARCHAR(5000);");
    runQuery("ALTER TABLE general_settings ADD COLUMN `maintenance_mode_status` TINYINT(1) DEFAULT 0;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `sitemap_frequency` VARCHAR(30) DEFAULT 'monthly';");
    runQuery("ALTER TABLE general_settings ADD COLUMN `sitemap_last_modification` VARCHAR(30) DEFAULT 'server_response';");
    runQuery("ALTER TABLE general_settings ADD COLUMN `sitemap_priority` VARCHAR(30) DEFAULT 'automatically';");
    runQuery("ALTER TABLE general_settings CHANGE `head_code` `custom_css_codes` MEDIUMTEXT;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `custom_javascript_codes` MEDIUMTEXT;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `last_cron_update` TIMESTAMP;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `version` VARCHAR(30) DEFAULT '4.0';");
    runQuery("ALTER TABLE images ADD COLUMN `user_id` INT(11);");
    runQuery("ALTER TABLE languages ADD COLUMN `text_editor_lang` VARCHAR(20) DEFAULT 'en';");
    runQuery("ALTER TABLE posts ADD COLUMN `title_hash` VARCHAR(500);");
    runQuery("ALTER TABLE posts ADD COLUMN `feed_id` INT(11);");
    runQuery("ALTER TABLE posts ADD COLUMN `post_url` VARCHAR(1000);");
    runQuery("ALTER TABLE posts ADD COLUMN `show_post_url` TINYINT(1) DEFAULT 1;");
    runQuery("ALTER TABLE settings ADD COLUMN `primary_font` SMALLINT(6) DEFAULT 19;");
    runQuery("ALTER TABLE settings ADD COLUMN `secondary_font` SMALLINT(6) DEFAULT 25;");
    runQuery("ALTER TABLE settings ADD COLUMN `telegram_url` VARCHAR(500);");
    runQuery("ALTER TABLE settings ADD COLUMN `youtube_url` VARCHAR(500);");
    runQuery("ALTER TABLE users ADD COLUMN `site_color` VARCHAR(30) DEFAULT 'default';");
    runQuery("ALTER TABLE users ADD COLUMN `site_mode` VARCHAR(10) DEFAULT 'light';");
    runQuery("ALTER TABLE users ADD COLUMN `telegram_url` VARCHAR(500);");

    $sqlFonts = "INSERT INTO `fonts` (`id`, `font_name`, `font_url`, `font_family`, `is_default`) VALUES
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
(32, 'Verdana', NULL, 'font-family: Verdana, Helvetica, sans-serif', 1);";
    runQuery($sqlFonts);

    //add keys
    runQuery("ALTER TABLE categories ADD INDEX idx_lang_id (lang_id);");
    runQuery("ALTER TABLE categories ADD INDEX idx_parent_id (parent_id);");
    runQuery("ALTER TABLE comments ADD INDEX idx_parent_id (parent_id);");
    runQuery("ALTER TABLE comments ADD INDEX idx_post_id (post_id);");
    runQuery("ALTER TABLE comments ADD INDEX idx_user_id (user_id);");
    runQuery("ALTER TABLE comments ADD INDEX idx_status (status);");
    runQuery("ALTER TABLE files ADD INDEX idx_user_id (user_id);");
    runQuery("ALTER TABLE followers ADD INDEX idx_following_id (following_id);");
    runQuery("ALTER TABLE followers ADD INDEX idx_follower_id (follower_id);");
    runQuery("ALTER TABLE images ADD INDEX idx_user_id (user_id);");
    runQuery("ALTER TABLE language_translations ADD INDEX idx_lang_id (lang_id);");
    runQuery("ALTER TABLE posts ADD INDEX idx_lang_id (lang_id);");
    runQuery("ALTER TABLE posts ADD INDEX idx_user_id (user_id);");
    runQuery("ALTER TABLE posts ADD INDEX idx_category_id (category_id);");
    runQuery("ALTER TABLE posts ADD INDEX idx_is_slider (is_slider);");
    runQuery("ALTER TABLE posts ADD INDEX idx_is_picked (is_picked);");
    runQuery("ALTER TABLE posts ADD INDEX idx_visibility (visibility);");
    runQuery("ALTER TABLE posts ADD INDEX idx_status (status);");
    runQuery("ALTER TABLE posts ADD INDEX idx_created_at (created_at);");
    runQuery("ALTER TABLE tags ADD INDEX idx_post_id (post_id);");

    //add language translations
    $result = runQuery("SELECT * FROM languages ORDER BY id");
    while ($row = mysqli_fetch_array($result)) {
        $path = "old/application/language/" . $row["folder_name"] . "/site_lang.php";
        if (file_exists($path)) {
            include $path;
            if (!empty($lang)) {
                foreach ($lang as $key => $value) {
                    $insert_translation = "INSERT INTO `language_translations` (`lang_id`, `label`, `translation`) 
                    VALUES (" . $row["id"] . ", '" . $key . "' , '" . $value . "')";
                    runQuery($insert_translation);
                }
            }
        }
    }
    runQuery("ALTER TABLE languages DROP COLUMN `folder_name`;");

    //add new translations
    $p = array();
    $p["import_rss_feed"] = "Import RSS Feed";
    $p["feed_name"] = "Feed Name";
    $p["feed_url"] = "Feed URL";
    $p["number_of_posts_import"] = "Number of Posts to Import";
    $p["show_images_from_original_source"] = "Show Images from Original Source";
    $p["download_images_my_server"] = "Download Images to My Server";
    $p["auto_update"] = "Auto Update";
    $p["show_read_more_button"] = "Show Read More Button";
    $p["add_posts_as_draft"] = "Add Posts as Draft";
    $p["read_more_button_text"] = "Read More Button Text";
    $p["update"] = "Update";
    $p["msg_rss_warning"] = "If you chose to download the images to your server, adding posts will take more time and will use more resources. If you see any problems, increase max_execution_time and memory_limit values from your server settings.";
    $p["msg_cron_feed"] = "With this URL you can automatically update your feeds.";
    $p["update_rss_feed"] = "Update Rss Feed";
    $p["feed"] = "Feed";
    $p["generate_keywords_from_title"] = "Generate Keywords from Title";
    $p["confirm_item"] = "Are you sure you want to delete this item?";
    $p["file_manager"] = "File Manager";
    $p["show_all_files"] = "Show all Files";
    $p["show_only_own_files"] = "Show Only Users Own Files";
    $p["maintenance_mode"] = "Maintenance Mode";
    $p["msg_cron_sitemap"] = "With this URL you can automatically update your sitemap.";
    $p["custom_css_codes"] = "Custom CSS Codes";
    $p["custom_javascript_codes"] = "Custom JavaScript Codes";
    $p["custom_css_codes_exp"] = "These codes will be added to the header of the site.";
    $p["custom_javascript_codes_exp"] = "These codes will be added to the footer of the site.";
    $p["font_settings"] = "Font Settings";
    $p["site_font"] = "Site Font";
    $p["add_font"] = "Add Font";
    $p["font_family"] = "Font Family";
    $p["fonts"] = "Fonts";
    $p["update_font"] = "Update Font";
    $p["msg_item_added"] = "Item successfully added!";
    addTranslations($p);
}

function updateFrom40To41()
{
    runQuery("DELETE FROM ci_sessions;");
    runQuery("ALTER TABLE ci_sessions DROP COLUMN `timestamp`;");
    runQuery("ALTER TABLE ci_sessions ADD COLUMN `timestamp` timestamp DEFAULT current_timestamp();");
    runQuery("ALTER TABLE ci_sessions ADD INDEX ci_sessions_timestamp (timestamp);");
    runQuery("ALTER TABLE general_settings ADD COLUMN `admin_route` VARCHAR(255) DEFAULT 'admin';");
    runQuery("ALTER TABLE general_settings ADD COLUMN `mail_encryption` VARCHAR(100) DEFAULT 'tls';");
    runQuery("ALTER TABLE general_settings ADD COLUMN `mail_reply_to` VARCHAR(255) DEFAULT 'noreply@domain.com';");
    runQuery("ALTER TABLE general_settings ADD COLUMN `auto_post_deletion` TINYINT(1) DEFAULT 0;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `auto_post_deletion_delete_all` TINYINT(1) DEFAULT 0;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `auto_post_deletion_days` INT(11) DEFAULT 30;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `newsletter_status` TINYINT(1) DEFAULT 1;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `newsletter_popup` TINYINT(1) DEFAULT 1;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `newsletter_temp_emails` LONGTEXT;");
    runQuery("ALTER TABLE general_settings ADD COLUMN `allowed_file_extensions` VARCHAR(500) DEFAULT 'jpg,jpeg,png,gif,svg,csv,doc,docx,pdf,ppt,psd,mp4,mp3,zip';");
    runQuery("ALTER TABLE general_settings DROP COLUMN `inf_key`;");
    runQuery("ALTER TABLE general_settings DROP COLUMN `purchase_code`;");
    runQuery("UPDATE general_settings SET `site_color` = '#0494b1' WHERE id = 1;");
    runQuery("UPDATE general_settings SET `version` = '4.1' WHERE id = 1;");
    runQuery("ALTER TABLE users DROP COLUMN `site_color`;");
    runQuery("ALTER TABLE users DROP COLUMN `site_mode`;");

    //translations
    runQuery("DELETE FROM language_translations WHERE label = 'send_email_registered';");
    runQuery("DELETE FROM language_translations WHERE label = 'gmail_smtp';");
    runQuery("DELETE FROM language_translations WHERE label = 'select_color';");
    runQuery("DELETE FROM language_translations WHERE label = 'download_sitemap';");
    runQuery("DELETE FROM language_translations WHERE label = 'update_sitemap';");
    runQuery("DELETE FROM language_translations WHERE label = 'gmail_warning';");
    runQuery("DELETE FROM language_translations WHERE label = 'send_email_subscribers';");
    runQuery("DELETE FROM language_translations WHERE label = 'msg_register_character_error';");

    //add new translations
    $p = array();
    $p["set_as_default"] = "Set as Default";
    $p["export"] = "Export";
    $p["translation"] = "Translation";
    $p["import_language"] = "Import Language";
    $p["json_language_file"] = "JSON Language File";
    $p["latest_posts"] = "Latest Posts";
    $p["google_fonts"] = "Google Fonts";
    $p["encryption"] = "Encryption";
    $p["reply_to"] = "Reply to";
    $p["send_test_email"] = "Send Test Email";
    $p["send_test_email_exp"] = "You can send a test mail to check if your mail server is working.";
    $p["newsletter_popup"] = "Newsletter Popup";
    $p["newsletter_email_error"] = "Select email addresses that you want to send mail!";
    $p["newsletter_send_many_exp"] = "Some servers do not allow mass mailing. Therefore, instead of sending your mails to all subscribers at once, you can send them part by part (Example: 50 subscribers at once). If your mail server stops sending mail, the sending process will also stop.";
    $p["mail_is_being_sent"] = "Mail is being sent. Please do not close this page until the process is finished!";
    $p["completed"] = "Completed";
    $p["join_newsletter"] = "Join Our Newsletter";
    $p["newsletter_desc"] = "Join our subscribers list to get the latest news, updates and special offers directly in your inbox";
    $p["email_address"] = "Email Address";
    $p["no_thanks"] = "No, thanks";
    $p["msg_published"] = "Post successfully published!";
    $p["top_menu"] = "Top Menu";
    $p["main_menu"] = "Main Menu";
    $p["edit_user"] = "Edit User";
    $p["site_color"] = "Site Color";
    $p["auto_post_deletion"] = "Auto Post Deletion";
    $p["number_of_days"] = "Number of Days";
    $p["number_of_days_exp"] = "If you add 30 here, the system will delete posts older than 30 days";
    $p["delete_all_posts"] = "Delete All Posts";
    $p["delete_only_rss_posts"] = "Delete only RSS Posts";
    $p["allowed_file_extensions"] = "Allowed File Extensions";
    $p["file_extensions"] = "File Extensions";
    $p["invalid_file_type"] = "Invalid File Type!";

    addTranslations($p);
}

function updateFrom41To42()
{
    $tableRoles = "CREATE TABLE `roles_permissions` (
      `id` INT AUTO_INCREMENT PRIMARY KEY,
      `role_name` text DEFAULT NULL,
      `permissions` text DEFAULT NULL,
      `is_super_admin` tinyint(1) DEFAULT 0,
      `is_admin` tinyint(1) DEFAULT 0,
      `is_author` tinyint(1) DEFAULT 0,
      `is_default` tinyint(1) DEFAULT 0
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

    runQuery($tableRoles);
    runQuery("ALTER TABLE users ADD COLUMN `role_id` smallint(6) DEFAULT 3;");

    $languages = runQuery("SELECT * FROM languages;");
    $nameArrayAdmin = array();
    $nameArrayAuthor = array();
    $nameArrayMember = array();
    while ($language = mysqli_fetch_array($languages)) {
        $itemAdmin = array(
            'lang_id' => $language['id'],
            'name' => "Super Admin"
        );
        array_push($nameArrayAdmin, $itemAdmin);

        $itemAuthor = array(
            'lang_id' => $language['id'],
            'name' => "Author"
        );
        array_push($nameArrayAuthor, $itemAuthor);

        $itemMember = array(
            'lang_id' => $language['id'],
            'name' => "Member"
        );
        array_push($nameArrayMember, $itemMember);
    }
    $nameArrayAdmin = serialize($nameArrayAdmin);
    $nameArrayAuthor = serialize($nameArrayAuthor);
    $nameArrayMember = serialize($nameArrayMember);

    $sqlRoles = "INSERT INTO `roles_permissions` (`id`, `role_name`, `permissions`, `is_super_admin`, `is_admin`, `is_author`, `is_default`) VALUES
                (1, '" . $nameArrayAdmin . "', 'all', 1, 1, 1, 1),
                (2, '" . $nameArrayAuthor . "', '2', 0, 0, 1, 1),
                (3, '" . $nameArrayMember . "', '', 0, 0, 0, 1);";
    runQuery($sqlRoles);

    $users = runQuery("SELECT * FROM users;");
    if (!empty($users->num_rows)) {
        while ($user = mysqli_fetch_array($users)) {
            $roleId = 3;
            if ($user['role'] == "admin") {
                $roleId = 1;
            } elseif ($user['role'] == "author") {
                $roleId = 2;
            }
            runQuery("UPDATE `users` SET `role_id` = " . $roleId . " WHERE id = " . $user['id']);
        }
    }
    runQuery("ALTER TABLE users DROP COLUMN `role`;");
    runQuery("UPDATE general_settings SET `version` = '4.2' WHERE id = 1;");

    //add new translations
    $p = array();
    $p["roles_permissions"] = "Roles Permissions";
    $p["add_role"] = "Add Role";
    $p["permissions"] = "Permissions";
    $p["role_name"] = "Role Name";
    $p["edit_role"] = "Edit Role";
    $p["roles"] = "Roles";
    $p["manage_all_posts"] = "Manage All Posts";
    $p["membership"] = "Membership";
    $p["confirm_delete"] = "Are you sure you want to delete this item?";
    $p["all_permissions"] = "All Permissions";
    $p["download_database_backup"] = "Download Database Backup";
    $p["dont_want_receive_emails"] = "Do not want receive these emails?";
    addTranslations($p);
}

function addTranslations($translations)
{
    $languages = runQuery("SELECT * FROM languages;");
    if (!empty($languages->num_rows)) {
        while ($language = mysqli_fetch_array($languages)) {
            foreach ($translations as $key => $value) {
                $trans = runQuery("SELECT * FROM language_translations WHERE label ='" . $key . "' AND lang_id = " . $language['id']);
                if (empty($trans->num_rows)) {
                    runQuery("INSERT INTO `language_translations` (`lang_id`, `label`, `translation`) VALUES (" . $language['id'] . ", '" . $key . "', '" . $value . "');");
                }
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Infinite - Update Wizard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            color: #444 !important;
            font-size: 14px;
            background: #007991;
            background: -webkit-linear-gradient(to left, #007991, #6fe7c2);
            background: linear-gradient(to left, #007991, #6fe7c2);
        }

        .logo-cnt {
            text-align: center;
            color: #fff;
            padding: 60px 0 60px 0;
        }

        .logo-cnt .logo {
            font-size: 42px;
            line-height: 42px;
        }

        .logo-cnt p {
            font-size: 22px;
        }

        .install-box {
            width: 100%;
            padding: 30px;
            left: 0;
            right: 0;
            top: 0;
            bottom: 0;
            margin: auto;
            background-color: #fff;
            border-radius: 4px;
            display: block;
            float: left;
            margin-bottom: 100px;
        }

        .form-input {
            box-shadow: none !important;
            border: 1px solid #ddd;
            height: 44px;
            line-height: 44px;
            padding: 0 20px;
        }

        .form-input:focus {
            border-color: #239CA1 !important;
        }

        .btn-custom {
            background-color: #239CA1 !important;
            border-color: #239CA1 !important;
            border: 0 none;
            border-radius: 4px;
            box-shadow: none;
            color: #fff !important;
            font-size: 16px;
            font-weight: 300;
            height: 40px;
            line-height: 40px;
            margin: 0;
            min-width: 105px;
            padding: 0 20px;
            text-shadow: none;
            vertical-align: middle;
        }

        .btn-custom:hover, .btn-custom:active, .btn-custom:focus {
            background-color: #239CA1;
            border-color: #239CA1;
            opacity: .8;
        }

        .tab-content {
            width: 100%;
            float: left;
            display: block;
        }

        .tab-footer {
            width: 100%;
            float: left;
            display: block;
        }

        .buttons {
            display: block;
            float: left;
            width: 100%;
            margin-top: 30px;
        }

        .title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
            margin-top: 0;
            text-align: center;
        }

        .sub-title {
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 30px;
            margin-top: 0;
            text-align: center;
        }

        .alert {
            text-align: center;
        }

        .alert strong {
            font-weight: 500 !important;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-12 col-md-offset-2">
            <div class="row">
                <div class="col-sm-12 logo-cnt">
                    <h1>Infinite</h1>
                    <p>Welcome to the Update Wizard</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="install-box">
                        <h2 class="title">Update from v3.9 to v4.2</h2>
                        <br><br>
                        <div class="messages">
                            <?php if (!empty($error)) { ?>
                                <div class="alert alert-danger">
                                    <strong><?= $error; ?></strong>
                                </div>
                            <?php } ?>
                            <?php if (!empty($success)) { ?>
                                <div class="alert alert-success">
                                    <strong><?= $success; ?></strong>
                                    <style>.alert-info {
                                            display: none;
                                        }</style>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="step-contents">
                            <div class="tab-1">
                                <?php if (empty($success)): ?>
                                    <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                                        <div class="tab-footer text-center">
                                            <button type="submit" name="btn_submit" class="btn-custom">Update My Database</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
