<?php
require_once 'models/User.php';
require_once 'controllers/Controller.php';

class HomeController extends Controller {
    public function home(){
        $this->content = $this->render('views/layouts/home.php');
        $this->page_title = 'Trang quản trị';
        require_once 'views/layouts/main.php';
    }
}
