<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hang Thỏ - Quản lý sản phẩm</title>

    <!-- ✅ CSS chung -->
    <link rel="stylesheet" href="/hangtho/public/css/style.css">

    <!-- ✅ CSS riêng -->
    <?php if (isset($page_css)) {
        echo '<link rel="stylesheet" href="/hangtho/public/css/' . $page_css . '">';
    } ?>

    <!-- ✅ Hình nền -->
    <?php $background_image = "/hangtho/public/images/" . $page . "-bg.jpg"; ?>
    <style>
        body {
            background: url("<?php echo $background_image; ?>") !important;
            background-repeat: no-repeat !important;
            background-position: center center !important;
            background-size: cover !important;
            background-attachment: fixed !important;
        }
    </style>

    <!-- ✅ Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ JavaScript -->
    <script src="/hangtho/public/js/search.js" defer></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/hangtho/">
                <img src="/hangtho/public/images/logo.png" alt="Hang Thỏ Logo" style="height: 40px;">
                Hang Thỏ
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Bên trái -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link" href="/hangtho/">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/hangtho/AboutUs">Giới thiệu</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Giao diện</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/hangtho/homeAPI">Giao diện API</a>
                            <a class="dropdown-item" href="/hangtho/">Giao diện MVC</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sản phẩm</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/hangtho/Category">Danh mục sản phẩm</a>
                            <a class="dropdown-item" href="/hangtho/Product">Danh sách sản phẩm</a>
                        </div>
                    </li>
                </ul>

                <!-- Thêm ô tìm kiếm -->
                <form class="search-bar ml-auto" action="/hangtho/Search" method="GET">
                    <input type="text" name="query" id="search-input" class="form-control" placeholder="Tìm kiếm sản phẩm hoặc danh mục...">
                </form>

                <!-- Bên phải -->
                <ul class="navbar-nav ml-auto">
                    <?php if (SessionHelper::isLoggedIn()): ?>
                        <li class="nav-item">
                            <span class="navbar-text text-warning mr-3">
                                <?php 
                                    $user = $_SESSION['username'];
                                    echo SessionHelper::isAdmin() ? "Welcome Admin $user" : "Welcome $user";
                                ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/hangtho/Account/logout">Đăng xuất</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/hangtho/Product/cart">
                                🛒 Giỏ hàng 
                                <span class="badge bg-warning" id="cart-count">
                                    <?php echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0; ?>
                                </span>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="/hangtho/account/auth">Đăng nhập</a></li>
                        <li class="nav-item"><a class="nav-link" href="/hangtho/account/auth">Đăng ký</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="main-content">
        