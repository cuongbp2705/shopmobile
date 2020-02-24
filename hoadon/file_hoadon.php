<?php
require_once('tcpdf_include.php');
require_once("docsotien.php");
require_once('../class/dt.php');
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$dt = new dt;

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
    require_once(dirname(__FILE__) . '/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('dejavusans', '', 10);

$pdf->AddPage();
$hoadon = isset($_GET['id']) ? $_GET['id'] : 0;
$date = date("Y-m-d");
// IN RA CSS FILE
$str = "
		<style type='text/css'>
				table.altrowstable { font-size:12px; color:#333333; border-width: 1px; border-color: #a9c6c9; border-collapse: collapse; background-color: #FFF; }				
				table.altrowstable td { border-width: 1px; padding: 8px; border-style: solid; border-color: #a9c6c9; }
				#tablerow { background:#CCC; text-align:center; }
                p { text-align:center; color: #900; font-size: 22px; text-shadow: 1px 1px 1px rgba(255,255,255,0.8); margin-top:5px; margin-bottom:5px; }
        </style>
		";
$pdf->writeHTML($str, true, false, true, false, '');

//IN RA TIEU DE FILE
$str = "<a style='font-weight: bold; font-size: 18px;'> CTY TNHH NGUYEN HUU NHAN </a> <br>
<a style='font-size: 12px;'> 123 ABC Street - District 3 - TP.HCM </a><br>
<a style='font-size: 12px;'> Tel: 123456879 - Fax: (08)45645633 </a>
<p> Hóa Đơn Mua Hàng</p>";
$pdf->writeHTML($str, true, false, true, false, '');
//in ra table va thong tin cua hoa don
$ngay = date('d');
$thang = date('m');
$nam = date('y');
$kq = $dt->LayDonHang($hoadon);
$row = $kq->fetch_assoc();
$mailto = $row['email'];
//$date = date('d-m-Y');
//$date2 = date('d-m-Y');
$PTTT = ($row['idPTT'] == 'chuyenkhoan') ? 'Chuyển Khoản' : 'Thanh Toán Khi Nhận Hàng';
$PTGH = '';
switch ($row['idPTGH']) {
    case 'giaotannha':
        $PTGH = 'Giao Tận Nhà';
        break;
    case 'chuyenphatnhanh':
        $PTGH = 'Chuyển Phát Nhanh';
        break;
    case 'buudien':
        $PTGH = 'Bưu Điện';
        break;
    default:
        $PTGH = 'Hỏa Tốc';
        break;
}
$str = "<div align='center'>
<a>Ngày: $ngay Tháng: $thang Năm: 20$nam </a><br>
<a> ...</a></div><br>
<table width='180'>
<tr>
    <td>Ngày Đặt:</td>
    <td> $row[ThoiDiemDatHang] </td>
</tr>
<tr>
    <td>Tên Người Nhận:</td>
    <td>$row[TenNguoiNhan]</td>
</tr>
<tr>
    <td>Điện Thoại:</td>
    <td>$row[DTNguoiNhan]</td>
</tr>
<tr>
    <td>Địa chỉ giao hàng:</td>
    <td>$row[DiaChi]</td>
</tr>
<tr>
    <td>Phương thức thanh toán:</td>
    <td>$PTTT</td>
</tr>
<tr>
    <td>Phương thức giao hàng:</td>
    <td>$PTGH</td>
</tr>
</table>
<div align='center'><a>...</a></div><br>";
$pdf->writeHTML($str, true, false, true, false, '');
$str = "<table class='altrowstable' align='center'>
<tr id='tablerow' style='color:#900'>
    <td width='40'><strong>STT</strong></td>
    <td width='140'><strong>Mã SP</strong></td>
    <td width='200'><strong>Tên SP</strong></td>
    <td width='125'><strong>Số lượng</strong></td>
    <td width='125'><strong>Đơn giá</strong></td>
</tr>";
$kq2 = $dt->LayDonHangCT($row['idDH']);
$i = 0;
$tien = 0;
while ($row2 = $kq2->fetch_assoc()) {
    $i++;
    $tien += $row2['SoLuong'] * $row2['Gia'];
    $gia = number_format($row2['Gia'], 0, ",", ".");
    $str .= "<tr>
    <td align='center'>$i</td>
    <td align='center'>$row2[idDH]</td>
    <td align='center'>$row2[TenDT]</td>
    <td align='center'>$row2[SoLuong]</td>
    <td align='center'> $gia</td>
</tr>";
}
$ship = 0;
switch ($row['idPTGH']) {
    case 'giaotannha':
        $ship = 10000;
        break;
    case 'chuyenphatnhanh':
        $ship = 15000;
        break;
    case 'buudien':
        $ship = 5000;
        break;

    default:
        $ship = 25000;
        break;
}
$thue = round($tien * 0.01);
$thanhtien = $tien + $thue + $ship;
//$tienbangchu =$thanhtien;
$tienbangchu = docso($thanhtien);

$tien = number_format($tien, 0, ",", ".");
$ship = number_format($ship, 0, ",", ".");
$thue = number_format($thue, 0, ",", ".");
$thanhtien = number_format($thanhtien, 0, ",", ".");

$str .= "
<tr style='border:0px'>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td style='border-left: 0px; border-right: 0px;'>Tổng Tiền Hàng:</td>
<td style='border-left: 0px;'> $tien VND </td>
</tr>

<tr style='border:0px'>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td style='border-left: 0px; border-right: 0px;'>Thuế GTGT:</td>
<td style='border-left: 0px;'> $thue VND </td>
</tr>

<tr style='border:0px'>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td style='border-left: 0px; border-right: 0px;'>Phí Vận Chuyển:</td>
<td style='border-left: 0px;'> $ship VND </td>
</tr>

<tr style='border:0px'>
<td align='center'></td>
<td align='center'></td>
<td align='center'></td>
<td style='border-left: 0px; border-right: 0px;'>Tổng Số Tiền:</td>
<td style='border-left: 0px;'> $thanhtien VND </td>
</tr>
</table>
<br><br><br>
<a style='font-weight: bold; font-size: 14px; padding-left: 50px'> Tiền bằng chữ:</a>
$tienbangchu VNĐ <br><br><br>";
$pdf->writeHTML($str, true, false, true, false, '');
$pdf->lastPage();
// ---------------------------------------------------------

//Close and output PDF document
$file = __DIR__ . '/file_hoadon_' . $hoadon . ".pdf";
$pdf->Output($file, 'F');

//============================================================+
// END OF FILE
//============================================================+
$kt = 1;

while ($kt == 1) {
    if (file_exists($file)) {
        $dt->GuiMailCoFilePDF($file, $mailto);
        $kt = 0;
    }
}

header('location:/banhang/dat-hang-tc/');
