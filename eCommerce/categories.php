<?php
  session_start();
  include 'init.php';
  $titlePage = 'Categories';
?>

<div class="container">
  <h1 class="text-center">Categories</h1>
  <div class="row">
    <?php
      $category = isset($_GET['pgid']) && is_numeric($_GET['pgid']) ? intval($_GET['pgid']) : 0;
      $theItems = getAll("*", "items", "where Cat_Id = {$category}", "AND Approve = 1", "ItemID");
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
