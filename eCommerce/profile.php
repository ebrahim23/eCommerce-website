<?php
  session_start();
  $titlePage = 'Profile';
  include 'init.php';

  if(isset($_SESSION['user'])){
    $getuser = $con->prepare("SELECT * FROM users WHERE Username = ?");
    $getuser->execute(array($sessionUser));
    $info = $getuser->fetch();
    $userid = $info['UserID'];
?>

<div class="info">
  <div class="container">
    <h1 class="text-center">My Profile</h1>
    <div class="card mt-3">
      <div class="card-header text-white bg-primary">
        my Information
      </div>
      <div class="card-body">
        <ul class="list-unstyled prof-info">
          <li>
            <i class="fa fa-unlock fa-fw"></i>
            <span>Name:</span> <?php echo $info['Username']; ?>
          </li>
          <li>
            <i class="fa fa-envelope-o fa-fw"></i>
            <span>Email:</span> <?php echo $info['Email']; ?>
          </li>
          <li>
            <i class="fa fa-user fa-fw"></i>
            <span>Fullname:</span> <?php echo $info['Fullname']; ?>
          </li>
          <li>
            <i class="fa fa-calendar fa-fw"></i>
            <span>Date:</span> <?php echo $info['Date']; ?>
          </li>
          <li>
            <i class="fa fa-star fa-fw"></i>
            <span>Favoeite Category:</span>
          </li>
        </ul>
        <a class="btn btn-info" href="#!">Edit Information</a>
      </div>
    </div>
  </div>
</div>
<div class="ads">
  <div class="container">
    <div class="card mt-3">
      <div id="my-items" class="card-header text-white bg-primary">
        My Items
      </div>
      <div class="card-body">
        <?php
          $items = getAll("*", "items", "where Member_Id = $userid", "", "ItemID");
          if(!empty($items)) {
            echo '<div class="row">';
            foreach ($items as $item) {
              echo '<div class="col-sm-6 col-md-3">';
                echo '<div class="item-box">';
                if($item['Approve'] == 0){ echo '<div class="no-approve"><i class="fa fa-trash"></i>&nbsp;Waiting For Approval</div>'; }
                  echo '<span class="price">$' . $item['Price'] . '</span>';
                  echo '<img src="layout/images/1.jpg" alt="Avatar">';
                  echo '<div class="caption">';
                    echo '<h3><a href="items.php?itemid='. $item['ItemID'] .'">'. $item['Name'] .'</a></h3>';
                    echo '<p>'. $item['Description'] .'</p>';
                    echo '<div class="span-date">'. $item['Date'] .'</div>';
                  echo '</div>';
                echo '</div>';
              echo '</div>';
            }
            echo '</div>';
          } else {
            echo 'There is no Ads to show Go To Add one <a href="newad.php">Create Ad</a>';
          }
        ?>
      </div>
    </div>
  </div>
</div>
<div class="comments">
  <div class="container">
    <div class="card mt-3">
      <div class="card-header text-white bg-primary">
        My Comments
      </div>
      <div class="card-body">
        <?php
          $stmt = $con->prepare("SELECT comment FROM comments WHERE UserID = ?");
          $stmt->execute(array($info['UserID']));

          $comments = $stmt->fetchAll();

          if(!empty($comments)) {
            foreach ($comments as $comment) {
              // code...
              echo '<p>' . $comment['comment'] . '</p>';
            }
          } else {
            echo 'There\'s no comments to show';
          }
        ?>
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
