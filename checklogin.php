<?php
session_start();
require_once "class/dt.php";
$dt = new dt;
$loi = array();
if (isset($_POST['mail'])) {

	$thanhcong = $dt->login($_POST['mail'], $_POST['pass'], $loi);
	if ($thanhcong == true) {
		echo "login";
	} else {
		if (isset($loi['mail']))
			echo '1|' . $loi['mail'];
		if (isset($loi['pass']))
			echo '2|' . $loi['pass'];
	}
}
