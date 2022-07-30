<?php
require_once 'models/Admin.php';
require_once 'controllers/Controller.php';

class LoginController extends Controller
{
  public function login()
  {
    if (isset($_SESSION['admin'])) {
        header("Location: index.php?controller=home&action=home");
        exit();
    }
    if (isset($_POST['submit'])) {
      $adminname = $_POST['adminname'];
      $password = $_POST['password'];
      if (empty($adminname) || empty($password)) {
        $this->error = 'AdminName hoặc password không được để trống';
      }
      $admin_model = new Admin();
      if (empty($this->error)) {
        $admin = $admin_model->getUser($adminname);
        if (empty($admin)) {
          $this->error = 'AdminName ko tồn tại';
        } else {

          $is_same_password = password_verify($password, $admin['password']);
          if ($is_same_password) {
            $_SESSION['success'] = 'Đăng nhập thành công';
            $_SESSION['admin'] = $admin;
            header("Location: index.php?controller=home&action=home");
            exit();
          } else {
            $this->error = 'Sai tài khoản hoặc mật khẩu';
          }
        }
      }
    }
    $this->page_title = 'Đăng nhập';
    $this->content = $this->render('views/admins/login.php');

    require_once 'views/layouts/login.php';
  }


  public function register(){
    if (isset($_POST['submit'])) {
      $admin_model = new Admin();
      $adminname = $_POST['adminname'];
      $password = $_POST['password'];
      $password_confirm = $_POST['password_confirm'];
      $admin = $admin_model->getUserByUsername($adminname);
      if (empty($adminname) || empty($password) || empty($password_confirm)) {
        $this->error = 'Không được để trống các trường';
      } else if ($password != $password_confirm) {
        $this->error = 'Password nhập lại chưa đúng';
      } else if (!empty($admin)) {
        $this->error = 'AdminName này đã tồn tại';
      }
      //xử lý lưu dữ liệu khi không có lỗi
      if (empty($this->error)) {
        $password_encrypt =
          password_hash($password, PASSWORD_BCRYPT);
        $admin_model->adminname = $adminname;
        $admin_model->password = $password_encrypt;
        $is_insert = $admin_model->register();
        if ($is_insert) {
          $_SESSION['success'] = 'Đăng ký thành công';
          header('Location: index.php?controller=login&action=login');
          exit();
        }
      }
    }
    $this->page_title = 'Đăng ký';
    $this->content = $this->render('views/admins/register.php');
    require_once 'views/layouts/login.php';
  }
}
