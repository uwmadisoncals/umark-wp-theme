( function( $ ){
	
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#site-title a' ).html( to );
		} );
	} );

	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#site-description' ).html( to );
		} );
	} );

  wp.customize( 'uwmadison_body_bg', function( value ) {
    value.bind( function( to ) {
      $( 'body' ).toggleClass( 'uw-white-bg uw-light-gray-bg' );
    } );
  } );

  wp.customize( 'uwmadison_header_style', function( value ) {
    value.bind( function( to ) {
      $( '.uw-global-bar' ).toggleClass( 'uw-global-bar-inverse' );
      $( '.uw-main-nav .uw-nav-menu' ).toggleClass( 'uw-nav-menu-reverse' );
      $( '.uw-nav-menu.uw-nav-menu-secondary' ).toggleClass( 'uw-nav-menu-secondary-reverse' );
    } );
  } );

  wp.customize( 'uwmadison_navbar_flat', function( value ) {
    value.bind( function( use ) {
      $( '.uw-global-bar' ).toggleClass( 'uw-global-bar-flat' );
      $( '.uw-main-nav .uw-nav-menu' ).toggleClass( 'uw-nav-menu-flat' );
    } );
  } );

  wp.customize( 'uwmadison_theme_layout', function( value ) {
    value.bind( function( to ) {
    	if (to == "content") {
    		$( 'body' ).removeClass( 'two-column left-sidebar right-sidebar' );
    		$( 'body' ).addClass( 'one-column' );
    	}
    	if (to == "content-sidebar") {
    		$( 'body' ).removeClass( 'one-column left-sidebar' );
    		$( 'body' ).addClass( 'two-column right-sidebar' );
    	}
    	if (to == "sidebar-content") {
    		$( 'body' ).removeClass( 'one-column right-sidebar' );
    		$( 'body' ).addClass( 'two-column left-sidebar' );
    	}
    } );
  } );

  wp.customize( 'uwmadison_use_search', function( value ) {
    value.bind( function( use ) {
    	var searchform = $('#searchform');
      if (use) {
      	searchform.show();
      } else {
      	searchform.hide();
      }
    } );
  } );

  wp.customize( 'uwmadison_use_official_uw_type', function( value ) {
    value.bind( function( use ) {
      $('head link[href*="cloud.typography"]').remove();
      if ( use ) {
        $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'https://cloud.typography.com/6462674/6639152/css/fonts.css') );
      }
    } );
  } );

  wp.customize( 'uwmadison_type_production', function( value ) {
    value.bind( function( use ) {
      var cloud_link = $('head link[href*="cloud.typography"]');

      if ( use ) {
        if (!cloud_link.length)
          // TODO: swap in production URL here
          $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'https://cloud.typography.com/6462674/6639152/css/fonts.css') );
      } else {
        cloud_link.remove();
        // add dev coud link
        $('head').append( $('<link rel="stylesheet" type="text/css" />').attr('href', 'https://cloud.typography.com/6462674/6639152/css/fonts.css') );
      }
      
    } );
  } );

} )( jQuery );