<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no front-page.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Microblog
 * @since      Microblog
 */
get_header();
if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
		<article id='post-<?php echo $post->ID; ?>' <?php post_class(); ?>>
		<div class="mcrblg-post-info">
			<h1>
				<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
			</h1>
			<?php echo __( 'Posted by', 'microblog' ) . ' '; the_author_posts_link(); echo ' ' . __( 'in', 'microblog' ) . ' '; the_category( ', ' );
			if ( get_the_title() == '' ) { ?>
				<a href="<?php the_permalink() ?>"> <?php _e( 'See post', 'microblog' ); ?></a>
			<?php
			} ?>
		</div><!--.mcrblg-post-info-->
		<div id="post-<?php the_ID(); ?>" <?php post_class( 'mcrblg-index-posts' ); ?> >
			<div class="mcrblg-post-image">
				<?php if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				} ?>
			</div><!--.mcrblg-post-image-->
			<?php the_content(); ?>
			<div class="mcrblg-post-info">
				<?php the_tags(); ?>
			</div><!--.mcrblg-post-info-->
			<?php wp_link_pages( array(
				'before' => '<div class="mcrblg-page-links"><span>' . __( 'Pages:', 'microblog' ) . ' </span>',
				'after'  => '</div>',
			) ); ?>
		</div><!--index_posts-->
		<hr />
		</article>
	<?php endwhile; ?>
	<div class="mcrblg-nav-container">
		<span class="mcrblg-next-post-button"><?php next_posts_link( __( '&#8249; previous posts', 'microblog' ) ); ?></span>
		<span class="mcrblg-previous-post-button"><?php previous_posts_link( __( 'next posts &#8250;', 'microblog' ) ); ?></span>
	</div><!--.nav-container-->
<?php else : ?>
	<p><?php _e( 'Sorry, no matching posts found', 'microblog' ); ?></p>
	<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'microblog' ); ?></p>
	<div class="mcrblg-not-found-form">
		<?php get_search_form(); ?>
	</div><!--.mcrblg-not-found-form-->
<?php endif ?>
</div><!--.mcrblg-content-container-->
<?php get_sidebar();
get_footer();
