<?php get_header(); ?>

<!-- Get wordpress posts -->
<div class="container">
    <div class="row">
        <?php
            if(have_posts()){ // Check if there is any posts
                while(have_posts()){ // Loop through posts
                    the_post();
        ?>
                    
                    <div class="col-sm-6">
                        <div class="main-posts">
                            <h2><a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                            <span><i class="demo-icon icon-user"></i><?php the_author_posts_link(); ?></span>
                            <span><i class="demo-icon icon-quote-right"></i><?php the_time('F jS, Y'); ?></span>
                            <span><i class="demo-icon icon-wechat"></i> <?php comments_popup_link('0 comment', '1 comment'); ?></span>
                            <?php the_post_thumbnail('', ['class' => 'img-responsive', 'title' => 'img post']); ?>
                            <div><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>"> Read more</a>
                            
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
                    </div>
        <?php
                }
            }
            echo '<div class="pag-posts text-center">';
                if(get_previous_posts_link()){
                    previous_posts_link('Prev');
                } else{
                    echo '<span>No Previous Page</span>';
                }
                if(get_next_posts_link()){
                    next_posts_link('Next');
                } else{
                    echo '<span>No Next Page</span>';
                }
            echo '</div>';
        ?>
    </div>
</div>

<?php get_footer(); ?>