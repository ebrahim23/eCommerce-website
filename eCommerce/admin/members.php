<?php
  session_start();

  if(isset($_SESSION['username'])){
    $titlePage = 'Members';

    include 'init.php';

    $action = isset($_GET['action']) ? $_GET['action'] : 'Manage';

    if($action == "Manage"){ // Manage Member Page

      $query = '';
      if(isset($_GET['page']) && $_GET['page'] == 'Pending'){
        $query = 'And RegStatus = 0';
      }

      $stmt = $con->prepare("SELECT * FROM users WHERE GroupID != 1 $query");
      $stmt->execute();

      $rows = $stmt->fetchAll();
      if(!empty($rows)){

    ?>
      <h1 class="text-center">Manage Members</h1>
      <div class="container">
        <div class="table-responsive">
          <table class="table table-bordered table-striped text-center custom-table">
            <thead class="thead-dark">
              <tr>
                <th>#ID</th>
                <th>Avatar</th>
                <th>Username</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Registerd Date</th>
                <th>Control</th>
              </tr>
            </thead>
            <?php
              foreach($rows as $row) {
                echo "<tr>";
                  echo "<td>" . $row['UserID'] . "</td>";
                  echo "<td>";
                    if(empty($row['Avatar'])){
                      echo "<img src='../layout/images/2.jpg' alt='default avatar' />";
                    } else{
                      echo "<img src='uploads/avatars/" . $row['Avatar'] . "'alt='avatar' />";
                    }
                  echo "</td>";
                  echo "<td>" . $row['Username'] . "</td>";
                  echo "<td>" . $row['Email'] . "</td>";
                  echo "<td>" . $row['Fullname'] . "</td>";
                  echo "<td>" . $row['Date'] . "</td>";
                  echo "<td><a href='?action=Edit&userid=" . $row['UserID'] . "' class='btn btn-success'><i class='fa fa-edit m-r'></i>Edit</a>
                  <a href='?action=Delete&userid=" . $row['UserID'] . "' class='btn btn-danger confirm'><i class='fa fa-close m-r'></i>Delete</a>";

                  if($row['RegStatus'] == 0){
                    echo "<a href='?action=Activate&userid=" . $row['UserID'] . "' class='btn btn-info activate'><i class='fa fa-close m-r'></i>Activate</a>";
                  }

                  echo "</td>";
                echo "</tr>";
              }
            ?>
          </table>
        </div>
        <a href='?action=Add' class="btn btn-primary"><i class="fa fa-plus"></i> Go To Add Member Page</a>
      </div>
    <?php }else {
      echo '<div class="container">';
        echo '<div class="no-con">There is no Content in this page.</div>';
        echo '<a href="?action=Add" class="btn btn-primary"><i class="fa fa-plus"></i> Go To Add Member Page</a>';
      echo '</div>';
    } ?>

    <?php }elseif($action == "Add"){ ?>

      <h1 class="text-center">Add Member...</h1>
        <div class="container">
          <form action="?action=Insert" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <div class="col-sm-12">
                <input type="text" name="username" class="form-control" autocomplete="off" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Password</label>
              <div class="col-sm-12">
                <input type="password" name="password" class="form-control" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-12">
                <input type="email" name="email" class="form-control" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Full Name</label>
              <div class="col-sm-12">
                <input type="text" name="fullName" class="form-control" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Add Your Image</label>
              <div class="col-sm-12">
                <input type="file" name="avatar" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-12">
                <input type="submit" value="Add Member" class="btn btn-primary s-btn">
              </div>
            </div>
          </form>
        </div>
    <?php
    }elseif($action == "Insert"){
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "<h1 class='text-center'>Insert Member...</h1>";
        echo "<div class='container'>";

        $avatarName = $_FILES['avatar']['name'];
        $avatarSize = $_FILES['avatar']['size'];
        $avatarTmp  = $_FILES['avatar']['tmp_name'];
        $avatarType = $_FILES['avatar']['type'];

        $avatarAllowedExtension = array("jpeg", "png", "jpg", "gif");

        $ava = explode('.', $avatarName);

        $avatarExtension1 = strtolower(end($ava));

        // Get form vars
        $user  = $_POST['username'];
        $pass  = $_POST['password'];
        $email = $_POST['email'];
        $name  = $_POST['fullName'];

        $hashPass = sha1($_POST['password']);

        // Validate Form
        $formErrors = array();

        if(empty($user)){
          $formErrors[] = 'You must type a username!';
        }
        if(empty($pass)){
          $formErrors[] = 'You must type a password!';
        }
        if(empty($email)){
          $formErrors[] = 'You must type your email!';
        }
        if(empty($name)){
          $formErrors[] = 'You must type your name!';
        }
        if(!empty($avatarName) && !in_array($avatarExtension1, $avatarAllowedExtension)){
          $formErrors[] = 'This Extension Is Not Allowed!';
        }
        if($avatarSize > 4194304){
          $formErrors[] = 'The Image Size Can\'t be more than 4mb!';
        }

        foreach($formErrors as $error){
          echo '<div class="alert alert-danger">' . $error . '</div>';
        }

        // Insert The Member
        if(empty($formErrors)){
          $avatar = rand(1, 1000000) . '_' . $avatarName;
          move_uploaded_file($avatarTmp, "uploads\avatars\\" . $avatar);

          // Check if user exist
          $check = check("Username", "users", $user);
          if($check == 1){
            $theMsg = '<div class="alert alert-danger">Sorry This user is already exist</div>';
            redirectFunc($theMsg, 'back');
          } else {
            // Insert user info in database
            $stmt = $con->prepare("INSERT INTO
                                    users(Username,Password,Email,Fullname,RegStatus,Date, Avatar)
                                    VALUES(:zuser, :zpass, :zmail, :zname,1, now(), :zavatar) ");
            $stmt->execute(array(
              'zuser'   => $user,
              'zpass'   => $hashPass,
              'zmail'   => $email,
              'zname'   => $name,
              'zavatar' => $avatar
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

    } elseif($action == "Edit"){ // Go to manage page

      $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

      $stmt = $con->prepare("SELECT * FROM users WHERE UserID = ? LIMIT 1");
      $stmt->execute(array($userid));
      $row = $stmt->fetch();
      $count = $stmt->rowCount();

      if($count > 0) { ?>

        <h1 class="text-center">Edit Member...</h1>
        <div class="container">
          <form action="?action=Update" method="POST">
            <input type="hidden" name="userid" value="<?php echo $userid ?>">
            <div class="form-group">
              <label class="col-sm-2 control-label">Username</label>
              <div class="col-sm-12">
                <input type="text" name="username" value="<?php echo $row['Username'] ?>" class="form-control" autocomplete="off" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Password</label>
              <div class="col-sm-12">
                <input type="hidden" name="oldpassword" value="<?php echo $row['Password'] ?>">
                <input type="password" name="newpassword" class="form-control">
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Email</label>
              <div class="col-sm-12">
                <input type="email" name="email" value="<?php echo $row['Email'] ?>" class="form-control" required='required'>
              </div>
            </div>
            <div class="form-group">
              <label class="col-sm-2 control-label">Full Name</label>
              <div class="col-sm-12">
                <input type="text" name="fullName" value="<?php echo $row['Fullname'] ?>" class="form-control" required='required'>
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
        echo "<h1 class='text-center'>Update Member...</h1>";
        echo "<div class='container'>";
          if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Get form vars
            $id    = $_POST['userid'];
            $user  = $_POST['username'];
            $email = $_POST['email'];
            $name  = $_POST['fullName'];

            // Password trick
            $pass = empty($_POST['newpassword']) ? $_POST['oldpassword'] : sha1($_POST['newpassword']);

            // Validate Form
            $formErrors = array();

            if(empty($user)){
              $formErrors[] = 'You must type a username!';
            }
            if(empty($email)){
              $formErrors[] = 'You must type your email!';
            }
            if(empty($name)){
              $formErrors[] = 'You must type your name!';
            }

            foreach($formErrors as $error){
              echo '<div class="alert alert-danger">' . $error . '</div>';
            }

            // Update The Member
            if(empty($formErrors)){
              $stmt2 = $con->prepare("SELECT
                                          *
                                      FROM
                                          users
                                      WHERE
                                          Username = ?
                                      AND
                                          UserID != ?");
              $stmt2->execute(array($user,$id));
              $count = $stmt2->rowCount();

              if($count == 1){
                $theMsg = '<div class="alert alert-danger">Sorry This User Is Exist</div>';
                redirectFunc($theMsg, 'back');
              } else{
                $stmt = $con->prepare("UPDATE users SET Username = ?, Email = ?, Fullname = ?, Password = ? WHERE UserID = ?");
                $stmt->execute(array($user, $email, $name, $pass, $id));

                // Success echo
                $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Updated</div>';
                redirectFunc($theMsg, 'back');
              }
            }

          } else{
            $theMsg = "<div class='alert alert-danger'>Sorry You Can't Browse This Page Directly!</div>";
            redirectFunc($theMsg);
          }
        echo "</div>";
    } elseif($action == 'Delete') {
      echo '<h1 class="text-center">Delete Member...</h1>';
      echo '<div class="container">';
      // Delete Member Page
      $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

      $check = check('userid', 'users', $userid);

      if($check > 0) {
        $stmt = $con->prepare("DELETE FROM users WHERE UserID = :zuser");
        $stmt->bindParam(":zuser", $userid);
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
    } elseif ($action == 'Activate') {
      // code...
      echo '<h1 class="text-center">Activate Member...</h1>';
      echo '<div class="container">';
      // Delete Member Page
      $userid = isset($_GET['userid']) && is_numeric($_GET['userid']) ? intval($_GET['userid']) : 0;

      $check = check('userid', 'users', $userid);

      if($check > 0) {
        $stmt = $con->prepare("UPDATE users SET RegStatus = 1 WHERE UserID = ?");
        $stmt->execute(array($userid));

        // Success echo
        $theMsg = "<div class='alert alert-success'>" . $stmt->rowCount() . ' Record Activated</div>';
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
