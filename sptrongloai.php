<?php
$TenLoai = isset($_GET['TenLoai']) ? $_GET['TenLoai'] : "";
$pageNum = isset($_GET['pageNum']) ? $_GET['pageNum'] : "";
settype($pageNum, "int");
if ($pageNum <= 0) $pageNum = 1;
$listSP = $dt->SanPhamTrongLoai($TenLoai, $pageNum, 6, $totalRows);
?>
<div class="container">
    <div class="heading">
        <h2>
            Sản Phẩm Trong Loại <?= strtoupper($TenLoai); ?>
        </h2>
    </div>
    <?php include "listsp.php"; ?>
    <div class="pages">
        <div class="slideInLeft animated">
            <?= $dt->pagesList1("dien-thoai/$TenLoai", $totalRows, $pageNum, 6, 3) ?>
        </div>
    </div>
</div>