<?php
/**
 * The category archive template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
<div class="entry-headline-wrapper">
  <div class="entry-headline-wrapper-inner">
    <h1 class="entry-headline"><?php single_cat_title(); ?></h1>
<?php songwriter_get_breadcrumb(); ?>
  </div>
</div>
<?php if ( category_description() ) : ?>
<div class="entry-content">
  <div class="entry-content-inner">   
    <div class="category-description"><?php echo category_description(); ?></div>
  </div>
</div>
<?php endif; ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?> 
<?php songwriter_content_nav( 'nav-below' ); ?>  
</div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>