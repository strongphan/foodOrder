<div class="container" style="max-width: 500px">
    <form method="post" action="">
        <h2>Login</h2>
        <div class="form-group">
            <label for="username">AdminName</label>
            <input type="text" name="adminname" value="" id="adminname" class="form-control"/>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" value="" id="password" class="form-control"/>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Đăng nhập" class="btn btn-primary"/>
            <p>
                Chưa có tài khoản, <a href="index.php?controller=login&action=register">Đăng ký</a> ngay
            </p>
        </div>
    </form>
</div>