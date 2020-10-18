<?php
/**
 * The archive template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
get_header(); ?>
<?php if ( have_posts() ) : ?>
<div class="entry-headline-wrapper">
  <div class="entry-headline-wrapper-inner">
    <h1 class="entry-headline"><?php if ( is_day() ) :
						printf( __( 'Daily Archive: %s', 'songwriter' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archive: %s', 'songwriter' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'songwriter' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archive: %s', 'songwriter' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'songwriter' ) ) . '</span>' );
					else :
						_e( 'Archive', 'songwriter' );
					endif ;?></h1>
<?php songwriter_get_breadcrumb(); ?>
  </div>
</div>   
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part( 'content', 'archives' ); ?>
<?php endwhile; endif; ?> 
<?php songwriter_content_nav( 'nav-below' ); ?>  
</div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>