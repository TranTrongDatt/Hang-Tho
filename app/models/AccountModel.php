<?php
class AccountModel {
    private $conn;
    private $table_name = "account";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy thông tin tài khoản theo username
    public function getAccountByUsername($username) {
        try {
            $query = "SELECT * FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":username", $username);
            $stmt->execute();
            
            // Trả về mảng hoặc null nếu không tìm thấy
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result ? $result : null; // Nếu không tìm thấy tài khoản, trả về null
        } catch (Exception $e) {
            return null; // Nếu có lỗi, trả về null
        }
    }
    

    // Lưu thông tin tài khoản mới
    public function save($username, $fullName, $password, $role = 'user') {
        try {
            // Kiểm tra xem username đã tồn tại hay chưa
            if ($this->getAccountByUsername($username)) {
                return false; // Nếu username đã tồn tại, trả về false
            }

            $query = "INSERT INTO " . $this->table_name . " SET username=:username, fullname=:fullname, password=:password, role=:role";
            $stmt = $this->conn->prepare($query);

            // Clean dữ liệu đầu vào
            $username = htmlspecialchars(strip_tags($username));
            $fullName = htmlspecialchars(strip_tags($fullName));
            $password = password_hash($password, PASSWORD_BCRYPT); // Mã hóa mật khẩu
            $role = htmlspecialchars(strip_tags($role));

            // Bind tham số vào câu lệnh SQL
            $stmt->bindParam(":username", $username);
            $stmt->bindParam(":fullname", $fullName);
            $stmt->bindParam(":password", $password);
            $stmt->bindParam(":role", $role);

            // Thực thi câu lệnh SQL và trả về kết quả
            if ($stmt->execute()) {
                return true; // Trả về true khi lưu thành công
            }
            return false; // Trả về false nếu có lỗi
        } catch (Exception $e) {
            return false; // Nếu có lỗi trong quá trình lưu, trả về false
        }
    }
}
?>
