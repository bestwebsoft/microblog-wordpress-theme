<?php
/**
 * The template for displaying all pages.
 *
 * @subpackage Microblog
 * @since      Microblog
 */
get_header(); ?>
<div id="post-<?php the_ID(); ?>" class="mcrblg-single-container">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="mcrblg-post-image">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} ?>
		</div><!--.mcrblg-post-image-->
		<?php the_content();
		wp_link_pages(
			array(
				'before' => '<div class="mcrblg-page-links"><span>' . __( 'Pages:', 'microblog' ) . ' </span>',
				'after'  => '</div>'
			)
		); ?>
		<?php comments_template( '', true ); ?>
	<?php endwhile; /* end of the loop.*/ ?>
</div><!--.mcrblg-single-container-->
</div><!--.mcrblg-content-container-->
<?php get_sidebar();
get_footer(); ?>