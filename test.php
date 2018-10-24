<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css
" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
<?php
$link      = array(
    'host' => "127.0.0.1",
    'port' => "3306",
    'account' => "php_jerry",
    'password' => "FrzbumJquiq5RQzt",
    'dbname' => "clothespricecompare"
);
$dbconnect = 'mysql:host=' . $link['host'] . ';port=' . $link['port'] . ';dbname=' . $link['dbname'] . ';charset=utf8';
try {
    $connect = new PDO($dbconnect, $link['account'], $link['password']);
    $connect->query("SET NAMES 'utf8'");
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e) {
    echo "Connection failed: ";
    echo iconv('gbk', 'utf-8', $e->getMessage());
    exit();
}
?>
   <form class="form-inline " Action="test.php" Method="Get" enctype="text/plain" style="float:right;">
        <div class="row-sm-12">
            <div class="col" style="margin-left: 15%;">
                <Input Type="text" class="col-sm-9" name="keywords" style="display: inline-block; height: 40px; overflow: auto;">
                <Input Type="submit" value=" S " style="overflow: auto; height: 40px; width: 40px;">
            </div>
        </div>
    </form>
    <br><br><br><br>


<?php
$sql = "SELECT gender, primary_category, minor_category, brand, product_name, original_price, sale_price, link, photo FROM PRODUCT WHERE gender Like '" . $_GET["keywords"] . "%' OR minor_category Like '%" . $_GET["keywords"] . "%' OR product_name Like '%" . $_GET["keywords"] . "%' OR brand Like '%" . $_GET["keywords"] . "%'";

$select = $connect->prepare($sql);
$select->execute();
$count = $select->rowCount();
$per   = 15;
$pages = ceil($count / $per);

if (!isset($_GET["page"])) {
    $page = 1; //設定起始頁
} else {
    $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    $page = ($page > 0) ? $page : 1; //確認頁數大於零
    $page = ($pages > $page) ? $page : $pages; //確認使用者沒有輸入太神奇的數字
}

$start   = ($page - 1) * $per;
$select1 = $connect->prepare($sql . "LIMIT " . $start . ',' . $per);
$select1->execute();
$card = 0;
$test = $count;
if ($count - $start > 0 && $start == 0) {
    $card = 5;
} else {
    $card = (($count - $start) / 3);
}

for ($i = 0; $i < $card; $i++) {
    $j = 0;
?>
  <div class="card-columns" style="margin-bottom:3px;margin:0px auto; ">
<?php
    while ($result = $select1->fetch(PDO::FETCH_ASSOC)) {
        $j++;
        if ($result["minor_category"] != NULL) {
?>
    
       <div class="card" style="position: relative; ">
           <a href=
<?php
            echo $result["link"];
?>
          >
        <img class="card-img-top" src=
<?php
            echo $result["photo"];
?>
       >
</a>
           <div class="card-body" style="bottom:0px;">
               <h5 class="card-title" style="font-size:12px; ">
                   <?php
            echo $result["brand"] == NULL ? '&nbsp;' : $result["brand"];
?>
              </h5>
               <hr style="padding:0;">
               <p class="card-text" style="font-size: 12px;">
                   <?php
            echo $result["product_name"];
?>
              </p>
               <p class="card-text" align="right" style="font-style:italic;">
                   <small class="text-muted">
<?php
            if ($result["sale_price"] == -1) {
?>
<span>
<?php
                echo '$' . $result["original_price"];
?>
</span>
<?php
            } else {
?>
<span style="text-decoration:line-through;" >
<?php
                echo '$' . $result["original_price"];
?>
</span>


<span style="font-size:18px;">
<?php
                echo $result["sale_price"] == 0 ? NULL : '$' . $result["sale_price"];
?>
</span>
<?php
            }
?>
</small>
               </p>
           </div>
       </div>
       <?php
        } else {
?>
      <div class="card" style="border:0;">
       </div> <?php
        }
        if ($j == 3) {
            break;
        }
    }
?>
</div>
<?php
}
?>
   <nav aria-label="Page navigation example" style="display:table; margin:0 auto; ">
    <ul class="pagination" >
    <li class="page-item">
    <a class="page-link" href="#" aria-label="Previous">
    <span aria-hidden="true">&laquo;</span>
    <span class="sr-only">Previous</span>
    </a>
    </li>
    <?php
for ($i = 1; $i <= $pages; $i++) {
?>
     <li class="page-item">
        <?php
    echo '<a class="page-link" href="?page=' . $i . '&keywords=' . $_GET["keywords"] . '">' . $i . '</a>';
?>
     </li>
        <?php
}
?>
   <li class="page-item">
    <a class="page-link" href="#" aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
    <span class="sr-only">Next</span>
    </a>
    </li>
    </ul>
    </nav>
  </body>
</html>
