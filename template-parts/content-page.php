<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="uw-page-header">
		<h1 class="uw-page-title uw-mini-bar"><?php the_title(); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'uw-madison-160' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="entry-meta">
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
