			<!-- Sidebar Widgets Column --> 
			<div class="col-lg-4">
				<div class="side">
					<!-- Categories Widget -->
					<?php if(is_active_sidebar('sidebar')): ?>
						<?php dynamic_sidebar('sidebar'); ?>
					<?php endif; ?>
				</div>
			</div>
		</div> <!-- /.row -->
	</div> <!-- /.container -->
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