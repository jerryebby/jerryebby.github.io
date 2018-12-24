<?php

if (isset($page)&&isset($data)) {
  for ($i=0; $i <count($data[$page])/3 ; $i++) {
    ?>
    <div class="card-columns" style="margin-bottom:3px;margin:0px auto; ">
    <?php
    for ($j=0; $j < 3; $j++) {
      $k=($i*3)+$j;
      if (($k<count($data[$page]))) {

        ?>

        <div class="card" style="position: relative; ">
            <a href=<?php echo $data[$page][$k]["link"]; ?>>
  <img class="card-img-top" src=<?php echo $data[$page][$k]["photo"]; ?> alt="Card image cap" >
  </a>
            <div class="card-body" style="bottom:0px;">
                <h5 class="card-title" style="font-size:12px; ">
                    <?php echo $data[$page][$k]["brand"]==NULL? '&nbsp;' :$data[$page][$k]["brand"];?>
                </h5>
                <hr style="padding:0;">
                <p class="card-text" style="font-size: 12px;">
                    <?php echo $data[$page][$k]["product_name"]; ?>
                </p>
                <p class="card-text" align="right" style="font-style:italic;">
                    <small class="text-muted">
  <?php
  if($data[$page][$k]["sale_price"]==-1)
  {?>
  <span>
  <?php echo '$'.$data[$page][$k]["original_price"]; ?>
  </span>
  <?php
  }
  else
  {
  ?>
  <span style="text-decoration:line-through;">
  <?php echo '$'.$data[$page][$k]["original_price"]; ?>
  </span>


  <span style="font-size:18px;">
  <?php echo $data[$page][$k]["sale_price"]==0?NULL :'$'.$data[$page][$k]["sale_price"]; ?>
  </span>
  <?php
  }
  ?>
  </small>
                </p>
            </div>


        </div>           <?}
      else {?>
        <div class="card" style="border:0;">
        </div>        <?php  }?>

      <?php
    }
    ?>
  </div>
    <?php
  }


}
else {
  echo "&nbsp&nbsp&nbsp未搜尋到該商品...";
}?>
