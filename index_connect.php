<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$link = array (
                'host' => "127.0.0.1",
                'port' =>"3306",
                'account' =>"php_jerry",
                'password' =>"FrzbumJquiq5RQzt",
                'dbname' =>"clothespricecompare"
);
$dbconnect='mysql:host='.$link['host'].';port='.$link['port'].
    ';dbname='.$link['dbname'].';charset=utf8';
try
{
    $connect = new PDO($dbconnect,$link['account'],$link['password']);
    $connect -> query("SET NAMES 'utf8'");
    $connect -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    echo "Connection failed: " ;
    echo iconv('gbk', 'utf-8',$e->getMessage());
    exit();
}

  $sql="SELECT  gender,  primary_category ,minor_category  , brand,product_name, original_price,sale_price,link,photo
  FROM PRODUCT ";

  $select =$connect -> prepare($sql);
  $select -> execute();
  $count = $select->rowCount();
  $per=15;
  $pages = ceil($count/$per);

  if(!isset($_GET["page"])){
      $page=1; //設定起始頁
  } else {
      $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
      $page = ($page > 0) ? $page : 1; //確認頁數大於零
      $page = ($pages > $page) ? $page : $pages; //確認使用者沒有輸入太神奇的數字
  }

  $start=($page-1)*$per;
  $select1 =$connect -> prepare( $sql."LIMIT ".$start.','.$per);
  $select1 -> execute();
  $card=0;
  if ($count-$start>0 && $start==0) {
      $card=5;
  }
  else {
    $card=(($count-$start)/3);
  }
  $data=array();
  while ($row=$select1->fetch(PDO::FETCH_ASSOC)) {
    $data[$page][]=$row;
  }

  $select->closeCursor();
  $select1->closeCursor();



 





?>
