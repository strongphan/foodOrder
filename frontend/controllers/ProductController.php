<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';
class ProductController extends Controller {
  public function showAll() {
    $params = [];
    if (isset($_POST['filter'])) {
      if (isset($_POST['category'])) {
        $category = implode(',', $_POST['category']);
        $str_category_id = "($category)";
        $params['category'] = $str_category_id;
      }
      if (isset($_POST['price'])) {
        $str_price = '';
        foreach ($_POST['price'] AS $price) {
          if ($price == 1) {
            $str_price .= " OR products.price < 1000000";
          }
          if ($price == 2) {
            $str_price .= " OR (products.price >= 1000000 AND products.price < 20000000)";
          }
          if ($price == 3) {
            $str_price .= " OR (products.price >= 2000000 AND products.price < 30000000)";
          }
          if ($price == 4) {
            $str_price .= " OR products.price >= 3000000";
          }
        }
        $str_price = substr($str_price, 3);
        $str_price = "($str_price)";
        $params['price'] = $str_price;
      }
    }
    $params_pagination = [
      'total' => 5,
      'limit' => 1,
      'full_mode' => FALSE,
    ];

    $product_model = new Product();
    $products = $product_model->getProductInHomePage($params);

    //get categories để filter
    $category_model = new Category();
    $categories = $category_model->getAll();

    $this->content = $this->render('views/products/show_all.php', [
      'products' => $products,
      'categories' => $categories
//      'pagination' => $pagination,
    ]);

    require_once 'views/layouts/main.php';
  }

  public function detail() {
    if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
      $_SESSION['error'] = 'ID ko hợp lệ';
      header("Location: index.php?controller=product&action=index");
      exit();
    }

    $id = $_GET['id'];
    $product_model = new Product();
    $product = $product_model->getById($id);

    $this->content = $this->render('views/products/detail.php', [
      'product' => $product
    ]);
    require_once 'views/layouts/main.php';
  }
}