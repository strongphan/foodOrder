<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
require_once 'models/Category.php';
require_once 'models/Product.php';
require_once 'helpers/Helper.php';

class HomeController extends Controller {
  public function index() {
      if (isset($_SESSION['user']['id'])) {
          $id = $_SESSION['user']['id'];
          $user_model = new User();
          $user = $user_model->getById($id);
          $category_model = new Category();
          $categories = $category_model->get3();
          $product_model = new Product();
          $products = $product_model->getProductInHomePage();
          $this->content = $this->render('views/homes/index.php', [
              'user' => $user,
              'categories' => $categories,
              'products' => $products
          ]);
          require_once 'views/layouts/main.php';

      }

      $category_model = new Category();
      $categories = $category_model->get3();
      $product_model = new Product();
      $products = $product_model->getProductInHomePage();
      $this->page_title = 'Food Order';
      $this->content = $this->render('views/homes/index.php', [
          'categories' => $categories,
          'products' => $products
      ]);
      require_once 'views/layouts/main.php';
  }
}