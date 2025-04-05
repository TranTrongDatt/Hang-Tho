<?php
require_once('app/config/database.php');
require_once('app/models/AccountModel.php');

class AccountController {
    private $accountModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->accountModel = new AccountModel($this->db);
    }

    // ✅ Trang giao diện chuyển đổi đăng nhập/đăng ký hiện đại
    public function auth() {
        include_once 'app/views/account/auth.php';
    }

    // Trang đăng ký cũ (nếu vẫn dùng)
    public function register() {
        include_once 'app/views/account/register.php';
    }

    // Trang đăng nhập cũ (nếu vẫn dùng)
    public function login() {
        include_once 'app/views/account/login.php';
    }

    // Lưu tài khoản đăng ký mới
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $fullName = $_POST['fullname'] ?? '';
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirmpassword'] ?? '';
            $role = $_POST['role'] ?? 'user';
            $errors = [];

            if (empty($username)) $errors['username'] = "Vui lòng nhập username!";
            if (empty($fullName)) $errors['fullname'] = "Vui lòng nhập fullname!";
            if (empty($password)) $errors['password'] = "Vui lòng nhập password!";
            if ($password != $confirmPassword) $errors['confirmPass'] = "Mật khẩu và xác nhận chưa khớp!";
            if (!in_array($role, ['admin', 'user'])) $role = 'user';

            if ($this->accountModel->getAccountByUsername($username)) {
                $errors['account'] = "Tài khoản này đã được đăng ký!";
            }

            if (count($errors) > 0) {
                include_once 'app/views/account/auth.php';
            } else {
                $result = $this->accountModel->save($username, $fullName, $password, $role);
                if ($result) {
                    header('Location: /hangtho/account/auth');
                    exit;
                } else {
                    $errors['save'] = "Đã xảy ra lỗi khi lưu tài khoản. Vui lòng thử lại!";
                    include_once 'app/views/account/auth.php';
                }
            }
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: /hangtho/product');
        exit();
    }

    public function checkLogin() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $account = $this->accountModel->getAccountByUsername($username);

            if ($account && password_verify($password, $account['password'])) {
                session_start();
                $_SESSION['username'] = $account['username'];
                $_SESSION['role'] = $account['role'];

                header('Location: /hangtho/product');
                exit();
            } else {
                $error = $account ? "Mật khẩu không đúng!" : "Không tìm thấy tài khoản!";
                include_once 'app/views/account/auth.php';
                exit();
            }
        }
    }
}
?>
