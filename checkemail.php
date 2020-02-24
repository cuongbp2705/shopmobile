<?php 
require_once "class/dt.php";
$dt = new dt;
$mail=$_GET['mail'];

if ($mail == null) echo "<span class='label label-warning'>You have not entered email address</span>";
 elseif (filter_var($mail, FILTER_VALIDATE_EMAIL) == false) echo "<span class='label label-warning'>You entered the wrong email</span>";
 elseif ($dt->CheckEmail($mail) == false) echo "<span class='label label-danger'>This email already has users</span>";
else echo "<span class='label label-success'>Congratulations, You can register to this email </span>"; 
