<?php
    session_start();
    $noNav = '';
    include 'init.php';

    if(isset($_SESSION['user'])){
        header('location: dashboard.php');
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Declaring The Main Variables
        $admin = $_POST['username'];
        $pass = $_POST['password'];
        $shaPass = sha1($pass);

        // If User Exist
        if(empty($admin) || empty($pass)){
            echo '<div class="alert alert-danger">لا يمكنك ترك الحقول فارغة</div>';

        } else{
            // Login
            $stmt = "SELECT * FROM admin WHERE name='$admin' AND pass='$pass'";
            $res = mysqli_query($con, $stmt);
            $row = mysqli_num_rows($res);

            // If count > 0 means it's exist in database
            if($row > 0){
                $_SESSION['user'] = $admin; // Regester Session name
                header('location: dashboard.php');
                exit();

            } else{
                echo '<div class="alert alert-danger">البيانات غير صحيحة برجاء اعادة المحاولة</div>';
            }
        }
    }
?>


<div class="login">
    <h1>تسجيل الدخول</h1>
    <form class="form-group" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <input class="form-control" type="text" name="username" placeholder="ادخل اسمك">
        <input class="form-control" type="password" name="password" placeholder="ادخل الباسورد">
        <input class="btn btn-danger" type="submit" name="login" value="Login">
    </form>
</div>

<?php include 'include/footer.php'; ?>