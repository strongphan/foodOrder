<?php
require_once 'helpers/Helper.php';
?>
<h2>Chi tiết admin</h2>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <td><?php echo $admin['id'] ?></td>
    </tr>
    <tr>
        <th>username</th>
        <td><?php echo $admin['adminname'] ?></td>
    </tr>
    <tr>
        <th>first_name</th>
        <td><?php echo $admin['first_name'] ?></td>
    </tr>
    <tr>
        <th>last_name</th>
        <td><?php echo $admin['last_name'] ?></td>
    </tr>
    <tr>
        <th>phone</th>
        <td><?php echo $admin['phone'] ?></td>
    </tr>
    <tr>
        <th>address</th>
        <td><?php echo $admin['address'] ?></td>
    </tr>
    <tr>
        <th>email</th>
        <td><?php echo $admin['email'] ?></td>
    </tr>
    <tr>
        <th>avatar</th>
        <td>
            <?php if (!empty($admin['avatar'])): ?>
                <img height="80" src="assets/uploads/<?php echo $admin['avatar'] ?>"/>
            <?php endif; ?>
        </td>
    </tr>
    <tr>
        <th>jobs</th>
        <td><?php echo $admin['jobs'] ?></td>
    </tr>
    <tr>
        <th>last_login</th>
        <td><?php echo !empty($admin['last_login']) ? date('d-m-Y H:i:s', strtotime($admin['last_login'])) : '' ?></td>
    </tr>
    <tr>
        <th>status</th>
        <td><?php echo Helper::getStatusText($admin['status']); ?></td>
    </tr>
    <tr>
        <th>created_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($admin['created_at'])) ?></td>
    </tr>
    <tr>
        <th>updated_at</th>
        <td><?php echo date('d-m-Y H:i:s', strtotime($admin['updated_at'])) ?></td>
    </tr>
</table>
<a href="index.php?controller=admin&action=index" class="btn btn-default">Back</a>