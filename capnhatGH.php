<?php
session_start();
require_once "class/dt.php";
$dt = new dt;
$action = isset($_GET['action']) ? $_GET['action'] : ''; // để bik phải làm gì: thêm/xóa/cập nhật
$idDT = isset($_GET['idDT']) ? $_GET['idDT'] : ''; // để bik sp nào mà thêm hay bớt
$dt->CapNhatGioHang($action, $idDT);

// if ($action == "add") header("location:gio-hang/");
// if ($action == "remove") header("location:gio-hang/");
// if ($action == "update") header("location:gio-hang/");

// header("location:javascript://history.go(-1)");

if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
header("location:$previous");
exit();
// if (isset($_SESSION['daySoLuong']) == false) {
//     echo "0";
// } else {
//     echo count($_SESSION['daySoLuong']);
// }
// if ($action == "remove" || $action == "update") {
//     if (isset($_SERVER['HTTP_REFERER'])) {
//         $previous = $_SERVER['HTTP_REFERER'];
//     }
//     header("location:$previous");
//     exit();
// }
