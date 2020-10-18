<?php
    session_start();
    $noNav = '';
    $titlePage = 'Login';
    if(isset($_SESSION['username'])){
        header('location: dashboard.php');
    }
    include 'init.php';

    // check if user coming from http post request
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $user = $_POST['username'];
        $pass = $_POST['pass'];
        $hashpass = sha1($pass);

        // check if user exist in database
        $stmt = $con->prepare("SELECT UserID, Username, Password FROM users WHERE Username = ? AND Password = ? AND GroupID = 1 LIMIT 1");
        $stmt->execute(array($user, $hashpass));
        $row = $stmt->fetch();
        $count = $stmt->rowCount();

        // If count > 0 means it's exist in database
        if($count > 0){
            $_SESSION['username'] = $user; // Regester Session name
            $_SESSION['ID'] = $row['UserID']; // Regester Session ID
            header('location: dashboard.php');
            exit();
        }
    }
?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="login">
        <h2 style="color:#FFF" class="text-center">Login Admin</h2>
        <input class="form-control" type="text" name="username" placeholder="Username" autocomplete="off" autofocus>
        <input class="form-control" type="password" name="pass" placeholder="Password">
        <input class="btn btn-success btn-block" type="submit" name="Submit">
    </form>

<?php include $temp . 'footer.php'; ?>
