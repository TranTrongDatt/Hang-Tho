<?php
$page = "list";
$page_css = "list.css"; // ✅ Đặt biến $page để xác định trang
include 'app/views/shares/header.php'; 
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">
    <h1 class="text-center text-warning mb-4">Danh sách Sản Phẩm</h1>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php foreach ($products as $product): ?>
        <div class="col">
            <div class="card shadow-lg rounded text-light border border-warning">
                <img src="/hangtho/<?php echo $product->image ? $product->image : 'images/no-image.png'; ?>" 
                     class="card-img-top border-bottom border-warning" 
                     alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title">
                        <a href="/hangtho/Product/show/<?php echo $product->id; ?>" 
                           class="text-decoration-none text-warning">
                            <?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </h5>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8')); ?></p>
                    <p class="text-danger font-weight-bold h5">💰 <?php echo number_format($product->price, 0, ',', '.'); ?> VND</p>
                    <p><strong>Danh mục:</strong> <?php echo htmlspecialchars($product->category_name, ENT_QUOTES, 'UTF-8'); ?></p>

                    <div class="d-flex justify-content-center mt-2">
                        <?php if (SessionHelper::isLoggedIn()): ?>
                            <a href="/hangtho/Product/addToCart/<?php echo $product->id; ?>" class="btn btn-success btn-cart">
                                🛒 Thêm vào giỏ
                            </a>
                        <?php endif; ?>

                        <?php if (SessionHelper::isAdmin()): ?>
                            <a href="/hangtho/Product/edit/<?php echo $product->id; ?>" class="btn btn-warning btn-sm shadow-sm">Sửa</a>
                            <a href="/hangtho/Product/delete/<?php echo $product->id; ?>" class="btn btn-danger btn-sm shadow-sm" onclick="return confirm(Bạn có chắc chắn muốn xóa sản phẩm này?);">Xóa</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <?php if (SessionHelper::isAdmin()): ?>
        <div class="col">
            <div class="category-card shadow-lg rounded text-light d-flex align-items-center justify-content-center add-product">
                <a href="/hangtho/Product/add" class="add-product-btn text-center">
                    <i class="bi bi-plus-circle-fill display-4"></i>
                    <p class="mt-2">Thêm sản phẩm mới</p>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
