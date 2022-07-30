<?php
require_once 'helpers/Helper.php';
?>
<div class="food_search">
    <div class="container">
        <form action="index.php?controller=product&action=search" method="get">
            <input type="search" name="search" placeholder="search for food..." required>
            <input type="button" name="search" value="Search" class="btn btn_primary">
            <input type="hidden" name="controller" value="product" />
            <input type="hidden" name="action" value="search" />
        </form>
    </div>
</div>
<div class="categories">
    <div class="container">
        <div class="h_text">
            <h1>Thể loại</h1>
        </div>
        <?php if (!empty($categories)): ?>
            <div class="link-secondary-wrap row">
                <?php foreach ($categories AS $category):
                    $slug = Helper::getSlug($category['description']);
                    $category_link = "the-loai/$slug/" . $category['id'] . ".html";
                    ?>
                    <div class="service-link col-md-4 col-sm-6 col-xs-12">
                        <div class="category_item">
                            <a href="<?php echo $category_link; ?>">
                                <img class="img img_responsive" title="<?php echo $category['description'] ?>"
                                     src="../backend/assets/uploads/<?php echo $category['avatar'] ?>"
                                     alt="<?php echo $category['description'] ?>"/>
                            </a>
                            <h3 class="categories_text"><?php echo $category['description'] ?></h3>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="food_menu">
    <h1 class="h_text">Danh sách đồ ăn</h1>
    <div class="product container">
      <?php if (!empty($products)): ?>
          <div class="link-secondary-wrap row">
            <?php foreach ($products AS $product):
              $slug = Helper::getSlug($product['title']);
              $product_link = "san-pham/$slug/" . $product['id'] . ".html";
              $product_cart_add = "them-vao-gio-hang/" . $product['id'] . ".html";
              ?>

                <div class="service-link col-md-6 col-sm-6 col-xs-12">
                    <div class="food_item">
                        <div class="food_img">
                            <a href="<?php echo $product_link; ?>">
                                <img class="img img_responsive" title="<?php echo $product['title'] ?>"
                                     src="../backend/assets/uploads/<?php echo $product['avatar'] ?>"
                                     alt="<?php echo $product['title'] ?>"/>
                            </a>
                        </div>
                        <div class="food_desc">
                            <h4><?php echo $product['title'] ?></h4>
                            <p class="food_price"><?php echo number_format($product['price']) ?></p>
                            <p class="food_detail">
                                <?php echo $product['summary'] ?>
                            </p>
                            <span class="add-to-cart" data-id="<?php echo $product['id']; ?>">
                                <a class="btn btn_primary" href="#" style="color: inherit">Thêm vào giỏ</a>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
          </div>
      <?php endif; ?>
    </div>
</div>
