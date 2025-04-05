<?php
class HomeAPIController
{
    public function index()
    {
        // Truyền biến CSS vào để sử dụng homeAPI.css
        $page_css = "homeAPI.css";

        // Gọi file homeAPI.php (API)
        include 'app/views/home/homeAPI.php';
    }
}
