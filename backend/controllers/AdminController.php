<?php
require_once 'controllers/Controller.php';
require_once 'models/Admin.php';
require_once 'models/Pagination.php';
class AdminController extends Controller {
    public function index() {
        $admin_model = new Admin();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total = $admin_model->getTotal();
        $query_additional = '';
        if (isset($_GET['adminname'])) {
            $query_additional .= "&adminname=" . $_GET['adminname'];
        }
        $params = [
            'total' => $total,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'admin',
            'action' => 'index',
            'page' => $page,
            'query_additional' => $query_additional
        ];
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
        $admins = $admin_model->getAllPagination($params);
        $this->page_title = 'Quản lý người dùng';
        $this->content = $this->render('views/admins/index.php', [
            'admins' => $admins,
            'pages' => $pages,
        ]);

        require_once 'views/layouts/main.php';
    }

    public function create() {
        $admin_model = new Admin();
        if (isset($_POST['submit'])) {
            $adminname = $_POST['adminname'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
            $status = $_POST['status'];
            //xử lý validate
            if (empty($adminname)) {
                $this->error = 'adminname không được để trống';
            } else if (empty($password)) {
                $this->error = 'Password không được để trống';
            } else if (empty($password_confirm)) {
                $this->error = 'Password confirm không được để trống';
            } else if ($password != $password_confirm) {
                $this->error = 'Password confirm chưa đúng';
            } else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->error = 'Link facebook không đúng định dạng url';
            } else if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            } else if (!empty($adminname)) {
                //kiếm tra xem adminname đã tồn tại trong DB hay chưa, nếu tồn tại sẽ báo lỗi
                $count_admin = $admin_model->getUserByUsername($adminname);
                if ($count_admin) {
                    $this->error = 'Adminname này đã tồn tại trong CSDL';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = '';
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = 'assets/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-admin-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                $admin_model->adminname = $adminname;
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $admin_model->password = md5($password);
                $admin_model->first_name = $first_name;
                $admin_model->last_name = $last_name;
                $admin_model->phone = $phone;
                $admin_model->address = $address;
                $admin_model->email = $email;
                $admin_model->avatar = $filename;
                $admin_model->jobs = $jobs;
                $admin_model->facebook = $facebook;
                $admin_model->status = $status;
                $is_insert = $admin_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: index.php?controller=admin');
                exit();
            }
        }
        $this->page_title = 'Thêm mới người dùng';
        $this->content = $this->render('views/admins/create.php');

        require_once 'views/layouts/main.php';
    }

    public function update() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=admin");
            exit();
        }

        $id = $_GET['id'];
        $admin_model = new Admin();
        $admin = $admin_model->getById($id);
        if (isset($_POST['submit'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
            $status = $_POST['status'];
            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->error = 'Link facebook không đúng định dạng url';
            } else if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = $admin['avatar'];
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = 'assets/uploads';
                    //xóa file ảnh đã update trc đó
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-admin-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $admin_model->first_name = $first_name;
                $admin_model->last_name = $last_name;
                $admin_model->phone = $phone;
                $admin_model->address = $address;
                $admin_model->email = $email;
                $admin_model->avatar = $filename;
                $admin_model->jobs = $jobs;
                $admin_model->facebook = $facebook;
                $admin_model->status = $status;
                $is_update = $admin_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=admin');
                exit();
            }
        }
        $this->page_title = 'update admin';
        $this->content = $this->render('views/admins/update.php', [
            'admin' => $admin
        ]);

        require_once 'views/layouts/main.php';
    }

    public function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=admin');
            exit();
        }

        $id = $_GET['id'];
        $admin_model = new Admin();
        $is_delete = $admin_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=admin');
        exit();
    }

    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=admin");
            exit();
        }
        $id = $_GET['id'];
        $admin_model = new Admin();
        $admin = $admin_model->getById($id);

        $this->content = $this->render('views/admins/detail.php', [
            'admin' => $admin
        ]);
        $this->page_title = 'admin detail';
        require_once 'views/layouts/main.php';
    }

    public function logout() {

//        session_destroy();
        $_SESSION = [];
        session_destroy();
//        unset($_SESSION['admin']);
        $_SESSION['success'] = 'Logout thành công';
        header('Location: index.php?controller=login&action=login');
        exit();
    }
}