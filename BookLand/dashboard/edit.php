<?php
    include 'init.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "SELECT * FROM categories WHERE id = '$id'";
        $res = mysqli_query($con, $query);
        $row = mysqli_fetch_assoc($res);
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['name'];
        
        // update values
        $query = "UPDATE categories SET catName='$catName' WHERE id = '$id'";
        $res = mysqli_query($con, $query);
        header('location: cats.php');
        exit();
    }
?>

<form action="edit.php?id=<?php echo $row['id'] ?>" method="POST" class="look-form">
    <input type="text" name="name" value="<?php echo $row['catName'] ?>">
    <input type="submit" value="update" class="sub btn btn-primary">
</form>

<?php include 'include/footer.php'; ?>