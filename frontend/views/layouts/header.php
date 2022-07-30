<?php
$id = '';
$year = '';
$username = '';
$firstname = '';
$lastname = '';
$jobs = '';
$avatar = '';
if (isset($_SESSION['user'])) {
    $username = $_SESSION['user']['adminname'];
    $jobs = $_SESSION['user']['jobs'];
    $avatar = $_SESSION['user']['avatar'];
    $year = date('Y', strtotime($_SESSION['user']['created_at']));
    $firstname = $_SESSION['user']['first_name'];
    $lastname = $_SESSION['user']['last_name'];
}
if (isset($user)){
    $id = $user['id'];
    $username = $user['username'];
    $jobs = $user['jobs'];
    $avatar = $user['avatar'];
    $year = date('Y', strtotime($user['created_at']));
    $firstname = $user['first_name'];
    $lastname = $user['last_name'];
    $fblink = $user['facebook'];
}

?>
<span class="ajax-message"></span>
<!-- header start -->
<header class="header-top nopc header">

    <div class="container">
        <div class="row navbar">

            <div class="logo">
                <a href="#" title="Logo">
                    <img src="assets/images/logo.png" alt="Restaurant Logo" class="img_responsive">
                </a>
            </div>
            <div class="menu">
                <ul class="menu_list">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="danh-sach-the-loai.html">Thể loại</a></li>
                    <li><a href="danh-sach-san-pham.html">Đồ ăn</a></li>
                    <li>
                        <a href="gio-hang-cua-ban.html" class="cart-link">
                            <i class="fa fa-cart-plus"></i>
                            <?php
                            $cart_total = 0;
                            if (isset($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] AS $cart) {
                                    $cart_total += $cart['quantity'];
                                }
                            }
                            ?>
                            <span class="cart-amount">
                                <?php echo $cart_total; ?>
                            </span>
                        </a>
                    <li>
                    <?php if (isset($_SESSION['user'])) :?>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <?php if (isset($avatar)){
                                    echo '<img src="../backend/assets/uploads/'.$avatar.' ?>" class="user-image" alt="User Image">';}
                                    else {
                                        echo '<i class="fas fa-user"></i>';
                                    }
                                ?>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header menu_separate">
                                    <div class="pull-left">
                                        <?php if (isset($avatar)){
                                            echo '<img src="../backend/assets/uploads/'.$avatar.' ?>" class="user-image" alt="User Image">';}
                                        else {
                                            echo '<i class="fas fa-user"></i>';
                                        }
                                        ?>
                                    </div>
                                    <div class="pull-right">
                                        <p class="username">
                                            <?php if (isset($firstname)){
                                                echo "$firstname";
                                            }
                                            else{
                                                echo $username;
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </li>
                                <hr>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="">
                                        <a href="trang-ca-nhan.html" class="btn btn-default btn-flat">Trang cá nhân</a>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <a href="settings.html" class="btn btn-default btn-flat">Cài đặt</a>
                                    </div>
                                    <div class="">
                                        <a href="index.php?controller=user&action=logout" class="btn btn-default btn-flat">Đăng xuất</a>
                                    </div>

                                </li>
                            </ul>
                        </li>

                    <?php else :?>
                    <li><a href="dang-nhap.html">Đăng nhập</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </div>
</header>
<!-- header end -->

<!-- Left sidebar menu start -->
<div class="sidebar">
    <div class="sidebar-wrapper">

        <!-- side menu logo start -->
        <div class="sidebar-logo">
            <a href="#"></a>
            <div class="sidebar-toggle-button">
                <i class="material-icons">&#xE317;</i>
            </div>
        </div>
        <!-- side menu logo end -->
        <!-- mobile menu start -->
        <div id="mobileMenu">
            <div class="sidebar-seperate"></div>
        </div>
        <!-- mobile menu end -->

        <!-- sidebar menu start -->
        <ul class="sidebar-menu">
            <li>
                <a href="index.php" class="material-button submenu-toggle">Trang chủ</a>
            </li>
            <li>
                <a href="#" class="material-button submenu-toggle">Sản phẩm</a>
            </li>
            <li>
                <a href="#" class="material-button submenu-toggle">Tin tức</a>
            </li>
            <li>
                <a href="#" class="material-button submenu-toggle">Đăng nhập</a>
            </li>
        </ul>
        <!-- sidebar menu end -->
        <div class="sidebar-seperate"></div>
        <!-- sidebar menu end -->
    </div>
</div>