<?php
$page = "home";
$page_css = "home.css"; // Xác định CSS riêng cho trang chủ
include 'app/views/shares/header.php'; 
?>

<main class="main-container">
    <!-- Slider container -->
    <div class="slider-container">
        <!-- Slide 1 -->
        <div class="product-slide active">
            <img src="/hangtho/public/images/slide1.jpg" alt="Slide 1" />
            <div class="slide-text">
                <h2>Nâng Tầm</h2>
                <p>Đẳng cấp cùng vani hạt vanilla</p>
            </div>
        </div>
        <!-- Slide 2 -->
        <div class="product-slide">
            <img src="/hangtho/public/images/slide2.jpg" alt="Slide 2" />
            <div class="slide-text">
                <h2>Coffee Break</h2>
                <p>Chất lượng tuyệt hảo, hương vị đậm đà</p>
            </div>
        </div>
        <!-- Slide 3 -->
        <div class="product-slide">
            <img src="/hangtho/public/images/slide3.jpg" alt="Slide 3" />
            <div class="slide-text">
                <h2>Hang Thỏ Special</h2>
                <p>Trải nghiệm cà phê đỉnh cao</p>
            </div>
        </div>

        <!-- Nút điều khiển -->
        <div class="slide-controls">
            <button class="slide-btn" data-slide="0"></button>
            <button class="slide-btn" data-slide="1"></button>
            <button class="slide-btn" data-slide="2"></button>
        </div>
    </div>

    <!-- Giới thiệu về Hang Thỏ -->
    <div class="intro-text">
        <h2>Chào mừng bạn đến với Hang Thỏ</h2>
        <p>Hang Thỏ là nơi bạn sẽ tìm thấy những hương vị cà phê tuyệt vời, từ những ly Espresso mạnh mẽ đến Latte mịn màng.</p>
        <a href="/hangtho/Product" class="btn-explore">Khám phá menu của chúng tôi</a>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
