<?php
	defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );
?>
<aside id="sidebar">
	<h2 class="blind">사이드바</h2>

	<div class="widget widget-category">
		<h3 class="widget-title">Category</h3>

		<div class="widget-content">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'blog_categories',
					'container'      => false,
				) );
			?>
		</div>
	</div>
</aside>
