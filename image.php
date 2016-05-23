<?php
/**
 * The Template for displaying image attachments.
 *
 * @subpackage Microblog
 * @since      Microblog
 */
get_header(); ?>
	<div class="mcrblg-single-container">
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="mcrblg-post-info">
				<h1><?php the_title(); ?></h1>
				<?php echo __( 'Posted by', 'microblog' ) . ' '; the_author_posts_link(); ?>
			</div><!--.mcrblg_post-info-->
			<div class="mcrblg-image-attachment">
				<div class="mcrblg-nav-container">
					<div class="mcrblg-previous-post-button"><?php next_image_link( false, __( 'Next &#8250;', 'microblog' ) ); ?></div>
					<div class="mcrblg-next-post-button"><?php previous_image_link( false, __( '&#8249; Previous', 'microblog' ) ); ?></div>
				</div><!--.mcrblg-nav-container-->
				<?php
				$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
				foreach ( $attachments as $i => $attachment ) {
					if ( $attachment->ID == $post->ID )
						break;
				}
				$i ++;
				/* If there is more than 1 attachment in a gallery */
				if ( count( $attachments ) > 1 ) {
					if ( isset( $attachments[$i] ) )
						/* Get the URL of the next image attachment */
						$next_attachment_url = get_attachment_link( $attachments[$i]->ID );
					else
						/* Or get the URL of the first image attachment */
						$next_attachment_url = get_attachment_link( $attachments[0]->ID );
				} else {
					/* Or, if there's only 1 image, get the URL of the image */
					$next_attachment_url = wp_get_attachment_url();
				} ?>
				<div class="mcrblg-post-image">
					<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
						<?php echo wp_get_attachment_image( $post->ID, 'full' ); ?>
					</a>
				</div><!--.mcrblg-post-image-->
				<?php if ( ! empty( $post->post_excerpt ) ) : ?>
					<div class="mcrblg-entry-caption">
						<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
						<?php $attachment = get_posts(
								array(
										'post_type'   => 'attachment',
										'post_parent' => $post->ID
								)
						);
						if ( $attachment ) {?>
							 <p class="mcrblg-img-descr">
								 <?php echo $attachment[0]->post_excerpt ?>
							 </p><!--.mcrblg-img-descr-->
						<?php }
						the_excerpt(); ?>
					</div><!-- .mcrblg-entry-caption -->
				<?php endif; ?>
			</div><!-- .mcrblg-image-attachment -->
			<?php the_content();
			wp_link_pages(
				array(
					'before' => '<div class="mcrblg-page-links"><span>' . __( 'Pages:', 'microblog' ) . ' </span>',
					'after'  => '</div>'
				)
			); ?>
			<div class="mcrblg-post-info">
				<p><?php the_tags(); ?></p>
			</div><!--.mcrblg-post-info-->
			<div class="mcrblg-nav-container">
				<span class="mcrblg-next-post-button"><?php next_post_link( '%link', __( '&#8249; FORWARD', 'microblog' ) ); ?></span>
				<span class="mcrblg-previous-post-button"><?php previous_post_link( '%link', __( 'BACK &#8250;', 'microblog' ) ); ?></span>
			</div><!--.nav-container-->
			<?php comments_template( '', true );
		endwhile; /* end of the loop.*/ ?>
	</div><!--.mcrblg_single-container-->
</div><!--.mcrblg-content-container-->
<?php get_sidebar();
get_footer(); ?>