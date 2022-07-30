<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/OrderDetail.php';
require_once 'libraries/PHPMailer/src/PHPMailer.php';
require_once 'libraries/PHPMailer/src/SMTP.php';
require_once 'libraries/PHPMailer/src/Exception.php';
require_once 'models/User.php';
class PaymentController extends Controller
{
    public function index() {

        if (isset($_POST['submit'])){
            $fullname = $_POST['fullname'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $method = $_POST['method'];
            $payment_status = 0;
            $price_total = 0;
            foreach ($_SESSION['cart'] as $cart_item){
                $price_total += $cart_item['price'] * $cart_item['quantity'];
            }
            $order_moder = new Order();
            $order_id = $order_moder->insertData($fullname, $price_total);
            foreach ($_SESSION['cart'] as $cart_item){
                $order_detail_model = new OrderDetail();
                $infos = [
                    'order_id' => $order_id,
                    'product_name' => $cart_item['name'],
                    'product_price' => $cart_item['price'],
                    'quantity' =>$cart_item['quantity']
                ];
                $is_insert = $order_detail_model->insertData($infos);
            }
            unset($_SESSION['cart']);
            if ($method == 0){
                // về trang thanh toán onl
            } else {
                // về trang cảm ơn
            }
        }
        if (isset($_SESSION['user']['id'])) {
            $id = $_SESSION['user']['id'];
            $user_model = new User();
            $user = $user_model->getById($id);
        }

        $this->page_title = 'Trang thanh toán';
        $this->content =
            $this->render('views/payments/index.php', [
                'user' => $user
            ]);
        require_once 'views/layouts/main.php';
    }
}