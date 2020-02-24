<?php
session_start();
require_once "class/dt.php";
$dt = new dt;
$loi = array();
$loi_str = "";
if (isset($_POST['mail'])) {

    $thanhcong = $dt->GoiPass($_POST['mail'], $loi);
    if ($thanhcong == true) {
        echo "<script>document.location='" . BASE_URL . "goi-pass-thanh-cong/';</script>";
        exit();
    } else foreach ($loi as $s) $loi_str = $loi_str . $s . "<br>";
}

?>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Shop bán điện thoại di động</title>
<meta charset="utf-8">
<div class="container" style="margin-top: 20px; width: 450px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>Gởi PassWord</b>
        </div>
        <div class="panel-body">
            <?php if ($loi_str != "") { ?>
                <div class="alert alert-danger"> <?= $loi_str ?> </div>
            <?php } ?>
            <form class="form-horizontal" method="POST" action="">

                <div class="form-group">
                    <label class="col-sm-12 text-center">
                        Nhập Email Đã Đăng Ký Để Nhận Password Mới :
                    </label>
                    <div class="col-sm-12">
                        <input type="email" class="form-control" name="mail" required placeholder="Email của bạn" value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>">
                    </div>
                </div>
                <!-- end email -->



                <div class="form-group text-center">

                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-primary"><b> Gửi </b> </button>
                    </div>
                    <br><br>
                    <div class="col-sm-12">
                        <strong>
                            <a href="<?= BASE_URL ?>"> Quay lại trang chủ</a>
                        </strong>
                    </div>
                </div>


            </form>
        </div>
    </div>

</div>