<!-- Blog Post -->
<div class="card mb-4 mt-4">
  <p class="img-thumb"><?php if(has_post_thumbnail()){
    the_post_thumbnail();
  } ?></p>
  <div class="card-body">

    <?php if(is_single()): ?>
      <h2 class="card-title"><?php the_title(); ?></h2>
    <?php else: ?>
      <h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php endif; ?>
    
    <?php if(is_single()): ?>
      <p class="card-text"><?php the_content(); ?></p>
    <?php else: ?>
      <p class="card-text"><?php the_excerpt(); ?></p>
    <?php endif; ?>

    <?php if(! is_single()): ?>
      <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More &rarr;</a>
    <?php endif; ?>

  </div>
  <?php if(! is_single()): ?>
    <div class="card-footer">
      Posted on <?php the_date(); ?> by
      <a href="#"><?php the_author(); ?></a>
    </div>
  <?php endif; ?>
</div>

<?php if(is_single()):
  comments_template();
endif; ?>