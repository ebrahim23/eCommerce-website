<?php
  ob_start();
  session_start();
  $titlePage = 'Home';
  include 'init.php';
?>

<div class="container">
  <div class="row">
    <?php
      $theItems = getAll('*', 'items', 'where Approve = 1', '', 'ItemID');
      foreach ($theItems as $item) {
        echo '<div class="col-sm-6 col-md-3">';
          echo '<div class="item-box">';
            echo '<span class="price">$' . $item['Price'] . '</span>';
            echo '<img src="layout/images/1.jpg" alt="Avatar">';
            echo '<div class="caption">';
              echo '<h3><a href="items.php?itemid='. $item['ItemID'] .'">'. $item['Name'] .'</a></h3>';
              echo '<p>'. $item['Description'] .'</p>';
              echo '<div class="span-date">'. $item['Date'] .'</div>';
            echo '</div>';
          echo '</div>';
        echo '</div>';
      }
    ?>
  </div>
</div>

<?php
  ob_end_flush();
?>
