<?php
$page = "homeAPI";
$page_css = "homeAPI.css"; // Xác định CSS riêng cho giao diện API
include 'app/views/shares/header.php'; 
?>

<main class="main-container">
    <!-- Giới thiệu về Hang Thỏ API -->
    <div class="intro-text">
        <h2>Chào mừng đến với Giao Diện API Hang Thỏ</h2>
        <p>Hang Thỏ là nơi bạn sẽ tìm thấy những hương vị cà phê tuyệt vời, từ những ly Espresso mạnh mẽ đến Latte mịn màng.</p>
        <!-- Liên kết đến API danh mục -->
        <a href="/hangtho/categoryAPI" class="btn btn-primary">Khám phá menu của chúng tôi</a>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
