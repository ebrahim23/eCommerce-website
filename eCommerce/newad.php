<?php
  session_start();
  $titlePage = 'Create New Ad';
  include 'init.php';

  if(isset($_SESSION['user'])){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $formErrors = array();

      // Creating Vars
      $name     = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
      $desc     = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
      $price    = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
      $country  = filter_var($_POST['country'], FILTER_SANITIZE_STRING);
      $status   = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
      $cat      = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT);
      $tags     = filter_var($_POST['tags'], FILTER_SANITIZE_STRING);

      if(strlen($name) < 4){
        $formErrors[] = 'You should type a title bigger than 3 characters';
      }
      if(strlen($desc) < 10){
        $formErrors[] = 'You should type at least 10 characters';
      }
      if(empty($price)){
        $formErrors[] = 'You can\'t leave the price empty';
      }
      if(empty($country)){
        $formErrors[] = 'You should type a country';
      }
      if(empty($status)){
        $formErrors[] = 'You can\'t leave the status empty';
      }
      if(empty($cat)){
        $formErrors[] = 'You should choose the category';
      }

      // Insert The Item
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
          'zmember'   => $_SESSION['theUserID'],
          'zcat'      => $cat,
          'ztag'      => $tags
        ));

        // Success echo
        if($stmt){
          $successMsg = 'Item has been Added';
        }
      }
    }
?>

<div class="newad">
  <div class="container">
    <h1 class="text-center"><?php echo $titlePage ?></h1>
    <div class="card mt-3">
      <div class="card-header text-white bg-primary">
        <?php echo $titlePage ?>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-8">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
              <div class="form-group row">
                <label class="col-sm-3 control-label">Name</label>
                <div class="col-sm-9">
                  <input type="text" name="name" class="form-control live-name" required='required'>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label">Description</label>
                <div class="col-sm-9">
                  <input type="text" name="description" class="form-control live-desc" required='required'>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label">Price</label>
                <div class="col-sm-9">
                  <input type="text" name="price" class="form-control live-price" required='required'>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label">Contry</label>
                <div class="col-sm-9">
                  <input type="text" name="country" class="form-control" required='required'>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label">Status</label>
                <div class="col-sm-9">
                  <select class="form-control" name="status">
                      <option value="0">...</option>
                      <option value="1">New</option>
                      <option value="2">Like New</option>
                      <option value="3">Used</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label">Category</label>
                <div class="col-sm-9">
                  <select class="form-control" name="category">
                      <option value="0">...</option>
                      <?php
                        $cats = getAll('*', 'categories', '', '', 'ID');
                        foreach ($cats as $cat) {
                          // code...
                          echo "<option value='" . $cat['ID'] . "'>" . $cat['Name'] . "</option>";
                        }
                      ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-3 control-label">Tags</label>
                <div class="col-sm-9">
                  <input type="text" name="tags" class="form-control" placeholder="Seprate by comma (,)">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-9">
                  <input type="submit" value="Add Item" class="btn btn-primary s-btn">
                </div>
              </div>
            </form>
          </div>
          <div class="col-md-4">
            <div class="item-box live-preview">
              <span class="price">$0</span>
              <img src="layout/images/1.jpg" alt="Avatar">
              <div class="caption">
                <h3>Name</h3>
                <p>Description</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Start Errors -->
        <?php
          if(!empty($formErrors)){
            foreach ($formErrors as $error) {
              // code...
              echo '<div class="alert alert-danger">' . $error . '</div>';
            }
          }
          if(isset($successMsg)){
            echo "<div class='alert alert-success'>" . $successMsg . "</div>";
          }
        ?>
        <!-- Start Errors -->
      </div>
    </div>
  </div>
</div>

<?php
} else{
  header('Location: login.php');
  exit();
}
?>
