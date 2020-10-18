<?php

  /*
  ============================================
  ================ Items Page ================
  ============================================
  */

  ob_start();

  session_start();

  if(isset($_SESSION['username'])){
    $titlePage = 'Items';

    include 'init.php';

    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

    if($action == "Manage"){
      // Manage Member Page
      $stmt = $con->prepare("SELECT
                                items.*,
                                categories.Name AS category_name,
                                users.Username
                              FROM
                                items
                              INNER JOIN
                                categories
                              ON
                                categories.ID = items.Cat_ID
                              INNER JOIN
                                users
                              ON
                                users.UserID = items.Member_ID");
      $stmt->execute();
      $items = $stmt->fetchAll();
      if(! empty($items)){
      ?>
      <h1 class="text-center">Manage Items</h1>
      <div class="container">
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center custom-table">
            <thead class="thead-dark">
              <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Registerd Date</th>
                <th>Category</th>
                <th>Username</th>
                <th>Control</th>
              </tr>
            </thead>
            <?php
              foreach($items as $item) {
                echo "<tr>";
                  echo "<td>" . $item['ItemID'] . "</td>";
                  echo "<td>" . $item['Name'] . "</td>";
                  echo "<td>" . $item['Description'] . "</td>";
                  echo "<td>" . $item['Price'] . "</td>";
                  echo "<td>" . $item['Date'] . "</td>";
                  echo "<td>" . $item['category_name'] . "</td>";
                  echo "<td>" . $item['Username'] . "</td>";
                  echo "<td><a href=' ?action=Edit&itemid=" . $item['ItemID'] . "' class='btn btn-success'><i class='fa fa-edit m-r'></i>Edit</a>
                  <a href='?action=Delete&itemid=" . $item['ItemID'] . "' class='btn btn-danger confirm'><i class='fa fa-close m-r'></i>Delete</a>";
                  if($item['Approve'] == 0){
                    echo "<a href='?action=Approve&itemid=" . $item['ItemID'] . "' class='btn btn-info activate'><i class='fa fa-check m-r'></i>Approve</a>";
                  }
                  echo "</td>";
                echo "</tr>";
              }
            ?>
          </table>
        </div>
        <a href='?action=Add' class="btn btn-primary"><i class="fa fa-plus"></i> Go To Add Item Page</a>
      </div>
      <?php }else {
        echo '<div class="container">';
          echo '<div class="no-con">There is no Content in this page.</div>';
          echo '<a href="?action=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Go To Add Item Page</a>';
        echo '</div>';
      } ?>

    <?php }elseif($action == "Add"){ // Add Member Page ?>
      <h1 class="text-center">Add Item...</h1>
        <div class="container">
          <form action="?action=Insert" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-12">
                <input type="text" name="name" class="form-control" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Description</label>
              <div class="col-sm-12">
                <input type="text" name="description" class="form-control" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Price</label>
              <div class="col-sm-12">
                <input type="text" name="price" class="form-control" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Contry</label>
              <div class="col-sm-12">
                <input type="text" name="country" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Status</label>
              <div class="col-sm-12">
                <select class="form-control" name="status">
                    <option value="0">...</option>
                    <option value="1">New</option>
                    <option value="2">Like New</option>
                    <option value="3">Used</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Member</label>
              <div class="col-sm-12">
                <select class="form-control" name="member">
                    <option value="0">...</option>
                    <?php
                      $members = getAll("*", "users", "", "", "UserID");
                      foreach ($members as $user) {
                        // code...
                        echo "<option value='" . $user['UserID'] . "'>" . $user['Username'] . "</option>";
                      }
                    ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Category</label>
              <div class="col-sm-12">
                <select class="form-control" name="category">
                    <option value="0">...</option>
                    <?php
                      $allCats = getAll("*", "categories", "where parent = 0", "", "ID");
                      foreach ($allCats as $cat) {
                        // code...
                        echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                        $subCats = getAll("*", "categories", "where parent = {$cat['ID']}", "", "ID");
                        foreach ($subCats as $subCat) {
                          // code...
                          echo "<option value='" . $cat['ID'] . "'>---" . $cat['Name'] . "</option>";
                        }
                      }
                    ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Tags</label>
              <div class="col-sm-12">
                <input type="text" name="tags" class="form-control" placeholder="Seprate by comma (,)">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="submit" value="Add Item" class="btn btn-primary s-btn">
              </div>
            </div>
          </form>
        </div>
    <?php
    }elseif($action == "Insert"){
      // Insert Page
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<h1 class='text-center'>Insert Item...</h1>";
        echo "<div class='container'>";

        // Get form vars
        $name     = $_POST['name'];
        $desc     = $_POST['description'];
        $price    = $_POST['price'];
        $country  = $_POST['country'];
        $status   = $_POST['status'];
        $member   = $_POST['member'];
        $category = $_POST['category'];
        $tags     = $_POST['tags'];

        // Validate Form
        $formErrors = array();

        if(empty($name)){
          $formErrors[] = 'You must type the item name!';
        }
        if(empty($desc)){
          $formErrors[] = 'You must type the item description!';
        }
        if(empty($country)){
          $formErrors[] = 'You must type the item country!';
        }
        if($status === 0){
          $formErrors[] = 'You must choose the item status!';
        }
        if($member === 0){
          $formErrors[] = 'You must choose the item member!';
        }
        if($category === 0){
          $formErrors[] = 'You must choose the item category!';
        }

        foreach($formErrors as $error){
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }

        // Insert The Member
        if(empty($formErrors)){
          // Insert user info in database
          $stmt = $con->prepare("INSERT INTO
                                        items(Name,Description,Price,Country,Status, Date, Cat_ID, Member_ID, Tags)
                                  VALUES(:zname, :zdesc, :zprice, :zcountry, :zstatus, now(), :zcat, :zmember, :ztag) ");
          $stmt->execute(array(
            'zname'     => $name,
            'zdesc'     => $desc,
            'zprice'    => $price,
            'zcountry'  => $country,
            'zstatus'   => $status,
            'zmember'   => $member,
            'zcat'      => $category,
            'ztag'      => $tags
          ));

          // Success echo
          $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
          redirectFunc($theMsg, 'back');
        }

      } else{
        $theMsg = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly!</div>";
        redirectFunc($theMsg);
      }
      echo "</div>";

    } elseif($action == "Edit"){
      // Edit Page
      $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

      $stmt = $con->prepare("SELECT * FROM items WHERE ItemID = ?");
      $stmt->execute(array($itemid));
      $item = $stmt->fetch();
      $count = $stmt->rowCount();

      if($count > 0) { ?>
        <h1 class="text-center">Edit Item...</h1>
          <div class="container">
            <form action="?action=Update" method="POST">
              <input type="hidden" name="itemid" value="<?php echo $itemid ?>">
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-12">
                  <input type="text" name="name" class="form-control" required='required' value="<?php echo $item['Name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
                  <input type="text" name="description" class="form-control" required='required' value="<?php echo $item['Description']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-12">
                  <input type="text" name="price" class="form-control" required='required' value="<?php echo $item['Price']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Contry</label>
                <div class="col-sm-12">
                  <input type="text" name="country" class="form-control" value="<?php echo $item['Country']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-12">
                  <select class="form-control" name="status">
                      <option value="1" <?php if($item['Status'] == 1) {echo "selected";} ?>>New</option>
                      <option value="2" <?php if($item['Status'] == 2) {echo "selected";} ?>>Like New</option>
                      <option value="3" <?php if($item['Status'] == 3) {echo "selected";} ?>>Used</option>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Member</label>
                <div class="col-sm-12">
                  <select class="form-control" name="member">
                      <?php
                        $stmt = $con->prepare("SELECT * FROM users");
                        $stmt->execute();
                        $users = $stmt->fetchAll();
                        foreach ($users as $user) {
                          // code...
                          echo "<option value='" . $user['UserID'] . "'"; if($item['Member_ID'] == $user['UserID']) {echo "selected";} echo">" . $user['Username'] . "</option>";
                        }
                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-12">
                  <select class="form-control" name="category">
                      <?php
                        $stmt = $con->prepare("SELECT * FROM categories");
                        $stmt->execute();
                        $cats = $stmt->fetchAll();
                        foreach ($cats as $cat) {
                          // code...
                          echo "<option value='" . $cat['ID'] . "'"; if($item['Cat_ID'] == $cat['ID']) {echo "selected";} echo">" . $cat['Name'] . "</option>";
                        }
                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Tags</label>
                <div class="col-sm-12">
                  <input type="text" value="<?php echo $item['Tags']; ?>" name="tags" class="form-control" placeholder="Seprate by comma (,)">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="submit" value="Save Item" class="btn btn-primary s-btn">
                </div>
              </div>
            </form>
            <?php
            // Manage Page
            $stmt = $con->prepare("SELECT
                                        comments.*, users.Username
                                    FROM
                                        comments
                                    INNER JOIN
                                        users
                                    ON
                                        users.UserID = comments.UserID
                                    WHERE ItemID = ?");
            $stmt->execute(array($itemid));

            $rows = $stmt->fetchAll();

            if(! empty($rows)){

          ?>
            <h1 class="text-center">Manage [<?php echo $item['Name']; ?>] Comments</h1>
            <div class="table-responsive">
              <table class="table table-bordered table-striped text-center custom-table">
                <thead class="thead-dark">
                  <tr>
                    <th>Comment</th>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>Control</th>
                  </tr>
                </thead>
                <?php
                  foreach($rows as $row) {
                    echo "<tr>";
                      echo "<td>" . $row['Comment'] . "</td>";
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
            <?php } ?>
          </div>
    <?php
        } else{
          echo '<div class="container">';
          $theMsg = '<div class="alert alert-danger">There is no such ID</div>';
          redirectFunc($theMsg);
          echo '</div>';
        }

    } elseif($action == "Update"){
      // Update Page
      echo "<h1 class='text-center'>Update Member...</h1>";
      echo "<div class='container'>";
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
          // Get form vars
          $id       = $_POST['itemid'];
          $name     = $_POST['name'];
          $desc     = $_POST['description'];
          $price    = $_POST['price'];
          $country  = $_POST['country'];
          $status   = $_POST['status'];
          $member   = $_POST['member'];
          $category = $_POST['category'];
          $tags     = $_POST['tags'];

          // Validate Form
          $formErrors = array();

          if(empty($name)){
            $formErrors[] = 'You must type the item name!';
          }
          if(empty($desc)){
            $formErrors[] = 'You must type the item description!';
          }
          if(empty($country)){
            $formErrors[] = 'You must type the item country!';
          }
          if($status === 0){
            $formErrors[] = 'You must choose the item status!';
          }
          if($member === 0){
            $formErrors[] = 'You must choose the item member!';
          }
          if($category === 0){
            $formErrors[] = 'You must choose the item category!';
          }

          foreach($formErrors as $error){
            echo '<div class="alert alert-danger">' . $error . '</div>';
          }

          // Update The Member
          if(empty($formErrors)){
            $stmt = $con->prepare("UPDATE items SET Name = ?, Description = ?, Price = ?, Country = ?, Status = ?, Member_ID = ?, Tags = ?, Cat_ID = ? WHERE ItemID = ?");
            $stmt->execute(array($name, $desc, $price, $country, $status, $member, $tags, $category, $id));

            // Success echo
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
            redirectFunc($theMsg, 'back');
          }

        } else{
          $theMsg = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly!</div>";
          redirectFunc($theMsg);
        }
      echo "</div>";

    } elseif($action == 'Delete') {
      // Delete Page
      echo '<h1 class="text-center">Delete Item...</h1>';
      echo '<div class="container">';
      // Delete Member Page
      $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

      $check = check('ItemID', 'items', $itemid);

      if($check > 0) {
        $stmt = $con->prepare("DELETE FROM items WHERE ItemID = :zid");
        $stmt->bindParam(":zid", $itemid);
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

    } elseif($action == 'Approve') {
      // Approve Page
      echo '<h1 class="text-center">Approve Item...</h1>';
      echo '<div class="container">';
      // Delete Member Page
      $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

      $check = check('ItemID', 'items', $itemid);

      if($check > 0) {
        $stmt = $con->prepare("UPDATE items SET Approve = 1 WHERE ItemID = ?");
        $stmt->execute(array($itemid));

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
