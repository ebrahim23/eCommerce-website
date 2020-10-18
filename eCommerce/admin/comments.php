<?php

  /*
  ===========================================
  ============== Comments Page ==============
  ===========================================
  */

  ob_start();

  session_start();

  if(isset($_SESSION['username'])){
    $titlePage = 'Comments';

    include 'init.php';

    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

    if($action == "Manage"){
      // Manage Page
      $stmt = $con->prepare("SELECT
                                  comments.*, items.Name, users.Username
                              FROM
                                  comments
                              INNER JOIN
                                  items
                              ON
                                  items.ItemID = comments.ItemID
                              INNER JOIN
                                  users
                              ON
                                  users.UserID = comments.UserID");
      $stmt->execute();

      $rows = $stmt->fetchAll();

      if(!empty($rows)){

    ?>
      <h1 class="text-center">Manage Comments</h1>
      <div class="container">
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center custom-table">
            <thead class="thead-dark">
              <tr>
                <th>#ID</th>
                <th>Comment</th>
                <th>Item Name</th>
                <th>User Name</th>
                <th>Date</th>
                <th>Control</th>
              </tr>
            </thead>
            <?php
              foreach($rows as $row) {
                echo "<tr>";
                  echo "<td>" . $row['cID'] . "</td>";
                  echo "<td>" . $row['Comment'] . "</td>";
                  echo "<td>" . $row['Name'] . "</td>";
                  echo "<td>" . $row['Username'] . "</td>";
                  echo "<td>" . $row['Date'] . "</td>";
                  echo "<td><a href='?action=Edit&comid=" . $row['cID'] . "' class='btn btn-success'><i class='fa fa-edit m-r'></i>Edit</a>
                  <a href='?action=Delete&comid=" . $row['cID'] . "' class='btn btn-danger confirm'><i class='fa fa-close m-r'></i>Delete</a>";

                  if($row['Status'] == 0){
                    echo "<a href='?action=Approve&comid=" . $row['cID'] . "' class='btn btn-info activate'><i class='fa fa-close m-r'></i>Approve</a>";
                  }

                  echo "</td>";
                echo "</tr>";
              }
            ?>
          </table>
        </div>
      </div>
    <?php }else {
      echo '<div class="container">';
        echo '<div class="no-con">There is no Content in this page.</div>';
      echo '</div>';
    } ?>

    <?php
    } elseif($action == "Edit"){ // Go to manage page

      $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

      $stmt = $con->prepare("SELECT * FROM comments WHERE cID = ?");
      $stmt->execute(array($comid));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();

      if($count > 0) { ?>

        <h1 class="text-center">Edit Comment...</h1>
        <div class="container">
          <form action="?action=Update" method="POST">
            <input type="hidden" name="comid" value="<?php echo $comid ?>">
            <div class="form-group">
              <label class="col-sm-2 control-label">Comment</label>
              <div class="col-sm-12">
                <textarea name="comment" class="form-control"><?php echo $row['Comment']; ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="submit" value="Save" class="btn btn-primary s-btn">
              </div>
            </div>
          </form>
        </div>
    <?php
        } else{
          echo '<div class="container">';
          $theMsg = '<div class="alert alert-danger">There is no such ID</div>';
          redirectFunc($theMsg);
          echo '</div>';
        }

    } elseif($action == "Update"){
        echo "<h1 class='text-center'>Update Comment...</h1>";
        echo "<div class='container'>";
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get form vars
            $id    = $_POST['comid'];
            $comment  = $_POST['comment'];

            // Update The Member
            $stmt = $con->prepare("UPDATE comments SET Comment = ? WHERE cID = ?");
            $stmt->execute(array($comment, $id));

            // Success echo
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
            redirectFunc($theMsg, 'back');

          } else{
            $theMsg = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly!</div>";
            redirectFunc($theMsg);
          }
        echo "</div>";
    } elseif($action == 'Delete') {
      echo '<h1 class="text-center">Delete Comment...</h1>';
      echo '<div class="container">';
      // Delete Member Page
      $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

      $check = check('cID', 'comments', $comid);

      if($check > 0) {
        $stmt = $con->prepare("DELETE FROM comments WHERE cID = :zid");
        $stmt->bindParam(":zid", $comid);
        $stmt->execute();

        // Success echo
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Deleded</div>';
        redirectFunc($theMsg, 'back');
      } else{
        echo '<div class="container">';
        $theMsg = '<div class="alert alert-danger">There is no such ID</div>';
        redirectFunc($theMsg);
        echo '</div>';
      }
      echo '</div>';
    } elseif ($action == 'Approve') {
      // code...
      echo '<h1 class="text-center">Approve Comment...</h1>';
      echo '<div class="container">';
      // Delete Member Page
      $comid = isset($_GET['comid']) && is_numeric($_GET['comid']) ? intval($_GET['comid']) : 0;

      $check = check('cID', 'comments', $comid);

      if($check > 0) {
        $stmt = $con->prepare("UPDATE comments SET Status = 1 WHERE cID = ?");
        $stmt->execute(array($comid));

        // Success echo
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Approved</div>';
        redirectFunc($theMsg, 'back');
      } else{
        echo '<div class="container">';
        $theMsg = '<div class="alert alert-danger">There is no such ID</div>';
        redirectFunc($theMsg);
        echo '</div>';
      }
    }

    include $temp . 'footer.php';

  } else{

    header('location: index.php');
    exit();

  }

  ob_end_flush();
?>
