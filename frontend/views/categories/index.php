<?php
require_once 'helpers/Helper.php';
?>
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