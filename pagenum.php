
<nav aria-label="Page navigation example" style="display:table; margin:0 auto; ">
  <ul class="pagination" >
    <?php
    if ( isset($pages)) {
      $Next=$page+1;
      $Previous=$page-1;
      ?>
      <li class="page-item">
        <?php
        if (isset($_GET["keywords"])) {
          echo '<a class="page-link" href="?page='.$Previous.'&keywords='.$_GET["keywords"].'">'."&laquo;".'</a>';
        }
        else {
          echo '<a class="page-link" href="?page='.$Previous.'">' ."&laquo;".'</a>';

        }
         ?>
      </li>
      <?php
      $j=$page-2;
      for($i=1;$i<=5;$i++) {
        if ($page<=3) {?>
          <li class="page-item">
            <?php
            if (isset($_GET["keywords"])) {
              echo '<a class="page-link" href="?page='.$i.'&keywords='.$_GET["keywords"].'">' . $i . '</a>';
            }
            else {
              echo '<a class="page-link" href="?page='.$i.'">' . $i . '</a>';

            }
             ?>
          </li>
        <?php
      }
      else {?>
        <li class="page-item">
          <?php
          if (isset($_GET["keywords"])) {
            echo '<a class="page-link" href="?page='.$j.'&keywords='.$_GET["keywords"].'">' . $j . '</a>';
          }
          else {
            echo '<a class="page-link" href="?page='.$j.'">' . $j . '</a>';
          }
          $j++;
           ?>
        </li>
    <?php  }
  }?>
  <li class="page-item">
    <?php
    if (isset($_GET["keywords"])) {
      echo '<a class="page-link" href="?page='.$Next.'&keywords='.$_GET["keywords"].'">'."&raquo;".'</a>';
    }
    else {
      echo '<a class="page-link" href="?page='.$Next.'">' . "&raquo;".'</a>';

    }
     ?>  </li>
  <?php
    }?>
  </ul>
</nav>
