<?php get_header() ?>

<!-- Page Content -->
<div class="container">
  <div class="row">
    <!-- Blog Entries Column -->
    <div class="col-lg-8">
      <h1 class="mb-4 mt-2">All
        <small>Posts</small>
      </h1>
      <?php 
        if(have_posts()){
          while(have_posts()) : the_post();
          get_template_part('content');
        endwhile; } ?>

      <!-- Pagination -->
      <ul class="pagination mb-4">
        <li class="page-item">
          <!-- <a class="page-link" href="#">Newer</a> -->
          <?php if(get_previous_posts_link()): ?>
            <?php previous_posts_link('Newer'); ?>
          <?php else: echo '<span class="disabled">Newer</span>' ?>
          <?php endif; ?>
        </li>
        <li class="page-item">
          <!-- <a class="page-link" href="#">Older</a> -->
          <?php if(get_next_posts_link()): ?>
            <?php next_posts_link('Older'); ?>
          <?php else: echo '<span class="disabled">Newer</span>' ?>
          <?php endif; ?>
        </li>
      </ul>
    </div>

<?php get_footer() ?>