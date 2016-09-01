<?php
/**
 * The Sidebar containing the primary widget area.
 *
 * @subpackage Microblog
 * @since      Microblog
 */
?>
<?php global $current_user; ?>
<div class="mcrblg-fixed">
	<div class="mcrblg-sidebar-container">
		<div class="mcrblg-close_button">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/close_button.png" alt="close" id="mcrblg_close_button">
		</div><!--.mcrblg-close_button-->
			<div class="mcrblg-widget-container">
				<?php wp_nav_menu( 'theme_location=sidebar&menu_class=menu-default&depth=3' ); ?>
			</div><!--.mcrblg-widget-container-->
			<div class="mcrblg-sidebar-line"></div><!--.sidebar-line-->
			<?php if ( ! function_exists( 'dynamic_sidebar' ) || ! dynamic_sidebar() ) : ?>
				<div class="mcrblg-widget-container">
					<?php the_widget( 'WP_Widget_Categories', 'count=1' , 'before_title=<div class="mcrblg-widget-title">&after_title=</div>' ); ?>
				</div><!--.mcrblg-widget-container-->
			<?php endif; ?>
		<div class="mcrblg-void-container-scroll"></div>
	</div><!--.mcrblg-sidebar-container-->
	<div class="mcrblg-userinfo">
		<div class="mcrblg-avatar">
			<?php echo get_avatar( $current_user->ID, 59 ); ?>
		</div><!--.mcrblg-avatar-->
		<?php if ( null != $current_user->display_name ) { ?>
			<p><?php echo __( 'Hi,', 'microblog' ) . ' ' . $current_user->display_name . '!' ?> </p>
		<?php } else { ?>
			<p><?php echo __( 'Hi, guest!', 'microblog' ) ?> </p>
		<?php } ?>
		<div id="mcrblg_gear">
			<p> <a href="<?php echo esc_url( admin_url() ); ?>"><img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/gear.png" alt="settings"></a> </p>
		</div><!--#mcrblg_gear-->
	</div><!--.mcrblg-userinfo-->
	<div class="mcrblg-sidebar-container-normal">
		<div class="mcrblg-menu_button">
			<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/menu_button.png" alt="menu" id="mcrblg_menu_button">
		</div><!--.mcrblg-menu_button-->
		<div class="mcrblg-footer">
			<h5>
				<a class="mcrblg-customize-header" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo get_bloginfo( 'name' ); ?> </a>
			</h5>
			<p class="mcrblg-customize-description">
				<?php echo get_bloginfo( 'description' ); ?>
			</p>
			<div class="mcrblg-sidebar-normal-line"></div><!--.mcrblg-sidebar-normal-line-->
			<p class="mcrblg-upper-case">
				<?php _e( 'Powered by', 'microblog' ); ?>
				<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>">BestWebLayout</a> <?php _e( 'and', 'microblog' ); ?>
				<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>">WordPress</a>
			</p><!--.mcrblg-upper-case-->
		</div><!--.mcrblg-footer-->
	</div><!--.mcrblg-sidebar-container-normal-->
</div><!--.mcrblg-fixed-->
