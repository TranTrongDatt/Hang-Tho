<?php
class ContactController 
{
    public function index() 
    {
        $page = "contact";
        $page_css = "contact.css";
        include 'app/views/pages/contact.php';
    }
}
