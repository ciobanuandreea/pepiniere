<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/public/css/style.css" rel="stylesheet" type="text/css">
    <link id="theme-style" href="/public/css/theme-dark.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="/public/images/logo_icon.ico" type="image/x-icon"/>
</head>
<body>
    <div class="banner">
        <?php require_once("C://wamp64/www/pepiniere_labranche/controller/controller.php"); ?>
        <?php include("header.php"); ?>
        <?php include("navbar.php"); ?>
    </div>
    <?php
    if ($title == "Produits") {
        ?>
        <div class="content" id="slideshow">
            <?= $content ?>
        </div>
        <?php
    } else {
        ?>
        <div class="content flex-center" id="slideshow">
            <?= $content ?>
        </div>
        <?php
    } ?>
    <?php include("footer.php"); ?>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="/public/js/theme-toggle.js"></script>
<script type="text/javascript" src="/public/js/animations.js"></script>
</body>
</html>