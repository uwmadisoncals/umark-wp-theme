<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 9]>
<html id="ie9" class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8) | !(IE 9)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php echo esc_url( get_template_directory_uri()); ?>/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php
		/* We add some JavaScript to pages with the comment form
		 * to support sites with threaded comments (when in use).
		 */
		if ( is_singular() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

		/* Always have wp_head() just before the closing </head>
		 * tag of your theme, or you will break many plugins, which
		 * generally use this hook to add elements to <head> such
		 * as styles, scripts, and meta tags.
		 */
		wp_head();

		$uwmadison_theme_layout = get_theme_mod('uwmadison_theme_layout','content-sidebar');
		$uwmadison_header_style = get_theme_mod('uwmadison_header_style','uw-white-top-bar');
		$uwmadison_home_hero_img = get_theme_mod('uwmadison_home_hero_img');
		$uwmadison_use_search = get_theme_mod('uwmadison_use_search', false);
	?>
	<!--[if lte IE 9]>
	  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie.css">
	<![endif]-->
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body <?php body_class(); ?>>

	<div class="uw-global-bar <?php echo ($uwmadison_header_style == "uw-white-top-bar") ? "uw-global-bar-inverse" : "" ?>">
		<a class="uw-global-name-link" href="http://www.wisc.edu">U<span>niversity <span class="uw-of">of</span> </span>W<span>isconsin</span>–Madison</a>
	</div>
	<header id="branding" role="banner" class="uw-header <?php echo ($uwmadison_use_search) ? "uw-has-search" : ""; ?>">
		<div class="uw-header-container">
			<div class="uw-header-crest-title">
				<div class="uw-header-crest">
					<a href="http://www.wisc.edu" alt="University of Wisconsin-Madison" title="University of Wisconsin-Madison"><img class="uw-crest-svg" src="<?php echo get_template_directory_uri(); ?>/images/uw-crest.svg" alt="Logo for University of Wisconsin-Madison"></a>
				</div>
				<div class="uw-title-tagline">
					<?php $title_tag = is_front_page() ? "h1" : "div"; ?>
					<<?php echo $title_tag; ?> id="site-title" class="uw-site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo get_bloginfo( 'name' ); ?></a>
					</<?php echo $title_tag; ?>>
					<?php $tagline = get_bloginfo( 'description' ); ?>
					<?php if (!empty($tagline)) { ?>
						<div id="site-description" class="uw-site-tagline"><?php echo $tagline ?></div>
					<?php } ?>
				</div>
			</div>
			<?php 
				if ($uwmadison_use_search) { ?>
					<div class="uw-header-search">
						<?php get_search_form();?>
					</div>
			<?php } ?>
		</div>
	</header><!-- #branding -->
	<button class="uw-mobile-menu-button-bar uw-is-closed <?php echo ($uwmadison_header_style == "uw-white-top-bar") ? "" : "uw-mobile-menu-button-bar-reversed" ?>" data-menu="uw-top-menus" aria-label="Open menu" aria-expanded="false" aria-controls="uw-top-menus"><span>Menu</span><svg aria-hidden="true"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#uw-symbol-menu"></use></svg><svg aria-hidden="true"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#uw-symbol-close"></use></svg></button>

	<div id="uw-top-menus" class="uw-hide-for-mobile" aria-hidden="true">
		<div class="uw-main-nav">
			<?php 
				/* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assigned to the primary location is the one used. If one isn't assigned, the menu with the lowest ID is used. */ 
					$menu_class = "uw-nav-menu";
					$menu_class .= ($uwmadison_header_style == "uw-white-top-bar") ? "" : " uw-nav-menu-reverse";
			?>
			<nav class="<?php echo $menu_class; ?>" role="navigation" aria-label="<?php _e( 'Main Menu', 'uw-madison-160' ); ?>">
				<?php
					wp_nav_menu( 
						array( 
							'theme_location' => 'main_menu',
							'container' => false,
							'menu_id' => "uw-main-nav", 
							'walker' => new Aria_Walker_Nav_Menu()
						)
					); ?>
			</nav>
		</div>
		<div class="uw-secondary-nav">
			<?php
				$menu_class = "uw-nav-menu uw-nav-menu-secondary";
				$menu_class .= ($uwmadison_header_style == "uw-white-top-bar") ? " uw-nav-menu-secondary-reverse" : ""; ?>
				<nav class="<?php echo $menu_class; ?>" role="navigation" aria-label="<?php _e( 'Secondary Menu', 'uw-madison-160' ); ?>">
					<?php
						wp_nav_menu( 
							array( 
								'theme_location' => 'utility_menu',
								'container' => false,
								'menu_id' => "uw-secondary-nav",
								'menu_class' => 'utility-menu',
								'walker' => new Aria_Walker_Nav_Menu(), 
								'fallback_cb' => false
							)
						); 
					?>
				</nav>
		</div>
	</div>

	<?php if ( isset($uwmadison_home_hero_img) && is_front_page() ) { ?>
		<?php 
			$out = '<div class="uw-hero">';
			$out .= wp_get_attachment_image( $uwmadison_home_hero_img, 'uw-hero' );
			$out .= '</div>';

	    /**
	     * Filter the hero image HTML block
	     *
	     * @param String $out The default HTML output
	     * @param Integer $uwmadison_home_hero_img The image attachment ID for the hero image as set in the theme Customizer
	     */
			echo apply_filters( 'uw_hero_image', $out, $uwmadison_home_hero_img );
		?>
	<?php } ?>
