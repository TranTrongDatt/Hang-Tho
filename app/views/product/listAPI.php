<?php 
$page = "list";
$page_css = "listAPI.css"; // ✅ Đặt biến $page để xác định trang
include 'app/views/shares/header.php'; 
?>

<main class="container mt-5 flex-grow-1 d-flex flex-column main-content">
    <h1 class="text-center text-warning mb-4">Danh sách Sản Phẩm (api)</h1>

    <!-- Thêm sản phẩm mới (api) -->
    <div class="d-flex justify-content-between">
        <a href="/hangtho/Product/add" class="btn btn-success mb-2">Thêm sản phẩm mới (api)</a>
    </div>

    <!-- Danh sách sản phẩm từ API -->
    <ul class="list-group mt-5" id="product-list">
        <!-- Danh sách sản phẩm sẽ được tải từ API và hiển thị tại đây -->
    </ul>
</main>

<?php include 'app/views/shares/footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const token = localStorage.getItem('jwtToken');
    if (!token) {
        alert('Vui lòng đăng nhập');
        location.href = '/hangtho/account/login'; // Điều hướng đến trang đăng nhập
        return;
    }
    fetch('/hangtho/api/product', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    })
    .then(response => response.json())
    .then(data => {
        const productList = document.getElementById('product-list');
        data.forEach(product => {
            const productItem = document.createElement('li');
            productItem.className = 'list-group-item';
            productItem.innerHTML = `
                <h2><a href="/hangtho/Product/show/${product.id}">${product.name} (api)</a></h2>
                <p>${product.description}</p>
                <p>Giá: ${product.price} VND (api)</p>
                <p>Danh mục: ${product.category_name} (api)</p>
                <a href="/hangtho/Product/edit/${product.id}" class="btn btn-warning">Sửa (api)</a>
                <button class="btn btn-danger" onclick="deleteProduct(${product.id})">Xóa (api)</button>
            `;
            productList.appendChild(productItem);
        });
    });
});

function deleteProduct(id) {
    if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')) {
        fetch(`/hangtho/api/product/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.message === 'Product deleted successfully') {
                location.reload();
            } else {
                alert('Xóa sản phẩm thất bại');
            }
        });
    }
}
</script>
