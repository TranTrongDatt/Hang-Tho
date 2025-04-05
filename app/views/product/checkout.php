<?php
$page = "checkout"; // ✅ Xác định trang để load CSS phù hợp
$page_css = "checkout.css"; // ✅ Gán file CSS riêng cho trang checkout
include 'app/views/shares/header.php';
?>

<main class="container mt-5 flex-grow-1 main-content">
    <h1 class="text-center text-warning mb-4">💳 Thanh Toán</h1>

    <?php if (empty($_SESSION['cart'])): ?>
        <p class="empty-cart text-center">🚨 Giỏ hàng trống! Hãy thêm sản phẩm trước khi thanh toán.</p>
        <div class="text-center mt-4">
            <a href="/hangtho/Product/" class="btn btn-warning btn-lg">🛍 Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <div class="checkout-container d-flex flex-wrap justify-content-between">
            
            <!-- 🧾 Thông tin đơn hàng -->
            <div class="order-summary col-md-5 mb-4">
                <h2 class="text-warning text-center">🛍 Đơn Hàng Của Bạn</h2>
                <ul class="list-group">
                    <?php 
                    $total_price = 0;
                    foreach ($_SESSION['cart'] as $item): 
                        $subtotal = $item['quantity'] * $item['price'];
                        $total_price += $subtotal;
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?> (x<?php echo $item['quantity']; ?>)</span>
                        <span><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</span>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <h4 class="text-warning text-right mt-3">Tổng cộng: <?php echo number_format($total_price, 0, ',', '.'); ?> VND</h4>
            </div>

            <!-- 📄 Form thông tin thanh toán -->
            <div class="payment-form col-md-6 mb-4">
                <h2 class="text-warning text-center">📌 Thông Tin Thanh Toán</h2>
                <form method="POST" action="/hangtho/Product/processCheckout">
                    <div class="form-group mb-3">
                        <label for="name">Họ và Tên</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" class="form-control" required>
                    </div>

                    <div class="form-group mb-4">
                        <label for="address">Địa chỉ nhận hàng</label>
                        <textarea id="address" name="address" class="form-control" required></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg w-100">✅ Đặt Hàng</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</main>

<?php include 'app/views/shares/footer.php'; ?>
