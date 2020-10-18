<?php
  session_start();

  if(isset($_SESSION['username'])){
    $titlePage = 'Categories';

    include 'init.php';

    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

    if($action == "Manage"){
      // Manage Member Page
      $sort = 'ASC';
      $sort_array = array('ASC', 'DESC');
      if(isset($_GET['sort']) && in_array($_GET['sort'], $sort_array)){
        $sort = $_GET['sort'];
      }

      $stmt = $con->prepare("SELECT * FROM categories WHERE parent = 0 ORDER BY Ordering $sort");
      $stmt->execute();
      $cats = $stmt->fetchAll();
      if(!empty($cats)){
      ?>
      <h1 class="text-center">Manage Categories</h1>
      <div class="container categories">
        <div class="card">
          <div class="card-header"><i class="fa fa-cog"></i>
            Manage Categories
            <div class="ordering pull-right">
              Order By [
              <a class="<?php if($sort == 'ASC'){echo 'active';} ?>" href="?sort=ASC">ASC</a>
              <a class="<?php if($sort == 'DESC'){echo 'active';} ?>" href="?sort=DESC">DESC</a>]
            </div>
          </div>
          <div class="card-body">
            <?php
            foreach ($cats as $cat) {
              // code...
              echo '<div class="cat">';
                echo '<div class="hidden-buts">';
                  echo '<a href="categories.php?action=Edit&catid=' . $cat['ID'] . '" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>';
                  echo '<a href="categories.php?action=Delete&catid=' . $cat['ID'] . '" class="confirm btn btn-danger"><i class="fa fa-close"></i> Delete</a>';
                echo '</div>';
                echo '<h3>' . $cat['Name'] . '</h3>';
                echo '<div class="hide-view">';
                  echo '<p>'; if($cat['Description'] == ''){echo 'There is no description for this';}else{echo $cat['Description'];} echo '</p>';
                  if($cat['Visibility'] == 1){echo '<span class="visibility">Hidden</span>';}
                  if($cat['Allow_Comments'] == 1){echo '<span class="comments">Comments Disabled</span>';}
                  if($cat['Allow_Ads'] == 1){echo '<span class="ads">Ads Disabled</span>';}
                  // Get Child Categories
                  $childCats = getAll("*", "categories", "where parent = {$cat['ID']}", "", "ID");
                  if(!empty($childCats)){
                    foreach ($childCats as $c) {
                      // code...
                      echo '<h5 class="childHead">Child Categories</h5>';
                      echo '<ul class="list-unstyled childCats">';
                      echo '<li>
                              <a href="categories.php?action=Edit&catid='. $c['ID'] .'">' .$c['Name'] . '</a>
                              <a href="categories.php?action=Delete&catid=' . $c['ID'] . '" class="confirm del"> Delete</a>
                            </li>';
                      echo '</ul>';
                    }
                  }
                echo '</div>';
              echo '</div>';
              echo '<hr>';
            }
            ?>
          </div>
        </div>
        <a href='?action=Add' class="btn btn-primary add-btn"><i class="fa fa-plus"></i> Go To Add Category Page</a>
      </div>
      <?php }else {
        echo '<div class="container">';
          echo '<div class="no-con">There is no Content in this page.</div>';
        echo '</div>';
      } ?>
      <?php
    }elseif($action == "Add"){ // Add Member Page ?>
      <h1 class="text-center">Add Category...</h1>
        <div class="container">
          <form action="?action=Insert" method="POST">
            <div class="form-group">
              <label class="col-sm-2 control-label">Name</label>
              <div class="col-sm-12">
                <input type="text" name="name" class="form-control" autocomplete="off" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Description</label>
              <div class="col-sm-12">
                <input type="text" name="description" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Category Parent</label>
              <div class="col-sm-12">
                <select name="parent">
                  <option value="0">None(Main Category)</option>
                  <?php
                    $cats = getAll("*", "categories", "where parent = 0", "", "ID", "ASC");
                    foreach ($cats as $cat) {
                      // code...
                      echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                    }
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Ordering</label>
              <div class="col-sm-12">
                <input type="text" name="ordering" class="form-control">
              </div>
            </div>
            <div class="form-group choose-box1">
              <label class="col-sm-2 control-label">Visibility</label>
              <div class="col-sm-12">
                <input id="ves-yes" type="radio" value="0" name="visibility" checked>
                <label for="ves-yes">Yes</label>
                <input id="ves-no" type="radio" value="1" name="visibility">
                <label for="ves-no">No</label>
              </div>
            </div>
            <div class="form-group choose-box2">
              <label class="col-sm-2 control-label">Allow Commenting</label>
              <div class="col-sm-12">
                <input id="com-yes" type="radio" value="0" name="comment" checked>
                <label for="com-yes">Yes</label>
                <input id="com-no" type="radio" value="1" name="comment">
                <label for="com-no">No</label>
              </div>
            </div>
            <div class="form-group choose-box3">
              <label class="col-sm-2 control-label">Allow Ads</label>
              <div class="col-sm-12">
                <input id="ad-yes" type="radio" value="0" name="ads" checked>
                <label for="as-yes">Yes</label>
                <input id="as-no" type="radio" value="1 " name="ads">
                <label for="as-no">No</label>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="submit" value="Add Category" class="btn btn-primary s-btn">
              </div>
            </div>
          </form>
        </div>

    <?php
    }elseif($action == "Insert"){
      // Insert Member Page
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<h1 class='text-center'>Insert Category...</h1>";
        echo "<div class='container'>";

        // Get form vars
        $name     = $_POST['name'];
        $desc     = $_POST['description'];
        $parent     = $_POST['parent'];
        $order    = $_POST['ordering'];
        $visible  = $_POST['visibility'];
        $comment  = $_POST['comment'];
        $ads      = $_POST['ads'];

        // Validate Form
        $formErrors = array();

        if(empty($name)){
          $formErrors[] = 'You must type a name for this category!';
        }

        foreach($formErrors as $error){
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }

        // Insert The Member
        if(empty($formErrors)){
          // Check if user exist
          $check = check("Name", "categories", $name);
          if($check == 1){
            $theMsg = '<div class="alert alert-danger">Sorry This user is already exist</div>';
            redirectFunc($theMsg, 'back');
          } else {
            // Insert user info in database
            $stmt = $con->prepare("INSERT INTO
                                    categories(Name,Description,parent,Ordering,Visibility,Allow_Comments,Allow_Ads)
                                    VALUES(:sname, :sdesc, :sparent, :sorder, :svisible, :scomment, :sads) ");
            $stmt->execute(array(
              'sname' => $name,
              'sdesc' => $desc,
              'sparent' => $parent,
              'sorder' => $order,
              'svisible' => $visible,
              'scomment' => $comment,
              'sads' => $ads
            ));

            // Success echo
            $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Inserted</div>';
            redirectFunc($theMsg, 'back');
          }
        }

      } else{
        $theMsg = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly!</div>";
        redirectFunc($theMsg, 'back');
      }
      echo "</div>";

    } elseif($action == "Edit"){
      // Edit Member Page
      $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

      $stmt = $con->prepare("SELECT * FROM categories WHERE ID = ?");
      $stmt->execute(array($catid));
      $cat = $stmt->fetch();
      $count = $stmt->rowCount();

      if($count > 0) { ?>
        <!-- The Code -->
        <h1 class="text-center">Edit Category...</h1>
          <div class="container">
            <form action="?action=Update" method="POST">
              <input type="hidden" name="catid" value="<?php echo $catid ?>">
              <div class="form-group">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-12">
                  <input type="text" name="name" class="form-control" required='required' value="<?php echo $cat['Name'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-12">
                  <input type="text" name="description" class="form-control" value="<?php echo $cat['Description'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Ordering</label>
                <div class="col-sm-12">
                  <input type="text" name="ordering" class="form-control" value="<?php echo $cat['Ordering'] ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Parent</label>
                <div class="col-sm-12">
                  <select name="parent">
                    <?php
                      $cats = getAll("*", "categories", "where parent = 0", "", "ID", "ASC");
                      echo "<option value='0'>None</option>";
                      foreach ($cats as $c) {
                        // code...
                        echo "<option value='" . $c['ID'] . "'";
                        if($cat['parent'] == $c['ID']){ echo 'selected'; }
                        echo ">" . $c['Name'] . "</option>";
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group choose-box1">
                <label class="col-sm-2 control-label">Visibility</label>
                <div class="col-sm-12">
                  <input id="ves-yes" type="radio" value="0" name="visibility" <?php if($cat['Visibility'] == 0){echo 'checked';} ?>>
                  <label for="ves-yes">Yes</label>
                  <input id="ves-no" type="radio" value="1" name="visibility" <?php if($cat['Visibility'] == 1){echo 'checked';} ?>>
                  <label for="ves-no">No</label>
                </div>
              </div>
              <div class="form-group choose-box2">
                <label class="col-sm-2 control-label">Allow Commenting</label>
                <div class="col-sm-12">
                  <input id="com-yes" type="radio" value="0" name="comment" <?php if($cat['Allow_Comments'] == 0){echo 'checked';} ?>>
                  <label for="com-yes">Yes</label>
                  <input id="com-no" type="radio" value="1" name="comment" <?php if($cat['Allow_Comments'] == 1){echo 'checked';} ?>>
                  <label for="com-no">No</label>
                </div>
              </div>
              <div class="form-group choose-box3">
                <label class="col-sm-2 control-label">Allow Ads</label>
                <div class="col-sm-12">
                  <input id="ad-yes" type="radio" value="0" name="ads" <?php if($cat['Allow_Ads'] == 0){echo 'checked';} ?>>
                  <label for="as-yes">Yes</label>
                  <input id="as-no" type="radio" value="1 " name="ads" <?php if($cat['Allow_Ads'] == 1){echo 'checked';} ?>>
                  <label for="as-no">No</label>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-12">
                  <input type="submit" value="Save Changes" class="btn btn-primary s-btn">
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
        // Update Member Page
        echo "<h1 class='text-center'>Update Category...</h1>";
        echo "<div class='container'>";
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get form vars
            $id         = $_POST['catid'];
            $name       = $_POST['name'];
            $desc       = $_POST['description'];
            $order      = $_POST['ordering'];
            $parent     = $_POST['parent'];
            $visible    = $_POST['visibility'];
            $comment    = $_POST['comment'];
            $ads        = $_POST['ads'];

            // Update The Member
            if(empty($formErrors)){
              $stmt = $con->prepare("UPDATE categories SET Name = ?, Description = ?, Ordering = ?, parent = ?, Visibility = ?, Allow_Comments = ?, Allow_Ads = ? WHERE ID = ?");
              $stmt->execute(array($name, $desc, $order, $parent, $visible, $comment, $ads, $id));

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
      // Delete Member Page
      echo '<h1 class="text-center">Delete Category...</h1>';
      echo '<div class="container">';
      // Delete Member Page
      $catid = isset($_GET['catid']) && is_numeric($_GET['catid']) ? intval($_GET['catid']) : 0;

      $check = check('ID', 'categories', $catid);

      if($check > 0) {
        $stmt = $con->prepare("DELETE FROM categories WHERE ID = :zname");
        $stmt->bindParam(":zname", $catid);
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
    }

    include $temp . 'footer.php';

  } else{

    header('location: index.php');
    exit();

  }
