<?php

  ob_start();
  session_start();
  $titlePage = 'Login';
  if(isset($_SESSION['user'])){
      header('location: index.php');
  }
  include 'init.php';

    // check if user coming from http post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      if(isset($_POST['login'])) {
        $user = $_POST['username'];
        $pass = $_POST['password'];
        $hashpass = sha1($pass);

        // check if user exist in database
        $stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ?");
        $stmt->execute(array($user, $hashpass));
        $get = $stmt->fetch();
        $count = $stmt->rowCount();

        // If count > 0 means it's exist in database
        if($count > 0){
            $_SESSION['user'] = $user; // Regester Session name
            $_SESSION['theUserID'] = $get['UserID'];
            header('location: index.php');
            exit();
        }
      } else{
        $avatarName = $_FILES['avatar']['name'];
        $avatarSize = $_FILES['avatar']['size'];
        $avatarTmp  = $_FILES['avatar']['tmp_name'];
        $avatarType = $_FILES['avatar']['type'];

        $avatarAllowedExtension = array("png", "jpg", "jpeg", "gif");

        $ava = explode('.', $avatarName);

        $avatarExtension = strtolower(end($ava));

        $formErrors = array();

        $theUser  = $_POST['username'];
        $thePass  = $_POST['password'];
        $thePass2 = $_POST['password2'];
        $theEmail = $_POST['email'];

        // Filter The Avatar
        if(!empty($avatarName) && !in_array($avatarExtension, $avatarAllowedExtension)){
          $formErrors[] = 'This Type Of Extension Is Not Alloweds';
        }

        // Filter The Username
        if(isset($theUser)){
          $filterUser = filter_var($theUser, FILTER_SANITIZE_STRING);
          if(strlen($filterUser) < 3){
            $formErrors[] = 'The Username must be larger than 2 Characters!';
          }
        }
        // Filter The Password
        if(isset($thePass) && isset($thePass2)){
          if(empty($thePass)){
            $formErrors[] = 'The Password is empty!';
          }
          $pass1 = sha1($thePass);
          $pass2 = sha1($thePass2);

          if($pass1 !== $pass2){
            $formErrors[] = 'The Password Feilds Are Not Match!';
          }
        }
        // Filter The Email
        if(isset($theEmail)){
          $filterEmail = filter_var($theEmail, FILTER_SANITIZE_EMAIL);

          if(filter_var($filterEmail, FILTER_VALIDATE_EMAIL) != true){
            $formErrors[] = 'The Email Is Not Valid!';
          }
        }
        // Check if The User Data Is Right
        if(empty($formErrors)){
          $avatar = rand(1, 1000000) . '_' . $avatarName;
          move_uploaded_file($avatarTmp, "admin\uploads\avatars\\" . $avatar);

          // Check if user exist
          $check = check("Username", "users", $theUser);
          if($check == 1){
            $formErrors[] = 'This user is already exist!';
          } else {
            // Insert user info in database
            $stmt = $con->prepare("INSERT INTO
                                    users(Username,Password,Email,RegStatus,Date, Avatar)
                                    VALUES(:zuser, :zpass, :zmail,0, now(), :zavatar) ");
            $stmt->execute(array(
              'zuser' => $theUser,
              'zpass' => sha1($thePass),
              'zmail' => $theEmail,
              'zavatar' => $avatar
            ));

            // Success echo
            $successMsg = 'Concrats You Have Regestered';
          }
        }
      }
    }

?>

<div class="container log-page">
  <h1 class="text-center"><span class="active" data-class="login">Login</span> | <span data-class="signup">Signup</span></h1>
  <!-- Login form -->
  <form class="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <div class="form-group">
      <input type="text" name="username" class="form-control" autocomplete="off" required='required' placeholder="Type your name">
    </div>
    <div class="form-group">
      <input type="password" name="password" class="form-control" autocomplete="new-password" required='required' placeholder="Type your password">
    </div>
    <div class="form-group">
      <input type="submit" name="login" class="btn btn-primary btn-block" value="Login">
    </div>
  </form>
  <!-- Signup form -->
  <form class="signup" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <input type="text" name="username" class="form-control" autocomplete="off" required='required' placeholder="Type your username">
    </div>
    <div class="form-group">
      <input type="text" name="email" class="form-control" autocomplete="off" required='required' placeholder="Type your email">
    </div>
    <div class="form-group">
      <input maxlength="4" type="password" name="password" class="form-control" autocomplete="new-password" required='required' placeholder="Type your password">
    </div>
    <div class="form-group">
      <input maxlength="4" type="password" name="password2" class="form-control" autocomplete="new-password" required='required' placeholder="Type your password again">
    </div>
    <div class="form-group">
      <input type="file" name="avatar" class="form-control">
    </div>
    <div class="form-group">
      <input type="submit" name="signup" class="btn btn-primary btn-block" value="Login">
    </div>
  </form>
</div>
<div class="errors text-center">
  <?php
    if(!empty($formErrors)){
      foreach ($formErrors as $error) {
        // code...
        echo $error . '<br>';
      }
    }
    if(isset($successMsg)){
      echo "<div class='alert alert-success'>" . $successMsg . "</div>";
    }
  ?>
</div>

<?php ob_end_flush(); ?>
