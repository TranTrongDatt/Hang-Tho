<?php
require_once 'app/models/CategoryModel.php';

class CategoryController {
    private $db;
    private $categoryModel;

    public function __construct($db) {
        $this->db = $db;
        $this->categoryModel = new CategoryModel($db);
    }

    // 🔹 Hiển thị danh sách danh mục (cho tất cả người dùng)
    public function index()
    {
        $categories = $this->categoryModel->getAllCategories();
        include 'app/views/category/category.php';
    }

    // 🔹 Hiển thị form thêm danh mục (chỉ admin)
    public function add_category()
    {
        if (!SessionHelper::isAdmin()) {
            echo "Bạn không có quyền truy cập vào trang này.";
            return;
        }
        include 'app/views/category/add_category.php';
    }

    // 🔹 Xử lý lưu danh mục mới (chỉ admin)
    public function save_category()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && SessionHelper::isAdmin()) {  // Kiểm tra quyền admin
            $name = $_POST['name'];
            $description = $_POST['description'];
            $imagePath = "";

            // 🖼 Xử lý ảnh tải lên
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
                $imagePath = $targetFile;
            }

            // 🛠 Thêm danh mục vào database
            $this->categoryModel->addCategory($name, $description, $imagePath);
            header("Location: /hangtho/Category");
        } else {
            echo "Bạn không có quyền truy cập vào trang này.";
        }
    }

    // 🔹 Hiển thị form sửa danh mục (chỉ admin)
    public function edit($id)
    {
        if (!SessionHelper::isAdmin()) {
            echo "Bạn không có quyền truy cập vào trang này.";
            return;
        }

        $category = $this->categoryModel->getCategoryById($id);
        if ($category) {
            include 'app/views/category/edit_category.php';
        } else {
            echo "Không tìm thấy danh mục.";
        }
    }

    // 🔹 Xử lý cập nhật danh mục (chỉ admin)
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && SessionHelper::isAdmin()) {  // Kiểm tra quyền admin
            $id = $_POST['id'];
            $name = $_POST['name'];
            $description = $_POST['description'];
            $imagePath = $_POST['existing_image'];

            // 🗑 Xóa ảnh nếu người dùng chọn "Xóa hình ảnh hiện tại"
            if (isset($_POST['delete_image']) && $_POST['delete_image'] == "1") {
                if (!empty($imagePath) && file_exists($imagePath)) {
                    unlink($imagePath);
                }
                $imagePath = NULL;
            }

            // 🖼 Nếu người dùng chọn ảnh mới, cập nhật ảnh mới
            if (!empty($_FILES['image']['name'])) {
                $targetDir = "uploads/category/";
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }
                $targetFile = $targetDir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
                $imagePath = $targetFile;
            }

            // 🛠 Cập nhật danh mục trong database
            $this->categoryModel->updateCategory($id, $name, $description, $imagePath);
            header("Location: /hangtho/Category");
            exit();
        } else {
            echo "Bạn không có quyền truy cập vào trang này.";
        }
    }

    // 🔹 Xóa danh mục (chỉ admin)
    public function delete($id)
    {
        if (!SessionHelper::isAdmin()) {
            echo "Bạn không có quyền truy cập vào trang này.";
            return;
        }

        $this->categoryModel->deleteCategory($id);
        header("Location: /hangtho/Category");
    }
}
