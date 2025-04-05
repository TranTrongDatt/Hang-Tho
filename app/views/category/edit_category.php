<?php
$page = "edit_category"; // ✅ Xác định trang để load CSS phù hợp
$page_css = "edit_category.css"; // ✅ Gán file CSS riêng cho trang edit category
include 'app/views/shares/header.php'; 
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">
    <h1 class="text-center text-warning mb-4">Sửa Danh Mục Sản Phẩm</h1>

    <!-- Hiển thị thông báo lỗi nếu có -->
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg p-4 rounded text-light border border-warning">
        <form method="POST" action="/hangtho/Category/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $category->id; ?>">

            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text" id="name" name="name" class="form-control border border-warning bg-transparent text-white" 
                       value="<?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea id="description" name="description" class="form-control border border-warning bg-transparent text-white" maxlength="150" required><?php echo htmlspecialchars($category->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <!-- Thêm phần chọn ảnh -->
            <div class="form-group mb-4">
                <label for="image" class="form-label">Hình ảnh (Tùy chọn)</label>
                <input type="file" id="image" name="image" class="form-control border border-warning bg-black text-warning">
                <input type="hidden" name="existing_image" value="<?php echo $category->image; ?>">
                
                <?php if ($category->image !== null && $category->image !== ""): ?>
                    <div class="form-group mb-4 text-center">
                        <p class="text-warning">Ảnh hiện tại:</p>
                        <img src="/hangtho/<?php echo htmlspecialchars($category->image, ENT_QUOTES, 'UTF-8'); ?>" 
                             alt="Category Image" class="img-thumbnail border border-warning" style="max-width: 150px;">
                        <br>
                        <label class="mt-2">
                            <input type="checkbox" name="delete_image" value="1"> Xóa hình ảnh hiện tại
                        </label>
                    </div>
                <?php else: ?>
                    <div class="form-group mb-4 text-center">
                        <p class="text-muted">Hiện tại chưa có ảnh.</p>
                    </div>
                <?php endif; ?>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning px-4 shadow-lg">Lưu thay đổi</button>
                <a href="/hangtho/Category" class="btn btn-secondary px-4 shadow-lg">Quay lại danh mục</a>
            </div>
        </form>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
