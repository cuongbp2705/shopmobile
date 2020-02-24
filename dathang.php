<?php
if (isset($_SESSION['DonHang']) == false) {
    header("location:/banhang/");
    exit();
}
$error = array();
$dt->LuuDonHang($error); //lưu thông tin đơn hàng 
if (count($error) == 0) {
    $luu_CT_DH = $dt->LuuChiTietDonHang(); //lưu các sản phẩm user đã mua

}
$iddh = $_SESSION['DonHang']['idDH'];
//if($luu_CT_DH == true)
if (count($error) == 0) {
    echo "<script>location.href = 'hoadon/file_hoadon.php?id=$iddh'</script>";
    unset($_SESSION['dayTenDT']); //hủy th.tin đã lưu  trong session
    unset($_SESSION['dayDonGia']);
    unset($_SESSION['daySoLuong']);
    unset($_SESSION['DonHang']);
}
// else {
//     header("location:/thanh-toan-4");
// }
?>

<div class="container">
    <div class="row">
        <div class="col-md-12 clearfix">
            <?php if (count($error) > 0) { ?>
                <div class="heading">
                    <h2>Có lỗi xảy ra</h2>
                </div>
                <p class="lead">
                    Có lỗi xảy ra trong quá trình lưu đơn hàng của bạn.<br /><br />
                    <span class="alert alert-danger"> <?php foreach ($error as $e) echo $e, "<br>"; ?></span>
                    <br /><br /> <a href="gio-hang/">Về trang giỏ hàng</a>
                </p>
            <?php } ?>
            
        </div>
    </div>
</div>