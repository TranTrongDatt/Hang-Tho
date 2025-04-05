<?php
$page = "add"; // ✅ Xác định trang để load CSS phù hợp
$page_css = "add.css"; // ✅ Gán file CSS riêng cho trang add
include 'app/views/shares/header.php'; 
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">

    <h1 class="text-center text-warning mb-4">Thêm Sản Phẩm Mới</h1>

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
        <form method="POST" action="/hangtho/Product/save" enctype="multipart/form-data" onsubmit="return validateForm();">
            
            <!-- Tên sản phẩm -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" id="name" name="name"
                    class="form-control border border-warning bg-transparent text-white" required value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea id="description" name="description"
                    class="form-control border border-warning bg-transparent text-white" required><?php echo htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <!-- Giá sản phẩm -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Giá (VNĐ)</label>
                <input type="number" id="price" name="price"
                    class="form-control border border-warning bg-transparent text-white" step="1000" required min="1000"
                    max="9999999999" value="<?php echo htmlspecialchars($price ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <!-- Chọn danh mục sản phẩm -->
            <div class="form-group mb-4">
                <label for="category_id" class="form-label">Danh mục</label>
                <select id="category_id" name="category_id"
                    class="form-select border border-warning bg-black text-warning" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>" class="bg-black text-warning" <?php echo (isset($category_id) && $category_id == $category->id) ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Thêm phần chọn ảnh -->
            <div class="form-group mb-4">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" id="image" name="image"
                    class="form-control border border-warning bg-black text-warning">
            </div>

            <!-- Nút submit và quay lại -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning px-4 shadow-lg">Thêm sản phẩm</button>
                <a href="/hangtho/Product" class="btn btn-secondary px-4 shadow-lg">Quay lại danh sách</a>
            </div>
        </form>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
