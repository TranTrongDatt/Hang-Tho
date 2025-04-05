<?php 
$page = "add_category"; // ✅ Xác định trang để load CSS phù hợp
$page_css = "add_category.css"; // ✅ Gán file CSS riêng cho trang add_category
include 'app/views/shares/header.php'; 
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">

    <h1 class="text-center text-warning mb-4">Thêm Danh Mục Sản Phẩm</h1>

    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li>
                        <?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg p-4 rounded text-light border border-warning">
        <form method="POST" action="/hangtho/Category/save_category" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" id="name" name="name"
                    class="form-control border border-warning bg-transparent text-white" maxlength="150" required>
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea id="description" name="description"
                    class="form-control border border-warning bg-transparent text-white" required></textarea>
            </div>

            <!-- Thêm phần chọn ảnh -->
            <div class="form-group mb-4">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" id="image" name="image"
                    class="form-control border border-warning bg-black text-warning">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning px-4 shadow-lg">Thêm danh mục</button>
                <a href="/hangtho/Category" class="btn btn-secondary px-4 shadow-lg">Quay lại danh mục</a>
            </div>
        </form>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
