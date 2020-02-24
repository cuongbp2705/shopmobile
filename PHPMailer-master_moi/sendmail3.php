<?php
//gói thư viện

include $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master_moi/class.phpmailer.php";
include $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master_moi/class.smtp.php";
include $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master_moi/functions.php";
// cấu hình hộp thư gửi mail

$ht = htmlentities(trim(strip_tags($_POST['name'])), ENT_QUOTES, 'utf-8');
$m = htmlentities(trim(strip_tags($_POST['email'])), ENT_QUOTES, 'utf-8');
$td = htmlentities(trim(strip_tags($_POST['subject'])), ENT_QUOTES, 'utf-8');
$nd = htmlentities(trim(strip_tags($_POST['message'])), ENT_QUOTES, 'utf-8');
$nd = nl2br($nd);

$content = $nd; //Nội dung email
$title = $td; //Tiêu để gửi mail

$nTo = $ht; // Tên ng nhận
$mTo = $m; // địa chỉ mail người nhận
$diachi = $m;

//test gửi mail
$mail = sendMailAttachment($title, $content, $nTo, $mTo, $diachicc = '', 'PHPMailer.doc', 'File hướng dẫn');

if ($mail == 1) {
    echo 'mail của bạn đã đc gửi đi hãy kt hộp thư đến để xem kq';
} else {
    echo  'Loi:';
}
