<?php
/**
 * Navigation
 *
 * @package 	DCS
 * @author  	Kate Amann
 * @since  		1.0.0
 * @license 	GPL-2.0+
 */

// Primary Nav in Header
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 11 );

// Secondary Nav in Footer.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 10 );

add_filter( 'wp_nav_menu_args', 'dcs_secondary_menu_args' );
/**
 * Reduces secondary navigation menu to one level depth.
 *
 * @since 2.2.3
 *
 * @param array $args Original menu options.
 * @return array Menu options with depth set to 1.
 */
function dcs_secondary_menu_args( $args ) {

	if ( 'secondary' !== $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;
	return $args;

}

// Removes output of primary navigation right extras.
// remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
// remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );


/**
 * Mobile Menu Toggle
 *
 */
function dcs_mobile_menu_toggle() {

	if( ! has_nav_menu( 'mobile' ) )
		return;

    echo '<div class="nav-mobile">';
	echo '<a class="mobile-menu-toggle" href="#">' . ea_icon( 'menu' ) . '</a>';
	echo '</div>';
}
// add_action( 'genesis_header', 'dcs_mobile_menu_toggle', 12 );

/**
 * Mobile Menu
 *
 */
function dcs_mobile_menu() {
  if( has_nav_menu( 'mobile' ) ) {
    echo '<div id="sidr-mobile-menu" class="sidr right">';
      echo '<a class="sidr-menu-close" href="#">' . ea_icon( 'close' ) . '</a>';
      wp_nav_menu( array( 'theme_location' => 'mobile' ) );
    echo '</div>';
  }
}
// add_action( 'wp_footer', 'dcs_mobile_menu' );



// Responsive menu

/**
 * Defines responsive menu settings.
 *
 * @since 1.0.0
 */
function responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( '<span class="hamburger-box"><span class="hamburger-inner"></span></span>' ),
		'menuIconClass'    => 'hamburger hamburger--elastic',
		'subMenu'          => __( 'Submenu', CHILD_TEXT_DOMAIN ),
		'subMenuIconClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}