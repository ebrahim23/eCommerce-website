<?php get_header() ?>

<!-- The Page -->
<!-- Showcase -->
<div class="showcase">
      <div class="container">
        <div class="over"></div>
        <h1>Wordpress bootstrap theme</h1>
        <p>Wordpress bootstrap theme development and design</p>
        <a href="#" class="btn btn-danger">Learn More</a>
      </div>
    </div>

    <!-- Features -->
    <div class="boxes">
      <div class="container">
        <div class="row">
          <div class="col-md-4">
            <div class="content">
              <i class="fas fa-users fa-3x"></i>
              <h3>Lorem Ipsum Dolor</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque non suscipit tenetur ducimus voluptate commodi. Deleniti pariatur culpa quaerat voluptatum.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="content">
              <i class="fas fa-angry fa-3x"></i>
              <h3>Lorem Ipsum Dolor</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque non suscipit tenetur ducimus voluptate commodi. Deleniti pariatur culpa quaerat voluptatum.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="content">
              <i class="fas fa-award fa-3x"></i>
              <h3>Lorem Ipsum Dolor</h3>
              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque non suscipit tenetur ducimus voluptate commodi. Deleniti pariatur culpa quaerat voluptatum.</p>
            </div>
          </div>
        </div>
      </div>
    </div>


<!-- Footer -->
<footer class="py-3 bg-dark">
	<?php
		wp_nav_menu( array(
			'theme_location'  => 'footer',
			'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
			'container'       => 'div',
			'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
			'walker'          => new WP_Bootstrap_Navwalker(),
		));
    ?>
		<p class="m-0 text-center text-white">Copyright &copy; <?php bloginfo('name') ?> <?php echo Date('Y') ?></p>
	</footer>

	<?php wp_footer(); ?>
</body>
</html>