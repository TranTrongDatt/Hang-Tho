<?php
$page = "edit"; // ✅ Đặt biến $page để xác định trang
$page_css = "edit.css";
include 'app/views/shares/header.php'; 
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">

    <h1 class="text-center text-warning mb-4">Sửa Sản Phẩm</h1>

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
        <form method="POST" action="/hangtho/Product/update" enctype="multipart/form-data" onsubmit="return validateForm();">
            <input type="hidden" name="id" value="<?php echo $product->id; ?>">

            <div class="form-group mb-3">
                <label for="name" class="form-label">Tên sản phẩm</label>
                <input type="text" id="name" name="name" class="form-control border border-warning bg-transparent text-white" 
                       value="<?php echo htmlspecialchars($product->name, ENT_QUOTES, 'UTF-8'); ?>" required>
            </div>

            <div class="form-group mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea id="description" name="description" class="form-control border border-warning bg-transparent text-white" required><?php echo htmlspecialchars($product->description, ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <div class="form-group mb-3">
                <label for="price" class="form-label">Giá (VNĐ)</label>
                <input type="number" id="price" name="price" class="form-control border border-warning bg-transparent text-white" 
                       value="<?php echo htmlspecialchars($product->price, ENT_QUOTES, 'UTF-8'); ?>" step="1000" required min="1000" max="9999999999">
            </div>

            <div class="form-group mb-4">
                <label for="category_id" class="form-label">Danh mục</label>
                <select id="category_id" name="category_id" class="form-select border border-warning bg-black text-warning" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id; ?>" 
                                class="bg-black text-warning" 
                                <?php echo $category->id == $product->category_id ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($category->name, ENT_QUOTES, 'UTF-8'); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <!-- Thêm phần chọn ảnh -->
            <div class="form-group mb-4">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" id="image" name="image" class="form-control border border-warning bg-black text-warning">
                <input type="hidden" name="existing_image" value="<?php echo $product->image; ?>">
                <?php if ($product->image !== null && $product->image !== ""): ?>
                    <div class="form-group mb-4 text-center">
                        <p class="text-warning">Ảnh hiện tại:</p>
                        <img src="/hangtho/<?php echo htmlspecialchars($product->image, ENT_QUOTES, 'UTF-8'); ?>" 
                            alt="Product Image" class="img-thumbnail border border-warning" style="max-width: 150px;">
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
                <a href="/hangtho/Product" class="btn btn-secondary px-4 shadow-lg">Quay lại danh sách</a>
            </div>
        </form>
    </div>
</main>

<?php include 'app/views/shares/footer.php'; ?>
