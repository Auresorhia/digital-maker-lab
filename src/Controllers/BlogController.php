<?php
namespace Controllers;

class BlogController
{
    public function index(): void
    {
        require_once '../src/Views/blog.php';
    }
}
