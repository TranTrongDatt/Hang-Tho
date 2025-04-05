<?php
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/helper/SessionHelper.php';

class CartAPIController
{
    public function index()
    {
        // Lấy giỏ hàng từ session
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        
        // Tính tổng giá trị giỏ hàng
        $total_price = 0;
        foreach ($cart as $id => $item) {
            $total_price += $item['quantity'] * $item['price'];
        }

        // Trả về dữ liệu giỏ hàng dưới dạng JSON
        echo json_encode([
            'cart' => $cart,
            'total_price' => $total_price
        ]);
    }

    public function addToCart($id)
    {
        // Lấy thông tin sản phẩm từ database
        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);
        
        // Kiểm tra xem sản phẩm có tồn tại không
        if (!$product) {
            echo json_encode(['message' => 'Product not found']);
            return;
        }

        // Kiểm tra nếu giỏ hàng chưa tồn tại trong session thì tạo mới
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Kiểm tra nếu sản phẩm đã có trong giỏ hàng, tăng số lượng lên 1
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image
            ];
        }

        // Trả về giỏ hàng mới sau khi thêm sản phẩm
        echo json_encode(['message' => 'Product added to cart', 'cart' => $_SESSION['cart']]);
    }

    public function removeFromCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]); // Xóa sản phẩm khỏi giỏ
            echo json_encode(['message' => 'Product removed from cart', 'cart' => $_SESSION['cart']]);
        } else {
            echo json_encode(['message' => 'Product not found in cart']);
        }
    }
}
?>
