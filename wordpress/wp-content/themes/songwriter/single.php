<?php
/**
 * The post template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<div class="entry-headline-wrapper">
  <div class="entry-headline-wrapper-inner">
    <h1 class="entry-headline title single-title entry-title"><?php the_title(); ?></h1>
<?php songwriter_get_breadcrumb(); ?>
  </div>
</div>
<div class="entry-content">
  <div class="entry-content-inner">
<?php songwriter_get_display_image_post(); ?>
<?php if ( get_theme_mod('songwriter_display_meta_post', songwriter_default_options('songwriter_display_meta_post')) != 'Hide' ) { ?>
    <p class="post-meta">
      <span class="post-info-author vcard author"><i class="icon_pencil-edit" aria-hidden="true"></i><span class="fn"><?php the_author_posts_link(); ?></span></span>
      <span class="post-info-date post_date date updated"><i class="icon_clock_alt" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
<?php if ( comments_open() ) : ?>
      <span class="post-info-comments"><i class="icon_comment_alt" aria-hidden="true"></i><a href="<?php comments_link(); ?>"><?php printf( _n( '1 Comment', '%1$s Comments', get_comments_number(), 'songwriter' ), number_format_i18n( get_comments_number() ), get_the_title() ); ?></a></span>
<?php endif; ?>
    </p>
    <div class="post-info">
      <p class="post-category"><span class="post-info-category"><i class="icon_folder-alt" aria-hidden="true"></i><?php the_category(', '); ?></span></p>
      <p class="post-tags"><?php the_tags( '<span class="post-info-tags"><i class="icon_tag_alt" aria-hidden="true"></i>', ', ', '</span>' ); ?></p>
    </div>
<?php } ?>
<?php the_content(); ?>
<?php wp_link_pages( array( 'before' => '<p class="page-link"><span>' . __( 'Pages:', 'songwriter' ) . '</span>', 'after' => '</p>' ) ); ?>
<?php edit_post_link( __( 'Edit', 'songwriter' ), '<p>', '</p>' ); ?>
<?php endwhile; endif; ?>
<?php if ( get_theme_mod('songwriter_next_preview_post', songwriter_default_options('songwriter_next_preview_post')) != 'Hide' ) { ?>
<?php songwriter_prev_next('songwriter-post-nav'); ?>
<?php } ?>
  </div>
</div>
<?php comments_template( '', true ); ?>   
</div> <!-- end of content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>