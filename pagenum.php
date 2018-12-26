
<nav aria-label="Page navigation example" style="display:table; margin:0 auto; ">
  <ul class="pagination" >
    <?php
    $keywords='';
    $minor_category='';
    $gender='';
    $min_price='';
    $max_price='';
    $price='';
    $order='';
    $minor_category='';
    $brand='';

    if (isset($_GET["brand"])) {
      $brand1=$_GET["brand"];
      for ($i=0; $i <count($brand1); $i++) {
        $brand=$brand."&brand[]={$brand1[$i]}";
               }    }

    if (isset($_GET["keywords"])) {
    $keywords="&keywords=".$_GET["keywords"];
    if ($keywords=="&keywords=") {
      $keywords='';
    }
    }
    if (isset($_GET["minor_category"])) {
      $minor_category1=$_GET["minor_category"];
      $minor_category1=array_unique($minor_category1);
      for ($i=0; $i <count($minor_category1); $i++) {
        $minor_category=$minor_category."&minor_category[]={$minor_category1[$i]}";
               }

    }
    if(isset($_GET["gender"]))
        {
        $gender1=$_GET["gender"];
        for ($i=0; $i <count($gender1); $i++) {
          $gender=$gender."&gender[]={$gender1[$i]}";
                 }
          }

          if(isset($_GET["min_price"])||isset($_GET["max_price"]))
          {
            $min_price=$_GET["min_price"];
            $max_price=$_GET["max_price"];
            $price="&min_price=".$min_price."&max_price=".$max_price;


          }
          if (isset($_GET["order"])) {
            if ($_GET["order"]!='1') {
              $order="&order=".$_GET["order"];
            }
          }


    if ( isset($pages)) {
      $Next=1;
      if ($Next+1>=$pages) {
        $Next=$pages;
      }
      else {
        $Next=$page+1;
      }
        $Previous=$page-1;

      ?>
      <li class="page-item">
        <?php
          echo '<a class="page-link" href="?page='.$Previous.$keywords.$minor_category.$gender.$order.$price.$brand.'">'."<".'</a>';
         ?>
      </li>

      <?php
      for( $i=1 ; $i<=$pages ; $i++ ) {
        if ( $page-3 < $i && $i < $page+3 ) {?>
          <li class="page-item">
            <?php
              echo '<a class="page-link" href="?page='.$i.$keywords.$minor_category.$gender.$order.$price.$brand.'">' . $i . '</a>';

             ?>
          </li><?php
        }
    }
      ?>



  <li class="page-item">
    <?php
      echo '<a class="page-link" href="?page='.$Next.$keywords.$minor_category.$gender.$order.$price.$brand.'">'.'>'.'</a>';
     ?>  </li>
  <?php
    }?>
  </ul>
</nav>
