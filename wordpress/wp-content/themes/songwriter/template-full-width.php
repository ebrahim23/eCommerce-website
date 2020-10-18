<?php
/**
 * Template Name: Full Width
 * The template file for pages without right sidebar.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="entry-headline-wrapper">
  <div class="entry-headline-wrapper-inner">
    <h1 class="entry-headline"><?php the_title(); ?></h1>
<?php songwriter_get_breadcrumb(); ?>
  </div>
</div>
<div class="entry-content">
  <div class="entry-content-inner">
<?php songwriter_get_display_image_page(); ?>
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'songwriter' ) . '</span>', 'after' => '</p>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'songwriter' ), '<p>', '</p>' ); ?>
<?php endwhile; endif; ?>
  </div>
</div>
<?php comments_template( '', true ); ?>  
</div> <!-- end of content -->
<?php get_footer(); ?>