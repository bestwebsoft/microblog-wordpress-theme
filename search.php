<?php
/**
 * The search template file.
 *
 * @subpackage Microblog
 * @since      Microblog
 */
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="mcrblg-post-info">
		<h1>
			<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
		</h1>
		<?php echo __( 'Posted by', 'microblog' ) . ' '; the_author_posts_link(); echo ' ' . __( 'in', 'microblog' ) . ' '; the_category( ', ' );
		if ( get_the_title() == '' ) { ?>
			<a href="<?php the_permalink() ?>"> <?php _e( 'See post', 'microblog' ); ?></a>
		<?php
		}?>
	</div><!--.mcrblg-post-info-->
	<div id="post-<?php the_ID(); ?>" <?php post_class( 'mcrblg-index-posts' ); ?> >
		<div class="mcrblg-post-image">
			<?php if ( has_post_thumbnail() ) {
				the_post_thumbnail();
			} ?>
		</div><!--.mcrblg-post-image-->
		<?php the_excerpt( ' ' ); ?>
		<div class="mcrblg-post-info">
			<?php the_tags(); ?>
		</div>
	</div><!--index_posts-->
	<hr />
<?php endwhile; ?>
	<div class="mcrblg-nav-container">
		<span class="mcrblg-next-post-button"><?php next_posts_link( __( '&#8249; previous posts', 'microblog' ) ); ?></span>
		<span class="mcrblg-previous-post-button"><?php previous_posts_link( __( 'next posts &#8250;', 'microblog' ) ); ?></span>
	</div><!--.nav-container-->
<?php else: ?>
	<h3><?php _e( 'No matching posts found', 'microblog' ); ?></h3>
	<?php _e( 'Sorry, but nothing matched your search query. Please try again with different keywords.', 'microblog' ); ?>
	<div class="mcrblg-not-found-form">
		<?php get_search_form(); ?>
	</div><!--.mcrblg-not-found-form-->
<?php endif ?>
</div><!--.mcrblg-content-container-->
<?php get_sidebar();
get_footer(); ?>