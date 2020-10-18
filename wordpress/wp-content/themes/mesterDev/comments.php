<?php
    if(comments_open()){
        echo '<ul class="list-unstyled the-comments">'; ?>
        <h3> <?php comments_number(); ?> </h3>
<?php
        $comments_arguments = array(
            'max_depth' => 2,
            'type' => 'comment',
            'avatar_size' => 40
        );

        wp_list_comments($comments_arguments);
        echo '</ul>';
        
        comment_form();
    }else{
        echo 'sorry comments are disabled';
    }