<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */

// $options = uwmadison_get_theme_options();
$current_layout = get_theme_mod('uwmadison_theme_layout');

if ( 'content' != $current_layout ) :
?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php 
				if ( has_post_thumbnail()) { ?>
					<?php 
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
						
						// only bind featherlight lightbox if we have a large enough image to justify doing so
						if ( $large_image_url[1] > 500 ) {
							$featherlight = ' data-featherlight="image"';
						}
					 ?>
					<aside class="widget uw-featured-image">
						<a href="<?php echo $large_image_url[0]; ?>"<?php echo $featherlight; ?>>
							<?php the_post_thumbnail('medium'); ?>
						</a>
					</aside>
					<?php
				}
			 ?>
			<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>

				<aside id="archives" class="widget">
					<h3 class="widget-title"><?php _e( 'Archives', 'uw-madison-160' ); ?></h3>
					<ul>
						<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
					</ul>
				</aside>

				<aside id="meta" class="widget">
					<h3 class="widget-title"><?php _e( 'Meta', 'uw-madison-160' ); ?></h3>
					<ul>
						<?php wp_register(); ?>
						<li><?php wp_loginout(); ?></li>
						<?php wp_meta(); ?>
					</ul>
				</aside>

			<?php endif; // end sidebar widget area ?>
		</div><!-- #secondary .widget-area -->
<?php endif; ?>