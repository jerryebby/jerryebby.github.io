<?php
if ( isset($pages)) {
  for($i=1;$i<=$pages;$i++) {?>
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
}?>