<?php
require_once "index_connect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css
" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">


    <script type="text/javascript">
      document.getElementById("")
    </script>
    <title>衣比呀,衣服比價網</title>
</head>

<body>
    <div class="container" style="display:flow-root;">
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

                  <div class="card-columns" style="overflow: auto;">
                      <div class="dropdown">
                          <span class="dropdown-item-text" style="text-align: center;">上衣類</span>
                          <div class="dropdown-divider"></div>
                          <div class="card items" style="border:0; ">
                              <ul class="list-group list-group-flush" align="center">
                                  <a class="dropdown-item" href="./search.php?minor_category=SHORT_SLEEVES&gender[]=WOMEN">短袖</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=LONG_SLEEVES&gender[]=WOMEN">長袖</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=SHIRT&gender[]=WOMEN">襯衫</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=OUTERWEAR&gender[]=WOMEN">外套</a>
                              </ul>
                          </div>
                      </div>
                      <div class="dropdown">
                          <span class="dropdown-item-text" style="text-align: center;">下身類</span>
                          <div class="dropdown-divider"></div>
                          <div class="card items" style="border:0; ">
                              <ul class="list-group list-group-flush" align="center">
                                  <a class="dropdown-item" href="./search.php?minor_category=SHORTS&gender[]=WOMEN">短褲</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=TROUSERS&gender[]=WOMEN">長褲</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=JEANS&gender[]=WOMEN">牛仔褲</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=SKIRT&gender[]=WOMEN">裙裝</a>
                                </br>
                              </ul>
                          </div>
                      </div>
                      <div class="dropdown">
                          <span class="dropdown-item-text" style="text-align: center;">其他</span>
                          <div class="dropdown-divider"></div>
                          <div class="card items" style="border:0; ">
                              <ul class="list-group list-group-flush" align="center">
                                  <a class="dropdown-item" href="./search.php?minor_category=SPORTS&gender[]=WOMEN">運動</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=ACCESSORIES&gender[]=WOMEN">配件</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=UNDERWEAR&gender[]=WOMEN">內衣</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=UNDERPANTS&gender[]=WOMEN">內褲</a>
                                </br>
                              </ul>
                          </div>
                      </div>
                  </div>

              </div>
          </li>
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Men
    </a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <div class="card-columns" style="overflow: auto;">
                      <div class="dropdown">
                          <span class="dropdown-item-text" style="text-align: center;">上衣類</span>
                          <div class="dropdown-divider"></div>
                          <div class="card items" style="border:0; ">
                              <ul class="list-group list-group-flush" align="center">
                                  <a class="dropdown-item" href="./search.php?minor_category=SHORT_SLEEVES&gender[]=MEN">短袖</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=LONG_SLEEVES&gender[]=MEN">長袖</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=POLO&gender[]=MEN">POLO衫</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=SHIRT&gender[]=MEN">襯衫</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=OUTERWEAR&gender[]=MEN">外套</a>
                              </ul>
                          </div>
                      </div>
                      <div class="dropdown">
                          <span class="dropdown-item-text" style="text-align: center;">下身類</span>
                          <div class="dropdown-divider"></div>
                          <div class="card items" style="border:0; ">
                              <ul class="list-group list-group-flush" align="center">
                                  <a class="dropdown-item" href="./search.php?minor_category=SHORTS&gender[]=MEN">短褲</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=TROUSERS&gender[]=MEN">長褲</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=JEANS&gender[]=MEN">牛仔褲</a>
                                </br></br>
                              </ul>
                          </div>
                      </div>
                      <div class="dropdown">
                          <span class="dropdown-item-text" style="text-align: center;">其他</span>
                          <div class="dropdown-divider"></div>
                          <div class="card items" style="border:0; ">
                              <ul class="list-group list-group-flush" align="center">
                                  <a class="dropdown-item" href="./search.php?minor_category=SPORTS&gender[]=MEN">運動</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=ACCESSORIES&gender[]=MEN">配件</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=UNDERWEAR&gender[]=MEN">內衣</a>
                                  <a class="dropdown-item" href="./search.php?minor_category=UNDERPANTS&gender[]=MEN">內褲</a>
                                </br>
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


                      <div class="card-columns" style="overflow: auto;">
                          <div class="dropdown">
                              <span class="dropdown-item-text" style="text-align: center;">上衣類</span>
                              <div class="dropdown-divider"></div>
                              <div class="card items" style="border:0; ">
                                  <ul class="list-group list-group-flush" align="center">
                                      <a class="dropdown-item" href="./search.php?minor_category=SHORT_SLEEVES&gender[]=KIDS">短袖</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=LONG_SLEEVES&gender[]=KIDS">長袖</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=SHIRT&gender[]=KIDS">襯衫</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=OUTERWEAR&gender[]=KIDS">外套</a>
                                  </ul>
                              </div>
                          </div>
                          <div class="dropdown">
                              <span class="dropdown-item-text" style="text-align: center;">下身類</span>
                              <div class="dropdown-divider"></div>
                              <div class="card items" style="border:0; ">
                                  <ul class="list-group list-group-flush" align="center">
                                      <a class="dropdown-item" href="./search.php?minor_category=SHORTS&gender[]=KIDS">短褲</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=TROUSERS&gender[]=KIDS">長褲</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=JEANS&gender[]=KIDS">牛仔褲</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=SKIRT&gender[]=KIDS">裙裝</a>

                                    </br></br>
                                  </ul>
                              </div>
                          </div>
                          <div class="dropdown">
                              <span class="dropdown-item-text" style="text-align: center;">其他</span>
                              <div class="dropdown-divider"></div>
                              <div class="card items" style="border:0; ">
                                  <ul class="list-group list-group-flush" align="center">
                                      <a class="dropdown-item" href="./search.php?minor_category=SPORTS&gender[]=KIDS">運動</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=ACCESSORIES&gender[]=KIDS">配件</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=UNDERWEAR&gender[]=KIDS">內衣</a>
                                      <a class="dropdown-item" href="./search.php?minor_category=UNDERPANTS&gender[]=KIDS">內褲</a>
                                    </br>
                                  </ul>
                              </div>
                          </div>
                      </div>


                  </div>
              </li>
      </ul>
      <div class="col">
          <form class="form-inline " Action="search.php" Method="get" enctype="text/plain" style="float:right;">
              <div class="row-sm-12">
                  <div class="col" style="margin-left: 15%;">
                      <Input Type="text" class="col-sm-9" name="keywords" value="<?php if (isset($_GET['keywords'])){ echo $_GET['keywords'];} ?>"style="display: inline-block; height: 40px; overflow: auto;">
                      <Input Type="submit" value=" S " style="overflow: auto; height: 40px; width: 40px;">
                  </div>
              </div>
          </form>
      </div>


    </div>
    </nav>


  </br></br>


            <div class="row">

                <div class="col-sm-3">
                  <div style="margin-top: 35%;"><span>進階搜尋</span></div>
                  <form method="get" action="search.php" id="formsearch" style="background-color:darkgray; padding: 20px; overflow: auto; background-color: white; border-style:double;">
                    <span>搜尋：</span>
                    <Input Type="text" class="col-sm-9" name="keywords" value="<?php if (isset($_GET['keywords'])){ echo $_GET['keywords'];} ?>"style="display: inline-block; height: 40px; overflow: auto;">
                    </br></br>
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
                          <span>性別</span>
                          <div class=" form-check">
                              <input type="checkbox" class="form-check-input" id="defaultCheck1" name="gender[]" value="MEN" <?php if (isset($_GET["gender"]) && in_array("MEN",$_GET["gender"])){echo "checked";}?>>
                              <label class="form-check-label" for="exampleCheck1">男生</label>
                          </div>
                          <div class=" form-check">
                              <input type="checkbox" class="form-check-input" id="defaultCheck2" name="gender[]" value="WOMEN"<?php if (isset($_GET["gender"]) && in_array("WOMEN",$_GET["gender"])){echo "checked";}?>>
                              <label class="form-check-label" for="exampleCheck1">女生</label>
                          </div>
                          <div class=" form-check">
                              <input type="checkbox" class="form-check-input" id="defaultCheck3" name="gender[]" value="KIDS"<?php if (isset($_GET["gender"]) && in_array("KIDS",$_GET["gender"])){echo "checked";}?>>
                              <label class="form-check-label" for="exampleCheck1">小孩</label>
                          </div>


                      </div>

                      <button type="submit" class="btn"  style="float:right; border:1px solid;">確定</button>
                  </form>


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
                    <div class="row-sm-12">
                        <nav aria-label="breadcrumb ">
                            <ol class="breadcrumb col-sm-5" style="float:left; background-color:white; font-size:16px;">
                                <li class="breadcrumb-item"><a href="index.php" style="color:black; text-decoration:none;">衣比呀</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?php if (isset($_GET["keywords"])) {
                                          echo $_GET["keywords"];
                                    }

                                    ?>
                                </li>
                            </ol>

                            <ol class="breadcrumb col-sm-4" style="float:right; background-color:white;">
                                <li class=" active" aria-current="page" style="vertical-align:bottom;">
                                  <?php include("search_num.php")?>
                                </li>
                            </ol>
                        </nav>

                    </div>

                    <div style="clear:both"></div>

                    <div class="form-group " style="float:right; margin-right:5%;">
                      <form method="post" action="search.php" style="background:#FFD382">
                        <select name="order[]" class="form-control" id="exampleFormControlSelect1" style="width: 150px; margin:0px auto;

">
      <option value="1">相關度</option>
      <option value="ASC">價格由低至高</option>
      <option value="DESC">價格由高至低</option>

    </select>
  </form>
                    </div>

                    <div style="clear:both"></div>







                    <div class="jumbotron" style="background-color:white;">

                        <!--page-->
                        <?php include("page.php") ?>
<!-- page end-->
<?php
include("pagenum.php")
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
