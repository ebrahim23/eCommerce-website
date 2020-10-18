<?php
  ob_start();
  session_start();
  $titlePage = 'Show Items';
  include 'init.php';

  $itemid = isset($_GET['itemid']) && is_numeric($_GET['itemid']) ? intval($_GET['itemid']) : 0;

  $stmt = $con->prepare("SELECT
                            items.*, categories.Name AS Cat_Name, users.Username
                          FROM
                            items
                          INNER JOIN
                            categories
                          ON
                            categories.ID = items.Cat_ID
                          INNER JOIN
                            users
                          ON
                            users.UserID = items.Member_ID
                          WHERE
                            ItemID = ?
                          AND
                            Approve = 1");
  $stmt->execute(array($itemid));
  $count = $stmt->rowCount();
  if($count > 0){
  $item = $stmt->fetch();
?>

<h1 class="text-center"><?php echo $item['Name'] ?></h1>
<div class="container">
  <div class="row showad">
    <div class="col-md-4">
      <img src="layout/images/1.jpg" class="img-thumbnail" alt="Avatar">
    </div>
    <div class="col-md-8">
      <h2><?php echo $item['Name'] ?></h2>
      <p><i class="fa fa-arrow-right fa-fw"></i><?php echo ' ' . $item['Description'] ?></p>
      <div><i class="fa fa-calendar fa-fw"></i><span> Added Date:</span> <?php echo ' ' . $item['Date'] ?></div>
      <div><i class="fa fa-money fa-fw"></i><span> Price:</span> <?php echo '$'. $item['Price'] ?></div>
      <div><i class="fa fa-flag fa-fw"></i><span> Made In:</span> <?php echo $item['Country'] ?></div>
      <div><i class="fa fa-tags fa-fw"></i><span> Category:</span> <a href="categories.php?pgid=<?php echo $item['Cat_ID'] ?>"><?php echo $item['Cat_Name'] ?></a></div>
      <div><i class="fa fa-plus fa-fw"></i><span> Added By:</span> <a href="#"> <?php echo $item['Username'] ?></a></div>
      <div><i class="fa fa-star fa-fw"></i><span> All Tags:</span>
        <?php
          $theTags = explode(",", $item['Tags']);
          foreach ($theTags as $tag) {
            echo "<a href='tags.php?name={$tag}'>" . $tag . "</a>";
          }
        ?>
    </div>
    </div>
  </div>
  <hr>
  <?php if(isset($_SESSION['user'])){ ?>
  <!-- Start Add Comments -->
  <div class="row">
    <div class="offset-md-4">
      <div class="the-comment">
        <h3>Add Your Comment</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] . '?itemid=' . $item['ItemID'] ?>" method="post">
          <textarea name="comment" required></textarea>
          <input type="submit" class="btn btn-primary" value="Add Comment">
        </form>
        <?php
          if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
            $iditem = $item['ItemID'];
            $iduser = $item['Member_ID'];

            if(!empty($comment)){
              $stmt = $con->prepare("INSERT INTO
                        comments(Comment, Status, Date, ItemID, UserID)
                        VALUES(:hcomment, 0, now(), :hitemid, :huserid)");

              $stmt->execute(array(
                'hcomment' => $comment,
                'hitemid' => $iditem,
                'huserid' => $iduser
              ));
            }
            if($stmt){
              echo '<div class="alert alert-success">Comment has been added successfuly</div>';
            } else{
              echo '<div class="alert alert-danger">Faild in adding the comment</div>';
            }
          }
        ?>
      </div>
    </div>
  </div>
  <?php } else{
    echo '<a href="login.php">Login</a> Or Regester To Add Comments';
  } ?>
  <hr>
  <?php
    $stmt = $con->prepare("SELECT
                                comments.*, users.Username AS Member
                            FROM
                                comments
                            INNER JOIN
                                users
                            ON
                                users.UserID = comments.UserID
                            WHERE
                                ItemID = ?
                            AND
                                Status = 1
                            ORDER BY
                                cID DESC");
    $stmt->execute(array($item['ItemID']));

    $comments = $stmt->fetchAll();
  ?>
    <?php foreach ($comments as $comment) { ?>
        <div class="comment-box">
          <div class="row">
            <div class="col-sm-2 text-center">
              <img class="img-responsive block-center rounded-circle img-thumbnail" src="layout/images/1.jpg" alt="">
              <span><?php echo $comment['Member'] ?></span>
            </div>
            <div class="col-sm-10">
              <p><?php echo $comment['Comment'] ?></p>
            </div>
          </div>
          <hr>
        </div>
      <?php } ?>
</div>

<?php
} else{
  $theMsg = '<div class="alert alert-danger war-msg">There is no such id &nbsp; <strong>Or</strong> &nbsp; this item is waiting for approval</div>';
  redirectFunc($theMsg, 'back');
}
  ob_end_flush();
?>
