<?php //tiếp nhận từ bước 2
if (isset($_POST['delivery']))
    $_SESSION['DonHang']['delivery'] = $_POST['delivery'];
// print_r($_SESSION);

?>

<div class="container">

    <div class="row">

        <div class="col-md-9 clearfix" id="checkout">

            <div class="box">
                <form method="post" action="thanh-toan-4/">
                    <ul class="nav nav-pills nav-justified">
                        <li class="disabled"><a href="#"><i class="fa fa-map-marker"></i><br>Địa chỉ</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-truck"></i><br>Phương thức giao hàng</a>
                        </li>
                        <li class="active"><a href="#"><i class="fa fa-money"></i><br>Phương thức thanh toán</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Thông tin đơn hàng</a>
                        </li>
                    </ul>

                    <div class="content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="box payment-method">

                                    <h4>Chuyển khoản</h4>

                                    <p>Quý khách thanh toán bằng chuyển khoản.</p>

                                    <div class="box-footer text-center">

                                        <input type="radio" name="payment" value="chuyenkhoan" required> Chuyển vào tài khoản 012 345 678 (Vietcombank)
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box payment-method">

                                    <h4>THANH TOÁN KHI GIAO HÀNG</h4>

                                    <p>Quý khách trả tiền khi nhận hàng tại nhà.</p>

                                    <div class="box-footer text-center">

                                        <input type="radio" name="payment" value="khigiaohang" checked> An toàn nhất.
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.content -->

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="thanh-toan-2/" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở lại bước 2 </a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-template-main">Qua bước cuối cùng<i class="fa fa-chevron-right"></i>
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
<!-- /.container -->