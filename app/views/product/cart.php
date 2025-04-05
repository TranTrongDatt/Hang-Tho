<?php
$page = "cart"; // ✅ Xác định trang để load CSS phù hợp
$page_css = "cart.css"; // ✅ Gán file CSS riêng cho trang cart
include 'app/views/shares/header.php';
?>

<main class="container mt-5 flex-grow-1 main-content">
    <h1 class="text-center text-warning mb-4">🛒 Giỏ Hàng Của Bạn</h1>

    <?php if (empty($cart)): ?>
        <p class="empty-cart text-center">🚨 Giỏ hàng trống! Hãy thêm sản phẩm ngay.</p>
        <div class="text-center mt-4">
            <a href="/hangtho/Product/" class="btn btn-warning btn-lg">🛍 Tiếp tục mua sắm</a>
        </div>
    <?php else: ?>
        <table class="table cart-table">
            <thead>
                <tr>
                    <th>Hình Ảnh</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Đơn Giá</th>
                    <th>Số Lượng</th>
                    <th>Tổng Giá</th>
                    <th>Hành Động</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_price = 0;
                foreach ($cart as $id => $item): 
                    $subtotal = $item['quantity'] * $item['price'];
                    $total_price += $subtotal;
                ?>
                <tr>
                    <td>
                        <img src="/hangtho/<?php echo $item['image'] ? $item['image'] : 'images/no-image.png'; ?>" 
                             class="cart-img" alt="Product Image">
                    </td>
                    <td><?php echo htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                    <td>
                        <div class="quantity-control">
                            <a href="/hangtho/Product/addToCart/<?php echo $id; ?>" class="btn btn-sm btn-success">+</a>
                            <span><?php echo $item['quantity']; ?></span>
                            <a href="/hangtho/Product/removeFromCart/<?php echo $id; ?>" class="btn btn-sm btn-danger">-</a>
                        </div>
                    </td>
                    <td><?php echo number_format($subtotal, 0, ',', '.'); ?> VND</td>
                    <td>
                        <a href="/hangtho/Product/removeFromCart/<?php echo $id; ?>" class="btn btn-danger btn-sm">❌ Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="cart-summary text-end">
            <h3 class="text-warning">Tổng cộng: <?php echo number_format($total_price, 0, ',', '.'); ?> VND</h3>
            
            <?php if (SessionHelper::isLoggedIn()): ?>
                <a href="/hangtho/Product/checkout" class="btn btn-success btn-lg">💳 Thanh Toán</a>
            <?php else: ?>
                <a href="/hangtho/account/auth" class="btn btn-warning btn-lg">
                    🔒 Vui lòng đăng nhập để thanh toán
                </a>
            <?php endif; ?>
        </div>

    <?php endif; ?>
</main>

<?php include 'app/views/shares/footer.php'; ?>
