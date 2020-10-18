<?php
    include 'init.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        $name = $_POST['adminName'];
        $mail = $_POST['adminMail'];
        $pass = $_POST['adminPass'];
        $shaPass = sha1($pass);

        $query = "UPDATE admin SET
                    name='$name', email='$mail', pass='$pass' WHERE id='1'";
        $res = mysqli_query($con, $query);
        header("REFRESH:0");
        exit();
    }
?>
    <div class="sidebar">
        <a class="active" href="look.php">نظرة عامة</a>
        <a href="profile.php">الصفحة الشخصية</a>
        <a href="cats.php">التصنيفات</a>
        <a href="books.php">الكتب</a>
    </div>
    <form class="look-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
    <?php
        $query = 'SELECT * FROM admin';
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
    ?>
        <label for="name">تعديل بياناتك</label>
        <input type="text" name="adminName" id="name" placeholder="اكتب الاسم الجديد" value="<?php echo $row['name']; ?>">
        <input type="text" name="adminMail" placeholder="اكتب الايميل الجديد" value="<?php echo $row['email']; ?>">
        <input type="password" name="adminPass" placeholder="ادخل الباسورد الجديد" value="<?php echo $row['pass']; ?>">
        <input class="sub btn btn-success" type="submit" value="Save">
    </form>

<?php include 'include/footer.php'; ?>