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
<h2 style="text-align: center">Xin chào <b><?php echo strtoupper($adminname); ?></b> đã đến với trang quản trị</h2>
