<?php
$page = "orderConfirmation"; // ✅ Xác định trang để load CSS phù hợp
$page_css = "orderConfirmation.css"; // ✅ Gán file CSS riêng cho trang order confirmation
include 'app/views/shares/header.php';

// ✅ Kiểm tra xem đơn hàng có tồn tại không
if (!isset($order) || empty($order)) {
    echo "<p class='text-center text-danger'>Không tìm thấy đơn hàng!</p>";
    include 'app/views/shares/footer.php';
    exit();
}
?>

<main class="container mt-5 flex-grow-1 main-content">
    <div class="confirmation-box text-center">
        <h1 class="text-warning">🎉 Đơn Hàng Đã Được Xác Nhận!</h1>
        <p class="text-light">Cảm ơn bạn đã đặt hàng tại Hang Thỏ! Chúng tôi sẽ liên hệ để xác nhận đơn hàng và giao hàng trong thời gian sớm nhất.</p>

        <div class="order-details">
            <h3 class="text-warning">📦 Thông Tin Đơn Hàng</h3>
            <ul>
                <li><strong>Khách hàng:</strong> <?php echo htmlspecialchars($order['name'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></li>
                <li><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($order['phone'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></li>
                <li><strong>Địa chỉ giao hàng:</strong> <?php echo htmlspecialchars($order['address'] ?? 'N/A', ENT_QUOTES, 'UTF-8'); ?></li>
                <li><strong>Ngày đặt hàng:</strong> <?php echo date("d/m/Y H:i:s", strtotime($order['created_at'] ?? '')); ?></li>
                <li><strong>Tổng tiền:</strong> 💰 <?php echo number_format($order['total_price'] ?? 0, 0, ',', '.'); ?> VND</li>
            </ul>
        </div>

        <div class="action-buttons">
            <a href="/hangtho/Product/" class="btn btn-warning btn-lg">🛍 Tiếp tục mua sắm</a>
            <a href="/hangtho/Product/cart" class="btn btn-secondary btn-lg">📦 Xem giỏ hàng</a>
        </div>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
