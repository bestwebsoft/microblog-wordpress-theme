<?php
/**
 * The template for displaying search forms in Microblog
 *
 * @subpackage Microblog
 * @since      Microblog
 */
?>
<div class="mcrblg-searchform-wrapper">
	<div class="mcrblg-searchform-container">
		<form role="search" method="get" autocomplete="off" action="<?php echo esc_url( home_url( '/' ) ) ?>">
			<label class="mcrblg-searchform-text" for="s"></label>
			<input type="text" placeholder="" name="s" id="s">
			<input type="submit" class="mcrblg-searchsubmit" value="">
		</form>
	</div><!--#searchform-container-->
	<img class="mcrblg-search-button" src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/search_button.png" alt="search">
</div><!--.searchform-wrapper-->