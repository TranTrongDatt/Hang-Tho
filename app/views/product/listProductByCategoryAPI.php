<?php
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';

class ListProductByCategoryAPIController
{
    public function index($categoryId)
    {
        // Lấy danh sách sản phẩm theo danh mục
        $productModel = new ProductModel();
        $products = $productModel->getProductsByCategory($categoryId);

        if (empty($products)) {
            echo json_encode(['message' => 'No products found in this category']);
            return;
        }

        // Trả về danh sách sản phẩm theo định dạng JSON
        echo json_encode(['products' => $products]);
    }
}
?>
