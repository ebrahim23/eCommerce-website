<?php get_header(); ?>

<!-- Get wordpress posts -->
<div class="container">
    <?php
        if(have_posts()){ // Check if there is any posts
            while(have_posts()){ // Loop through posts
                the_post();
    ?>

    <div class="main-posts single-post">
        <span class="edit"><?php edit_post_link('Edit'); ?></span>
        <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
        <span><i class="demo-icon icon-user"></i><?php the_author_posts_link(); ?></span>
        <span><i class="demo-icon icon-quote-right"></i><?php the_time('F jS, Y'); ?></span>
        <span><i class="demo-icon icon-wechat"></i> <?php comments_popup_link('0 comment', '1 comment'); ?></span>
        <?php the_post_thumbnail('', ['class' => 'img-responsive', 'title' => 'img post']); ?>
        <div><?php the_content(); ?></div>

        <hr>
        <div class="category"><i class="demo-icon icon-tags"></i> <?php the_category(', '); ?></div>
        <div class="category"><i class="demo-icon icon-tags"></i> <?php
            if(has_tag()){
                the_tags();
            } else{
                echo 'Tags: There\'s no tags in here';
            }
        ?></div>
    </div>

    
    <?php
            }
        }
        echo '<div class="pag-posts text-center">';
            if(get_previous_post_link()){
                previous_post_link();
            } else{
                echo '<span>No Previous Page</span>';
            }
            if(get_next_post_link()){
                next_post_link();
            } else{
                echo '<span>No Next Page</span>';
            }
        echo '</div>';
    ?>
    <hr>
    <h4><?php get_the_author_meta('first_name', 'description'); ?></h4>
    <hr>
    <?php comments_template() ?>
</div>


<?php get_footer(); ?>