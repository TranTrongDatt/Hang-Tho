<?php
require_once 'app/config/database.php';
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';

class ProductController
{
    private $categoryModel;
    private $productModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->productModel = new ProductModel($this->db);
        $this->categoryModel = new CategoryModel($this->db);
    }

    // 🔹 Hiển thị danh sách sản phẩm (cho tất cả người dùng)
    public function index()
    {
        $products = $this->productModel->getProducts();
        include 'app/views/product/list.php';
    }

    // 🔹 Hiển thị sản phẩm tìm kiếm
    public function search()
    {
        $search_term = $_GET['search'] ?? '';
        $products = $this->productModel->searchProducts($search_term);
        include 'app/views/product/search_results.php';  // Tạo view mới cho kết quả tìm kiếm
    }

    // 🔹 Hiển thị chi tiết sản phẩm (cho tất cả người dùng)
    public function show($id)
    {
        $product = $this->productModel->getProductById($id);
        if ($product) {
            include 'app/views/product/show.php';
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    }

    // 🔹 Hiển thị form thêm sản phẩm (chỉ admin)
    public function add()
    {
        if (!SessionHelper::isAdmin()) {
            echo "Bạn không có quyền truy cập vào trang này.";
            return;
        }
        
        $categories = (new CategoryModel($this->db))->getAllCategories();
        include_once 'app/views/product/add.php';
    }

    // 🔹 Xử lý lưu sản phẩm (chỉ admin)
    // 🔹 Xử lý lưu sản phẩm (chỉ admin)
    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && SessionHelper::isAdmin()) 
        {
            $errors = []; // ✅ Khởi tạo mảng lỗi trước khi dùng
    
        $name = $_POST['name'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? '';
        $category_id = $_POST['category_id'] ?? null;
        
        $image = "";  // Đặt mặc định là không có ảnh

        $imageUploadResult = $this->uploadImage($_FILES['image']);
        $uploadErrors = ["File không phải là ảnh.", "Ảnh đã tồn tại.", "Ảnh quá lớn.", "Chỉ hỗ trợ ảnh JPG, JPEG, PNG, GIF.", "Đã xảy ra lỗi khi tải ảnh lên."];

        // ✅ Nếu kết quả là chuỗi nằm trong danh sách lỗi → lỗi
        if (in_array($imageUploadResult, $uploadErrors)) 
        {
            $errors[] = $imageUploadResult;
            $categories = (new CategoryModel($this->db))->getAllCategories();
            include 'app/views/product/add.php';
            return;
        } 
        else 
        {
            $image = $imageUploadResult; // ✅ Gán ảnh nếu upload thành công
        }

        // Lưu sản phẩm vào cơ sở dữ liệu
        $result = $this->productModel->addProduct
        (
            $name,
            $description,
            $price,
            $category_id,
            $image
        );

        if (is_array($result)) 
        {
            $errors = $result;
            $categories = (new CategoryModel($this->db))->getAllCategories();
            include 'app/views/product/add.php';
        } 
        else 
        {
            header('Location: /hangtho/Product');  // Chuyển hướng về danh sách sản phẩm
            exit();
        }
        } 
        else 
        {
        echo "Bạn không có quyền truy cập vào trang này.";
        }
        }

    // 🔹 Hiển thị form sửa sản phẩm (chỉ admin)
    public function edit($id)
    {
        if (!SessionHelper::isAdmin()) {
            echo "Bạn không có quyền truy cập vào trang này.";
            return;
        }

        $product = $this->productModel->getProductById($id);
        $categories = (new CategoryModel($this->db))->getAllCategories();
        if ($product) {
            include 'app/views/product/edit.php';
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    }

    // 🔹 Xử lý cập nhật sản phẩm (chỉ admin)
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && SessionHelper::isAdmin()) {  // Kiểm tra quyền admin
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
            $deleteImage = isset($_POST['delete_image']) ? true : false;

            // 🖼 Lấy thông tin sản phẩm hiện tại để kiểm tra ảnh cũ
            $product = $this->productModel->getProductById($id);
            $currentImage = $product->image;

            // 🖼 Xử lý hình ảnh
            $imagePath = $currentImage; // Giữ ảnh cũ nếu không có ảnh mới

            // Nếu người dùng chọn xóa ảnh, thực hiện xóa ảnh khỏi thư mục và database
            if ($deleteImage && !empty($currentImage)) {
                if (file_exists($currentImage)) {
                    unlink($currentImage); // Xóa file ảnh trong thư mục
                }
                $imagePath = ""; // Xóa đường dẫn ảnh trong database
            }

            // Nếu có ảnh mới, lưu ảnh mới và xóa ảnh cũ (nếu có)
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);

                // Xóa ảnh cũ nếu có ảnh mới
                if (!empty($currentImage) && file_exists($currentImage)) {
                    unlink($currentImage);
                }

                $imagePath = $targetFile; // Cập nhật ảnh mới
            }

            // 🛠 Gọi model để cập nhật sản phẩm
            $this->productModel->updateProduct(
                $id,
                $name,
                $description,
                $price,
                $category_id,
                $imagePath
            );

            header('Location: /hangtho/Product');
            exit();
        } else {
            echo "Bạn không có quyền truy cập vào trang này.";
        }
    }

    // 🔹 Xóa sản phẩm (chỉ admin)
    public function delete($id)
    {
        if (!SessionHelper::isAdmin()) {
            echo "Bạn không có quyền truy cập vào trang này.";
            return;
        }

        $this->productModel->deleteProduct($id);
        header("Location: /hangtho/Product");
    }

    // 🛒 Hiển thị giỏ hàng
    public function cart()
    {
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        include 'app/views/product/cart.php';
    }

    // 🛒 Thêm sản phẩm vào giỏ hàng (có kiểm tra số lượng)
    public function addToCart($id)
    {
        $product = $this->productModel->getProductById($id);
        if (!$product) {
            echo "Không tìm thấy sản phẩm.";
            return;
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['quantity']++;  // ✅ Tăng số lượng nếu đã có trong giỏ
        } else {
            $_SESSION['cart'][$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,  // ✅ Mặc định 1 sản phẩm
                'image' => $product->image
            ];
        }

        header('Location: /hangtho/Product/cart');
    }

    // 📸 Xử lý tải ảnh lên
