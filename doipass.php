<?php
session_start();
require_once "class/dt.php";
$dt = new dt;
$dt->checkLogin();

$loi = array();
$loi_str = "";
if (isset($_POST['pass'])) {
    $passold = isset($_POST['passold']) ? $_POST['passold'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";
    $repass = isset($_POST['repass']) ? $_POST['repass'] : "";
    $thanhcong = $dt->DoiMatKhau($passold, $pass, $repass, $loi);
    if ($thanhcong == true) {
        echo "<script>document.location='".BASE_URL."doi-pass-thanh-cong/';</script>";
        exit();
    } else foreach ($loi as $s) $loi_str = $loi_str . $s . "<br>";
}

?>


<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Trang đăng nhập</title>
<meta charset="utf-8">
<div class="container" style="margin-top: 20px; ">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <b>Đổi Password</b>
            </div>
            <div class="panel-body">

                <?php if ($loi_str != "") { ?>
                    <div class="alert alert-danger"> <?= $loi_str ?> </div>
                <?php } ?>
                <form class="form-horizontal" method="POST" action="">

                    <div class="form-group">
                        <label class="control-label col-sm-3">
                            Email:
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled value="<?= $_SESSION['login_email'] ?>">
                        </div>
                    </div>
                    <!-- end email -->

                    <div class="form-group">
                        <label class="control-label col-sm-3">
                            Họ Tên:
                        </label>
                        <div class="col-sm-9">
                            <input class="form-control" disabled value="<?= $_SESSION['login_hoten'] ?>">
                        </div>
                    </div>
                    <!-- end hoten -->

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="passold">
                            Mật Khẩu cũ:
                        </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="passold" id="passold" required placeholder="Mật khẩu cũ của bạn" value="<?php if (isset($_POST['passold'])) echo $_POST['passold']; ?>">

                        </div>
                    </div>
                    <!-- end passold -->

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="pass">
                            Mật Khẩu mới:
                        </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="pass" id="pass" required placeholder="Mật khẩu mới của bạn" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">

                        </div>
                    </div>
                    <!-- end pass -->

                    <div class="form-group">
                        <label class="control-label col-sm-3" for="repass">
                            Gõ lại mk mới:
                        </label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="repass" id="repass" required placeholder="Nhập lại mk mới" value="<?php if (isset($_POST['repass'])) echo $_POST['repass']; ?>">

                        </div>
                    </div>
                    <!-- end repass -->

                    <div class="form-group">
                        <label class="control-label col-sm-3">
                        </label>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-default"> Đổi mật khẩu </button>
                        </div>
                    </div>
                    <!-- end submit -->

                </form>
            </div>
        </div>
    </div>
</div>