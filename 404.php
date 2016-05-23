<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @subpackage Microblog
 * @since      Microblog
 */
get_header(); ?>
	<div class="mcrblg-single-container">
		<p><?php _e( 'Sorry, unfortunately, we could not find the requested page.', 'microblog' ); ?></p>
		<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'microblog' ); ?></p>
		<div class="mcrblg-not-found-form">
			<?php get_search_form(); ?>
		</div><!--.mcrblg-not-found-form-->
	</div><!--.mcrblg-single-container-->
</div><!--.content-container-->
<?php get_sidebar();
get_footer(); ?>