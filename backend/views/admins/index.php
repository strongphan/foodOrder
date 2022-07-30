<form method="GET" action="">
    <div class="form-group">
        <label for="adminname">AdminName</label>
        <input type="text" name="adminname" id="adminname"
               value="<?php echo isset($_GET['adminname']) ? $_GET['adminname'] : '' ?>" class="form-control"/>
        <input type="hidden" name="controller" value="user"/>
        <input type="hidden" name="action" value="index"/>
    </div>
    <div class="form-group">
        <input type="submit" value="Tìm kiếm" name="search" class="btn btn-primary"/>
        <a href="index.php?controller=user" class="btn btn-default">Back</a>
    </div>
</form>

<h2>Danh sách user</h2>
<a href="index.php?controller=user&action=create" class="btn btn-success">
    <i class="fa fa-plus"></i> Thêm mới
</a>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Adminname</th>
        <th>first_name</th>
        <th>last_name</th>
        <th>phone</th>
        <th>address</th>
        <th>email</th>
        <th>avatar</th>
        <th>jobs</th>
        <th>created_at</th>
        <th></th>
    </tr>
    <?php if (!empty($admins)): ?>
        <?php foreach ($admins as $admin): ?>
            <tr>
                <td><?php echo $admin['id'] ?></td>
                <td><?php echo $admin['adminname'] ?></td>
                <td><?php echo $admin['first_name'] ?></td>
                <td><?php echo $admin['last_name'] ?></td>
                <td><?php echo $admin['phone'] ?></td>
                <td><?php echo $admin['address'] ?></td>
                <td><?php echo $admin['email'] ?></td>
                <td>
                    <?php if (!empty($admin['avatar'])): ?>
                        <img height="80" src="assets/uploads/<?php echo $admin['avatar'] ?>"/>
                    <?php endif; ?>
                </td>
                <td><?php echo $admin['jobs'] ?></td>
                <td><?php echo date('d-m-Y H:i:s', strtotime($admin['created_at'])) ?></td>
                <td>
                    <?php
                    $url_detail = "index.php?controller=admin&action=detail&id=" . $admin['id'];
                    $url_update = "index.php?controller=admin&action=update&id=" . $admin['id'];
                    $url_delete = "index.php?controller=admin&action=delete&id=" . $admin['id'];
                    ?>
                    <a title="Chi tiết" href="<?php echo $url_detail ?>"><i class="fa fa-eye"></i></a> &nbsp;&nbsp;
                    <a title="Update" href="<?php echo $url_update ?>"><i class="fa fa-pencil-alt"></i></a> &nbsp;&nbsp;
                    <a title="Xóa" href="<?php echo $url_delete ?>" onclick="return confirm('Có chắc muốn xóa?')"><i
                                class="fa fa-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
    <?php endif; ?>
</table>
<?php echo $pages; ?>