<?php
$conn = new mysqli("localhost", "username", "password", "database");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$keyword = isset($_GET['q']) ? $conn->real_escape_string($_GET['q']) : '';

$sql = "
    SELECT p.id, p.name AS product_name, c.name AS category_name 
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.name LIKE '%$keyword%' OR c.name LIKE '%$keyword%'
    LIMIT 10
";
$result = $conn->query($sql);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = [
            'id' => $row['id'],
            'product_name' => $row['product_name'],
            'category_name' => $row['category_name']
        ];
    }
}
echo json_encode($products);
$conn->close();
?>