<?php
/**
 * The template for displaying search forms in UW-Madison
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */
?>
	<form role="search" class="uw-search-form" method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'uw-madison-160' ); ?></label>
		<input type="text" class="field uw-search-input" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'uw-madison-160' ); ?>" />
		<input type="submit" class="submit uw-search-submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'uw-madison-160' ); ?>" />
	</form>
