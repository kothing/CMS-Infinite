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
    updateFrom40To41();
    sleep(1);
    updateFrom41To42();
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
                        <h2 class="title">Update from v4.0.x to v4.2</h2>
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
