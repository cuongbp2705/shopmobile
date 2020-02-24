<?php
session_start();
unset($_SESSION['login_id']);
unset($_SESSION['login_hoten']);
unset($_SESSION['login_email']);
header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();
