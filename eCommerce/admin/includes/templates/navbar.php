<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="dashboard.php"><?php echo lang('HOMAPAGE'); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item"><a class="nav-link" href="categories.php"><?php echo lang('CATS'); ?></a></li>
      <li class="nav-item"><a class="nav-link" href="items.php"><?php echo lang('ITEMS'); ?></a></li>
      <li class="nav-item"><a class="nav-link" href="members.php"><?php echo lang('MEMBER'); ?></a></li>
      <li class="nav-item"><a class="nav-link" href="comments.php"><?php echo lang('COMMENT'); ?></a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo lang('USERNAME'); ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="members.php?action=Edit&userid=<?php echo $_SESSION['ID'] ?>"><?php echo lang('EDIT_PROF'); ?></a>
          <a class="dropdown-item" href="../index.php"><?php echo lang('INDEX'); ?></a>
          <a class="dropdown-item" href="#"><?php echo lang('SETTINGS'); ?></a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php"><?php echo lang('OUT'); ?></a>
        </div>
      </li>
    </ul>
  </div>
</nav>
