<?php
require_once 'controllers/Controller.php';
require_once 'models/Site.php';


class SiteController extends Controller {
    public function index(){
        $site_model = new Site();
        $sites =$site_model->listData();
        $this->page_title ='Trang danh sách';
        $this->content = $this->render('views/sites/index.php',[
            'sites' => $sites
        ]);
        require_once'views/layouts/main.php';

    }
    public function create(){
        if (isset($_POST['submit'])){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $contact = $_POST['contact'];
            $content = $_POST['about_content'];
            if (empty($name)){
                $this->error = 'Không được để trống tên trang';
            } else if ($_FILES['cover_img']['error'] == 0) {
                $extension = pathinfo($_FILES['cover_img']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $arr_extension = ['jpg', 'jpeg', 'png', 'gif'];

                $file_size_mb = $_FILES['cover_img']['size'] / 1024 / 1024;
                //làm tròn theo đơn vị thập phân
                $file_size_mb = round($file_size_mb, 2);

                if (!in_array($extension, $arr_extension)) {
                    $this->error = 'Cần upload file định dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được quá 2MB';
                }
            }
            if (empty($this->error)) {
                $filename = '';
                if ($_FILES['cover_img']['error'] == 0) {
                    $dir_uploads = 'assets/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }
                    $filename = time() . '-site-' . $_FILES['cover_img']['name'];
                    move_uploaded_file($_FILES['cover_img']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                $site_model = new Site();
                $site_model->name = $name;
                $site_model->email = $email;
                $site_model->contact = $contact;
                $site_model->content = $content;
                $site_model->cover_img = $filename;
                $is_insert = $site_model->insertData();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: index.php?controller=site');
                exit();
            }
        }
        $this->page_title = 'Thêm mới giao diện';
        $this->content = $this->render('views/sites/create.php');

        require_once 'views/layouts/main.php';
    }


    public function delete(){
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=site');
            exit();
        }

        $id = $_GET['id'];
        $site_model = new Site();
        $is_delete = $site_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=site?action=index');
        exit();
    }
}