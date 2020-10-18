<?php
    session_start();

    if(isset($_SESSION['username'])){

        $titlePage = 'Dashboard';

        include 'init.php';

        // Set The Latest Users
        $latestUsers = 4;
        $theLatestUser = getLatest("*", "users", "UserID", $latestUsers);
        // Set The Latest Items
        $latestItems = 4;
        $theLatestItem = getLatest("*", "items", "ItemID", $latestItems);
        // Set The Latest Items
        $latestComments = 4;
        $theLatestComments = getLatest("*", "comments", "cID", $latestComments);
?>

        <!-- Dashboard Structure -->
        <div class="container theStat text-center">
          <h1>Dashboard</h1>
          <div class="row">
            <div class="col-md-3">
              <div class="stat st-member">
                <i class="fa fa-users"></i>
                <div class="info">
                  All Members
                  <span><a href="members.php"><?php echo countItems('UserID', 'users') ?></a></span>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat st-pending">
                <i class="fa fa-user-plus"></i>
                <div class="info">
                  Pending Members
                  <span><a href="members.php?action=Manage&page=Pending"><?php echo check('RegStatus', 'users', 0) ?></a></span>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat st-item">
                <i class="fa fa-shopping-bag"></i>
                <div class="info">
                  All Products
                  <span><a href="items.php"><?php echo countItems('ItemID', 'items') ?></a></span>
                </div>
              </div>
            </div>
            <div class="col-md-3">
              <div class="stat st-comment">
                <i class="fa fa-comments"></i>
                <div class="info">
                  All Comments
                  <span><a href="comments.php"><?php echo countItems('cID', 'comments') ?></a></span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="container latest">
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-users"></i> Latest <?php echo $latestUsers ?> Registerd Users
                  <span class="plus-icon pull-right">
                    <i class="fa fa-plus fa-lg"></i>
                  </span>
                </div>
                <div class="card-body cb-dash">
                  <ul class="list-unstyled latest-users">
                    <?php
                      // Get The Latest Users
                    if($latestUsers > 0){
                      foreach ($theLatestUser as $user) {
                        // code...
                        echo '<li>';
                          echo $user['Username'];
                          echo '<a href="members.php?action=Edit&userid='. $user['UserID'] .'">';
                            echo '<span class="btn btn-success pull-right">';
                              echo '<i class="fa fa-edit"></i> Edit';
                              if($user['RegStatus'] == 0){
                                echo "<a href='members.php?action=Activate&userid=" . $user['UserID'] . "' class='btn btn-info activate pull-right'><i class='fa fa-check m-r'></i>Activate</a>";
                              }
                            echo '</span>';
                          echo '</a>';
                        echo '</li>';
                      }
                    } else{
                      echo 'There is no members to show';
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-tag"></i> Latest <?php echo $latestItems ?> Items
                  <span class="plus-icon pull-right">
                    <i class="fa fa-plus fa-lg"></i>
                  </span>
                </div>
                <div class="card-body cb-dash">
                  <ul class="list-unstyled latest-users">
                    <?php
                      // Get The Latest Users
                    if($latestItems > 1){
                      foreach ($theLatestItem as $item) {
                        // code...
                        echo '<li>';
                          echo $item['Name'];
                          echo '<a href="items.php?action=Edit&itemid='. $item['ItemID'] .'">';
                            echo '<span class="btn btn-success pull-right">';
                              echo '<i class="fa fa-edit"></i> Edit';
                              if($item['Approve'] == 0){
                                echo "<a href='items.php?action=Approve&itemid=" . $item['ItemID'] . "' class='btn btn-info activate pull-right'><i class='fa fa-check m-r'></i>Approve</a>";
                              }
                            echo '</span>';
                          echo '</a>';
                        echo '</li>';
                      }
                    } else{
                      echo 'There is no Items to show';
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Second Row -->
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <i class="fa fa-comments-o"></i> Latest <?php echo $latestComments ?> Comments
                  <span class="plus-icon pull-right">
                    <i class="fa fa-plus fa-lg"></i>
                  </span>
                </div>
                <div class="card-body cb-dash">
                  <?php
                    $stmt = $con->prepare("SELECT
                                                comments.*, users.Username
                                            FROM
                                                comments
                                            INNER JOIN
                                                users
                                            ON
                                                users.UserID = comments.UserID
                                            ORDER BY
                                                cID DESC
                                            LIMIT $latestComments");
                    $stmt->execute();

                    $comments = $stmt->fetchAll();

                    if($comments > 1){
                      foreach ($comments as $comment) {
                        // code...
                        echo '<div class="c-box">';
                          echo '<a href="members.php"><span class="member-n">' . $comment['Username'] . '</span>' . '</a>';
                          echo '<p class="member-c">' . $comment['Comment'] . '</p>';
                          echo '<a class="member-b" href="comments.php?action=Edit&comid='. $comment['cID'] .'">';
                            echo '<span class="btn btn-success pull-right btn-sm">';
                              echo '<i class="fa fa-edit"></i> Edit';
                              if($comment['Status'] == 0){
                                echo "<a href='comments.php?action=Approve&comid=" . $comment['cID'] . "' class='btn btn-info activate pull-right btn-sm'><i class='fa fa-check m-r'></i>Approve</a>";
                              }
                            echo '</span>';
                          echo '</a>';
                        echo '</div>';
                      }
                    } else{
                      echo 'There is no Items to show';
                    }
                  ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php include $temp . 'footer.php';

    } else{

        header('location: index.php');
        exit();

    }
