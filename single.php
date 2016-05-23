<?php
/**
 * The Template for displaying all single posts.
 *
 * @subpackage Microblog
 * @since      Microblog
 */
get_header(); ?>
	<div class="mcrblg-single-container">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div id="post-<?php the_ID(); ?>" <?php post_class( 'mcrblg-post-info' ); ?> >
				<?php echo __( 'Posted by', 'microblog' ) . ' '; the_author_posts_link();
				echo ' ' . __( 'in', 'microblog' ) . ' '; the_category( ', ' );
				edit_post_link( __( 'Edit', 'microblog' ), '<span class="mcrblg-edit-post">', '</span>' ); ?>
			</div><!--.mcrblg_post-info-->
				<div class="mcrblg-post-image">
					<?php if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					} ?>
				</div><!--.mcrblg-post-image-->
			<?php the_content(); ?>
			<?php wp_link_pages(
				array(
					'before' => '<div class="mcrblg-page-links"><span>' . __( 'Pages:', 'microblog' ) . ' </span>',
					'after'  => '</div>'
				)
			); ?>
			<div class="mcrblg-post-info">
				<p><?php the_tags(); ?></p>
			</div>
			<div class="mcrblg-nav-container">
				<span class="mcrblg-next-post-button"><?php next_post_link( '%link', __( '&#8249; next post', 'microblog' ) ); ?></span>
				<span class="mcrblg-previous-post-button"><?php previous_post_link( '%link', __( 'prev post &#8250;', 'microblog' ) ); ?></span>
			</div><!--.nav-container-->
			<?php comments_template( '', true ); ?>
		<?php endwhile; /*end of the loop.*/ ?>
	</div><!--.mcrblg_single-container-->
</div><!--.mcrblg-content-container-->
<?php get_sidebar();
get_footer(); ?>