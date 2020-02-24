<?php //tiếp nhận từ bước 1
if (isset($_POST['hoten']))
    $_SESSION['DonHang']['hoten'] = $_POST['hoten'];

if (isset($_POST['diachi']))
    $_SESSION['DonHang']['diachi'] = $_POST['diachi'];

if (isset($_POST['dienthoai']))
    $_SESSION['DonHang']['dienthoai'] = $_POST['dienthoai'];

if (isset($_POST['email']))
    $_SESSION['DonHang']['email'] = $_POST['email'];
// print_r($_SESSION);
?>
<script>
    function validateForm() {
        var x = document.forms["myForm"]["delivery"].value;
        if (x == "") {
            alert("Bạn vui lòng chọn phương thức giao hàng");
            return false;
        }
    }
</script>
<div class="container">

    <div class="row">

        <div class="col-md-9 clearfix" id="checkout">

            <div class="box">
                <form method="post" action="thanh-toan-3/" name="myForm" onsubmit="return validateForm()">
                    <ul class="nav nav-pills nav-justified">
                        <li class="disabled"><a href="#"><i class="fa fa-map-marker"></i><br>Địa chỉ</a>
                        </li>
                        <li class="active"><a href="#"><i class="fa fa-truck"></i><br>Phương thức giao hàng</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Phương thức thanh toán</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-eye"></i><br>Thông tin đơn hàng</a>
                        </li>
                    </ul>

                    <div class="content">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="box shipping-method">

                                    <h4>GIAO TẬN NHÀ</h4>

                                    <p>Nội thành TPHCM - miễn phí. Nơi khác – 10.000 VND.</p>

                                    <div class="box-footer text-center">

                                        <input type="radio" name="delivery" value="giaotannha" checked> Giao tận nhà
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="box shipping-method">

                                    <h4>CHUYỂN PHÁT NHANH EMS</h4>

                                    <p>Phí 15000 VNĐ. TPHCM -2 ngày. Nơi khác tối đa 3 ngày.</p>

                                    <div class="box-footer text-center">

                                        <input type="radio" name="delivery" value="chuyenphatnhanh"> Giao chuyển phát
                                        nhanh.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="box shipping-method">

                                    <h4>CHUYỂN PHÁT THƯỜNG QUA BƯU ĐIỆN</h4>

                                    <p>Phí 5000 VNĐ. Tối đa 7 ngày.</p>

                                    <div class="box-footer text-center">

                                        <input type="radio" name="delivery" value="buudien"> Giao qua bưu điện.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="box shipping-method">

                                    <h4>HỎA TỐC</h4>

                                    <p>Phí 25000 VNĐ. Tối đa 1 ngày.</p>

                                    <div class="box-footer text-center">

                                        <input type="radio" name="delivery" value="hoatoc"> Giao hỏa tốc.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.content -->

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="thanh-toan-1/" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở lại
                                bước 1</a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-template-main">Qua bước tiếp theo<i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->
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


        </div>
        <!-- /.col-md-9 -->

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