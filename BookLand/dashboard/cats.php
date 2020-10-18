<?php
    include 'init.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $cat = $_POST['cat'];

        if(empty($cat)){
            $false = '<div class="alert alert-danger">برجاء ملئ الحقل</div>';
        } else{
            $query = "INSERT INTO categories(catName) VALUES('$cat')";
            $res = mysqli_query($con, $query);

            if(isset($res)){
                $success = '<div class="alert alert-success">تم اضافة التصنيف بنجاح</div>';
            }
        }
    }
?>
<!-- Delete Category -->
<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "DELETE FROM categories WHERE id='$id'";
        $delete = mysqli_query($con, $query);
    }
?>

<div class="sidebar">
    <a href="look.php">نظرة عامة</a>
    <a href="profile.php">الصفحة الشخصية</a>
    <a class="active" href="cats.php">التصنيفات</a>
    <a href="books.php">الكتب</a>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="look-form">
<?php
    if(isset($false)){
        echo $false;
    }
    if(isset($success)){
        echo $success;
    }
?>
    <label for="cat">اضافة تصنيف جديد</label>
    <input type="text" name="cat" id="cat">
    <input type="submit" value="Add" class="sub btn btn-success">
</form>

<div class="cats-table">
    <table class="table table-dark">
    <thead>
        <tr>
        <th scope="col">الرقم</th>
        <th scope="col">الاسم</th>
        <th scope="col">تاريخ الاضافة</th>
        <th scope="col">التحكم</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $query = "SELECT * FROM categories ORDER BY id DESC";
            $res = mysqli_query($con, $query);
            $num = 0;
            while($row = mysqli_fetch_assoc($res)){
                $num++;
        ?>
            <tr>
            <th> <?php echo $num; ?> </th>
            <td> <?php echo $row['catName']; ?> </td>
            <td> <?php echo $row['catDate']; ?> </td>
            <td>
                <a href="edit.php?id=<?php echo $row['id'] ?>" class="btn btn-success custom-btn">تعديل</a>
                <a href="cats.php?id=<?php echo $row['id'] ?>" class="btn btn-danger custom-btn confirm">حذف</a>
            </td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
</div>

<?php include 'include/footer.php'; ?>