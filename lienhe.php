<div class="container" id="contact">

    <section>
        <div class="row">
            <div class="col-md-8">

                <div class="heading">
                    <h2>Chúng tôi ở đây để phục vụ bạn</h2>
                </div>

                <p class="lead"> Bạn có điều gì chưa rõ không? Bạn có cần tư vấn về cách sử dụng điện thoại không?
                    Bạn có cần tìm hiểu một vài tính năng mới không?
                    Bạn có đang cần mua một điện thoại mới?
                    Mọi vấn đề về điện thoại mà bạn muốn biết… xin hãy đến với chúng tôi.</p>
                <p>Vui lòng điền thông tin trong mẫu dưới để liên hệ với chúng tôi (24/24).</p>

                <div class="heading">
                    <h3>Bạn Vui Lòng Để Lại Thông Tin</h3>
                </div>

                <?php
                $loi = '';

                if (isset($_POST['name']) == true) {
                    $ht = htmlentities(trim(strip_tags($_POST['name'])), ENT_QUOTES, 'utf-8');
                    $m = htmlentities(trim(strip_tags($_POST['email'])), ENT_QUOTES, 'utf-8');
                    $td = htmlentities(trim(strip_tags($_POST['subject'])), ENT_QUOTES, 'utf-8');
                    $nd = htmlentities(trim(strip_tags($_POST['message'])), ENT_QUOTES, 'utf-8');
                    $nd = nl2br($nd);
                    $loi = "";

                    $cap = $_POST['cap'];
                    if ($cap == '') $loi .= "Bạn chưa nhập Captcha<br>";
                    elseif ($cap != $_SESSION['captcha_code']) $loi .= "Bạn nhập chữ không đúng hình<br>";

                    if ($ht == "") $loi .= "Bạn chưa nhập họ tên<br>";
                    if ($m == "") $loi .= "Bạn chưa nhập email<br>";
                    if ($nd == "") $loi .= "Bạn chưa nhập nội dung liên hệ<br>";
                    else if (strlen($nd) <= 10) $loi .= "Nội dung liên hệ quá ngắn<br>";
                    if ($loi == "") {
                        $to = "nghnhanbrvt@gmail.com";
                        $from = "nghnhanbrvt@gmail.com";
                        $pass = "pxriedhtjmtrsnrr"; // mat khau cho ung dung tren may window su dung gg
                        $topText = "Họ tên: {$ht}<br>Email: {$m}<br>Tiêu đề: {$td}";
                        $nd = $topText . "<br>Nội dung:<hr>" . $nd;
                        $error = "";

                        $dt->GuiMail($to, $from, $fromName = "Ban Quan Tri", $td, $nd, $from, $pass, $error);

                        if ($error != "") $loi = $error;
                        else {
                            $_SESSION['camon'] = "Cảm ơn bạn. Ý kiến đã được ghi nhận";
                            echo "<script>document.location='/banhang/lien-he/';</script>";
                            exit();
                        }
                    }
                }
                ?>

                <div id="thongbaoLH" style="background:#ccc;color:red; padding:20px; text-align:center;line-height:150%; margin-top:10px">
                    <?php
                    if ($loi != "") echo $loi;
                    if (isset($_SESSION['camon']) == true) {
                        echo $_SESSION['camon'];
                        unset($_SESSION['camon']);
                    }
                    ?>
                </div>
                <br>
                <?php if (isset($_SESSION['camon']) == false) { ?>


                    <form class="contact_form margin_top_15" id="contact_form" method="post" action="">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="name">Họ Tên</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="subject">Tiêu Đề</label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="message">Nội Dung</label>
                                    <textarea id="message" class="form-control" name="message"></textarea>
                                </div>
                            </div>

                            &nbsp;


                            <div class="col-sm-3">
                                <div class="form-group">
                                    <img src="captcha.php" align="left" height="46">
                                    <br> <br> <br>
                                    <input type="text" name="cap" class="form-control" placeholder="Nhập chữ trong hình" value="<?php if (isset($_POST['cap'])) echo $_POST['cap'] ?>">
                                </div>
                            </div>


                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-template-main"><i class="fa fa-envelope-o"></i> Gửi Thông Tin</button>

                            </div>
                        </div>
                        <!-- /.row -->
                    </form>

                <?php } ?>

            </div>

            <div class="col-md-4">


                <h3 class="text-uppercase">Địa chỉ</h3>

                <p>30/4/1/5 Cung Vàng
                    <br>Điện Ngọc River
                    <br>Thành phố Trăng Vàng
                    <br>Việt Nam
                    <br>
                    <strong>Shốp Điện Thoại Ltd</strong>
                </p>

                <h3 class="text-uppercase">Điện Thoại</h3>

                <p class="text-muted">Số điện thoại này miễn phí nếu gọi từ Việt Nam. Nếu không, chúng tôi khuyên bạn nên sử dụng hình thức liên lạc điện tử.</p>
                <p><strong>+33 555 444 333</strong>
                </p>



                <h3 class="text-uppercase">Địa Chỉ Email</h3>

                <p class="text-muted">Email liên lạc với chúng tôi.</p>
                <ul>
                    <li><strong><a href="mailto:">info@fakeemail.com</a></strong>
                    </li>
                    <li><strong><a href="#">shopdienthoai@gmail.com</a></strong> </li>
                </ul>


            </div>

        </div>


    </section>

</div>
<!-- /#contact.container -->