<?php

if(isset($count))
{?>
    <span>搜尋商品
共 <?php echo $count; ?>
筆結果</span>
    <?php
}
else {
echo "未搜尋到該商品";
}
?>
