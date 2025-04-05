<?php 
$page = "contact";              // dùng để load ảnh nền: contact-bg.jpg (nếu có)
$page_css = "contact.css";      
include 'app/views/shares/header.php'; 
?>

<main class="contact-container container mt-5 mb-5 text-light">
    <h1 class="text-warning text-center mb-4">LIÊN HỆ</h1>
    <div class="row">
        <div class="col-md-6 mb-4">
            <iframe src="https://www.google.com/maps?q=84+Trần+Quang+Diệu,+Quận+3,+TP.HCM&output=embed"
                    width="100%" height="350" frameborder="0" allowfullscreen></iframe>
        </div>
        <div class="col-md-6">
            <h4>Thông tin liên hệ</h4>
            <p>📍 Địa chỉ shop: 84 Trần Quang Diệu, P14, Quận 3, TP.HCM</p>
            <p>📞 Hotline: <strong>0329222698</strong></p>
            <p>⏰ Mở cửa: Tất cả các ngày từ 9:00 - 22:00</p>

            <h5 class="mt-4">Gửi thắc mắc</h5>
            <form>
                <input class="form-control mb-2" type="text" placeholder="Tên của bạn">
                <input class="form-control mb-2" type="email" placeholder="Email của bạn">
                <input class="form-control mb-2" type="text" placeholder="Số điện thoại">
                <textarea class="form-control mb-3" rows="3" placeholder="Nội dung..."></textarea>
                <button class="btn btn-pink">Gửi</button>
            </form>
        </div>
    </div>
</main>
<?php include 'app/views/shares/footer.php'; ?>
