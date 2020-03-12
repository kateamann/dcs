<?php
/**
 * Helper Functions
 *
 * @package     DCS
 * @author      Kate Amann
 * @since       1.0.0
 * @license     GPL-2.0+
 */


/**
 * Redirect home after password reset
 */
add_action( "password_reset", "dcs_password_reset", 10, 2 );

/**
 * Implement "password_reset" for RNGS
 *
 * After a password reset has been performed we want the Log in link to redirect the user to the home url.
 * When we see this action being run we know that we should be filtering "login_url" to add the redirect the home page.
 * We don't filter "login_url" any other time. 
 *
 * @param WP_User $user - the user object
 * @param string $new_pass - the new password
 *  
 */
function dcs_password_reset( $user, $new_pass ) {
  add_filter( "login_url", "dcs_login_url", 10, 2 );
}

/**
 *  Implement "login_url" filter for RNGS
 *
 * Redirect the user to the home page after logging in
 *
 * @TODO - make this an option field that controls where the logged in user goes
 * @TODO - dependent upon role?
 * 
 * @param string $login_url - the original login_url which is not expected to include "redirect_to" or "reauth"
 * @param string $redirect - expected to be null/blank
 */
function dcs_login_url( $login_url, $redirect ) {
  $home_redirect = home_url();
  $login_url = add_query_arg('redirect_to', urlencode( $home_redirect ), $login_url);
  return( $login_url );
} 

/**
 * Display partner list by category shortcode
 */
add_shortcode( 'list_partners', 'dcs_partner_list_shortcode' );
function dcs_partner_list_shortcode( $atts ) {
    ob_start();

    extract( shortcode_atts( array (
        'category' => 'expert-partners',
    ), $atts ) );
 
    $options = array(
        'post_type' => 'partners',
        'order' => 'ASC',
        'orderby' => 'title',
        'posts_per_page' => -1,
        'tax_query' => array(
			array(
				'taxonomy' => 'our-partners',
				'field'    => 'slug',
				'terms'    => $category,
			),
		),
    );
    $query = new WP_Query( $options );

    if ( $query->have_posts() ) { ?>
        <ul class="partner-list two-column-list">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <li class="post-<?php the_ID(); ?>">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </ul>
    <?php $partner_list = ob_get_clean();
    return $partner_list;
    }
}

/**
 * Display partner logos shortcode
 */
add_shortcode( 'partner_logos', 'dcs_partner_logos_shortcode' );
function dcs_partner_logos_shortcode( $atts ) {
    ob_start();
 
    $query = new WP_Query( array(
        'post_type' => 'partners',
        'order' => 'ASC',
        'orderby' => 'title',
        'posts_per_page' => -1,
    ) );

    if ( $query->have_posts() ) { ?>
        <section class="partner-logos clearfix">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="logo post-<?php the_ID(); ?>">
                <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'medium' );?>
                </a>
            </div>
            <?php endwhile;
            wp_reset_postdata(); ?>
        </section>
    <?php $partner_logos = ob_get_clean();
    return $partner_logos;
    }
}


// Add author name to post meta
add_filter( 'genesis_post_info', 'add_post_author_name' );
function add_post_author_name($post_info) {
    $post_info = '[post_date] [post_author_name]';
    if ( is_singular('post') ) {
        $post_info = '[post_date] [post_author_name] [post_categories sep=", " before="Posted Under: "]';
    }

    return $post_info;
}


/**
 * Author name shortcode
 */
add_shortcode( 'post_author_name', 'get_post_author_name' );
function get_post_author_name ($atts){

    global $post;
    $post_author = get_field('post_author');

    if ( $post_author ) {
        $post = $post_author;
        setup_postdata( $post );

        $writer = get_field('post_author', $post_author->ID); 
        $person_name = get_the_title($writer); 

        wp_reset_postdata();
        return 'by ' . $person_name;
    }
}


// Replace the default password change email subject
add_filter('password_change_email', 'dcs_change_password_mail_subject', 10, 3);
function dcs_change_password_mail_subject( $pass_change_email, $user, $userdata ) {
    // Call Change Email to HTML function
    add_filter( 'wp_mail_content_type', 'set_email_html_content_type' );
    $pass_change_email[ 'subject' ] = 'Your DCS eLearning password was changed';

    return $pass_change_email;
}


/**
 * Move Yoast to the Bottom
 */
function yoast_to_bottom() {
  return 'low';
}
add_filter( 'wpseo_metabox_prio', 'yoast_to_bottom');