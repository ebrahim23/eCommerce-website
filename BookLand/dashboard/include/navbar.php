<?php
    $query = 'SELECT * FROM admin';
    $res = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($res);
?>

<div class="dashboard text-center">
    <header>
        <h2>صفحة التحكم</h2>
        <div class="me">
            <a class="btn btn-danger" href="/Bookland/layout/">زيارة الموقع</a>
            <a class="btn btn-danger" href="logout.php">تسجيل الخروج</a>
            <a class="btn btn-success"><?php echo $row['name']; ?></a>
        </div>
    </header>