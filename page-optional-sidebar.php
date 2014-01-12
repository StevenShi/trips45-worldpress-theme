<?php
/**
 * The template for displaying all pages.
 *
 * Template Name: Page Template with Optional Sidebar
 *
 * @package Inkness
 */

get_header(); ?>
	

	<div id="primary" class="content-area col-md-9">
		<main id="main" class="site-main" role="main">
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar('optional'); ?>
<?php get_footer(); ?>