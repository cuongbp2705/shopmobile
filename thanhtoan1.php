<div class="container">

    <div class="row">

        <div class="col-md-9 clearfix" id="checkout">

            <div class="box">
                <form method="post" action="thanh-toan-2/">

                    <ul class="nav nav-pills nav-justified">
                        <li class="active"><a href="#"><i class="fa fa-map-marker"></i><br>Địa chỉ</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-truck"></i><br>Phương thức giao hàng</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Phương thức thanh toán</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Thông tin đơn hàng</a>
                        </li>
                    </ul>

                    <div class="content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="hoten">Họ tên</label>
                                    <input type="text" class="form-control" id="hoten" name="hoten" required oninvalid="this.setCustomValidity('Mời bạn nhập họ tên');" oninput="this.setCustomValidity('');">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="diachi">Địa chỉ</label>
                                    <input type="text" class="form-control" id="diachi" name="diachi" required oninvalid="this.setCustomValidity('Bạn cho biết địa chỉ nhé');" oninput="this.setCustomValidity('');">
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="dienthoai">Điện thoại</label>
                                    <input type="text" class="form-control" id="dienthoai" name="dienthoai" required oninvalid="this.setCustomValidity('Bạn ơi số điện thoại của bạn chưa có.');" oninput="this.setCustomValidity('');">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required oninvalid="this.setCustomValidity('Bạn thân mến! Còn email nữa');" oninput="this.setCustomValidity('');">
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                    </div>

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="<?= BASE_URL ?>gio-hang/ " class="btn btn-default"><i class="fa fa-chevron-left"></i>Xem lại giỏ hàng </a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-template-main">Qua bước kế<i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->


        </div>
        <!-- /.col-md-9 -->
        <?php
        reset($_SESSION['daySoLuong']);
        reset($_SESSION['dayDonGia']);
        reset($_SESSION['dayTenDT']);
        reset($_SESSION['dayHinh']);
        $tongtien = $tongsoluong = 0;
        for ($i = 0; $i < count($_SESSION['daySoLuong']); $i++) {
            $idDT = key($_SESSION['daySoLuong']);
            $tendt = current($_SESSION['dayTenDT']);
            $soluong = current($_SESSION['daySoLuong']);
            $dongia = current($_SESSION['dayDonGia']);
            $hinh = current($_SESSION['dayHinh']);
            $tien = $dongia * $soluong;
            $tongtien += $tien;
            $tongsoluong += $soluong;
            next($_SESSION['daySoLuong']);
            next($_SESSION['dayDonGia']);
            next($_SESSION['dayTenDT']);
            next($_SESSION['dayHinh']);
        } //for 
        ?>
        <div class="col-md-3">

            <div class="box" id="order-summary">
                <div class="box-header">
                    <h3 style="text-align: center">Đơn hàng</h3>
                </div>
                <p class="text-muted">Thông tin đơn hàng hiện tại của bạn.</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Tiền mua hàng</td>
                                <th><?= number_format($tongtien, 0, ",", "."); ?> VND</th>
                            </tr>
                            <tr>
                                <td>Thuế</td>
                                <th><?php
                                    $thue = round($tongtien * 0.01);
                                    echo number_format($thue, 0, ",", "."); ?> VND</th>
                            </tr>
                            <tr class="total">
                                <td>Tổng tiền </td>
                                <th><?= number_format($tongtien + $thue, 0, ",", "."); ?> VND</th>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
        <!-- /.col-md-3 -->

    </div>
    <!-- /.row -->

</div>