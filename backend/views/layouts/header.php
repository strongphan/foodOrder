<?php
$year = '';
$adminname = '';
$jobs = '';
$avatar = '';
if (isset($_SESSION['admin'])) {
    $adminname = $_SESSION['admin']['adminname'];
    $jobs = $_SESSION['admin']['jobs'];
    $avatar = $_SESSION['admin']['avatar'];
    $year = date('Y', strtotime($_SESSION['admin']['created_at']));
}

?>
<header class="main-header">
    <!-- Logo -->
    <a href="index.php?controller=home&action=home" class="logo">
        <span class="logo-mini"><b>A</b>LT</span>
        <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <i class="fa fa-bars"></i>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php if (isset($avatar)){
                            echo '<img src="assets/uploads/'.$avatar.' ?>" class="user-image" alt="User Image">';} ?>
                        <span class="hidden-xs"><?php echo $adminname; ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <?php if (isset($avatar)){
                                echo '<img src="assets/uploads/'.$avatar.' ?>" class="user-image" alt="User Image">';} ?>
                            <p>
                                <?php echo $adminname . ' - ' . $jobs; ?>
                                <small>Thành viên từ năm <?php echo $year; ?></small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="index.php?controller=user&action=logout" class="btn btn-default btn-flat">Sign
                                    out</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel" ">
            <div class="pull-left image">
                <?php if (isset($avatar)){
                    echo '<img src="assets/uploads/'.$avatar.' ?>" class="user-image" alt="User Image">';} ?>
            </div>
            <div class="pull-left info" >
                <p><?php echo $adminname; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">QUẢN LÝ</li>

            <li>
                <a href="index.php?controller=category&action=index">
                    <i class="fa fa-th"></i> <span>Quản lý danh mục</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=product&action=index">
                    <i class="fa fa-code"></i> <span>Quản lý sản phẩm</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=user&action=index">
                    <i class="fa fa-user"></i> <span>Quản lý user</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=admin&action=index">
                    <i class="fa fa-user"></i> <span>Quản lý admin</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li>
                <a href="index.php?controller=site&action=index">
                    <i class="fa fa-cog"></i> <span>Quản lý giao diện</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </section>
</aside>

<!-- Breadcrumd Wrapper. Contains breadcrumb -->
<div class="breadcrumb-wrap content-wrap content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>Control panel</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
</div>

<!-- Messaeg Wrapper. Contains messaege error and success -->
<div class="message-wrap content-wrap content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($this->error)): ?>
            <div class="alert alert-danger">
                <?php
                echo $this->error;
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

    </section>
</div>