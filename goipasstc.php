<?php
session_start();
require_once "class/dt.php";
?>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Gởi Mật Khẩu Thành Công</title>
<meta charset="utf-8">
<div class="container" style="margin-top: 100px; ">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>Gởi Mật Khẩu Thành Công</b>
            </div>
            <div class="panel-body">
                <div class="alert alert-success">
                    <strong>
                        <p> Đã cập nhật mật khẩu mới</p>
                        <p> Quay lại<a href="<?= BASE_URL ?>"> trang chủ</a></p>
                        <p> Hoặc <a href="<?= BASE_URL ?>login.php"> click here</a> to sign in</p>
                    </strong>
                </div>
            </div>
        </div>
    </div>
</div>