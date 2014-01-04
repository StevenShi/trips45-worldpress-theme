<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Inkness
 */
?>
	<div id="secondary" class="widget-area col-md-3" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-5' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->


