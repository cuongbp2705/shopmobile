<?php
require_once "class/dt.php";
$dt = new dt;
$sorecord = $dt->DanhDauKichHoatUser($_GET['id'], $_GET['rd']);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <title>Activate Account</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

</head>

<body>
    <div class="panel panel-default text-center text-uppercase" style="width: 60%; margin: 50px auto">
        <div class="panel-heading">
            <b>Activate Account</b>
        </div>
        <div class="panel-body">
            <?php
            if ($sorecord > 0) { ?>
                <div class="alert alert-success">
                    Account is done activated <br> <br>
                    Please <a href="<?= BASE_URL ?>login.php"> click here</a> to sign in
                </div>
            <?php } else { ?>
                <div class="alert alert-info">
                    Your Account are activated <br>
                    No need to activate anymore <br> <br>
                    <a href="<?= BASE_URL ?>index.php"> Back to home </a>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>