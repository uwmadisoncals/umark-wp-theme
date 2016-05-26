<?php

/**
 * Add meta box
 *
 * @param postType $postType The post type
 * @param post $post The post object
 */
function uwmadison_page_options_add_meta_boxes( $postType, $post ){

  // add meta box for post and page types
  if ( !in_array( $postType, array( 'post', 'page' ) ))
    return;

  // check to see if the site is using the two-column layout
  $current_layout = get_theme_mod('uwmadison_theme_layout','content-sidebar');
  if ( in_array( $current_layout, array( 'content-sidebar', 'sidebar-content' ) )) {
    add_meta_box( 'uwmadison_page_options_meta_box', __( 'Page options', 'uw-madison-160' ), 'uwmadison_page_options_meta_box_html', array('page','post'), 'side', 'low' );
  }
}
add_action( 'add_meta_boxes', 'uwmadison_page_options_add_meta_boxes', 10, 2 );

/**
 * Build custom field meta box
 *
 * @param post $post The post object
 */
function uwmadison_page_options_meta_box_html( $post ){
  wp_nonce_field( basename( __FILE__ ), 'uwmadison_page_options_meta_box_nonce' );

  // get current value
  $uwmadison_use_sidebar = get_post_meta( $post->ID, '_uwmadison_use_sidebar', true );

  if ( !is_numeric( $uwmadison_use_sidebar ) ) {
    $uwmadison_use_sidebar = 1;
  }
  ?>
    <p>
      <input type='hidden' value='0' name='uwmadison_use_sidebar'>
      <label>Include sidebar? <input type="checkbox" name="uwmadison_use_sidebar" value="1" <?php checked( $uwmadison_use_sidebar, 1 ); ?> /></label>
    </p>
  <?php

}

/**
 * Store custom field meta box data
 *
 * @param int $post_id The post ID.
 */
function uwmadison_page_options_meta_boxes_data( $post_id, $post ){

  // only persist data for post or page
  if ( !in_array( $post->post_type, array( 'post', 'page' ) ))
    return;

  // verify meta box nonce
  if ( !isset( $_POST['uwmadison_page_options_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['uwmadison_page_options_meta_box_nonce'], basename( __FILE__ ) ) ){
    return;
  }

  // check user permissions
  if ( ! current_user_can( 'edit_post', $post_id ) ){
    return;
  }

  // store page options data
  if ( isset( $_POST['uwmadison_use_sidebar'] ) ) {
    update_post_meta( $post_id, '_uwmadison_use_sidebar', intval($_POST['uwmadison_use_sidebar']) );
  } else {
    delete_post_meta( $post_id, '_uwmadison_use_sidebar' );
  }
}
add_action( 'save_post', 'uwmadison_page_options_meta_boxes_data', 10, 2 );