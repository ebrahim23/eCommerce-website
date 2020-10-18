<?php
  // Customize The Comments Form
  $comment_form = array(
    'fields' => array(
      'author' => '<div class="form-group"><label>Your Name</label><input class="form-control" id="author" name="author"></div>',
      'email' => '<div class="form-group"><label>Your Email</label><input class="form-control"  id="email" name="email"></div>',
      'url' => '<div class="form-group"><label>Your Website Url</label><input class="form-control"  id="url" name="url"></div>'
    ),
    'comment_notes_before' => '',
    'title_reply' => 'Leave a Comment:',
    'class_submit' => 'btn btn-primary',
    'comment_field' => '<div class="form-group"><textarea class="form-control" name="comment" id="comment"></textarea></div>',
    'class_container' => 'card my-4'
  );
  comment_form($comment_form);

  echo '<ul class="list-unstyled">';
    $comment_list = array(
      'max_depth' => 2,
      'type' => 'comment',
      'avatar_size' => 40
    );

    wp_list_comments($comment_list);
  echo '</ul>';
?>
