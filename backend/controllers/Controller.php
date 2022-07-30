<?php
class Controller
{
    public function __construct()
    {
        $controller = isset($_GET['controller']) ? $_GET['controller'] : 'category';
        $action = isset($_GET['action']) ? $_GET['action'] : 'index';
        if (!isset($_SESSION['admin']) && $controller != 'login' && !in_array($action, ['login', 'register'])) {
            $_SESSION['error'] = 'Bạn cần đăng nhập';
            header('Location: index.php?controller=login&action=login');
            exit();
        }
    }

    public $content;
    public $error;
    public function render($file, $variables = []) {
        extract($variables);
        ob_start();
        require_once $file;
        $render_view = ob_get_clean();
        return $render_view;
    }
}
