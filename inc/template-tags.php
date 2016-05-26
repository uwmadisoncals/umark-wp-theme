<?php

if ( ! function_exists( 'uwmadison_continue_reading_link' ) ) :
  /**
   * Returns a "Continue Reading" link for excerpts
   *
   * @return String HTML for continue reading link
   **/
  function uwmadison_continue_reading_link() {
    return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'uw-madison-160' ) . '</a>';
  }
endif;


if ( ! function_exists( 'uwmadison_content_nav' ) ) :
  /**
   * Prints navigation to next/previous pages when applicable
   *
   * @param String $nav_id Name for id attribute to be applied to <nav> element
   *
   **/
  function uwmadison_content_nav( $nav_id='' ) {
    global $wp_query;

    if ( $wp_query->max_num_pages > 1 ) : ?>
      <?php $id_attr = ( isset($nav_id) ) ? 'id="'. $nav_id .'"' : '' ?>
      <nav <?php echo $id_attr; ?> class="uw-pagination">
        <h3 class="assistive-text"><?php _e( 'Post navigation', 'uw-madison-160' ); ?></h3>
        <div class="uw-pagination-prev-next">
          <span class="uw-pagination-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'uw-madison-160' ) ); ?></span>
          <span class="uw-pagination-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'uw-madison-160' ) ); ?></span>
        </div>
      </nav><!-- #nav-above -->
    <?php endif;
  }
endif; // uwmadison_content_nav


if ( ! function_exists( 'uwmadison_footer_contact' ) ) :
  /**
   * Prints contact info and social media links based on theme options
   * set via the Customizer.
   *
   **/
  function uwmadison_footer_contact() {
    $uwmadison_email = get_theme_mod( "uwmadison_email" );
    $uwmadison_phone = get_theme_mod( "uwmadison_phone" );
    $uwmadison_social = get_theme_mod( "uwmadison_social" );

    // return if none of the footer options have been set
    if (
        empty($uwmadison_email) &&
        empty($uwmadison_phone) &&
        no_social_links($uwmadison_social) 
      ) {
      return false;
    } else {
      $output = '
      <div class="uw-footer-contact">
        <h3 class="uw-footer-header">Contact Us</h3>
        <ul class="uw-contact-list">';
      if (!empty($uwmadison_email))
        $output .= "<li class=\"uw-contact-item\">Email: <a href=\"mailto:$uwmadison_email\">$uwmadison_email</a></li>\n";
      if (!empty($uwmadison_phone))
        $output .= "<li class=\"uw-contact-item\">Phone: <a href=\"tel:$uwmadison_phone\">$uwmadison_phone</a></li>\n";
      if (!empty($uwmadison_social)) {
        $output .= '<li><ul class="uw-social-icons">';

        foreach ($uwmadison_social as $key => $value) {
          if ( !empty($value) ) {
            $output .= "<li id=\"uw-icon-$key\" class=\"uw-social-icon\"><a aria-label=\"$key\" href=\"$value\"><svg aria-hidden=\"true\"><use xmlns:xlink=\"http://www.w3.org/1999/xlink\" xlink:href=\"#uw-symbol-$key\"></use></svg></a></li>";
          }
        }

        $output .= '</ul></li>';
      }
      $output .= '</ul>
      </div>';
    }

    /**
     * Filter the footer contact info output markup
     *
     * @param string $output Markup generated be default
     * @param Array void The email, phone and social links theme options
     * as set in the Customizer.
     */
    $output = apply_filters( 'uwmadison_footer_contacts', $output, array('email' => $uwmadison_email, 'phone' => $uwmadison_phone, 'social' => $uwmadison_social) );
    return $output;
  }
endif;

/**
 * Helper function to test if we have meaningful data in the social links customizer options
 *
 * @param Array $uwmadison_social social links array returned form theme options
 * @return boolean
 **/
function no_social_links($uwmadison_social) {
  if ( empty($uwmadison_social) ) {
    return true;
  } else {
    foreach ($uwmadison_social as $key => $value) {
      if ( !empty($value)) {
        return false;
      }
    }
    return true;
  }
}


if ( ! function_exists( 'uwmadison_comment' ) ) :
  /**
   * Prints an individual comment.
   *
   * To override this in a child theme without modifying the comments template
   * simply create your own uwmadison_comment(), and that function will be used instead.
   *
   * Used as a callback by wp_list_comments() for displaying the comments.
   *
   * @param WP_Comment $comment The comment instance
   * @param Array $args Arguments array for comment_reply_link()
   * @param Integer $depth 
   */
  function uwmadison_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    switch ( $comment->comment_type ) :
      case 'pingback' :
      case 'trackback' :
    ?>
    <li class="post pingback">
      <p><?php _e( 'Pingback:', 'uw-madison-160' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'uw-madison-160' ), '<span class="edit-link">', '</span>' ); ?></p>
    <?php
        break;
      default :
    ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
      <article id="comment-<?php comment_ID(); ?>" class="comment">
        <footer class="comment-meta">
          <div class="comment-author vcard">
            <?php
              $avatar_size = 68;
              if ( '0' != $comment->comment_parent )
                $avatar_size = 39;

              echo get_avatar( $comment, $avatar_size );

              /* translators: 1: comment author, 2: date and time */
              printf( __( '%1$s on %2$s <span class="says">said:</span>', 'uw-madison-160' ),
                sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
                sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
                  esc_url( get_comment_link( $comment->comment_ID ) ),
                  get_comment_time( 'c' ),
                  /* translators: 1: date, 2: time */
                  sprintf( __( '%1$s at %2$s', 'uw-madison-160' ), get_comment_date(), get_comment_time() )
                )
              );
            ?>

            <?php edit_comment_link( __( 'Edit', 'uw-madison-160' ), '<span class="edit-link">', '</span>' ); ?>
          </div><!-- .comment-author .vcard -->

          <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'uw-madison-160' ); ?></em>
            <br />
          <?php endif; ?>

        </footer>

        <div class="comment-content"><?php comment_text(); ?></div>

        <div class="reply">
          <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'uw-madison-160' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </div><!-- .reply -->
      </article><!-- #comment-## -->

    <?php
        break;
    endswitch;
  }
endif; // ends check for uwmadison_comment()


if ( ! function_exists( 'uwmadison_posted_on' ) ) :
  /**
   * Prints HTML with meta information for the current post-date/time and author.
   * Create your own uwmadison_posted_on to override in a child theme
   *
   */
  function uwmadison_posted_on() {
    printf( __( '<span class="sep">Posted on </span><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></span></span>', 'uw-madison-160' ),
      esc_url( get_permalink() ),
      esc_attr( get_the_time() ),
      esc_attr( get_the_date( 'c' ) ),
      esc_html( get_the_date() ),
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', 'uw-madison-160' ), get_the_author() ) ),
      get_the_author()
    );
  }
endif;