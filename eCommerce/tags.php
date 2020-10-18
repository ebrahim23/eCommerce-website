<?php
  session_start();
  include 'init.php';
  $titlePage = 'Tags';
?>

<div class="container">
  <div class="row">
    <?php
      if(isset($_GET['name'])) {
        $tag = $_GET['name'];
        echo '<h1 class="text-center">' . $tag . '</h1>';
        $theTags = getAll("*", "items", "where Tags like '%$tag%'", "AND Approve = 1", "ItemID");
        foreach ($theTags as $item) {
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
      }
    ?>
  </div>
</div>
