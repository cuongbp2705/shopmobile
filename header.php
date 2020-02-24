<header>

    <!-- *** TOP ***
_________________________________________________________ -->
    <div id="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-5 contact">
                    <p class="hidden-sm hidden-xs">Liên hệ ngay với chúng tôi theo số +028 123 456 78 hoặc sdt@.com.vn</p>
                    <p class="hidden-md hidden-lg"><a href="#" data-animate-hover="pulse"><i class="fa fa-phone"></i></a> <a href="#" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                    </p>
                </div>
                <div class="col-xs-7">
                    <div class="social">
                        <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                        <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                        <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                        <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                    </div>

                    <div class="login">
                        <?php if (isset($_SESSION['login_id']) == false) { ?>
                            <a href="#" data-toggle="modal" data-target="#login-modal"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Đăng nhập</span></a>
                            <a href="dang-ky/"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Đăng ký</span></a>
                        <?php } else { ?>
                            <span id="hoten" class="text-uppercase">
                                <u> <?= $_SESSION['login_hoten'] ?></u>
                            </span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <a href="thoat.php"><span class="glyphicon glyphicon-log-out"></span> Thoát </a>&nbsp;
                            <a href="doi-pass/"><span class="glyphicon glyphicon-retweet"></span> Đổi pass</a>
                        <?php } ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- *** TOP END *** -->

    <!-- *** NAVBAR ***
    _________________________________________________________ -->

    <div class="navbar-affixed-top" data-spy="affix" data-offset-top="200">

        <div class="navbar navbar-default yamm" role="navigation" id="navbar">

            <div class="container">
                <div class="navbar-header">

                    <a class="navbar-brand home" href="index.php">
                        <img src="img/logo1.png" alt="Logo Shop" class="hidden-xs hidden-sm" style="width: 158px;">
                        <img src="img/logo-small.png" alt="Universal logo" class="visible-xs visible-sm"><span class="sr-only">Universal - go to homepage</span>
                    </a>
                    <div class="navbar-buttons">
                        <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                            <span class="sr-only">Toggle navigation</span>
                            <i class="fa fa-align-justify"></i>
                        </button>
                    </div>
                </div>
                <!--/.navbar-header -->

                <div class="navbar-collapse collapse" id="navigation">

                    <ul class="nav navbar-nav navbar-right">
                        <li class="active">
                            <a href="<?= BASE_URL ?>">Trang chủ </a>

                        </li>

                        <li class="use-yamm yamm-fw">
                            <a href="<?= BASE_URL ?>dien-thoai/">Sản phẩm</a>
                        </li>

                        <li class="use-yamm yamm-fw">
                            <a href="<?= BASE_URL ?>lien-he/">Liên hệ</a>
                        </li>

                        <!-- ========== FULL WIDTH MEGAMENU ================== -->
                        <li class="use-yamm yamm-fw">
                            <a href="<?= BASE_URL ?>tin-tuc/">Tin tức</a>
                        </li>

                        <!-- ========== FULL WIDTH MEGAMENU END ================== -->

                        <li>
                            <a href="<?= BASE_URL ?>gioi-thieu/">Giới thiệu</a>

                        </li>

                        <a href="<?= BASE_URL ?>gio-hang/" class="btn btn-info btn-lg" id="cart">
                            <span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng
                            <?php
                            if (isset($_SESSION['daySoLuong']) == false) {
                                echo "<span id='count-cart'>0</span>";
                            } else { ?>
                                <span id="count-cart"> <?= count($_SESSION['daySoLuong']) ?> </span>

                            <?php } ?>

                        </a>

                        <?php if (isset($_SESSION['alerAddCart']) && $_SESSION['alerAddCart']) {
                            ?>
                            <div class="alert alert-success alert-dismissible" role="alert" style="z-index: 2;position: absolute; width: auto;right: 0px; display:block;">

                                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                                Thêm giỏ hàng thành công.
                            </div>
                        <?php
                            unset($_SESSION['alerAddCart']);
                        } ?>

                    </ul>
                </div>
                <!--/.nav-collapse -->

                <div class="collapse clearfix" id="search">
                    <form class="navbar-form" role="search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search">
                            <span class="input-group-btn">

                                <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>

                            </span>
                        </div>
                    </form>

                </div>
                <!--/.nav-collapse -->

            </div>

        </div>
        <!-- /#navbar -->

    </div>

    <!-- *** NAVBAR END *** -->

</header>
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $('.alert-dismissible').hide();
        }, 5000);
    });
</script>