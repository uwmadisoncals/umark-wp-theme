<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage UW_Madison
 * @since UW-Madison 1.0
 */
?>

	<footer id="colophon" role="contentinfo" class="uw-footer">
		<div class="uw-footer-content">
			<div class="uw-logo">
				<a href="http://www.wisc.edu">
          <svg><desc>University of Wisconsin–Madison logo that links to home page</desc><use xlink:href="#uw-symbol-crest-footer" /></svg>
        </a>
			</div>
      <?php 
        for ($i = 1; $i <= 2; $i++) {

          $uwmadison_footer_menu = wp_get_nav_menu_object( get_theme_mod("uwmadison_footer_menu_$i",null) );

          if ( $uwmadison_footer_menu ) { ?>
              <div>
                <h3 class="uw-footer-header"><?php echo $uwmadison_footer_menu->name ?></h3>
                <?php 
                  wp_nav_menu( 
                    array( 
                      'menu'=>$uwmadison_footer_menu->term_id,
                      'menu_class'=>'',
                      'menu_id'=>'',
                      'container'=>null

                    ) 
                  ); 
                ?>
              </div>
            
        <?php } ?>
      <?php } ?>

			<?php echo uwmadison_footer_contact(); ?>
		</div>

		<div class="uw-copyright">
			<p>&copy; <?php echo date('Y'); ?> Board of Regents of the <a href="http://www.wisconsin.edu" title = "University of Wisconsin System" >University of Wisconsin System</a></p>
		</div>
	</footer>

  <?php wp_footer(); ?>
  <?php echo file_get_contents(__DIR__ . '/images/uw-icons.svg'); ?>
</body>
</html>