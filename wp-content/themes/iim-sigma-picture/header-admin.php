<?php
if (is_front_page() && is_user_logged_in()) {
    wp_redirect(get_the_permalink(get_page_by_path('dashboard')));
    exit;
} elseif( ! is_front_page() && ! is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
} elseif(checkRole() !== 'admin') {
	wp_redirect(home_url());
	exit;
}
if (ENV === 'DEV') {
	require __DIR__ . '/vendor/autoload.php';
}
?>
<!DOCTYPE html>
<!--[if IE 7]>
    <html class="ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>
    <html class="ie ie8" <?php language_attributes(); ?>><![endif]-->
    <!--[if !(IE 7) | !(IE 8)  ]><!-->
    <html <?php language_attributes(); ?>><!--<![endif]-->
    <head>
        <title><?php the_title(); ?></title>
        <meta charset="utf-8mb4">
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <!-- Favicon -->
        <link rel="apple-touch-icon" sizes="57x57" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/assets/favicon/apple-touch-icon-180x180.png">
        <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/favicon/favicon-32x32.png" sizes="32x32">
        <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/favicon/android-chrome-192x192.png" sizes="192x192">
        <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/favicon/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php bloginfo('template_directory'); ?>/assets/favicon/favicon-16x16.png" sizes="16x16">
        <link rel="manifest" href="<?php bloginfo('template_directory'); ?>/assets/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#000000">
        <meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/assets/favicon/mstile-144x144.png">
        <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/file-uploader/5.16.2/all.fine-uploader/fine-uploader-new.min.css">

        <link href="<?php bloginfo('template_directory'); ?>/style/matt.css" rel="stylesheet">

        <!-- Styles -->
        <?php $version = filemtime(get_theme_root() . '/' . get_template() . '/style/main.css'); ?>
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style/main.css?v=<?= $version; ?>">

    <!--[if lt IE 9]>
    <script src="<?php bloginfo( 'template_directory' ); ?>/script/build/html5shiv.min.js"></script>
    <script src="<?php bloginfo( 'template_directory' ); ?>/script/build/respond.min.js"></script>
<![endif]-->

    <style>
        #trigger-upload {
            color: white;
            background-color: #00ABC7;
            font-size: 14px;
            padding: 7px 20px;
            background-image: none;
            display: none;
        }

        #fine-uploader-manual-trigger .qq-upload-button {
            width: 220px;
            margin-right: 15px;
        }

        #fine-uploader-manual-trigger .buttons {
            width: 36%;
        }

        #fine-uploader-manual-trigger .qq-uploader {
            overflow-x: hidden;
        }

        #fine-uploader-manual-trigger .qq-uploader .qq-total-progress-bar-container {
            width: 60%;
        }
    </style>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <header >
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>
