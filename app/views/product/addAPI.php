<?php
$page = "addAPI";
$page_css = "addAPI.css"; // Đặt file CSS cho giao diện API
include 'app/views/shares/header.php'; 
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">

    <h1 class="text-center text-warning mb-4">Thêm Sản Phẩm Mới (api)</h1>

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
                <label for="name" class="form-label">Tên sản phẩm (api)</label>
                <input type="text" id="name" name="name"
                    class="form-control border border-warning bg-transparent text-white" required value="<?php echo htmlspecialchars($name ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <!-- Mô tả sản phẩm -->
            <div class="form-group mb-3">
                <label for="description" class="form-label">Mô tả (api)</label>
                <textarea id="description" name="description"
                    class="form-control border border-warning bg-transparent text-white" required><?php echo htmlspecialchars($description ?? '', ENT_QUOTES, 'UTF-8'); ?></textarea>
            </div>

            <!-- Giá sản phẩm -->
            <div class="form-group mb-3">
                <label for="price" class="form-label">Giá (VNĐ api)</label>
                <input type="number" id="price" name="price"
                    class="form-control border border-warning bg-transparent text-white" step="1000" required min="1000"
                    max="9999999999" value="<?php echo htmlspecialchars($price ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            </div>

            <!-- Chọn danh mục sản phẩm -->
            <div class="form-group mb-4">
                <label for="category_id" class="form-label">Danh mục (api)</label>
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
                <label for="image" class="form-label">Hình ảnh (api)</label>
                <input type="file" id="image" name="image"
                    class="form-control border border-warning bg-black text-warning">
            </div>

            <!-- Nút submit và quay lại -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-warning px-4 shadow-lg">Thêm sản phẩm (api)</button>
                <a href="/hangtho/Product" class="btn btn-secondary px-4 shadow-lg">Quay lại danh sách (api)</a>
            </div>
        </form>
    </div>

    <!-- Phần thêm mã mới -->
    <h1>Thêm sản phẩm mới (API)</h1>
    <form id="add-product-form">
        <div class="form-group">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Giá:</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="category_id">Danh mục:</label>
            <select id="category_id" name="category_id" class="form-control" required>
                <!-- Các danh mục sẽ được tải từ API và hiển thị tại đây -->
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Thêm sản phẩm (api)</button>
    </form>
    <a href="/hangtho/Product/list" class="btn btn-secondary mt-2">Quay lại danh sách sản phẩm (api)</a>
</main>


<?php include 'app/views/shares/footer.php'; ?>

<script>
// JavaScript cho API
document.addEventListener("DOMContentLoaded", function() {
    // Lấy các danh mục từ API
    fetch('/hangtho/api/category')
    .then(response => response.json())
    .then(data => {
        const categorySelect = document.getElementById('category_id');
        data.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            categorySelect.appendChild(option);
        });
    });

    // Xử lý form thêm sản phẩm
    document.getElementById('add-product-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        const jsonData = {};
        formData.forEach((value, key) => {
            jsonData[key] = value;
        });

        fetch('/hangtho/api/product', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(jsonData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product created successfully') {
                location.href = '/hangtho/Product';
            } else {
                alert('Thêm sản phẩm thất bại');
            }
        });
    });
});
</script>
