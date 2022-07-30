<?php
$year = '';
$username = '';
$firstname = '';
$lastname = '';
$jobs = '';
$avatar = '';
$fblink = '';

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

<div class="profile">
    <section class="index-module">
        <div class="profile-banner" style="background-image: url(https://i.pinimg.com/736x/52/55/44/5255445017cd98fd66d7d589e6c10f58.jpg);">
            <div class="profile-user">
                <div class="profile-avatar">
                    <?php if (isset($avatar)){
                        echo '<img src="../backend/assets/uploads/'.$avatar.' ?>" class="profile-image" alt="User Image">';}
                    else {
                        echo '<img href="assets/images/img.png">';
                    }
                    ?>
                </div>
                <div class="profile-name">
                    <?php if (isset($lastname) || isset($firstname)){
                        echo "$firstname $lastname";
                    }
                    else{
                        echo $username;
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="profile-container">
            <div class="row">
                <div class="content-left">
                    <div class="box-wrapper">
                        <h4 class="box-title">Giới thiệu</h4>
                        <div>
                            <div class="profile-participation">
                                <div class="profile-participation_icon">
                                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="user-group" class="svg-inline--fa fa-user-group " role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><path fill="currentColor" d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3c-95.73 0-173.3 77.6-173.3 173.3C0 496.5 15.52 512 34.66 512H413.3C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM479.1 320h-73.85C451.2 357.7 480 414.1 480 477.3C480 490.1 476.2 501.9 470 512h138C625.7 512 640 497.6 640 479.1C640 391.6 568.4 320 479.1 320zM432 256C493.9 256 544 205.9 544 144S493.9 32 432 32c-25.11 0-48.04 8.555-66.72 22.51C376.8 76.63 384 101.4 384 128c0 35.52-11.93 68.14-31.59 94.71C372.7 243.2 400.8 256 432 256z"></path></svg>
                                </div>
                                <span>
                                Thành viên của
                                <span class="profile-highlight">Food Order</span>
                                Từ <?php echo $year; ?>
                                </span>
                            </div>
                        </div>
                        <div>
                            <div class="profile-participation">
                                <div class="profile-participation_icon">
                                    <i class="fab fa-facebook"></i>
                                </div>
                                <a class="link-profile" href="<?php echo $fblink; ?>">Kết nối Facebook tại đây</a>
                            </div>
                        </div>
                    </div>
                    <div class="box-wrapper">
                        <h4 class="box-title">Hoạt động gần đây</h4>
                        <div>
                            <div class="profile-participation">
                                Chưa có hoạt động
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-right">
                    <div class="box-wrapper">
                        <h4 class="box-title">Các sản phẩm đã mua</h4>
                        <div>
                            <?php if (!empty($products)): ?>
                                <div class="profile-inner">
                                    <?php foreach ($products AS $product):
                                        $slug = Helper::getSlug($product['title']);
                                        $product_link = "san-pham/$slug/" . $product['id'] . ".html";
                                        $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
                                        ?>
                                        <a class="profile-thumb" href="<?php echo $product_link; ?>">
                                            <img class="profile-thumb_img" title="<?php echo $product['title'] ?>"
                                                 src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                                                 alt="<?php echo $product['title'] ?>"/>
                                        </a>
                                    <div class="info">
                                        <h3 class="profile-info_title">
                                            <a href="<?php echo $product_link; ?>"><?php echo $product['title'] ?></a>
                                        </h3>
                                        <p class="profile-info_summary"><?php echo $product['summary'] ?></p>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php else: ?>
                                <div class="profile-participation">
                                    Chưa có mua sản phẩm nào
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>