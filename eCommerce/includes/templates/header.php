<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $css; ?>bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo $css; ?>front.css?v=<?php echo time(); ?>" />
    <title><?php echo getTitle() ?></title>
  </head>
  <body>
    <div class="upper-bar">
      <?php
        if(isset($_SESSION['user'])){ ?>

      <img src="layout/images/2.jpg" class="avatar rounded-circle" alt="Avatar">
      <div class="btn-group pull-right">
        <span class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          <?php echo $sessionUser ?>
          <span class="caret"></span>
        </span>
        <ul class="dropdown-menu">
          <li><a href="profile.php">My Profile</a></li>
          <li><a href="newad.php">New Item</a></li>
          <li><a href="profile.php#my-items">My Items</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </div>
      <?php } else{ ?>
        <a href="login.php" class="login">Login|Signup</a>
      <?php } ?>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
      <a class="navbar-brand" href="index.php"><?php echo lang('HOMAPAGE'); ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <?php
            $cats = getAll("*", "categories", "where parent = 0", "", "ID", "ASC");

            foreach ($cats as $cat) {
              // code...
              echo '<li class="nav-item"><a class="nav-link" href="categories.php?pgid=' . $cat['ID'] . '">' . $cat['Name'] . '</a></li>';
            }
          ?>
        </ul>
      </div>
    </nav>

    <div class="footer"></div>

    <script src="<?php echo $js; ?>jquery-3.2.1.min.js" ></script>
    <script src="<?php echo $js; ?>popper.min.js" ></script>
    <script src="<?php echo $js; ?>bootstrap.min.js" ></script>
    <script src="<?php echo $js; ?>front.js" ></script>
  </body>
</html>
