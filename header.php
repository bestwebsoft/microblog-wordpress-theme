<?php /* The Header for our theme.
*
* Displays all of the <head> section
	*
	* @subpackage Microblog
	* @since Microblog
	*/
?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge" charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name=viewport content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"/>
	<?php wp_head(); ?>
</head>
<body id="mcrblg_body" <?php body_class(); ?>>
	<div class="mcrblg-header-image">
		<?php if ( get_header_image() != '' ) { ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<img src="<?php header_image(); ?>" alt="mcrblg-header-image">
			</a>
		<?php } ?>
	</div>
	<div class="mcrblg-head-content mcrblg-disable-overflow">
		<hr class="mcrblg-ie-hr mcrblg-display-none">
		<div class="mcrblg-shadow-box mcrblg-disable-overflow">
			<?php get_search_form() ?>
			<div class="mcrblg-latest-posts">
				<p>
					<?php if ( is_home() ) : /*headers in searchform*/
						echo( __( 'Latest posts', 'microblog' ) );
					elseif ( is_archive() ) :
						the_archive_title();
					elseif ( is_search() ) :
						global $wp_query;
						printf( __( 'Search results: %1$s matches on', 'microblog' ) . ' ', $wp_query->found_posts ); the_search_query();
					elseif ( is_404() ) :
						_e( '404: Page not found', 'microblog' );
					else :
						the_title();
					endif; ?>
				</p>
			</div><!--.mcrblg-latest-posts-->
		</div><!--.mcrblg-shadow-box-->
		<hr class="mcrblg-ie-hr mcrblg-display-none">
	</div><!-- .mcrblg-head-content -->
	<div class="mcrblg-content-container">
