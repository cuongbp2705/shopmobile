<?php
session_start();
require_once "class/dt.php";
$dt = new dt;
$p = isset($_GET['p']) ? $_GET['p'] : '';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Shop bán điện thoại di động</title>
    <base href="<?= BASE_URL ?>" />
    <script src="js/jquery-3.4.1.min.js"></script>
    <meta name="keywords" content="">

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800&effect=fire-animation' rel='stylesheet' type='text/css'>

    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <!-- Css animations  -->
    <link href="css/animate.css" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes -->
    <link href="css/custom.css" rel="stylesheet">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png" />
</head>

<body>

    <div id="all">

        <?php require "header.php" ?>

        <!-- *** LOGIN MODAL ***
_________________________________________________________ -->

        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog modal-sm">

                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="Login">Customer login</h4>
                    </div>
                    <div class="modal-body">

                        <form id="loginform">
                            <div class="form-group">
                                <input type="email" class="form-control" id="email_modal" name="mail" required placeholder="Email của bạn" value="<?php if (isset($_POST['mail'])) echo $_POST['mail']; ?>">
                                <div id="errEmail">

                                </div>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" id="password_modal" name="pass" required placeholder="Password của bạn" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>">
                                <div id="errPass">

                                </div>
                            </div>

                            <p class="text-center">
                                <button type="submit" class="btn btn-template-main"><i class="fa fa-sign-in"></i> Log in</button>
                            </p>

                        </form>

                        <p class="text-center text-muted">Not registered yet?</p>
                        <p class="text-center text-muted"><a href="dang-ky/"><strong>Register now</strong></a>! It is easy and done in 1&nbsp;minute and gives you access to special discounts and much more!</p>

                    </div>
                </div>
            </div>
        </div>

        <!-- *** LOGIN MODAL END *** -->

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <?php if ($p == "lienhe") {
                            echo "<h1 class='font-effect-fire-animation'>Contact Us</h1>";
                        } elseif ($p == "dangky") {
                            echo "<h1 class='font-effect-fire-animation'>Sign Up</h1>";
                        } elseif ($p == "chitiet") {
                            echo "<h1 class='font-effect-fire-animation'>Product Details </h1>";
                        } elseif ($p == "sptrongloai") {
                            echo "<h1 class='font-effect-fire-animation'>products in kind</h1>";
                        } elseif ($p == "giohang") {
                            echo "<h1 class='font-effect-fire-animation'>Cart</h1>";
                        } elseif ($p == "thanhtoan1" || $p == 'thanhtoan2' || $p == 'thanhtoan3' || $p == 'thanhtoan4') {
                            echo "<h1 class='font-effect-fire-animation'>Check out</h1>";
                        } elseif ($p == "tintuc") {
                            echo "<h1 class='font-effect-fire-animation'>Blog</h1>";
                        } elseif ($p == "gioithieu") {
                            echo "<h1 class='font-effect-fire-animation'>About Us</h1>";
                        } elseif ($p == "dathangtc") {
                            echo "<h1 class='font-effect-fire-animation'>Order Success</h1>";
                        } elseif ($p == "search") {
                            echo "<h1 class='font-effect-fire-animation'>Search</h1>";
                        } else { ?>
                            <h1 class='font-effect-fire-animation'>DANH MỤC SẢN PHẨM</h1>
                        <?php } ?>
                    </div>
                    <div class="col-md-5">
                        <ul class="breadcrumb">
                            <li><a href="index.php">Trang chủ </a>
                            </li>

                            <?php
                            if ($p == "lienhe") {
                                echo "<li>Contact Us</li>";
                            } elseif ($p == "dangky") {
                                echo "<li>Sign Up</li>";
                            } elseif ($p == "chitiet") {
                                echo "<li>Product Details </li>";
                            } elseif ($p == "sptrongloai") {
                                echo "<li>products in kind</li>";
                            } elseif ($p == "giohang") {
                                echo "<li>Cart</li>";
                            } elseif ($p == "tintuc") {
                                echo "<li>Blog</li>";
                            } elseif ($p == "gioithieu") {
                                echo "<li>About Us</li>";
                            } elseif ($p == "dathangtc") {
                                echo "<li>Order Success</li>";
                            } elseif ($p == "thanhtoan1" || $p == 'thanhtoan2' || $p == 'thanhtoan3' || $p == 'thanhtoan4') {
                                echo "<li>Check out</li>";
                            } elseif ($p == "search") {
                                echo "<li>Search</li>";
                            } else {
                                ?>
                                <li>Sản phẩm</li>
                            <?php } ?>
                        </ul>

                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix col-md-4 pull-right" id="search">
            <form class="navbar-form" role="search" method="GET">
                <div class="input-group">
                    <?php
                    $tukhoa = (isset($_GET['TuKhoa']) == true) ? $_GET['TuKhoa'] : "";
                    $tukhoa = str_replace(array('"', '"'), "", trim(strip_tags($tukhoa)));
                    ?>
                    <input type="hidden" name="p" value="search">
                    <input type="text" name="TuKhoa" class="form-control" placeholder="Từ khóa" value="<?= $tukhoa ?>">

                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
        </div>
        <!--/.nav-collapse -->

        <div id="content">
            <!-- <div class="container"> -->
            <?php
            if ($p == 'giohang') {
                $action = isset($_GET['action']) ? $_GET['action'] : ''; // để bik phải làm gì: thêm/xóa/cập nhật
                $idDT = isset($_GET['idDT']) ? $_GET['idDT'] : ''; // để bik sp nào mà thêm hay bớt
                $soluong = isset($_GET['soluong']) ? $_GET['soluong'] : ''; // để bik so luong bao nhiêu
                $dt->CapNhatGioHang($action, $idDT, $soluong);
                require "giohang.php";
            } elseif ($p == 'dangky') require "dangky.php";
            elseif ($p == 'dangkytc') require "dangkytc.php";
            elseif ($p == "lienhe") require "lienhe.php";
            elseif ($p == "chitiet") require "chitiet.php";
            elseif ($p == "sptrongloai") require "sptrongloai.php";
            elseif ($p == "dathang") require "dathang.php";
            elseif ($p == "dathangtc") require "dathangtc.php";
            elseif ($p == 'thanhtoan1') require "thanhtoan1.php";
            elseif ($p == 'thanhtoan2') require "thanhtoan2.php";
            elseif ($p == 'thanhtoan3') require "thanhtoan3.php";
            elseif ($p == 'thanhtoan4') require "thanhtoan4.php";
            elseif ($p == 'tintuc') require "tintuc.php";
            elseif ($p == 'gioithieu') require "gioithieu.php";
            else if ($p == "search") require "ketquatimkiem.php";
            else {
                ?>
                <div class="container">
                    <div class="heading">
                        <h2> Sản Phẩm Mới</h2>
                    </div>

                    <?php
                        $listSP = $dt->SanPhamMoi(18);
                        include "listsp.php";
                        ?>

                    <div class="heading">
                        <h2>Sản Phẩm Bán Chạy</h2>
                    </div>

                    <?php
                        $listSP = $dt->SanPhamBanChay(18);
                        include "listsp.php";
                        ?>

                    <div class="heading">
                        <h2>Sản Phẩm Hot</h2>
                    </div>

                    <?php
                        $listSP = $dt->SanPhamHot(18);
                        include "listsp.php";
                        ?>
                </div>
            <?php } //if 
            ?>
            <!-- </div> -->
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <!-- *** GET IT ***
_________________________________________________________ -->

        <div id="get-it">
            <div class="container">
                <div class="col-md-8 col-sm-12">
                    <h3>Do you want cool website like this one?</h3>
                </div>
                <div class="col-md-4 col-sm-12">
                    <a href="#" class="btn btn-template-transparent-primary">Buy this template now</a>
                </div>
            </div>
        </div>


        <!-- *** GET IT END *** -->


        <!-- *** FOOTER ***
