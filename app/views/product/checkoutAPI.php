<?php
require_once 'app/models/ProductModel.php';
require_once 'app/models/OrderModel.php';
require_once 'app/helper/SessionHelper.php';

class CheckoutAPIController
{
    public function processCheckout()
    {
        // Kiểm tra nếu giỏ hàng trống
        if (empty($_SESSION['cart'])) {
            echo json_encode(['message' => 'Cart is empty']);
            return;
        }

        // Lấy thông tin đơn hàng từ request
        $data = json_decode(file_get_contents("php://input"), true);
        $name = $data['name'] ?? '';
        $phone = $data['phone'] ?? '';
        $address = $data['address'] ?? '';
        
        if (empty($name) || empty($phone) || empty($address)) {
            echo json_encode(['message' => 'All fields are required']);
            return;
        }

        // Tính tổng giá trị đơn hàng
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_price += $item['quantity'] * $item['price'];
        }

        // Tạo đơn hàng trong cơ sở dữ liệu
        $orderModel = new OrderModel();
        $orderId = $orderModel->createOrder($name, $phone, $address, $total_price);

        // Lưu thông tin giỏ hàng vào đơn hàng
        foreach ($_SESSION['cart'] as $productId => $item) {
            $orderModel->addOrderDetail($orderId, $productId, $item['quantity'], $item['price']);
        }

        // Xóa giỏ hàng sau khi thanh toán
        unset($_SESSION['cart']);

        echo json_encode(['message' => 'Order placed successfully', 'order_id' => $orderId]);
    }
}
?>
