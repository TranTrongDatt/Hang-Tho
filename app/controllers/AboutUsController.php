<?php
class AboutUsController 
{
    public function index() 
    {
        $page = "aboutus";
        $page_css = "aboutus.css";
        include 'app/views/pages/aboutus.php';
    }
}
