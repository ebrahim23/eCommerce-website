<?php
/**
 * The sidebar template file.
 * @package SongWriter
 * @since SongWriter 1.0.0
*/
?>
<?php if (get_theme_mod('songwriter_display_sidebar', songwriter_default_options('songwriter_display_sidebar')) != 'Hide') { ?>
<aside id="sidebar">
<?php if ( dynamic_sidebar( 'sidebar-1' ) ) : else : ?>
<?php endif; ?>
</aside> <!-- end of sidebar -->
<?php } ?>