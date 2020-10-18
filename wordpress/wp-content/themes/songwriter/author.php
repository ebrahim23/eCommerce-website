<?php
/**
 * The author archive template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
<?php the_post(); ?>
<div class="entry-headline-wrapper">
  <div class="entry-headline-wrapper-inner">
    <h1 class="entry-headline"><?php printf( __( 'Author Archive: %s', 'songwriter' ), '<span class="vcard">' . get_the_author() . '</span>' ); ?></h1>
<?php songwriter_get_breadcrumb(); ?>
  </div>
</div>  
<?php rewind_posts(); ?>
<?php if ( get_the_author_meta( 'description' ) ) : ?>
<div class="entry-content">
  <div class="entry-content-inner"> 
    <div class="archive-meta">
      <div class="author-info">
		    <div class="author-description">
          <div class="author-avatar">
<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'songwriter_author_bio_avatar_size', 60 ) ); ?>
		      </div>
			    <p><?php the_author_meta( 'description' ); ?></p>
		    </div>
		  </div>
    </div>
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