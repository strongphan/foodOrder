<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
require_once 'models/Pagination.php';
class UserController extends Controller {


    public function update() {
        if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }
        $id = $_SESSION['user']['id'];
        $user_model = new User();
        $user = $user_model->getById($id);

        if (isset($_POST['submit'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
            $status = $_POST['status'];
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

            if (empty($this->error)) {
                $filename = $user['avatar'];
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = '../backend/assets/uploads';
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                $user_model->first_name = $first_name;
                $user_model->last_name = $last_name;
                $user_model->phone = $phone;
                $user_model->address = $address;
                $user_model->email = $email;
                $user_model->avatar = $filename;
                $user_model->jobs = $jobs;
                $user_model->facebook = $facebook;
                $user_model->status = $status;
                $is_update = $user_model->update($id);
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: trang-ca-nhan.html');
                exit();
            }
        }
        $this->page_title = 'update user';
        $this->content = $this->render('views/users/update.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }



    public function detail() {
        if (!isset($_SESSION['user']['id']) || !is_numeric($_SESSION['user']['id'])) {
            header("Location: index.php");
            exit();
        }
        $id = $_SESSION['user']['id'];
        $user_model = new User();
        $user = $user_model->getById($id);


        $this->content = $this->render('views/users/profile.php', [
            'user' => $user
        ]);
        $this->page_title = 'Profile';
        require_once 'views/layouts/main.php';
    }

    public function logout() {

        $_SESSION = [];
        session_destroy();
        $_SESSION['success'] = 'Logout thành công';
        header('Location: dang-nhap.html');
        exit();
    }
}