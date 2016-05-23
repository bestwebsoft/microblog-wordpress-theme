<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @subpackage Microblog
 * @since      Microblog
 */
if ( post_password_required() )
	return; ?>
<div id="mcrblg_comments" class="mcrblg-comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="mcrblg-post-info">
			<?php
			printf( _n( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'microblog' ), number_format_i18n( get_comments_number() ),
			'<span>' . get_the_title() . '</span>' );
			?>
		</h2><!--.mcrblg-post-info-->
		<ol class="mcrblg-commentlist">
			<?php wp_list_comments( array( 'callback' => 'microblog_comment', 'style' => 'li' ) ); ?>
		</ol><!-- .mcrblg-commentlist-->
		<div class="mcrblg-nav-container">
			<div class="mcrblg-next-post-button"><?php previous_comments_link( __( '&#8249; Previous Comments', 'microblog' ) ); ?></div>
			<div class="mcrblg-previous-post-button"><?php next_comments_link( __( 'Next Comments &#8250;', 'microblog' ) ); ?></div>
		</div><!--.mcrblg-nav-container-->
		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
			<p class="mcrblg-nocomments">
				<?php _e( 'Comments are closed.', 'microblog' ); ?>
			</p><!--.mcrblg-nocomments-->
		<?php endif; /*!comments open*/
	endif; /*have_comments() closed*/
	comment_form(); ?>
</div><!--.mcrblg-comments-area -->