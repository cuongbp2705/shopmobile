<?php //tiếp nhận từ bước 3
if (!$_POST) die('');
$sosp = count($_SESSION['daySoLuong']);

if (isset($_POST['payment']))
    $_SESSION['DonHang']['payment'] = $_POST['payment'];
// print_r($_SESSION);

?>

<div class="container">

    <div class="row">

        <div class="col-md-9 clearfix" id="checkout">

            <div class="box">
                <form method="post" action="dat-hang/">
                    <ul class="nav nav-pills nav-justified">
                        <li class="disabled"><a href="#"><i class="fa fa-map-marker"></i><br>Địa chỉ</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-truck"></i><br>Phương thức giao hàng</a>
                        </li>
                        <li class="disabled"><a href="#"><i class="fa fa-money"></i><br>Phương thức thanh toán</a>
                        </li>
                        <li class="active"><a href="#"><i class="fa fa-eye"></i><br>Thông tin đơn hàng</a>
                        </li>
                    </ul>

                    <div class="content">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Tên SP</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Giảm</th>
                                        <th>Tiền</th>

                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    reset($_SESSION['daySoLuong']);
                                    reset($_SESSION['dayDonGia']);
                                    reset($_SESSION['dayTenDT']);
                                    reset($_SESSION['dayHinh']);
                                    $tongtien = $tongsoluong = 0;

                                    for ($i = 0; $i < $sosp; $i++) {

                                        $idDT = key($_SESSION['daySoLuong']);
                                        $tendt = current($_SESSION['dayTenDT']);
                                        $soluong = current($_SESSION['daySoLuong']);
                                        $dongia = current($_SESSION['dayDonGia']);
                                        $hinh = current($_SESSION['dayHinh']);
                                        $tien = $dongia * $soluong;
                                        $tongtien += $tien;
                                        $tongsoluong += $soluong

                                        ?>

                                        <tr>
                                            <td>
                                                <a href="#">
                                                    <img src="<?= BASE_URL . "upload/hinhchinh/" . $hinh ?>" alt="<?= $tendt ?>" onerror="this.src='<?= BASE_URL ?>defaultImg.jpg'">
                                                </a>
                                            </td>
                                            <td><a href="#"><?= $tendt ?></a></td>
                                            <td><?= $soluong ?></td>
                                            <td><?= number_format($dongia, 0, ",", "."); ?> VND</td>
                                            <td>$0.00</td>
                                            <td><?= number_format($tien, 0, ",", "."); ?> VND</td>
                                        </tr>

                                        <?php
                                            next($_SESSION['daySoLuong']);
                                            next($_SESSION['dayDonGia']);
                                            next($_SESSION['dayTenDT']);
                                            next($_SESSION['dayHinh']);
                                            ?>
                                    <?php } //for 
                                    ?>

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="5">Tổng tiền</th>
                                        <th><?= number_format($tongtien, 0, ",", "."); ?> VND</th>
                                    </tr>
                                </tfoot>
                            </table>

                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.content -->

                    <div class="box-footer">
                        <div class="pull-left">
                            <a href="thanh-toan-3/" class="btn btn-default"><i class="fa fa-chevron-left"></i>Trở lại bước 3</a>
                        </div>
                        <div class="pull-right">
                            <button type="submit" class="btn btn-template-main">Đặt hàng<i class="fa fa-chevron-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box -->


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