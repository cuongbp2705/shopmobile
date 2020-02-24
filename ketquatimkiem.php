<?php
$TuKhoa = isset($_GET['TuKhoa']) ? $_GET['TuKhoa'] : "";
$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : "";
settype($pageNum, "int");
if ($pageNum <= 0) $pageNum = 1;
$listSP = $dt->TimKiem($TuKhoa, $pageNum, 6, $totalRows);
?>
<div class="container">
    <div class="heading">
        <h2>
            Kết Quả Tìm Kiếm: <?= $TuKhoa ?>
        </h2>
        <h6>
            Số Sản Phẩm Tìm Được: <span class="text-success"><?= $totalRows ?></span>
        </h6>
    </div>
    <?php include "listsp.php"; ?>
    <div class="pages">
        <div class="slideInLeft animated">
            <?= $dt->pagesList1("tim-kiem/$TuKhoa", $totalRows, $pageNum, 6, 3) ?>
        </div>
    </div>
</div>