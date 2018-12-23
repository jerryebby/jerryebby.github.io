<?php
include "connect.php";
$sql="SELECT  gender, primary_category, minor_category, brand, product_name, original_price, sale_price,actual_price ,link, photo
FROM PRODUCT WHERE 1 ";
if (isset($_GET["keywords"])&&$_GET["keywords"]!='')
{
  $keywords=$_GET["keywords"];
  $sql=$sql." and (
   product_name Like '%{$keywords}%'
  or brand Like '%{$keywords}%') "." ";
}
if(isset($_GET["gender"]))
    {
    $gender=$_GET["gender"];
    $gender=array_unique($gender);
    for ($i=0; $i <count($gender); $i++) {
      if($i==0 && count($gender)==1)
      {
        $sql=$sql." and (
         gender='{$gender[$i]}')"." ";
      }
      else if ($i==0) {
        $sql=$sql." and (
         gender='{$gender[$i]}'";
             }
             else if($i==(count($gender)-1)) {
               $sql=$sql." or
                gender='{$gender[$i]}' )"." ";
              }
              else
              {
                $sql=$sql." or
                 gender='{$gender[$i]}' "." ";
              }
             }



      }


if(isset($_GET["minor_category"])&&$_GET["minor_category"]!='')
{
  // $minor_category=$_GET["minor_category"];
  // $sql=$sql." and(
  //  minor_category='{$minor_category}') "." ";
  $minor_category=$_GET["minor_category"];
  $minor_category=array_unique($minor_category);
  for ($i=0; $i <count($minor_category); $i++) {
    if($i==0 && count($minor_category)==1)
    {
      $sql=$sql." and (
       minor_category='{$minor_category[$i]}')"." ";
    }
    else if ($i==0 ) {
      $sql=$sql." and (
       minor_category='{$minor_category[$i]}'";
           }
           else if($i==(count($minor_category)-1)) {
             $sql=$sql." or
              minor_category='{$minor_category[$i]}' )"." ";
            }
            else
            {
              $sql=$sql." or
               minor_category='{$minor_category[$i]}' "." ";
            }
           }


}
if(isset($_GET["min_price"])&&isset($_GET["max_price"])&&($_GET["min_price"]<$_GET["max_price"]))
{
  $min_price=$_GET["min_price"];
  $max_price=$_GET["max_price"];
  $sql=$sql."and (actual_price BETWEEN '{$min_price}' and '{$max_price}')"." ";
}
if (isset($_GET["brand"])) {
  $brand=$_GET["brand"];
  $brand=array_unique($brand);
  for ($i=0; $i <count($brand); $i++) {
    if($i==0 && count($brand)==1)
    {
      $sql=$sql." and (
       brand='{$brand[$i]}')"." ";
    }
    else if ($i==0 ) {
      $sql=$sql." and (
       brand='{$brand[$i]}'";
           }
           else if($i==(count($brand)-1)) {
             $sql=$sql." or
              brand='{$brand[$i]}' )"." ";
            }
            else
            {
              $sql=$sql." or
               brand='{$brand[$i]}' "." ";
            }
           }
         }
if (isset($_GET["order"])) {
  $order=$_GET["order"];
  if ($order!='1') {
    $sql=$sql."order by actual_price ".$order;
  }
}


    $select = $connect -> prepare($sql);
    $select -> execute();
    $count = $select->rowCount();
    if ($count==0) {
    }
    else {
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
      $select1 = $connect -> prepare( $sql." LIMIT ".$start.','.$per);
      $select1 -> execute();
      while ($row=$select1->fetch(PDO::FETCH_ASSOC)) {
          $data[$page][]=$row;
      }
      $select->closeCursor();
      $select1->closeCursor();
}

 ?>
