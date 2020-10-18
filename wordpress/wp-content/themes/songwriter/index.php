<?php
/**
 * The main template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
get_header(); ?>   
    <section class="home-latest-posts">
      <div class="entry-headline-wrapper">
        <div class="entry-headline-wrapper-inner">
          <h1 class="entry-headline"><?php if(get_theme_mod('songwriter_latest_posts_headline', songwriter_default_options('songwriter_latest_posts_headline')) == '') { ?><?php _e( 'Latest Posts' , 'songwriter' ); ?><?php } else { echo esc_attr(get_theme_mod('songwriter_latest_posts_headline', songwriter_default_options('songwriter_latest_posts_headline'))); } ?></h1>
        </div>
      </div>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?>
<?php songwriter_content_nav( 'nav-below' ); ?>
    </section>   
</div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>