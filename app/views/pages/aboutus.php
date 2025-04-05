<?php 
$page = "aboutus";              // dùng để load ảnh nền: aboutus-bg.jpg (nếu có)
$page_css = "AboutUs.css";      // dùng để load file CSS riêng
include 'app/views/shares/header.php'; 
?>

<main class="aboutus-container container mt-5 mb-5 text-light">
    <h1 class="text-warning text-center mb-4">ABOUT US</h1>
    <p>[HangTho Company / Thừa hưởng và phát triển]</p>
    <p>
        “Được sáng lập bởi Bùi Bảo Hân - sinh viên năm 3 ngu ngốc”
    </p>
    <p>
        Lớn lên giữa những trò chơi điện tử, những chiếc máy game cầm tay như PSP, 3DS, PS4, và Nintendo, đam mê game đã là người bạn đồng hành từ khi còn nhỏ. Từ đó, tôi phát triển khả năng tư duy logic và kỹ năng công nghệ, cùng ước mơ trở thành một Business Analyst chuyên nghiệp để không chỉ tự tạo dựng tương lai mà còn lo lắng cho mẹ, giúp bà có cuộc sống không phải lo nghĩ về điều gì.
    </p>

    <div class="image text-center mt-4">
        <img src="/hangtho/public/images/tho_aboutus.jpg" alt="About Us Image" class="img-fluid rounded shadow" style="max-width: 100%; height: auto;">
    </div>
</main>
<?php include 'app/views/shares/footer.php'; ?>
