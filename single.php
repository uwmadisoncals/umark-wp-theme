<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */

get_header(); ?>

  <main id="main" class="group">
		<div id="primary">
			<div id="content">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'template-parts/content', 'single' ); ?>

					<?php comments_template( '/template-parts/comments.php', true ); ?>

					<nav class="uw-pagination">
						<h3 class="assistive-text"><?php _e( 'Post navigation', 'uw-madison-160' ); ?></h3>
            <div class="uw-pagination-prev-next">
              <span class="uw-pagination-previous"><?php previous_post_link( '%link', __( '<span class="meta-nav">&larr;</span> Previous', 'uw-madison-160' ) ); ?></span>
              <span class="uw-pagination-next"><?php next_post_link( '%link', __( 'Next <span class="meta-nav">&rarr;</span>', 'uw-madison-160' ) ); ?></span>
            </div>
					</nav><!-- #nav-single -->

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #primary -->

    <?php
      $uwmadison_use_sidebar = get_post_meta( $post->ID, '_uwmadison_use_sidebar', true );
      if ( $uwmadison_use_sidebar || !is_numeric( $uwmadison_use_sidebar ) ) {
        get_sidebar();
      }
    ?>

  </main>
<?php get_footer(); ?>