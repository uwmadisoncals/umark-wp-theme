<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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

					<?php get_template_part( 'template-parts/content', 'page' ); ?>

					<?php comments_template( '/template-parts/comments.php', true ); ?>

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