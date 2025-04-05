<?php
class DefaultController
{
    public function index()
    {
        // Truyền biến CSS vào để sử dụng home.css
        $page_css = "home.css";

        // Gọi file home.php
        include 'app/views/home/home.php';
    }
}
?>
