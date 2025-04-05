<?php
$page = "show"; // ✅ Đặt biến để xác định trang
$page_css = "show.css"; // ✅ Gán file CSS riêng cho trang show
include 'app/views/shares/header.php';
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">

    <div class="card shadow-lg border border-warning">
        <div class="card-header bg-dark text-warning text-center">
            <h2 class="mb-0">Chi Tiết Sản Phẩm</h2>
        </div>
        <div class="card-body bg-dark text-light">
            <?php if ($product): ?>
            <div class="row">
                <div class="col-md-6">
                    <?php if ($product->image): ?>
                        <img src="/hangtho/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                             class="img-fluid rounded border border-warning shadow-lg" 
                             alt="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>">
                    <?php else: ?>
                        <img src="/hangtho/images/no-image.png" class="img-fluid rounded border border-warning" alt="Không có ảnh">
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <h3 class="card-title text-warning font-weight-bold"><?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?></h3>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?></p>
                    <p class="text-danger font-weight-bold h4">💰 <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                    <p><strong>Danh mục:</strong>
                        <span class="badge bg-warning text-dark"><?php echo !empty($product->category_name) ? htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8') : 'Chưa có danh mục'; ?></span>
                    </p>

                    <div class="mt-4">
                        <a href="/hangtho/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success px-4">➕ Thêm vào giỏ hàng</a>
                        <a href="/hangtho/Product/list" class="btn btn-secondary px-4 ml-2">Quay lại danh sách</a>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="alert alert-danger text-center">
                <h4>Không tìm thấy sản phẩm!</h4>
            </div>
            <?php endif; ?>
        </div>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
