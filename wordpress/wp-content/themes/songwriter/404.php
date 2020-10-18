<?php
/**
 * The 404 page (Not Found) template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
get_header(); ?>
<div class="entry-headline-wrapper">
  <div class="entry-headline-wrapper-inner">
    <h1 class="entry-headline"><?php _e( 'Nothing Found', 'songwriter' ); ?></h1>
<?php songwriter_get_breadcrumb(); ?>
  </div>
</div>
<div class="entry-content">
  <div class="entry-content-inner">
    <p><?php _e( 'Apologies, but no results were found for your request. Perhaps searching will help you to find a related content.', 'songwriter' ); ?></p>
<?php get_search_form(); ?>
  </div>
</div>  
</div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>