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

// Remove secondary nav from header
remove_action( 'genesis_after_header', 'genesis_do_subnav' );

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