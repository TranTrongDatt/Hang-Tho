<?php
require_once 'vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class JWTHandler
{
    private $secret_key;

    public function __construct()
    {
        $this->secret_key = "baohan"; // Thay thế bằng khóa bí mật của bạn
    }

    // Tạo JWT
    public function encode($data)
    {
        $issuedAt = time();
        $expirationTime = $issuedAt + 3600; // JWT có hiệu lực trong 1 giờ
        $payload = array(
            'iat' => $issuedAt,
            'exp' => $expirationTime,
            'data' => $data
        );
        return JWT::encode($payload, $this->secret_key, 'HS256');
    }

    // Giải mã JWT
    public function decode($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, new Key($this->secret_key, 'HS256'));
            return (array) $decoded->data;
        } catch (Exception $e) {
            return null; // Trả về null nếu token không hợp lệ
        }
    }

    // Xác thực JWT
    public function validateToken($jwt)
    {
        try {
            $decoded = JWT::decode($jwt, new Key($this->secret_key, 'HS256'));
            // Kiểm tra thời gian hết hạn
            if (isset($decoded->exp) && $decoded->exp < time()) {
                return false; // Token đã hết hạn
            }
            return true; // Token hợp lệ
        } catch (Exception $e) {
            return false; // Token không hợp lệ
        }
    }
}
?>