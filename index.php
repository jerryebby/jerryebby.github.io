<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css
" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

    <title>衣比呀,衣服比價網</title>
</head>

<body>
    <div class="container" style="display:flow-root;">
                      <?php
  require_once "connect.php";


  if(!isset($_GET["keywords"]))
  {
    echo "Search失敗!";

  }
  else {
    $select =$connect -> prepare("SELECT  GENDER,  CATEGORY  , BRAND,PRODUCT_NAME, ORIGINAL_PRICE,SALE_PRICE,LINK,PHOTO
        FROM PRODUCT WHERE
        GENDER Like '{$_GET["keywords"]}%' or
        CATEGORY Like '%{$_GET["keywords"]}%' or PRODUCT_NAME Like '%{$_GET["keywords"]}%'
        or BRAND  Like '%{$_GET["keywords"]}%'");
    $select -> execute();
    $count = $select->rowCount();
   }?>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background-color:＃fffff;">

            <a class="navbar-brand" href="index.php">衣比呀</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon" ></span>
  </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Women
        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">上衣</a>
                            <a class="dropdown-item" href="#">褲子</a>
                            <a class="dropdown-item" href="#">外套</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Men
        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <div class="card-columns" style=" overflow: auto;">
                                <div class="dropdown">
                                    <span class="dropdown-item-text" style="text-align: center;">上衣類</span>
                                    <div class="dropdown-divider"></div>
                                    <div class="card items" style="border:0; ">
                                        <ul class="list-group list-group-flush">
                                            <a class="dropdown-item" href="http://localhost/index.php?keywords=shirt">短Ｔ</a>
                                            <a class="dropdown-item" href="#">短袖/背心</a>
                                            <a class="dropdown-item" href="#">七分/長袖</a>
                                            <a class="dropdown-item" href="#">POLO衫</a>
                                            <a class="dropdown-item" href="#">襯衫</a>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <span class="dropdown-item-text" style="text-align: center;">外套類</span>
                                    <div class="dropdown-divider"></div>
                                    <div class="card items" style="border:0; ">
                                        <ul class="list-group list-group-flush">
                                            <a class="dropdown-item" href="#">休閒外套</a>
                                            <a class="dropdown-item" href="#">機能外套</a>
                                            <a class="dropdown-item" href="#">西裝/大衣</a>
                                            <a class="dropdown-item" href="#">羽絨衣</a>
                                            <br>
                                        </ul>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <span class="dropdown-item-text" style="text-align: center;">褲＆裙裝</span>
                                    <div class="dropdown-divider"></div>
                                    <div class="card items" style="border:0; ">
                                        <ul class="list-group list-group-flush">
                                            <a class="dropdown-item" href="#">短/七分褲</a>
                                            <a class="dropdown-item" href="#">牛仔褲</a>
                                            <a class="dropdown-item" href="#">束口褲</a>
                                            <a class="dropdown-item" href="#">長褲</a>
                                            <br>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Kids
        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="#">上衣</a>
                                <a class="dropdown-item" href="#">褲子</a>
                                <a class="dropdown-item" href="#">外套</a>
                            </div>
                        </li>
                </ul>
                <div class="col">
                    <form class="form-inline " Action="index.php" Method="Get" enctype="text/plain" style="float:right;">
                        <div class="row-sm-12">
                            <div class="col" style="margin-left: 15%;">
                                <Input Type="text" class="col-sm-9" name="keywords" style="display: inline-block; height: 40px; overflow: auto;">
                                <Input Type="submit" value=" S " style="overflow: auto; height: 40px; width: 40px;">
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </nav>

        <br><br>


        <div class="row">
           
           <div class="col-sm-3">
           <!--
                <div style="margin-top: 35%;"><span>進階搜尋</span></div>
                <form style="background-color:darkgray; padding: 20px; overflow: auto; background-color: white; border-style:double;
">
                    <div id="priceinterval">
                        <span>價格區間</span>
                        <div class="row" style="text-align: center;">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="最低">
                            </div>

                            <span>~</span>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="最高">
                            </div>
                        </div>
                    </div>

                    <div id="size" style="margin-top: 20px;">
                        <span>尺寸</span>
                        <div class="form-group form-check">
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">XS</label>
                                </div>
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">S</label>
                                </div>
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">M</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">L</label>
                                </div>
                                <div class="col">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">XL</label>
                                </div>
                                <div class="col">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="size" style="margin-top: 20px;">
                        <span>付款方式</span>
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="defaultCheck1">
                            <label class="form-check-label" for="exampleCheck1">信用卡付款</label>
                        </div>
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="defaultCheck1">
                            <label class="form-check-label" for="exampleCheck1">超商付款</label>
                        </div>
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="defaultCheck1">
                            <label class="form-check-label" for="exampleCheck1">ATM付款</label>
                        </div>


                    </div>
                    <div id="size" style="margin-top: 20px; margin-bottom: 20px;">
                        <span>運送方式</span>
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="defaultCheck1">
                            <label class="form-check-label" for="exampleCheck1">宅配</label>
                        </div>
                        <div class=" form-check">
                            <input type="checkbox" class="form-check-input" id="defaultCheck1">
                            <label class="form-check-label" for="exampleCheck1">超商取件</label>
                        </div>
                    </div>

                    <button type="submit" class="btn" style="float:right; border:1px solid;">確定</button>
                </form>

-->
            </div>
            
            <div class="col-sm-9">
<!--
                <form Action="index.php" Method="Get" enctype="text/plain">
                    <div class="row-sm-12">
                        <div class="col" style="margin-left: 15%;">
                            <Input Type="text" class="col-sm-9" name="keywords" style="display: inline-block; height: 40px; overflow: auto;">
                            <Input Type="submit" value=" S " style="overflow: auto; height: 40px; width: 40px;">
                        </div>
                    </div>
                </form>
-->  
<div class="row-sm-12" >
    <nav  aria-label="breadcrumb " >
  <ol class="breadcrumb col-sm-6" style="float:left; background-color:white; font-size:16px;" >
    <li class="breadcrumb-item"><a href="index.php" style="color:black; text-decoration:none;">衣比呀</a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php $_GET["keywords"]==NULL?:$_GET["keywords"] ?></li>
  </ol>
  
  <ol class="breadcrumb col-sm-3" style="float:right; background-color:white;">
                                <li class=" active" aria-current="page" style="vertical-align:bottom;">
<?php
if($count!=0 && $_GET["keywords"]!=NULL)
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
                                </li>
                            </ol>
</nav>
            
</div>
      
       <div style="clear:both"></div>

    <div class="form-group " style="float:right; margin-right:5%;">

    <select class="form-control" id="exampleFormControlSelect1" style="width: 150px; margin:0px auto;

">
      <option>相關度</option>
      <option>價格由低至高</option>
      <option>價格由高至低</option>

    </select>
  </div>
                
    <div style="clear:both"></div>

                     
                        
                
                
                

<div class="jumbotron" style="background-color:white;">

<!--page-->
  <?php
  while($count>0){?>
    <div class="card-deck">
<?php
$i=3;
$j=0;
if((($count-3)<=0)&&($count%3>0))
{
  $i=$count%3;
  $j=3-$count%3;
}
  while($i>0)
  {
    $i--;
    $result = $select->fetch();
    ?>
                <div class="card" >
                            <a  href=<?php echo $result["LINK"]; ?>>
              <img class="card-img-top" src=<?php echo $result["PHOTO"]; ?> alt="Card image cap" style="    max-width: 100%;
    height: auto;">
            </a>
                           <div class="card-body"  >
                <h5 class="card-title" style="font-size:14px; position:relative;">
                    <?php echo $result["BRAND"]==NULL? :$result["BRAND"];?>
                </h5>
                <hr style="padding:0;">
                <p class="card-text" style="font-size: 16px;">
                  <?php echo $result["PRODUCT_NAME"]; ?>
                </p>
                <p class="card-text" align="right" style="font-style:italic;">
                 <small class="text-muted" >
<?php
if($result["SALE_PRICE"]==0)
{?>
    <span >
    <?php echo '$'.$result["ORIGINAL_PRICE"]; ?>
  </span> 
  <?php
}
 else
    {
        ?>
<span style="text-decoration:line-through;" >
<?php echo '$'.$result["ORIGINAL_PRICE"]; ?>
</span>


<span style="font-size:18px;">
<?php echo $result["SALE_PRICE"]==0?NULL :'$'.$result["SALE_PRICE"]; ?>
</span>
<?php
    }
?>
                  

                  
                </small>
              </p>
              </div>
                </div>
  <?php
  while($i==0 && $j>0)
  {
    $j--;
    ?>
    <div class="card" style="border:0;">
</div>
    <?php
  }
}?>
  </div>
  <?php
  $count=$count-3;
}
  ?>
</div>




        </div>
    </div>

            </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js
" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js
" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js
" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>
