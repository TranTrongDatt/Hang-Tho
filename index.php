<?php
session_start();
require_once 'app/config/Database.php'; // Đưa Database vào đầu để sử dụng chung cho tất cả controller
require_once 'app/models/ProductModel.php';
require_once 'app/models/CategoryModel.php';
require_once 'app/helper/SessionHelper.php'; // Nếu cần, có thể thêm vào helper hoặc utils

// Lấy URL từ request
$url = $_GET['url'] ?? '';
$url = rtrim($url, '/');
$url = filter_var($url, FILTER_SANITIZE_URL);  // Sanitize URL để tránh lỗi injection
$url = explode('/', $url);

// Kết nối database
$database = new Database();
$db = $database->getConnection();

// Xác định controller
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'DefaultController';

// Định tuyến các yêu cầu API
if ($controllerName === 'ApiController' && isset($url[1])) {
    $apiControllerName = ucfirst($url[1]) . 'ApiController';
    if (file_exists('app/controllers/' . $apiControllerName . '.php')) {
        require_once 'app/controllers/' . $apiControllerName . '.php';
        $controller = new $apiControllerName();
        $method = $_SERVER['REQUEST_METHOD'];
        $id = $url[2] ?? null;
        switch ($method) {
            case 'GET':
                $action = $id ? 'show' : 'index';
                break;
            case 'POST':
                $action = 'store';
                break;
            case 'PUT':
                if ($id) {
                    $action = 'update';
                }
                break;
            case 'DELETE':
                if ($id) {
                    $action = 'destroy';
                }
                break;
            default:
                http_response_code(405);
                echo json_encode(['message' => 'Method Not Allowed']);
                exit;
        }
        if (method_exists($controller, $action)) {
            $id ? call_user_func_array([$controller, $action], [$id]) : call_user_func_array([$controller, $action], []);
        } else {
            http_response_code(404);
            echo json_encode(['message' => 'Action not found']);
        }
        exit;
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'Controller not found']);
        exit;
    }
}

// Kiểm tra xem controller có tồn tại không
if (!file_exists('app/controllers/' . $controllerName . '.php')) {
    die('Controller not found');
}

require_once 'app/controllers/' . $controllerName . '.php';

// ✅ Nếu controller là CategoryController hoặc ProductController thì cần truyền `$db`
if ($controllerName == "CategoryController" || $controllerName == "ProductController") {
    $controller = new $controllerName($db);
} else {
    $controller = new $controllerName(); // Những controller không cần database sẽ không truyền `$db`
}

// Xác định action (method trong controller)
$action = isset($url[1]) && $url[1] != '' ? $url[1] : 'index';

// Kiểm tra xem action có tồn tại trong controller không
if (!method_exists($controller, $action)) {
    die('Action not found');
}

// Gọi action với các tham số còn lại (nếu có)
call_user_func_array([$controller, $action], array_slice($url, 2));
?>
