<h2>Thêm mới giao diện</h2>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="name">Name <span class="red">*</span></label>
        <input type="text" name="name" id="name"
               value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="contact">Contact</label>
        <input type="text" name="contact" id="contact" value="<?php echo isset($_POST['contact']) ? $_POST['address'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="avatar">Avatar</label>
        <input type="file" name="avatar" id="avatar" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="content">About Content</label>
        <input type="text" name="content" id="content" value="<?php echo isset($_POST['about_content']) ? $_POST['jobs'] : '' ?>" class="form-control"/>
    </div>
    <div class="form-group">
        <label for="status">Trạng thái</label>
        <select name="status" class="form-control" id="status">
            <?php
            $selected_active = '';
            $selected_disabled = '';
            if (isset($_POST['status'])) {
                switch ($_POST['status']) {
                    case 0:
                        $selected_disabled = 'selected';
                        break;
                    case 1:
                        $selected_active = 'selected';
                        break;
                }
            }
            ?>
            <option value="0" <?php echo $selected_disabled; ?>>Disabled</option>
            <option value="1" <?php echo $selected_active ?>>Active</option>
        </select>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" value="Save" class="btn btn-primary"/>
        <a href="index.php?controller=site&action=index" class="btn btn-default">Back</a>
    </div>
</form>