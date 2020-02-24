<?php
//gói thư viện

include $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master_moi/class.phpmailer.php";
include $_SERVER['DOCUMENT_ROOT'] . "/banhang/PHPMailer-master_moi/class.smtp.php";
// cấu hình hộp thư gửi mail
$nFrom = "Nhatgnhe"; //mail đc gửi từ đâu, thường để tên CTY bạn
$mFrom = "vodanhvk16@gamil.com"; // địa chỉ email của bạn
$mPass = '0643824930Nhan'; //Pass email của bạn (pass của mail trên: người gửi)

$nTo = 'Nguyen Huu Nhan'; // Tên ng nhận
$mTo = 'nghnhanbrvt@gmail.com'; // địa chỉ mail người nhận

$mail = new PHPMailer();
$body = "Bạn đang tìm hiểu cách gửi email bằng php mailer"; //Nội dung email
$title = "Hướng dẫn gửi mail bằng PHPMailer"; //Tiêu để gửi mail
$mail->IsSMTP();
$mail->CharSet = "utf-8";
$mail->SMTPDebug = 0;  //  enable SMTP debug information (for testing)
$mail->SMTPAuth = true; // enable SMTP authentication
$mail->SMTPSecure = 'ssl'; // sets the prefix to servers
$mail->Host = 'smtp.gmail.com'; // server gui mail
$mail->Port = 465; // cổng gửi email để nguyên

//xong phần cấu hình, bắt đầu phần gửi mail
$mail->Username = $mFrom; //khai báo địa chỉ email gửi
$mail->Password = $mPass; //khai báo pass email gửi
$mail->SetFrom($mFrom, $nFrom);
$mail->addReplyTo('vodanhvk16@gamil.com', ' Nhatnghe'); //khi ng dùng phản hồi sẽ đc gửi đến email này
$mail->Subject = $title; // tiêu đề email
$mail->MsgHTML($body); // noi dung chinh cua mail
$mail->addAddress($mTo, $nTo);
// thực thi lệnh mail

if (!$mail->Send()) {
    echo  'Loi:' . $mail->ErrorInfo;
} else {
    echo 'mail của bạn đã đc gửi đi hãy kt hộp thư đến để xem kq';
}
