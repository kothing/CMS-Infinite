<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>404 Page Not Found</title>
    <link rel="shortcut icon" type="image/png" href="<?= getFavicon($generalSettings); ?>"/>
    <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet"/>
    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            color: #555;
            font-family: Verdana, Geneva, sans-serif;
        }

        .flex-container {
            height: 100%;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .error-404 {
            display: inline-block;
            vertical-align: middle;
            float: none;
            min-height: 500px;
            width: 100%;
            text-align: center;
        }

        .error-404 h1 {
            font-size: 128px;
            font-weight: bold;
            margin-bottom: 10px
        }

        .error-404 h2 {
            margin-top: 10px;
            font-size: 32px;
            color: #777;
        }

        .btn {
            margin-top: 15px;
            border-radius: 3px !important;
            border-color: #e4e4e4 !important;
            font-size: 14px !important;
            color: #555 !important;
            -moz-transition: all .2s ease-in-out 0s;
            -webkit-transition: all .2s ease-in-out 0s;
            transition: all .2s ease-in-out 0s;
            outline: none !important;
        }

        .btn:hover, .btn:focus, .btn:active {
            background-color: #f6f6f6 !important;
        }

        .svg-icon {
            width: 1em;
            height: 1em;
            display: inline-block;
            vertical-align: middle;
            position: relative;
            margin-right: 5px;
            top: -0.063rem !important;
        }
    </style>
</head>
<body>
<div class="flex-container">
    <div class="error-404">
        <h1>404</h1>
        <h2><?= trans("page_not_found"); ?></h2>
        <p><?= trans("page_not_found_sub"); ?></p>
        <a class="btn btn-lg btn-default" href="<?= langBaseUrl(); ?>">
            <svg width="18" height="18" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg" fill="#555" class="svg-icon">
                <path d="M1792 800v192q0 14-9 23t-23 9h-1248v224q0 21-19 29t-35-5l-384-350q-10-10-10-23 0-14 10-24l384-354q16-14 35-6 19 9 19 29v224h1248q14 0 23 9t9 23z"/>
            </svg>
            <?= trans("go_to_home"); ?>
        </a>
    </div>
</div>
</body>
</html>
