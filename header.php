<?php
    ob_start();
    session_start();
?>
<?php include 'config/SQLQuery.php'?>
<!DOCTYPE html>
<html lang="en-gb" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Món ăn</title>
    <link type="image/png" href="/template/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Leckerli+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/template/client/css/main.css" />
    <script src="/template/client/js/uikit.js"></script>
</head>

<body>

    <nav class="uk-navbar-container uk-letter-spacing-small">
        <div class="uk-container">
            <div class="uk-position-z-index" data-uk-navbar>
                <div class="uk-navbar-left">
                    <a class="uk-navbar-item uk-logo" href="/">Hướng dẫn nấu ăn</a>
                    <ul class="uk-navbar-nav uk-visible@m uk-margin-large-left">
                        <li class="uk-active"><a href="/">Trang chủ</a></li>
                        <li><a href="/search.php">Tìm kiếm</a></li>
                        <li><a href="/contact.php">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <div>
                        <a class="uk-navbar-toggle" data-uk-search-icon href="#"></a>
                        <div class="uk-drop uk-background-default" data-uk-drop="mode: click; pos: left-center; offset: 0">
                            <form action="/" class="uk-search uk-search-navbar uk-width-1-1">
                                <input name="q" class="uk-search-input uk-text-demi-bold" type="search" placeholder="Tìm kiếm..." autofocus>
                            </form>
                        </div>
                    </div>
                    <ul class="uk-navbar-nav uk-visible@m">
                        <?php if (isset($_SESSION['user'])): ?>
                        <li>
                            <a href="#">👤 <?=htmlspecialchars($_SESSION['user']['username'])?></a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                                    <li><a href="/admin/foods/">Quản trị</a></li>
                                    <?php endif; ?>
                                    <li><a href="/admin/favorite/">Yêu thích của tôi</a></li>
                                    <li><a href="/logout.php">Đăng xuất</a></li>
                                </ul>
                            </div>
                        </li>
                        <?php else: ?>
                        <li><a href="sign-in.php">Đăng nhập</a></li>
                        <?php endif; ?>
                    </ul>

                    <div class="uk-navbar-item">
                        <?php if (!isset($_SESSION['user'])): ?>
                        <div><a class="uk-button uk-button-primary" href="sign-up.php">Đăng ký</a></div>
                        <?php endif; ?>
                    </div>
                    <a class="uk-navbar-toggle uk-hidden@m" href="#offcanvas" data-uk-toggle><span data-uk-navbar-toggle-icon></span></a>
                </div>
            </div>
        </div>
    </nav>