public function uploadImage($file)
{
    // Đường dẫn thư mục lưu ảnh
    $targetDir = "uploads/products/";
    
    // Kiểm tra nếu thư mục chưa có thì tạo mới
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    // Tạo tên file ảnh
    $targetFile = $targetDir . basename($file["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Kiểm tra xem file có phải là ảnh không
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return "File không phải là ảnh.";
    }

    // Kiểm tra nếu file ảnh đã tồn tại
    if (file_exists($targetFile)) {
        return "Ảnh đã tồn tại.";
    }

    // Kiểm tra kích thước ảnh
    if ($file["size"] > 5000000) { // Giới hạn kích thước ảnh là 5MB
        return "Ảnh quá lớn.";
    }

    // Kiểm tra định dạng ảnh
    if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
        return "Chỉ hỗ trợ ảnh JPG, JPEG, PNG, GIF.";
    }

    // Di chuyển ảnh vào thư mục đích
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        return $targetFile;  // Trả về đường dẫn của ảnh đã được tải lên
    } else {
        return "Đã xảy ra lỗi khi tải ảnh lên.";
    }
}


    // 🛒 Xóa sản phẩm khỏi giỏ hàng
    public function removeFromCart($id)
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        header('Location: /hangtho/Product/cart');
        exit();
    }

    // 🏪 Hiển thị trang thanh toán
    public function checkout()
    {
        // ✅ Nếu chưa đăng nhập → chuyển đến trang auth
        if (!SessionHelper::isLoggedIn()) 
        {
            header('Location: /hangtho/account/login_register'); // bạn có thể đổi về /hangtho/auth nếu muốn
            exit;
        }
        $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
        if (empty($cart)) 
        {
            echo "Giỏ hàng trống.";
            return;
        }
        include 'app/views/product/checkout.php';
    }


    // 💳 Xử lý thanh toán
    public function processCheckout()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];

            // Kiểm tra giỏ hàng có sản phẩm không
            if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
                echo "Giỏ hàng trống.";
                return;
            }

            // 🛒 Tính tổng giá trị đơn hàng
            $cart = $_SESSION['cart'];
            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item['quantity'] * $item['price'];
            }

            // 🔄 Bắt đầu transaction
            $this->db->beginTransaction();
            try {
                // 📝 Lưu thông tin đơn hàng
                $query = "INSERT INTO orders (name, phone, address, total_price, status) 
                        VALUES (:name, :phone, :address, :total_price, 'pending')";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':phone', $phone);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':total_price', $total_price);
                $stmt->execute();
                $order_id = $this->db->lastInsertId();

                // 🛍 Lưu thông tin sản phẩm trong đơn hàng
                foreach ($cart as $product_id => $item) {
                    $query = "INSERT INTO order_details (order_id, product_id, quantity, unit_price) 
                            VALUES (:order_id, :product_id, :quantity, :unit_price)";
                    $stmt = $this->db->prepare($query);
                    $stmt->bindParam(':order_id', $order_id);
                    $stmt->bindParam(':product_id', $product_id);
                    $stmt->bindParam(':quantity', $item['quantity']);
                    $stmt->bindParam(':unit_price', $item['price']);
                    $stmt->execute();
                }

                // 🧹 Xóa giỏ hàng sau khi đặt hàng thành công
                unset($_SESSION['cart']);
                $_SESSION['last_order_id'] = $order_id;

                // ✅ Commit giao dịch
                $this->db->commit();

                // 🔄 Chuyển hướng đến trang xác nhận đơn hàng
                header('Location: /hangtho/Product/orderConfirmation');
                exit();
            } catch (Exception $e) {
                // ❌ Rollback nếu có lỗi
                $this->db->rollBack();
                echo "Đã xảy ra lỗi khi xử lý đơn hàng: " . $e->getMessage();
            }
        }
    }

    // 📦 Trang xác nhận đơn hàng
    public function orderConfirmation()
    {
        if (!isset($_SESSION['last_order_id'])) {
            echo "Không tìm thấy đơn hàng.";
            return;
        }

        $order_id = $_SESSION['last_order_id'];
        $query = "SELECT * FROM orders WHERE id = :order_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':order_id', $order_id);
        $stmt->execute();
        $order = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$order) {
            echo "Lỗi: Không tìm thấy đơn hàng.";
            return;
        }

        include 'app/views/product/orderConfirmation.php';
    }
    public function category($category_id)
    {
        // Lấy thông tin danh mục
        $category = $this->categoryModel->getCategoryById($category_id);
        if (!$category) {
            die("Danh mục không tồn tại!");
        }

        // Lấy danh sách sản phẩm thuộc danh mục
        $products = $this->productModel->getProductsByCategory($category_id);

        // Gửi dữ liệu sang view
        include 'app/views/product/list_product_by_category.php';
    }

    public function list()
    {
    $this->index(); // Gọi lại hàm index để giữ URL list
    }

}

?>
