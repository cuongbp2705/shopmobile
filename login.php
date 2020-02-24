<?php
session_start();
$loi = array();
if (isset($_POST['mail'])) {
    require_once "class/dt.php";
    $dt = new dt;
    $thanhcong = $dt->login($_POST['mail'], $_POST['pass'], $loi);
    if ($thanhcong == true) {
        if (isset($_SESSION['back'])) {
            $back = $_SESSION['back'];
            unset($_SESSION['back']);
            header("location:" . $back);
        } else header("location:index.php");
        exit();
    }
}
?>

<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<title>Shop bán điện thoại di động</title>
<meta charset="utf-8">
<div class="container" style="margin-top: 20px; width: 450px;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>Thành viên đăng nhập</b>
        </div>
        <div class="panel-body">
            <form class="form-horizontal" method="POST" action="">

                <div class="form-group">
                    <label class="control-label col-sm-3">
                        Email:
                    </label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" name="mail" required placeholder="Email của bạn" value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>">
                        <?php if (isset($loi['mail'])) echo $loi['mail'] ?>
                    </div>
                </div>
                <!-- end email -->

                <div class="form-group">
                    <label class="control-label col-sm-3">
                        Password:
                    </label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" name="pass" required placeholder="Password của bạn" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">
                        <?php if (isset($loi['pass'])) echo $loi['pass'] ?>

                    </div>
                </div>
                <!-- end pass -->

                <div class="form-group text-center">
                    
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-default"> Đăng Nhập </button>
                    </div>
                </div>
                <!-- end pass -->

            </form>
        </div>
    </div>

</div>