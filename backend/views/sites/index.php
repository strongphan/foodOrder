<h2>Danh sách user</h2>
<a href="index.php?controller=site&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Contact</th>
        <th>Cover_img</th>
        <th>About_content</th>
    </tr>
    <?php if (!empty($sites)): ?>
        <?php foreach ($sites as $site): ?>
            <tr>
                <td><?php echo $site['id'] ?></td>
                <td><?php echo $site['name'] ?></td>
                <td><?php echo $site['email'] ?></td>
                <td><?php echo $site['contact'] ?></td>
                <td>
                    <?php if (!empty($site['cover_img'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $site['cover_img'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php echo substr($site['about_content'],0,150) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=user&action=detail&id=" . $site['id'];
                    $url_update = "index.php?controller=user&action=update&id=" . $site['id'];
                    $url_delete = "index.php?controller=user&action=delete&id=" . $site['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Are you sure delete?')"><i
                            class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>