_________________________________________________________ -->

        <?php require "footer.php"; ?>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->

        <!-- *** COPYRIGHT ***
_________________________________________________________ -->

        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <p class="pull-left">&copy; 2019. Nguyen Huu Nhan / PHP & MySQL</p>
                    <p class="pull-right">Template by <a href="https://bootstrapious.com">Bootstrapious</a> & <a href="https://fity.cz">Fity.cz</a>
                        <!-- Not removing these links is part of the license conditions of the template. Thanks for understanding :) If you want to use the template without the attribution links, you can do so after supporting further themes development at https://bootstrapious.com/donate  -->
                    </p>
                </div>

            </div>
        </div>
        <!-- /#copyright -->

        <!-- *** COPYRIGHT END *** -->





    </div>
    <!-- /#all -->


    <!-- #### JAVASCRIPT FILES ### -->

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/front.js"></script>

    <script>
        $(document).ready(function() {
            $('#loginform').submit(function(e) {

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: 'checklogin.php',
                    data: $(this).serialize(),
                    success: function(data) {
                        if (data === 'login') {
                            location.reload();
                        } else {
                            var err = data.split("|");
                            if (err[0] == '1') {
                                $("#errEmail").html(err[1]);
                            } else if (err[0] == '2') {
                                $("#errPass").html(err[1]);
                            }
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>