<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/User.php';

class CartController extends Controller
{
    public function add() {
        $product_id = $_GET['product_id'];
        $product_model = new Product();
        $product = $product_model->getById($product_id);
        $cart_item = [
            'name' => $product['title'],
            'avatar' => $product['avatar'],
            'price' => $product['price'],
            'quantity' => 1
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'][$product_id] = $cart_item;
        } else {
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]['quantity']++;
            } else {
                $_SESSION['cart'][$product_id] = $cart_item;
            }
        }
    }

    public function index() {
        if (isset($_POST['submit'])) {
            foreach($_SESSION['cart'] AS $product_id => $cart_item) {
                if ($_POST[$product_id] < 0) {
                    $_SESSION['error'] = 'Số lượng phải > 0';
                    header('Location: gio-hang-cua-ban.html');
                    exit();
                }

                $_SESSION['cart'][$product_id]['quantity']
                    = $_POST[$product_id];
            }
            $_SESSION['success'] = "Cập nhật giỏ hàng thành công";
        }
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            $user_model = new User();
            $user = $user_model->getById($id);
        }

        $this->page_title = 'Trang giỏ hàng của bạn';
        $this->content = $this->render('views/carts/index.php',[
            'user' => $user
        ]);
        require_once 'views/layouts/main.php';
    }

    public function delete() {
        $product_id = $_GET['id'];
        unset($_SESSION['cart'][$product_id]);
        $_SESSION['success'] = 'Xóa sp khỏi giỏ thành công';
        header('Location:gio-hang-cua-ban.html');
        exit();
    }
}