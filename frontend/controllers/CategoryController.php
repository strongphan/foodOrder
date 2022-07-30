<?php
require_once 'controllers/Controller.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';
class CategoryController extends Controller{
    public function showAll(){
        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/categories/index.php', [
            'categories' => $categories
        ]);
        require_once 'views/layouts/main.php';
    }
    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID ko hợp lệ';
            header("Location: index.php?controller=category&action=index");
            exit();
        }

        $id = $_GET['id'];
        $product_model = new Category();
        $products = $product_model->getById($id);

        $this->content = $this->render('views/products/show_all.php', [
            'products' => $products
        ]);
        require_once 'views/layouts/main.php';
    }
}